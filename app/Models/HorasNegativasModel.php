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
        }

    }
}
