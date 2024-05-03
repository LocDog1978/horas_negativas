<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\PessoasModel;

class HomeController extends BaseController
{
	protected $userModel;
	protected $currentUser;

	public function __construct()
	{
		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
	}

	public function index()
	{
		$data['currentUser'] = $this->currentUser;
		return view('inicio', $data);
	}
}

?>