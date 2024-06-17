<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\LogAlteracoesModel;
use App\Models\PostosModel;

class HorasNegativasController extends BaseController
{
    protected $userModel;
    protected $currentUser;
    protected $logAlteracoes;
    protected $postosModel;

    public function __construct()
	{
		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
		$this->logAlteracoes = new LogAlteracoesModel();
        $this->postosModel = new PostosModel();
	}
    
    public function index()
    {
        $data['currentUser'] = $this->currentUser;
        $data['listaPostos'] = $this->postosModel->getAlldata();
        $data['isChosenPage'] = true;
        $data['isDaterangepickerPage'] = true;
        
        return view('horas_negativas/index', $data);
    }

    public function horasValidate()
    {
        $posto = $this->request->getPost('postos');
        $mes = $this->request->getPost('mes');
        $ano = $this->request->getPost('ano');

        $response = [
            'update' => 1,
            'validation' => 2,
            'insertid' => 3
        ];
        return $this->response->setJSON($response);

    }

    public function calendario()
    {
        $data['currentUser'] = $this->currentUser;
        return view('horas_negativas/calendario', $data);
    }
}