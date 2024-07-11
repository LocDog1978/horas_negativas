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
