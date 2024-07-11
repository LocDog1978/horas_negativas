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
        $mes = $this->request->getPost('mes');
        $ano = $this->request->getPost('ano');

        helper('data_helper');
        return $this->response->setJSON(dias_entre_datas($mes, $ano));
    }

    public function tabelaHorasNegativas()
    {
        $periodo = $this->request->getPost('periodo');
        $postoID = $this->request->getPost('posto');
        
        $data['periodo'] = $periodo;
        $data['postoID'] = $postoID;
        $data['nome_posto'] = $this->postosModel->getPosto($postoID)->nome;

        // Carregar os dados existentes do banco de dados
        $data['horasNegativas'] = [];
        foreach ($periodo as $data_invisivel) {
            $horas = $this->horasNegativasModel->getHorasNegativasByPostoData($postoID, $data_invisivel);
            if ($horas) {
                $data['horasNegativas'][$data_invisivel] = $horas;
            }
        }

        return view('horas_negativas/tabelaHorasNegativas', $data);
    }

    public function getHorasNegativas()
    {
        $dados = $this->request->getPost('dados');
        $postoID = $this->request->getPost('posto');
        $result = $this->horasNegativasModel->saveHoras($dados, $postoID);

        return $this->response->setJSON([
            'message' => "Horas cadastradas com sucesso!"
        ]);
    }

}
