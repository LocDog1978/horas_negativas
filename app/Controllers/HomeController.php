<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\PostosModel;
use App\Models\HorasNegativasModel;

class HomeController extends BaseController
{
	protected $userModel;
	protected $currentUser;
	protected $postosModel;
	protected $horasNegativasModel;

	public function __construct()
	{
		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
		$this->postosModel = new PostosModel();
		$this->horasNegativasModel = new HorasNegativasModel();
	}

	public function index()
	{
		helper('data_helper');
		$data['currentUser'] = $this->currentUser;
		$data['isChosenPage'] = true;
		$data['postosList'] = $this->postosModel->getAllData();

		$mes = $this->request->getPost('mes') ?? date('n');
		$ano = $this->request->getPost('ano') ?? date('Y');

		$data['somatorioPeriodo'] = $this->horasNegativasModel->somatorioPeriodo($mes, $ano);
		$data['intervaloDias'] = intervalo_dias_formatado($mes, $ano);
		$data['mesesPortugues'] = get_meses_portugues();
		$data['anos'] = get_years();

		return view('inicio', $data);
	}

	public function tabela()
	{
		helper('data_helper');

		$mes = $this->request->getPost('mes');
		$ano = $this->request->getPost('ano');

		$data['somatorioPeriodo'] = $this->horasNegativasModel->somatorioPeriodo($mes, $ano);
		$data['intervaloDias'] = intervalo_dias_formatado($mes, $ano);

		return view('home/tabela', $data);
	}
}
