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
        $posto = $this->request->getPost('posto');
        $data = $this->request->getPost('data');
        $diurno = $this->request->getPost('diurno');
        $noturno = $this->request->getPost('noturno');

        $dataToInsertOrUpdate = [
            'fk_local' => $posto,
            'diurno' => $diurno,
            'noturno' => $noturno,
            'data' => $data
        ];

        // Verificar se já existe um registro com o mesmo fk_local e data
        $existingRecord = $this->horasNegativasModel
                            ->where('fk_local', $posto)
                            ->where('data', $data)
                            ->first();

        if ($existingRecord) {
            // Se existir, faça um update
            $updated = $this->horasNegativasModel
                            ->where('fk_local', $posto)
                            ->where('data', $data)
                            ->set($dataToInsertOrUpdate)
                            ->update();

            if ($updated) {
                $response = [
                    'update' => 1,
                    'insertid' => $existingRecord->id
                ];
            } else {
                $response = [
                    'update' => 0,
                    'insertid' => $existingRecord->id
                ];
            }
        } else {
            // Se não existir, faça um insert
            $inserted = $this->horasNegativasModel->insert($dataToInsertOrUpdate);

            if ($inserted) {
                $response = [
                    'update' => 0,
                    'insertid' => $this->horasNegativasModel->insertID()
                ];
            } else {
                $response = [
                    'update' => 0,
                    'insertid' => 0
                ];
            }
        }

        return $this->response->setJSON($response);
    }

    public function getHorasNegativas()
    {
        $posto = $this->request->getPost('posto');
        $data = $this->request->getPost('data');

        $record = $this->horasNegativasModel->getHorasNegativasByPostoData($posto, $data);

        if ($record) {
            $response = [
                'diurno' => $record->diurno,
                'noturno' => $record->noturno,
                'status' => 'success'
            ];
        } else {
            $response = [
                'diurno' => 0,
                'noturno' => 0,
                'status' => 'not_found'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function tabelaHorasNegativas()
    {
        $data['currentUser'] = $this->currentUser;
        
        $posto = $this->request->getPOST('posto');
        $data = $this->request->getPOST('data');

        $data['period'] = $this->horasNegativasModel->getIntervalo($posto, $data);
        
        return view('horas_negativas/tabelaHorasNegativas', $data);
    }
}