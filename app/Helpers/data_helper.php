<?php

if (!function_exists('dias_entre_datas')) {
    function dias_entre_datas($mes, $ano) {
        // Verifica se o mês é 12 para ajustar o ano e o mês seguinte
        if ($mes == 12) {
            $mesSeguinte = 1;
            $anoSeguinte = $ano + 1;
        } else {
            $mesSeguinte = $mes + 1;
            $anoSeguinte = $ano;
        }

        // Definir as datas de início e fim
        $dataInicio = DateTime::createFromFormat('Y-m-d', "$ano-$mes-25");
        $dataFim = DateTime::createFromFormat('Y-m-d', "$anoSeguinte-$mesSeguinte-24");

        // Inicializar o array de dias
        $dias = [];

        // Iterar sobre o período e adicionar cada dia ao array
        $periodo = new DatePeriod($dataInicio, new DateInterval('P1D'), $dataFim);
        foreach ($periodo as $data) {
            $dias[] = $data->format('Y-m-d');
        }

        // Adicionar o último dia (dataFim) ao array
        $dias[] = $dataFim->format('Y-m-d');

        return $dias;
    }
}

if (!function_exists('intervalo_dias_formatado')) {
    function intervalo_dias_formatado() {
        $currentDate = date('Y-m-d'); // Data atual
        $day = date('d'); // Dia do mês atual
        $month = date('m'); // Mês atual
        $year = date('Y'); // Ano atual

        // Definir o intervalo de datas com base na lógica fornecida
        if ($day >= 25) {
            $startDate = DateTime::createFromFormat('Y-m-d', "$year-$month-25");
            $endDate = DateTime::createFromFormat('Y-m-d', "$year-$month-24");
            $endDate->modify('+1 month');
        } else {
            $startDate = DateTime::createFromFormat('Y-m-d', "$year-$month-25");
            $startDate->modify('-1 month');
            $endDate = DateTime::createFromFormat('Y-m-d', "$year-$month-24");
        }

        // Formatar as datas no formato dd/mm/YYYY
        $dia_inicial = $startDate->format('d/m/Y');
        $dia_final = $endDate->format('d/m/Y');

        return [
            'dia_inicial' => $dia_inicial,
            'dia_final' => $dia_final
        ];
    }
}