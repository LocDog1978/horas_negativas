<?php
namespace App\Models;

use CodeIgniter\Model;

class HorasNegativasModel extends Model
{
	protected $table = 'horas_negativas';
	protected $primaryKey = 'id';
	protected $allowedFields = ['fk_local', 'diurno', 'noturno', 'data', 'justificativa'];
	protected $returnType = 'object';

	public function __construct()
	{
		parent::__construct();
		helper('data');
	}

	public function getHorasNegativasByPostoData($posto, $data)
	{
		return $this->select('diurno, noturno, justificativa')
					->where('fk_local', $posto)
					->where('data', $data)
					->first();
	}

	public function saveHoras($dados, $postoID)
	{
		$sum_diurno = 0;
		$sum_noturno = 0;

		foreach ($dados as $item) {
			$data_invisivel = $item['data_invisivel'];
			$diurno = $item['diurno'];
			$noturno = $item['noturno'];
			$justificativa = $item['justificativa'];

			// Converter os tempos para minutos usando o helper
			$diurno_min = timeToMinutes($diurno);
			$noturno_min = timeToMinutes($noturno);

			// Buscar registro existente
			$existingRecord = $this->where('data', $data_invisivel)
								   ->where('fk_local', $postoID)
								   ->first();

			if ($existingRecord) {
				// Atualiza o registro existente
				$this->update($existingRecord->id, [
					'diurno' => empty($diurno) ? NULL : $diurno,
					'noturno' => empty($noturno) ? NULL : $noturno,
					'justificativa' => empty($justificativa) ? NULL : $justificativa,
				]);
			} else {
				// Insere um novo registro
				$this->insert([
					'data' => $data_invisivel,
					'diurno' => empty($diurno) ? NULL : $diurno,
					'noturno' => empty($noturno) ? NULL : $noturno,
					'fk_local' => $postoID,
					'justificativa' => empty($justificativa) ? NULL : $justificativa,
				]);
			}

			// Somar os tempos
			$sum_diurno += $diurno_min;
			$sum_noturno += $noturno_min;
		}

		return [
			'sum_diurno' => minutesToTime($sum_diurno),
			'sum_noturno' => minutesToTime($sum_noturno),
			'total_sum' => minutesToTime($sum_diurno + $sum_noturno),
		];
	}

	public function sumHorasDiurnas($postoID, $periodo)
	{
		$soma = $this->selectSum('diurno')
					 ->where('fk_local', $postoID)
					 ->whereIn('data', $periodo)
					 ->first();

		return timeToMinutes($soma->diurno ?? '00:00');
	}

	public function sumHorasNoturnas($postoID, $periodo)
	{
		$soma = $this->selectSum('noturno')
					 ->where('fk_local', $postoID)
					 ->whereIn('data', $periodo)
					 ->first();

		return timeToMinutes($soma->noturno ?? '00:00');
	}

	public function somatorioPeriodo($mes = null, $ano = null)
	{
	    if (is_null($mes)) {
	        $mes = date('m');
	    }
	    if (is_null($ano)) {
	        $ano = date('Y');
	    }

	    $postosModel = new PostosModel();
	    $postos = $postosModel->getAlldata();

	    // Ajusta o ano e o mês seguinte
	    if ($mes == 12) {
	        $mesSeguinte = 1;
	        $anoSeguinte = $ano + 1;
	    } else {
	        $mesSeguinte = $mes + 1;
	        $anoSeguinte = $ano;
	    }

	    $startDate = date('Y-m-d', strtotime("$ano-$mes-25"));
	    $endDate = date('Y-m-d', strtotime("$anoSeguinte-$mesSeguinte-24"));

	    $resultados = [];
	    $totalDiurno = 0;
	    $totalNoturno = 0;

	    foreach ($postos as $posto) {
	        // Busca todos os registros individuais do período para somar corretamente os minutos
	        $horas = $this->select('diurno, noturno')
	                      ->where('fk_local', $posto->id)
	                      ->where('data >=', $startDate)
	                      ->where('data <=', $endDate)
	                      ->findAll();

	        $diurnoTotalMin = 0;
	        $noturnoTotalMin = 0;

	        foreach ($horas as $hora) {
	            $diurnoTotalMin += timeToMinutes($hora->diurno ?? '00:00');
	            $noturnoTotalMin += timeToMinutes($hora->noturno ?? '00:00');
	        }

	        // Adiciona os resultados já convertidos corretamente
	        $resultados[] = [
	            'posto' => $posto->nome,
	            'diurno' => minutesToTime($diurnoTotalMin),
	            'noturno' => minutesToTime($noturnoTotalMin),
	        ];

	        // Soma total para exibir no final
	        $totalDiurno += $diurnoTotalMin;
	        $totalNoturno += $noturnoTotalMin;
	    }

	    // Adiciona linha TOTAL
	    $resultados[] = [
	        'posto' => 'TOTAL',
	        'diurno' => minutesToTime($totalDiurno),
	        'noturno' => minutesToTime($totalNoturno),
	    ];

	    return $resultados;
	}

	public function getJustificativasPeriodo($mes = null, $ano = null)
	{
		if (is_null($mes)) {
			$mes = date('m');
		}
		if (is_null($ano)) {
			$ano = date('Y');
		}

		$postosModel = new PostosModel();
		$postos = $postosModel->getAlldata();

		if ($mes == 12) {
			$mesSeguinte = 1;
			$anoSeguinte = $ano + 1;
		} else {
			$mesSeguinte = $mes + 1;
			$anoSeguinte = $ano;
		}

		$startDate = date('Y-m-d', strtotime("$ano-$mes-25"));
		$endDate = date('Y-m-d', strtotime("$anoSeguinte-$mesSeguinte-24"));

		$resultados = [];

		foreach ($postos as $posto) {
			$justificativas = $this->select('data, justificativa')
								   ->where('fk_local', $posto->id)
								   ->where('data >=', $startDate)
								   ->where('data <=', $endDate)
								   ->findAll();

			$resultados[] = [
				'posto' => $posto->nome,
				'justificativas' => $justificativas,
			];
		}

		return $resultados;
	}
}
