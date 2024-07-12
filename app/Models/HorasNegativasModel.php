<?php

namespace App\Models;

use CodeIgniter\Model;

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

}
