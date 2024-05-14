<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\LogAlteracoesModel;

class PostosController extends BaseController
{
    protected $userModel;
    protected $currentUser;
    protected $logAlteracoes;

    public function __construct()
	{
		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
		$this->logAlteracoes = new LogAlteracoesModel();
	}

    public function index()
    {
        $data['currentUser'] = $this->currentUser;
        return view('cadastro/postos/index', $data);
    }
}
