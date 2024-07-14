<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\LogAlteracoesModel;
use App\Models\HorasNegativasModel;
use \Mpdf\Mpdf;

class RelatorioController extends BaseController
{
    protected $userModel;
    protected $currentUser;
    protected $logAlteracoes;
    protected $horasNegativasModel;

    public function __construct()
    {
        $this->userModel = new UsuarioModel();
        $this->currentUser = $this->userModel->getUserData(session()->userID);
        $this->horasNegativasModel = new HorasNegativasModel();
        require_once ROOTPATH . '/vendor/autoload.php';
    }

    public function setHeader($info) {
        $logo = ROOTPATH . "assets\\images\\logo.svg";

        $dia_inicial            = $info['intervaloDias']['dia_inicial'];
        $dia_final              = $info['intervaloDias']['dia_final'];
        $mes_inicial_extenso    = $info['intervaloDias']['mes_inicial_extenso'];
        $mes_final_extenso      = $info['intervaloDias']['mes_final_extenso'];
        $numeroDocumento        = $info['numeroDocumento'];
        $de                     = $info['de'];
        $para                   = $info['para'];

        // Configurar a formatação da data
        $formatter = new \IntlDateFormatter(
            'pt_BR',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'America/Sao_Paulo',
            \IntlDateFormatter::GREGORIAN,
            'd \'de\' MMMM \'de\' yyyy'
        );
        $dataAtual = $formatter->format(new \DateTime());

        return '
            <div style="text-align: center;">
                <img src="' . $logo . '" width="50">
                <p>Governo do Estado do Rio de Janeiro</p>
                <p>Secretaria de Estado de Ciência e Tecnologia</p>
                <p>Universidade do Estado do Rio de Janeiro</p>
                <p>Divisão de Segurança/UERJ-Campi</p>
                <hr>
            </div>
            <div style="text-align: right;">
                <p>Rio de Janeiro, ' . $dataAtual . '</p>
            </div>
            <div style="text-align: left;">
                <br>
                <b>CI UERJ / DISEG - CAMPI Nº ' . htmlspecialchars($numeroDocumento) . '</b>
                <p><b>DE: ' . htmlspecialchars($de) . '</b></p>
                <p><b>PARA: ' . htmlspecialchars($para) . '</b></p>
                <br>
            </div>
            <div style="text-align: center;">
                <p><b>HORAS NEGATIVAS REFERENTE AO MÊS '. strtoupper($mes_inicial_extenso) .'/'. strtoupper($mes_final_extenso) .' DO DIA '.$dia_inicial.' À '.$dia_final.'</b></p>
            </div>';
    }

    public function setFooter() {
        return '<hr>
            <table width="100%" style="font-size: 11px;">
                <tr>
                    <td width="33%">Impresso em {DATE j/m/Y à\s H:i:s}<br> Desenvolvido por Diogo Vicente e Leandro Carlos</td>
                    <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                    <td width="33%" style="text-align: right;">Sistema de Horas Negativas</td>
                </tr>
            </table>';
    }

    public function setPag1($info) {
        // Iniciar tabela com cabeçalho
        $tabela = '
            <div style="text-align: center;">
                <table id="tabelaDados" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                    <thead>
                        <tr style="text-align: center; vertical-align: middle; border: 1px solid black;">
                            <th style="border: 1px solid black;">POSTOS</th>
                            <th style="border: 1px solid black;">HORAS DIURNAS</th>
                            <th style="border: 1px solid black;">HORAS NOTURNAS</th>
                            <th style="border: 1px solid black;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>';

        // Preencher tabela com dados
        foreach ($info['somatorioPeriodo'] as $somatorio) {
            $total = isset($somatorio['total']) ? $somatorio['total'] : ($somatorio['diurno'] + $somatorio['noturno']);
            $posto = htmlspecialchars($somatorio['posto']);
            if ($posto != "TOTAL") {
                $tabela .= '
                    <tr>
                        <td style="border: 1px solid black;">' . $posto . '</td>
                        <td style="border: 1px solid black; text-align: center; vertical-align: middle;">' . number_format(htmlspecialchars($somatorio['diurno']), 0, ",", ".") . '</td>
                        <td style="border: 1px solid black; text-align: center; vertical-align: middle;">' . number_format(htmlspecialchars($somatorio['noturno']), 0, ",", ".") . '</td>
                        <td style="border: 1px solid black; text-align: center; vertical-align: middle;">' . number_format($total, 0, ",", ".") . '</td>
                    </tr>';
            } else {
                $tabela .= '
                    <tr>
                        <td style="border: 1px solid black;"><b>' . $posto . '</b></td>
                        <td style="border: 1px solid black; text-align: center; vertical-align: middle;"><b>' . number_format(htmlspecialchars($somatorio['diurno']), 0, ",", ".") . '</b></td>
                        <td style="border: 1px solid black; text-align: center; vertical-align: middle;"><b>' . number_format(htmlspecialchars($somatorio['noturno']), 0, ",", ".") . '</b></td>
                        <td style="border: 1px solid black; text-align: center; vertical-align: middle;"><b>' . number_format($total, 0, ",", ".") . '</b></td>
                    </tr>';
            }
        }

        // Fechar tabela
        $tabela .= '
                    </tbody>
                </table>
            </div>';
        return $tabela;
    }

    public function index()
	{
	    helper('data_helper');
	    $intervaloDias = intervalo_dias_formatado();
	    $somatorioPeriodo = $this->horasNegativasModel->somatorioPeriodo();

	    $numeroDocumento = $this->request->getGet('documentNumber');
	    $de = $this->request->getGet('de');
	    $para = $this->request->getGet('para');

	    $info = [
	        'intervaloDias'     =>  $intervaloDias,
	        'somatorioPeriodo'  =>  $somatorioPeriodo,
	        'numeroDocumento'   =>  $numeroDocumento,
	        'de'                =>  $de,
	        'para'              =>  $para
	    ];

	    $this->response->setHeader('Content-Type', 'application/pdf');

	    $mpdf = new \Mpdf\Mpdf(
	        [
	            'mode' => 'utf-8',
	            'format' => 'A4-P',
	            'margin_top' => 110, // Ajuste a margem superior para dar espaço ao cabeçalho
	            'margin_bottom' => 30,
	            'default_font_size' => 8
	        ]
	    );

	    $mpdf->SetHTMLHeader($this->setHeader($info));
	    $mpdf->SetHTMLFooter($this->setFooter());

	    $mpdf->WriteHTML($this->setPag1($info));

	    $mes_inicial = strtolower($intervaloDias['mes_inicial_extenso']);
	    $mes_final = strtolower($intervaloDias['mes_final_extenso']);
	    $ano_inicial = date('Y', strtotime(str_replace('/', '-', $intervaloDias['dia_inicial'])));
	    $ano_final = date('Y', strtotime(str_replace('/', '-', $intervaloDias['dia_final'])));

	    $filename = "{$mes_inicial}_{$ano_inicial}-{$mes_final}_{$ano_final}.pdf";
	    $mpdf->Output($filename, "I"); // Alterado para "I" para abrir no navegador
	}
}
