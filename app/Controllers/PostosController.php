<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\TurnoController;
use App\Models\UsuarioModel;
use App\Models\LogAlteracoesModel;
use App\Models\PostosModel;

class PostosController extends BaseController
{
    protected $userModel;
    protected $currentUser;
    protected $logAlteracoes;
    protected $postosModel;
    protected $turnos;

    public function __construct()
	{
		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
		$this->logAlteracoes = new LogAlteracoesModel();
        $this->postosModel = new PostosModel();
        // $this->turnos = new TurnoController();
	}

    public function index()
    {
        $data['currentUser'] = $this->currentUser;
        $data['listaPostos'] = $this->postosModel->getAlldata();
        $data['isChosenPage'] = true;

        return view('cadastro/postos/index', $data);
    }
}
