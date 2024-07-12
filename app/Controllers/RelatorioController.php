<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\LogAlteracoesModel;
use \Mpdf\Mpdf;

class RelatorioController extends BaseController
{
	protected $userModel;
	protected $currentUser;
	protected $logAlteracoes;

	public function __construct()
	{
		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
		require_once ROOTPATH . '/vendor/autoload.php';
	}

	public function setHeader() {
		$logo = ROOTPATH . "\\assets\\images\\LOGO PREFEITURA.png";
		return '
			<table width="100%" style="border-collapse: collapse;">
				<tr>
					<td width="100">
						<img src="'.$logo.'" width="170">
					</td>
					<td align="right">
						<p>UERJ - PREFEITURA DOS CAMPI&nbsp;</p>
						<p>Departamento Geral de Segurança</p>
					</td>
				</tr>
			</table>
			<hr>';
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

	/*public function setPag1($info) { // Assinatura
		$pag1 = "<p><b>Evento: <span style='font-size: 14px;'>".$info['nome']."</b></p>";
		$pag1 .= "<table style='border-collapse: collapse;'>";
			$pag1 .= "<tr>";
				$pag1 .= "<td style='padding-right: 40px;'><b>Início:</b> " . $info['data_inicio'] . " às " . $info['hora_inicio'] . "h</td>";
				$pag1 .= "<td><b>Fim:</b> " . $info['data_fim'] . " às " . $info['hora_fim'] . "h</td>";
			$pag1 .= "</tr>";
		$pag1 .= "</table>";

		$pag1 .= "<p><b>Local:</b> ".$info['local'].": " . $info['local_comp'] . "</p>";
		$pag1 .= "<p><b>Solicitante:</b> ".$info['solicitante'] . "</p>";

		$pag1 .= "<table style='width: 100%; border: 1px solid black;'>";
			$pag1 .= "<thead>";
			$pag1 .= "<tr>";
				$pag1 .= "<th height='70' width='300' style='text-align: left;'>NOME</th>";
				$pag1 .= "<th width='80' style='text-align: center;'>MATRÍCULA</th>";
				$pag1 .= "<th width='80' style='text-align: center;'>CPF</th>";
				$pag1 .= "<th width='80' style='text-align: center;'>IDENTIDADE</th>";
				$pag1 .= "<th width='80' style='text-align: center;'>PIS/PASEP</th>";
				$pag1 .= "<th width='80' style='text-align: center;'>CARGO</th>";
				$pag1 .= "<th width='80' style='text-align: center;'>VALOR</th>";
				$pag1 .= "<th width='200' style='text-align: center;'>ASSINATURA</th>";
			$pag1 .= "</tr>";
			$pag1 .= "</thead>";

			$pag1 .="<tbody>";
		foreach ($info['equipe'] as $membro) {
		    $pag1 .= "<tr>";
			    $pag1 .= "<td height='40' style='text-align: left'> $membro->nome </td>";
			    $pag1 .= "<td style='text-align: center'>$membro->matricula</td>";
			    $pag1 .= "<td style='text-align: center'>$membro->cpf</td>";
			    $pag1 .= "<td style='text-align: center'>$membro->rg</td>";
			    $pag1 .= "<td style='text-align: center'>$membro->pis_pasep</td>";
			    $pag1 .= "<td style='text-align: center'>$membro->cargo</td>";
			    $pag1 .= "<td style='text-align: center'>R$ " . number_format($membro->valor, 2, ',', '.') . "</td>";
			    $pag1 .= "<td style='text-align: center'>___________________________________________________</td>";
		    $pag1 .= "</tr>";
		}
			$pag1 .= "</tbody>";
		$pag1 .= "</table>";

		if ($info['uso_talao'] == "Não")
		{
			$pag1 .= "<p style='font-weight: bold;'>SUBSTITUIÇÕES</p>";
				$pag1 .= "<table style='width: 100%; border: 1px solid black;'>";
					$pag1 .= "<tr>";
						$pag1 .= "<th width='33%\' style='text-align: left;'>NOME</th>";
						$pag1 .= "<th style='text-align: left;'>MATRÍCULA</th>";
						$pag1 .= "<th style='text-align: left;'>CPF</th>";
						$pag1 .= "<th style='text-align: left;'>IDENTIDADE</th>";
						$pag1 .= "<th style='text-align: left;'>VALOR</th>";
						$pag1 .= "<th style='text-align: left;'>ASSINATURA</th>";
					$pag1 .= "</tr>";
				$pag1 .= "</table>";
				$pag1 .= "<table style='width: 100%; border: 1px solid black;'>";
					$pag1 .= "<tr style='height: 50px;'>";
						$pag1 .= "<td>&nbsp;<br></td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
					$pag1 .= "</tr>";
				$pag1 .= "</table>";
				$pag1 .= "<table style='width: 100%; border: 1px solid black;'>";
					$pag1 .= "<tr style='height: 50px;'>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
					$pag1 .= "</tr>";
				$pag1 .= "</table>";
				$pag1 .= "<table style='width: 100%; border: 1px solid black;'>";
					$pag1 .= "<tr style='height: 50px;'>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
						$pag1 .= "<td>&nbsp;</td>";
					$pag1 .= "</tr>";
				$pag1 .= "</table>";
				$pag1 .= '<table style="width: 100%;">';
					$pag1 .= '<tr>';
						$pag1 .= '<td style="vertical-align: top;">';
							$pag1 .= '<p>Regras para a substituição em caso de falta:</p>';
							$pag1 .= '<p style="margin-left: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;Só poderá cobrir a lacuna o Agente que estiver saindo do plantão.</p>';
							$pag1 .= '<p style="margin-left: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;Não será admitido deslocar Agente de Segurança de outra Unidade para tal cobertura.</p>';
						$pag1 .= '</td>';
						$pag1 .= '<td style="vertical-align: top; text-align: right;">';
							$pag1 .= '<table style="border-collapse: collapse; width: auto;">';
								$pag1 .= "<tr style='border: 1px solid black;'>";
									$pag1 .= '<td style="border: 1px solid black; text-align: left; width: 150px">Matrícula</td>';
									$pag1 .= '<td style="border: 1px solid black; text-align: left; width: 150px">Assinatura</td>';
								$pag1 .= '</tr>';
								$pag1 .= "<tr style='border: 1px solid black;'>";
									$pag1 .= '<td style="border: 1px solid black;"><br>&nbsp;</td>';
									$pag1 .= '<td style="border: 1px solid black;"><br>&nbsp;</td>';
								$pag1 .= '</tr>';
							$pag1 .= '</table>';

						$pag1 .= '</td>';
					$pag1 .= '</tr>';
				$pag1 .= '</table>';
		}

		return $pag1;
	}

	public function setpag2($info) { // Pagamento
		$pag2 = "<p><b>Evento: <span style='font-size: 14px;'>".$info['nome']."</b></p>";
		$pag2 .= "<table style='border-collapse: collapse;'>";
			$pag2 .= "<tr>";
				$pag2 .= "<td style='padding-right: 40px;'><b>Início:</b> " . $info['data_inicio'] . " às " . $info['hora_inicio'] . "h</td>";
				$pag2 .= "<td><b>Fim:</b> " . $info['data_fim'] . " às " . $info['hora_fim'] . "h</td>";
			$pag2 .= "</tr>";
		$pag2 .= "</table>";

		$pag2 .= "<p><b>Local:</b> ".$info['local'].": " . $info['local_comp'] . "</p>";
		$pag2 .= "<p><b>Solicitante:</b> ".$info['solicitante'] . "</p>";

		$pag2 .= "<table style='width: 100%; border: 1px solid black;'>";
			$pag2 .= "<thead>";
			$pag2 .= "<tr>";
				$pag2 .= "<th height='70' width='300' style='text-align: left;'>NOME</th>";
				$pag2 .= "<th width='80' style='text-align: center;'>MATRICULA</th>";
				$pag2 .= "<th width='80' style='text-align: center;'>CPF</th>";
				$pag2 .= "<th width='80' style='text-align: center;'>IDENTIDADE</th>";
				$pag2 .= "<th width='80' style='text-align: center;'>PIS/PASEP</th>";
				$pag2 .= "<th width='80' style='text-align: center;'>BANCO</th>";
				$pag2 .= "<th width='80' style='text-align: center;'>AGÊNCIA</th>";
				$pag2 .= "<th width='80' style='text-align: center;'>CONTA</th>";
				$pag2 .= "<th width='80' style='text-align: center;'>VALOR</th>";
			$pag2 .= "</tr>";
			$pag2 .= "</thead>";

			$pag2 .="<tbody>";
		foreach ($info['equipe'] as $membro) {

			if ($membro->presenca == 1)
			{
				if ($membro->fk_banco != 0)
					$nomeBanco = $this->bancosModel->getBanco($membro->fk_banco)->banco;
				else
					$nomeBanco = 0;

				$pag2 .= "<tr>";
					$pag2 .= "<td height='40' style='text-align: left'>$membro->nome</td>";
					$pag2 .= "<td style='text-align: center'>$membro->matricula</td>";
					$pag2 .= "<td style='text-align: center'>$membro->cpf</td>";
					$pag2 .= "<td style='text-align: center'>$membro->rg</td>";
					$pag2 .= "<td style='text-align: center'>$membro->pis_pasep</td>";
					$pag2 .= "<td style='text-align: center'>$nomeBanco</td>";
					$pag2 .= "<td style='text-align: center'>$membro->agencia</td>";
					$pag2 .= "<td style='text-align: center'>$membro->conta</td>";
					$pag2 .= "<td style='text-align: center'>R$ " . number_format($membro->valor, 2, ',', '.') . "</td>";
				$pag2 .= "</tr>";
			}

		}
		$pag2 .="</tbody>";
		$pag2 .= "</table>";
		$pag2 .= "<table style='width: 100%; margin-top: 40px; page-break-inside: avoid;'>";
		$pag2 .= "<tr>";
		$pag2 .= "<td>";

			$pag2 .= "<p style='font-weight: bold;'>SUBSTITUIÇÕES</p>";
			$pag2 .= "<table style='width: 100%; border: 1px solid black;'>";
				$pag2 .= "<tr>";
					$pag2 .= "<th width='33%\' style='text-align: left;'>NOME</th>";
					$pag2 .= "<th style='text-align: left;'>MATRÍCULA</th>";
					$pag2 .= "<th style='text-align: left;'>CPF</th>";
					$pag2 .= "<th style='text-align: left;'>IDENTIDADE</th>";
					$pag2 .= "<th style='text-align: left;'>VALOR</th>";
					$pag2 .= "<th style='text-align: left;'>ASSINATURA</th>";
				$pag2 .= "</tr>";
			$pag2 .= "</table>";
			$pag2 .= "<table style='width: 100%; border: 1px solid black;'>";
				$pag2 .= "<tr style='height: 50px;'>";
					$pag2 .= "<td>&nbsp;<br></td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
				$pag2 .= "</tr>";
			$pag2 .= "</table>";
			$pag2 .= "<table style='width: 100%; border: 1px solid black;'>";
				$pag2 .= "<tr style='height: 50px;'>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
				$pag2 .= "</tr>";
			$pag2 .= "</table>";
			$pag2 .= "<table style='width: 100%; border: 1px solid black;'>";
				$pag2 .= "<tr style='height: 50px;'>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
					$pag2 .= "<td>&nbsp;</td>";
				$pag2 .= "</tr>";
			$pag2 .= "</table>";
			$pag2 .= '<table style="width: 100%;">';
				$pag2 .= '<tr>';
					$pag2 .= '<td style="vertical-align: top;">';
						$pag2 .= '<p>Regras para a substituição em caso de falta:</p>';
						$pag2 .= '<p style="margin-left: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;Só poderá cobrir a lacuna o Agente que estiver saindo do plantão.</p>';
						$pag2 .= '<p style="margin-left: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;Não será admitido deslocar Agente de Segurança de outra Unidade para tal cobertura.</p>';
					$pag2 .= '</td>';
					$pag2 .= '<td style="vertical-align: top; text-align: right;">';
						$pag2 .= '<table style="border-collapse: collapse; width: auto;">';
							$pag2 .= "<tr style='border: 1px solid black;'>";
								$pag2 .= '<td style="border: 1px solid black; text-align: left; width: 150px">Matrícula</td>';
								$pag2 .= '<td style="border: 1px solid black; text-align: left; width: 150px">Assinatura</td>';
							$pag2 .= '</tr>';
							$pag2 .= "<tr style='border: 1px solid black;'>";
								$pag2 .= '<td style="border: 1px solid black;"><br>&nbsp;</td>';
								$pag2 .= '<td style="border: 1px solid black;"><br>&nbsp;</td>';
							$pag2 .= '</tr>';
						$pag2 .= '</table>';

					$pag2 .= '</td>';
				$pag2 .= '</tr>';
			$pag2 .= '</table>';

		$pag2 .= "</td>";
		$pag2 .= "</tr>";
		$pag2 .= "</table>";
		return $pag2;
	}

	public function setpag3($info) { // Talão
		$this->extenso = new NumeroPorExtenso;

		if ($info['tkts_usados'] === null || $info['tkts_usados'] == 0) {
			$tktsUsados = "R$ 0,00";
		} else {
			$tktsUsados = $info['tkts_usados'];
		}

		if ($info['liquido'] < 0) {
			$extensoLiquido = "menos " . $this->extenso->converter(abs($info['liquido']));
		} else {
			$extensoLiquido = $this->extenso->converter($info['liquido']);
		}

		$pag3 = "<table style='width: 100%; border: 1px solid black;'>";
			$pag3 .= "<tr>";
				$pag3 .= "<th colspan='4' style='text-align: center; font-size: 12px;'><u>DEMONSTRATIVO DE RECEITA</u></th>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='font-size: 12px;'><b>Evento: <span>".$info['nome']."</b></td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='font-size: 12px;'><b>Início:</b> " . $info['data_inicio'] . " às " . $info['hora_inicio'] . "h</td>";
				$pag3 .= "<td style='font-size: 12px;'><b>Fim:</b> " . $info['data_fim'] . " às " . $info['hora_fim'] . "h</td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td colspan='3' style='font-size: 12px;'><b>Local:</b> ".$info['local'].": " . $info['local_comp'] . "</td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td colspan='2' style='padding-right: 40px; font-size: 12px;'><b>Portão:</b> " . $info['portoes'] . "</td>";
				$pag3 .= "<td style='padding-right: 40px;'><b>Valor do Ticket:</b> R$ "  . number_format($info['valor_tkt'], 2, ',', '.') . "</td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td colspan='3' style='font-size: 12px;'><b>Solicitante:</b> ".$info['solicitante']."</td>";
			$pag3 .= "</tr>";
		$pag3 .= "</table>";
		$pag3 .= "<table style='width: 100%; border: 1px solid black; font-size: 12px;'>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='text-align: right;'><b>Total de Tickets:</b></td>";
				$pag3 .= "<td style='text-align: left;'>" . $tktsUsados . "</td>";
				$pag3 .= "<td>(" . str_replace(array(' reais', ' real'), '', $this->extenso->converter($tktsUsados)) . ")</td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='text-align: right;'><b>Receita Bruta:</b></td>";
				$pag3 .= "<td style='text-align: left;'>" . "R$ " . number_format($info['receita'], 2, ',', '.') . "</td>";
				$pag3 .= "<td>(" . $this->extenso->converter($info['receita']) . ")</td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='text-align: right;'><b>Despesa Apoio:</b></td>";
				$pag3 .= "<td style='text-align: left;'>" . "R$ " . number_format($info['despesa'], 2, ',', '.') . "</td>";
				$pag3 .= "<td>(" . $this->extenso->converter($info['despesa']) . ")</td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='text-align: right;'><b>Total Líquido:</b></td>";
				$pag3 .= "<td style='text-align: left;'>" . "R$ " . number_format($info['liquido'], 2, ',', '.') . "</td>";
				$pag3 .= "<td>(" . $extensoLiquido . ")</td>";
			$pag3 .= "</tr>";
		$pag3 .= "</table>";
			$pag3 .= "<table style='width: 100%; border: 1px solid black; font-size: 12px;'>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='text-align: center;'><b>Nº INICIAL</td>";
				$pag3 .= "<td style='text-align: center;'><b>Nº FINAL</td>";
				$pag3 .= "<td style='text-align: center;'><b>Nº TICKETS</td>";
				$pag3 .= "<td style='text-align: center;'><b>VALOR TALÃO</td>";
			$pag3 .= "</tr>";
		foreach ($info['listaTaloes'] as $talao) {
			$num_tkts = $this->calcularValorTotal($talao->inicio, $talao->fim, $info['valor_tkt'])['num_tkts'];
			$valor_tkts = $this->calcularValorTotal($talao->inicio, $talao->fim, $info['valor_tkt'])['total'];
			$getTotal = "R\$ " . number_format($valor_tkts, 2, ',', '.');

			$pag3 .= "<tr>";
				$pag3 .= "<td style='text-align: center;'>$talao->inicio</td>";
				$pag3 .= "<td style='text-align: center;'>$talao->fim</td>";
				$pag3 .= "<td style='text-align: center;'>$num_tkts</td>";
				$pag3 .= "<td style='text-align: center;'>$getTotal</td>";
			$pag3 .= "</tr>";
		}
		$pag3 .= "</table>";
		$pag3 .= "<table style='width: 100%; border: 1px solid black; font-size: 12px;'>";
			$pag3 .= "<tr>";
				$pag3 .= "<th style='text-align: left; background-color: lightgrey'>Quantidade de Talões Manuseados: " . $info['taloesManuseados'] . "</th>";
			$pag3 .= "</tr>";
		$pag3 .= "</table>";
		$pag3 .= "<table style='width: 100%; border: 1px solid black;' font-size: 12px;>";
			$pag3 .= "<tr>";
				$pag3 .= "<th colspan='4' style='text-align: center;'>DETALHES DAS FORMAS DE PAGAMENTO</th>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td></td>";
				$pag3 .= "<td style='text-align: center;'><b>TICKETS</b></td>";
				$pag3 .= "<td style='text-align: center;'><b>VALOR</b></td>";
				$pag3 .= "<td></td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>Crédito</td>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>" . $info['credito'] . "</td>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>" . $this->valorEmTickets($info['credito'], $info['valor_tkt']) . "</td>";
				$pag3 .= "<td></td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>Débito</td>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>" . $info['debito'] . "</td>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>" . $this->valorEmTickets($info['debito'], $info['valor_tkt']) . "</td>";
				$pag3 .= "<td></td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>Dinheiro</td>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>" . $info['dinheiro'] . "</td>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>" . $this->valorEmTickets($info['dinheiro'], $info['valor_tkt']) . "</td>";
				$pag3 .= "<td></td>";
			$pag3 .= "</tr>";
			$pag3 .= "<tr>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>Pix</td>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>" . $info['pix'] . "</td>";
				$pag3 .= "<td style='text-align: center; font-size: 12px;'>" . $this->valorEmTickets($info['pix'], $info['valor_tkt']) . "</td>";
				$pag3 .= "<td></td>";
			$pag3 .= "</tr>";
		$pag3 .= "</table>";

		return $pag3;
	}

	function implodeNomePortao($array) {
		$nomesPortao = array_map(function ($obj) {
			return $obj->nome_portao;
		}, $array);
		return implode(', ', $nomesPortao);
	}

	function calcularValorTotal($ini, $fim, $valor) {
		$num_tkts = ($fim - $ini) + 1;
		$total = $num_tkts * $valor;
		return array(
			'num_tkts' => $num_tkts,
			'total' => $total
		);
	}

	function valorEmTickets($qntdTickets, $valorTicket) {
		$resultado = $qntdTickets * $valorTicket;
		$resultadoFormatado = "R$ " . number_format($resultado, 2, ',', '.');
		return $resultadoFormatado;
	}*/

	public function index()
	{
		/*$id_evento = $this->request->getGet('id');
		$infoEvento = $this->eventosModel->getEvento($id_evento);
		$infoLocal = $this->localModel->getLocal($infoEvento->fk_local);
		$infoPortao = $this->eventosPortoesModel->getPortoes($id_evento);
		$tkts_usados = $this->talaoModel->getTktsUsados($id_evento);
		$listaTaloes = $this->talaoModel->getTaloesEvento($id_evento);
		$taloesManuseados = count($listaTaloes);

		$despesa = $this->equipeModel->getDespesa($id_evento);
		$receita = $this->talaoModel->getReceita($id_evento);
		$liquido = $receita - $despesa;
		$getReceita = "R$ " . number_format($receita, 2, ',', '.');
		$getLiquido = "R$ " . number_format($liquido, 2, ',', '.');
		$credito = $infoEvento->credito;
		$debito = $infoEvento->debito;
		$dinheiro = $infoEvento->dinheiro;
		$pix = $infoEvento->pix;

		$nome = $infoEvento->nome;
		$data_inicio = date("d/m/Y", strtotime($infoEvento->data_inicio));
		$hora_inicio = date("H:i", strtotime($infoEvento->hora_inicio));
		$data_fim = date("d/m/Y", strtotime($infoEvento->data_fim));
		$hora_fim = date("H:i", strtotime($infoEvento->hora_fim));
		$local = $infoLocal->nome;
		$local_comp = $infoEvento->local_comp;
		$equipe = $this->equipeModel->getEquipe($id_evento);
		$valor_tkt = $infoEvento->valor_tkt;
		$solicitante = $infoEvento->solicitante;
		$uso_talao = $infoEvento->uso_talao;
		$portoes = $this->implodeNomePortao($infoPortao);

		$info = [
			'nome' 				=>	$nome,
			'data_inicio'		=>	$data_inicio,
			'hora_inicio' 		=>	$hora_inicio,
			'data_fim'			=>	$data_fim,
			'hora_fim' 			=>	$hora_fim,
			'local' 			=>	$local,
			'local_comp'		=>	$local_comp,
			'equipe' 			=>	$equipe,
			'valor_tkt'			=>	$valor_tkt,
			'solicitante'		=>	$solicitante,
			'uso_talao'			=>	$uso_talao,
			'portoes'			=>	$portoes,
			'despesa'			=>	$despesa,
			'receita'			=>	$receita,
			'liquido'			=>	$liquido,
			'listaTaloes'		=>	$listaTaloes,
			'tkts_usados'		=>	$tkts_usados,
			'receita'			=>	$receita,
			'despesa'			=>	$despesa,
			'liquido'			=>	$liquido,
			'credito'			=>	$credito,
			'debito'			=>	$debito,
			'dinheiro'			=>	$dinheiro,
			'pix'				=>	$pix,
			'taloesManuseados'	=>	$taloesManuseados
		];*/

		$this->response->setHeader('Content-Type', 'application/pdf');

		$mpdf = new \Mpdf\Mpdf(
			[
				'mode' => 'utf-8',
				'format' => 'A4-L',
				'margin_top' => 22,
				'margin_bottom' => 30,
				'default_font_size' => 8
			]
		);

		$mpdf->SetHTMLHeader($this->setHeader());
		$mpdf->SetHTMLFooter($this->setFooter());

		/*$mpdf->WriteHTML($this->setPag1($info));
		$mpdf->AddPage();
		$mpdf->WriteHTML($this->setPag2($info));

		if ($uso_talao == "Sim")
		{
			$mpdf->AddPage('P');
			$mpdf->WriteHTML($this->setPag3($info));
		}

		$filename = $nome . "_" . str_replace('/', '-', $data_inicio) . '.pdf';*/
		$filename = "teste";
		$mpdf->Output($filename, "I");
	}
}