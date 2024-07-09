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

    public function getIntervalo($posto, $data)
    {
        $input_date = strtotime($data);
        $day = date('j', $input_date);

        // Calcular o intervalo de datas
        if ($day >= 25) {
            $start_date = date('Y-m-25', $input_date);
            $end_date = date('Y-m-24', strtotime('+1 month', $input_date));
        } else {
            $start_date = date('Y-m-25', strtotime('-1 month', $input_date));
            $end_date = date('Y-m-24', $input_date);
        }

        $intervalo = $this->select('data, diurno, noturno')
                    ->where('fk_local', $posto)
                    ->where('data >=', $start_date)
                    ->where('data <=', $end_date)
                    ->findAll();

        return $intervalo;
    }
}
