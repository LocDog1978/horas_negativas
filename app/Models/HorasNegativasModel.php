<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PostosModel;

class HorasNegativasModel extends Model
{
	protected $table            = 'horas_negativas';
	protected $primaryKey       = 'id';
	protected $allowedFields    = ['fk_local', 'diurno', 'noturno', 'data'];
	protected $returnType       = 'object';

	public function getHorasNegativasByPostoData($posto, $data)
	{
		return $this->select('diurno, noturno')
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

			// Verificar se já existe um registro com a mesma data_invisivel e fk_local
			$existingRecord = $this->where('data', $data_invisivel)
								   ->where('fk_local', $postoID)
								   ->first();

			if ($existingRecord) {
				// Se existir, faz um UPDATE
				$this->update($existingRecord->id, [
					'diurno' => $diurno == "" ? NULL : $diurno,
					'noturno' => $noturno == "" ? NULL : $noturno,
				]);
			} else {
				// Se não existir, faz um INSERT
				$this->insert([
					'data' => $data_invisivel,
					'diurno' => $diurno == "" ? NULL : $diurno,
					'noturno' => $noturno == "" ? NULL : $noturno,
					'fk_local' => $postoID,
				]);
			}
			$sum_diurno += intval($diurno);
			$sum_noturno += intval($noturno);
		}

		return [
			'sum_diurno' => $sum_diurno,
			'sum_noturno' => $sum_noturno,
			'total_sum' => $sum_diurno + $sum_noturno,
		];
	}

	public function sumHorasDiurnas($postoID, $periodo)
	{
		$builder = $this->db->table('horas_negativas');
		$builder->selectSum('diurno');
		$builder->where('fk_local', $postoID);
		$builder->whereIn('data', $periodo);
		$query = $builder->get();
		return $query->getRow()->diurno_sum ?? 0;
	}

	public function sumHorasNoturnas($postoID, $periodo)
	{
		$builder = $this->db->table('horas_negativas');
		$builder->selectSum('noturno');
		$builder->where('fk_local', $postoID);
		$builder->whereIn('data', $periodo);
		$query = $builder->get();
		return $query->getRow()->noturno_sum ?? 0;
	}

	public function somatorioPeriodo($mes = null, $ano = null)
	{
		// Usar mês e ano atuais se não forem fornecidos
		if (is_null($mes)) {
			$mes = date('m');
		}
		if (is_null($ano)) {
			$ano = date('Y');
		}

		$postosModel = new PostosModel();
		$postos = $postosModel->getAlldata();

		// Verifica se o mês é 12 para ajustar o ano e o mês seguinte
		if ($mes == 12) {
			$mesSeguinte = 1;
			$anoSeguinte = $ano + 1;
		} else {
			$mesSeguinte = $mes + 1;
			$anoSeguinte = $ano;
		}

		// Definir o intervalo de datas com base na lógica fornecida
		$startDate = date('Y-m-d', strtotime("$ano-$mes-25"));
		$endDate = date('Y-m-d', strtotime("$anoSeguinte-$mesSeguinte-24"));

		$resultados = [];
		$totalDiurno = 0;
		$totalNoturno = 0;

		foreach ($postos as $posto) {
			$sums = $this->selectSum('diurno')
						 ->selectSum('noturno')
						 ->where('fk_local', $posto->id)
						 ->where('data >=', $startDate)
						 ->where('data <=', $endDate)
						 ->first();

			$diurnoSum = $sums->diurno ?? 0;
			$noturnoSum = $sums->noturno ?? 0;

			$resultados[] = [
				'posto' => $posto->nome,
				'diurno' => $diurnoSum,
				'noturno' => $noturnoSum,
			];

			$totalDiurno += $diurnoSum;
			$totalNoturno += $noturnoSum;
		}

		$resultados[] = [
			'posto' => 'TOTAL',
			'diurno' => $totalDiurno,
			'noturno' => $totalNoturno,
		];

		return $resultados;
	}

}
