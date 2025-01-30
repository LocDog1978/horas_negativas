<?php
if (!function_exists('dias_entre_datas')) {
	function dias_entre_datas($mes, $ano) {
		if ($mes == 12) {
			$mesSeguinte = 1;
			$anoSeguinte = $ano + 1;
		} else {
			$mesSeguinte = $mes + 1;
			$anoSeguinte = $ano;
		}

		$dataInicio = DateTime::createFromFormat('Y-m-d', "$ano-$mes-25");
		$dataFim = DateTime::createFromFormat('Y-m-d', "$anoSeguinte-$mesSeguinte-24");

		$dias = [];
		$periodo = new DatePeriod($dataInicio, new DateInterval('P1D'), $dataFim);
		foreach ($periodo as $data) {
			$dias[] = $data->format('Y-m-d');
		}
		$dias[] = $dataFim->format('Y-m-d');

		return $dias;
	}
}

if (!function_exists('intervalo_dias_formatado')) {
	function intervalo_dias_formatado($mes = null, $ano = null) {
		if (is_null($mes)) {
			$mes = date('m');
		}
		if (is_null($ano)) {
			$ano = date('Y');
		}

		if ($mes == 12) {
			$mesSeguinte = 1;
			$anoSeguinte = $ano + 1;
		} else {
			$mesSeguinte = $mes + 1;
			$anoSeguinte = $ano;
		}

		$day = date('d');

		if ($day >= 25) {
			$startDate = DateTime::createFromFormat('Y-m-d', "$ano-$mes-25");
			$endDate = DateTime::createFromFormat('Y-m-d', "$anoSeguinte-$mesSeguinte-24");
		} else {
			$startDate = DateTime::createFromFormat('Y-m-d', "$ano-$mes-25");
			$startDate->modify('-1 month');
			$endDate = DateTime::createFromFormat('Y-m-d', "$ano-$mes-24");
		}

		$dia_inicial = $startDate->format('d/m/Y');
		$dia_final = $endDate->format('d/m/Y');

		$meses_portugues = [
			1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março',
			4 => 'Abril', 5 => 'Maio', 6 => 'Junho',
			7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro',
			10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
		];

		$mes_inicial_extenso = $meses_portugues[intval($mes)];
		$mes_final_extenso = $meses_portugues[intval($mesSeguinte)];

		if ($startDate->format('Y') != $endDate->format('Y')) {
			$mes_final_extenso .= ' ' . $endDate->format('Y');
		}

		return [
			'dia_inicial' => $dia_inicial,
			'dia_final' => $dia_final,
			'mes_inicial_extenso' => $mes_inicial_extenso,
			'mes_final_extenso' => $mes_final_extenso
		];
	}
}

if (!function_exists('get_meses_portugues')) {
    function get_meses_portugues() {
        return [
            1 => 'JANEIRO', 2 => 'FEVEREIRO', 3 => 'MARÇO',
            4 => 'ABRIL', 5 => 'MAIO', 6 => 'JUNHO',
            7 => 'JULHO', 8 => 'AGOSTO', 9 => 'SETEMBRO',
            10 => 'OUTUBRO', 11 => 'NOVEMBRO', 12 => 'DEZEMBRO'
        ];
    }
}

if (!function_exists('get_years')) {
    function get_years() {
        $startYear = 2024;
        $currentYear = date('Y');
        $currentMonth = date('n');

        $years = [];
        for ($year = $startYear; $year <= $currentYear; $year++) {
            $years[] = $year;
        }

        if ($currentMonth == 12) {
            $years[] = $currentYear + 1;
        }

        return $years;
    }
}

if (!function_exists('timeToMinutes')) {
    /**
     * Converte um tempo no formato HH:MM para minutos inteiros.
     */
    function timeToMinutes($time)
    {
        if (empty($time) || strpos($time, ':') === false) {
            return 0; // Retorna 0 se a string estiver vazia ou sem ":"
        }

        list($h, $m) = explode(':', $time);

        return ((int)$h * 60) + (int)$m;
    }
}

if (!function_exists('minutesToTime')) {
    /**
     * Converte minutos inteiros para o formato HH:MM.
     */
    function minutesToTime($minutes)
    {
        if (!is_numeric($minutes) || $minutes < 0) {
            return '00:00'; // Evita erros caso um valor inválido seja passado
        }

        $h = floor($minutes / 60);
        $m = $minutes % 60;

        return sprintf('%02d:%02d', $h, $m);
    }
}
