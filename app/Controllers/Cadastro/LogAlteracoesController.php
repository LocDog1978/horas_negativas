<?php

namespace App\Controllers\Cadastro;
use App\Libraries\GroceryCrud;
use App\Models\UsuarioModel;
use App\Models\LogAlteracoesModel;

class LogAlteracoesController extends \CodeIgniter\Controller
{
	protected $userModel;
	protected $currentUser;
	protected $log_alteracoes;
	protected $groceryCrud;

	public function __construct()
	{
		helper('form');
		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
		$this->logAlteracoes = new LogAlteracoesModel();
		$this->groceryCrud = new GroceryCrud();
	}

	/**
	 * --------------------------------------------------------------------------
	 * Cadastro de LogAlteracoes
	 * Cadastro de usuários utilizando a biblioteca Grocery Crud 
	 * https://www.grocerycrud.com/
	 * Na versão 2.0.1 compatível com Codeigniter 4.x
	 * --------------------------------------------------------------------------
	 */

	public function log_alteracoes(){
		$crud = $this->groceryCrud;
		$crud->setTable('log_alteracoes');
		$crud->setSubject('Log de Alterações');
		$crud->columns(['tabela', 'info', 'acao', 'data_hora', 'usuario']);
		$crud->displayAs('info', 'Informação');
		$crud->displayAs('acao', 'Tipo de Ação');
		$crud->displayAs('data_hora', 'Data e Hora');
		$crud->displayAs('usuario', 'Autor');
		$crud->unsetOperations();

		// setar o dado como ativo
		$modelLogAlteracoes = $this->logAlteracoes;
		$crud->callbackAfterInsert(function ($stateParameters) use ($modelLogAlteracoes) {
			$modelLogAlteracoes->setActive($stateParameters->insertId);
			return $stateParameters;
		});

		$output = $crud->render();
		return $this->_log_alteracoesOutput($output);
	}

	private function _log_alteracoesOutput($output = null) {
		$output->currentUser = $this->currentUser;
		return view('cadastro/log_alteracoes', (array)$output);
	}

	public function trash($id = null) {
		if ($this->userModel->getUserData(session()->userID)->nivel == 3) {
			return redirect()->to('error/e403');
		} else {
			$response = array(
				"success"           =>  true,
				"success_message"   =>  "<p>O registro foi excluído com sucesso<\p>"
			);
			$data['getResponse'] = json_encode($response);
			$this->logAlteracoes->unsetActive($id);
			return redirect()->to('cadastro/log_alteracoes');
		}
	}

	public function restore($id = null) {
		if ($this->userModel->getUserData(session()->userID)->nivel == 3) {
			return redirect()->to('error/e403');
		} else {
			$response = array(
				"success"           =>  true,
				"success_message"   =>  "<p>O registro foi excluído com sucesso<\p>"
			);
			$data['getResponse'] = json_encode($response);
			$this->logAlteracoes->setActive($id);
			return redirect()->to('cadastro/log_alteracoes');
		}
	}
}