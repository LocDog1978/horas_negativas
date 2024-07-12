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
		$data['postosList'] = $this->postosModel->getAllData();
		$data['somatorioPeriodo'] = $this->horasNegativasModel->somatorioPeriodo();
		$data['intervaloDias'] = intervalo_dias_formatado();
		return view('inicio', $data);
	}
}

?>