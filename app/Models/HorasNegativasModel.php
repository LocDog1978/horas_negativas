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
}
