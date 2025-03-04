<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\LogAlteracoesModel;
use App\Models\PostosModel;
use App\Models\HorasNegativasModel;

class HorasNegativasController extends BaseController
{
	protected $userModel;
	protected $currentUser;
	protected $logAlteracoes;
	protected $postosModel;
	protected $horasNegativasModel;

	public function __construct()
	{
		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
		$this->logAlteracoes = new LogAlteracoesModel();
		$this->postosModel = new PostosModel();
		$this->horasNegativasModel = new HorasNegativasModel();
		helper('data');
	}

	public function index()
	{
		$data['currentUser'] = $this->currentUser;
		$data['listaPostos'] = $this->postosModel->getAlldata();
		$data['isChosenPage'] = true;
		$data['isDaterangepickerPage'] = true;
		$data['anos'] = get_years();

		return view('horas_negativas/index', $data);
	}

	public function horasValidate()
	{
		$mes = $this->request->getPost('mes');
		$ano = $this->request->getPost('ano');

		return $this->response->setJSON(dias_entre_datas($mes, $ano));
	}

	public function tabelaHorasNegativas()
	{
		$periodo = $this->request->getPost('periodo');
		$postoID = $this->request->getPost('posto');

		$data['periodo'] = $periodo;
		$data['postoID'] = $postoID;
		$data['nome_posto'] = $this->postosModel->getPosto($postoID)->nome;

		$data['horasNegativas'] = [];
		$sum_diurno = 0;
		$sum_noturno = 0;

		foreach ($periodo as $data_invisivel) {
			$horas = $this->horasNegativasModel->getHorasNegativasByPostoData($postoID, $data_invisivel);
			if ($horas) {
				if (!isset($horas->justificativa)) {
					$horas->justificativa = '';
				}
				$horas->diurno = is_null($horas->diurno) ? '' : $horas->diurno;
				$horas->noturno = is_null($horas->noturno) ? '' : $horas->noturno;
				$data['horasNegativas'][$data_invisivel] = $horas;

				// Converter para minutos e somar
				$sum_diurno += timeToMinutes($horas->diurno);
				$sum_noturno += timeToMinutes($horas->noturno);
			} else {
				$data['horasNegativas'][$data_invisivel] = (object)[
					'diurno' => '',
					'noturno' => '',
					'justificativa' => ''
				];
			}
		}

		// Converter os totais de volta para HH:MM
		$data['sum_diurno'] = minutesToTime($sum_diurno);
		$data['sum_noturno'] = minutesToTime($sum_noturno);
		$data['total_sum'] = minutesToTime($sum_diurno + $sum_noturno);

		return view('horas_negativas/tabelaHorasNegativas', $data);
	}

	public function getHorasNegativas()
	{
		$dados = $this->request->getPost('dados');
		$postoID = $this->request->getPost('posto');
		$result = $this->horasNegativasModel->saveHoras($dados, $postoID);

		return $this->response->setJSON([
			'somatorio_diurno'  => $result['sum_diurno'],
			'somatorio_noturno' => $result['sum_noturno'],
			'somatorio_total'   => $result['total_sum'],
			'message' => "Horas cadastradas com sucesso!"
		]);
	}
}
