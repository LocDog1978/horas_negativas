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
		$numeroDocumento        = $info['numeroDocumento'];
		$de                     = $info['de'];
		$para                   = $info['para'];
		$dia_inicial            = $info['intervaloDias']['dia_inicial'];
		$dia_final              = $info['intervaloDias']['dia_final'];
		$mes_inicial_extenso    = $info['intervaloDias']['mes_inicial_extenso'];
		$mes_final_extenso      = $info['intervaloDias']['mes_final_extenso'];
		$dia_inicial_ajustado   = $info['diaInicialAjustado'];
		$dia_final_ajustado		= $info['diaFinalAjustado'];
		// Iniciar tabela com cabeçalho
		$tabela = '
		<div style="text-align: left;">
			<br>
			<b>CI UERJ / DISEG - CAMPI Nº ' . htmlspecialchars($numeroDocumento) . '</b>
			<p><b>DE: ' . htmlspecialchars($de) . '</b></p>
			<p><b>PARA: ' . htmlspecialchars($para) . '</b></p>
			<br>
		</div>
		<div style="text-align: center;">
				<p><b>HORAS NEGATIVAS REFERENTES AOS MESES '. mb_strtoupper($mes_inicial_extenso, 'UTF-8') . '/' . mb_strtoupper($mes_final_extenso, 'UTF-8') .' DO DIA '.$dia_inicial_ajustado.' À '.$dia_final_ajustado.'</b></p>
			</div><br>
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

		// Adicionar observações
		if (!empty($info['observacoes'])) {
			$tabela .= "<br>".str_repeat("&nbsp;", 10)."<i>Observações: " . htmlspecialchars($info['observacoes']) . "</i>";
		}
		$tabela .= '
			<div style="position: absolute; bottom: 130px; left: 40%; transform: translate(-50%, 0); text-align: center;">
				<table style="border-collapse: collapse; text-align: center; font-size: 12px;">
					<tr>
						<td>Andréa Travassos Rocha</td>
					</tr>
					<tr>
						<td>Chefe do DISEG-CAMPI</td>
					</tr>
					<tr>
						<td>Matrícula 34012-5 / ID 607902-4</td>
					</tr>
				</table>
			</div>';
		return $tabela;
	}

	public function setPag2($info) {
	$dia_inicial            = $info['intervaloDias']['dia_inicial'];
	$dia_final              = $info['intervaloDias']['dia_final'];
	$mes_inicial_extenso    = $info['intervaloDias']['mes_inicial_extenso'];
	$mes_final_extenso      = $info['intervaloDias']['mes_final_extenso'];
	$dia_inicial_ajustado   = $info['diaInicialAjustado'];
	$dia_final_ajustado		= $info['diaFinalAjustado'];

	// Iniciar tabela com cabeçalho
	$tabela = str_repeat("<br>", 3);
	$tabela .= '
	<div style="text-align: center;">
		<p><b>JUSTIFICATIVAS REFERENTES AOS MESES '. mb_strtoupper($mes_inicial_extenso, 'UTF-8') . '/' . mb_strtoupper($mes_final_extenso, 'UTF-8') .' DO DIA '.$dia_inicial_ajustado.' À '.$dia_final_ajustado.'</b></p>
	</div>
	<div style="text-align: center;">
		<table id="tabelaDados" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
			<thead>
				<tr style="text-align: center; vertical-align: middle; border: 1px solid black;">
					<th style="border: 1px solid black; width: 20%;">POSTOS</th>
					<th style="border: 1px solid black; width: 20%;">DATA</th>
					<th style="border: 1px solid black; width: 60%;">JUSTIFICATIVAS</th>
				</tr>
			</thead>
			<tbody>';

	// Verificar se há justificativas para exibir
	$justificativasEncontradas = false;

	// Preencher tabela com dados
	foreach ($info['justificativaPeriodo'] as $postoData) {
		$posto = htmlspecialchars($postoData['posto']);
		$justificativas = array_filter($postoData['justificativas'], function($j) {
			return !empty($j->justificativa);
		});
		$rowspan = count($justificativas);

		if ($rowspan > 0) {
			$justificativasEncontradas = true;

			// Exibir a primeira linha com o rowspan
			$primeiraJustificativa = array_shift($justificativas);
			$tabela .= '
			<tr>
				<td style="border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="' . $rowspan . '">' . $posto . '</td>
				<td style="border: 1px solid black; text-align: center; vertical-align: middle;">' . date('d/m/Y', strtotime($primeiraJustificativa->data)) . '</td>
				<td style="border: 1px solid black; text-align: center; vertical-align: middle;">' . htmlspecialchars($primeiraJustificativa->justificativa) . '</td>
			</tr>';

			// Exibir as demais linhas para o posto sem o posto (sem rowspan)
			foreach ($justificativas as $justificativa) {
				$tabela .= '
				<tr>
					<td style="border: 1px solid black; text-align: center; vertical-align: middle;">' . date('d/m/Y', strtotime($justificativa->data)) . '</td>
					<td style="border: 1px solid black; text-align: center; vertical-align: middle;">' . htmlspecialchars($justificativa->justificativa) . '</td>
				</tr>';
			}
		}
	}

	if (!$justificativasEncontradas) {
		$tabela .= '
		<tr>
			<td colspan="3" style="border: 1px solid black; text-align: center; vertical-align: middle;">Sem justificativas lançadas no período.</td>
		</tr>';
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
		$mes = $this->request->getGet('mes') ?? date('n');
		$ano = $this->request->getGet('ano') ?? date('Y');
		$intervaloDias = intervalo_dias_formatado($mes, $ano);
		$somatorioPeriodo = $this->horasNegativasModel->somatorioPeriodo($mes, $ano);
		$justificativasPeriodo = $this->horasNegativasModel->getJustificativasPeriodo($mes, $ano);

		$numeroDocumento = $this->request->getGet('documentNumber');
		$de = $this->request->getGet('de');
		$para = $this->request->getGet('para');
		$observacoes = $this->request->getGet('observacoes');

		// Função para ajustar o mês e ano, somando 1 ao mês
		function ajustarMesAno($data)
		{
			$partes = explode('/', $data);
			$dia = $partes[0];
			$mes = intval($partes[1]);
			$ano = intval($partes[2]);

			$mes++;
			if ($mes > 12) {
				$mes = 1;
				$ano++;
			}

			return sprintf('%02d/%02d/%04d', $dia, $mes, $ano);
		}

		// Ajustar os dias inicial e final com incremento de mês
		$diaInicial = $this->request->getGet('dia_inicial') ?? '25/11/2024';
		$diaFinal = $this->request->getGet('dia_final') ?? '24/12/2024';

		$diaInicialAjustado = ajustarMesAno($diaInicial);
		$diaFinalAjustado = ajustarMesAno($diaFinal);

		$info = [
			'intervaloDias'           => $intervaloDias,
			'somatorioPeriodo'        => $somatorioPeriodo,
			'numeroDocumento'         => $numeroDocumento,
			'de'                      => $de,
			'para'                    => $para,
			'observacoes'             => $observacoes,
			'justificativaPeriodo'    => $justificativasPeriodo,
			'diaInicialAjustado'      => $diaInicialAjustado,
			'diaFinalAjustado'        => $diaFinalAjustado
		];

		$this->response->setHeader('Content-Type', 'application/pdf');

		$mpdf = new \Mpdf\Mpdf(
			[
				'mode' => 'utf-8',
				'format' => 'A4-P',
				'margin_top' => 61,
				'margin_bottom' => 34,
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

		$mpdf->AddPage();
		$mpdf->WriteHTML($this->setPag2($info));

		$filename = "{$mes_inicial}_{$ano_inicial}-{$mes_final}_{$ano_final}.pdf";
		$mpdf->Output($filename, "I"); // Alterado para "I" para abrir no navegador
	}
}
