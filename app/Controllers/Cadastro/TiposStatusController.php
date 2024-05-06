<?php

namespace App\Controllers\Cadastro;
use App\Libraries\GroceryCrud;
use App\Models\UsuarioModel;
use App\Models\TiposStatusModel;
use App\Models\LogAlteracoesModel;

class TiposStatusController extends \CodeIgniter\Controller
{
	protected $userModel;
	protected $userData;
	protected $tipos_status;
	protected $logAlteracoes;
	protected $groceryCrud;

	public function __construct()
	{
		helper('form');

		//instanciando o model dos usuários
		$this->userModel = new UsuarioModel();

		//dados completos do usuário na sessão atual
		$this->userData = $this->userModel->getUserData(session()->userID);

		//instanciando o model dos tipos_status
		$this->tipos_status = new TiposStatusModel();

		//instanciando o model log de alterações
		$this->logAlteracoes = new LogAlteracoesModel();

		//instanciando Grocry Crud
		$this->groceryCrud = new GroceryCrud();
	}

	/**
	 * --------------------------------------------------------------------------
	 * Cadastro de TiposStatus
	 * Cadastro de usuários utilizando a biblioteca Grocery Crud 
	 * https://www.grocerycrud.com/
	 * Na versão 2.0.1 compatível com Codeigniter 4.x
	 * --------------------------------------------------------------------------
	 */

	public function tipos_status(){
		$crud = $this->groceryCrud;
		$crud->setTable('tipos_status');
		$crud->setSubject('Tipos de Status');
		$crud->columns(['nome', 'ativo']);
		$crud->displayAs('ativo', 'Lixeira');
		$crud->fields(['nome']);
		$crud->requiredFields(['nome']);
		$crud->uniqueFields(['nome']);
		
		// botão para enviar para lixeira e restaurar caso seja dev / adm
		$crud->callbackColumn('ativo', function ($value, $row) {
			if ($value) {
				$link = base_url('cadastro/tipos_status/trash/' . $row->id);
				return '<a href="' . $link . '" onclick="return confirm(\'Tem certeza que deseja envar este item para lixeira?\');"><i class="fa fa-trash"></i></a>';
			} else {
				$link = base_url('cadastro/tipos_status/restore/' . $row->id);
				return '<a href="' . $link . '" onclick="return confirm(\'Tem certeza que deseja restaurar este item da lixeira?\');"><i class="fa fa-undo"></i></a>';
			}
		});

		// caso seja administrador
		if ($this->userData->nivel == 2) {
			$crud->unsetDelete();
		}

		// caso seja colaborador
		if ($this->userData->nivel == 3) {
			$crud->unsetColumns(['ativo']);
			$crud->unsetOperations();
			$crud->where('ativo', 1);
		}

		// setar o dado como ativo e salvar log
		$modelTiposStatus = $this->tipos_status;
		$modelLogAlteracoes = $this->logAlteracoes;
		$crud->callbackAfterInsert(function ($stateParameters) use ($modelTiposStatus, $modelLogAlteracoes) {
			$data = [
				'tabela'		=> $modelTiposStatus->tableName(),
				'info'			=> $stateParameters->data['nome'],
				'acao'			=> 'Cadastrou',
				'data_hora'		=> date('Y-m-d H:i:s'),
				'fk_usuario'	=> session()->userID
			];
			$modelTiposStatus->setActive($stateParameters->insertId);
			$modelLogAlteracoes->saveLog($data);
			return $stateParameters;
		});

		$crud->callbackAfterUpdate(function ($stateParameters) use ($modelTiposStatus, $modelLogAlteracoes) {
			$id = $stateParameters->primaryKeyValue;
			$data = [
				'tabela'		=> $modelTiposStatus->tableName(),
				'info'			=> $this->tipos_status->getTiposStatus($id)->nome,
				'acao'			=> 'Atualizou',
				'data_hora'		=> date('Y-m-d H:i:s'),
				'fk_usuario'	=> session()->userID
			];
			$modelLogAlteracoes->saveLog($data);
			return $stateParameters;
		});

		$crud->callbackBeforeDelete(function ($stateParameters) use ($modelTiposStatus, $modelLogAlteracoes) {
			$id = $stateParameters->primaryKeyValue;
			$data = [
				'tabela'		=> $modelTiposStatus->tableName(),
				'info'			=> $this->tipos_status->getTiposStatus($id)->nome,
				'acao'			=> 'Excluiu',
				'data_hora'		=> date('Y-m-d H:i:s'),
				'fk_usuario'	=> session()->userID
			];
			$modelLogAlteracoes->saveLog($data);
			return $stateParameters;
		});
		$output = $crud->render();
		return $this->_tipos_statusOutput($output);
	}

	private function _tipos_statusOutput($output = null) {
		$output->userData = $this->userData;
		return view('cadastro/tipos_status', (array)$output);
	}

	public function trash($id = null) {
		if ($this->userModel->getUserData(session()->userID)->nivel == 3) {
			return redirect()->to('error/e403');
		} else {
			$data = [
				'tabela'		=> $this->tipos_status->tableName(),
				'info'			=> $this->tipos_status->getTiposStatus($id)->nome,
				'acao'			=> 'Lixo',
				'data_hora'		=> date('Y-m-d H:i:s'),
				'fk_usuario'	=> session()->userID
			];
			$this->logAlteracoes->saveLog($data);
			$response = array(
				"success"           =>  true,
				"success_message"   =>  "<p>O registro foi excluído com sucesso<\p>"
			);
			$data['getResponse'] = json_encode($response);
			$this->tipos_status->unsetActive($id);
			return redirect()->to('cadastro/tipos_status');
		}
	}

	public function restore($id = null) {
		if ($this->userModel->getUserData(session()->userID)->nivel == 3) {
			return redirect()->to('error/e403');
		} else {
			$data = [
				'tabela'		=> $this->tipos_status->tableName(),
				'info'			=> $this->tipos_status->getTiposStatus($id)->nome,
				'acao'			=> 'Restaurou',
				'data_hora'		=> date('Y-m-d H:i:s'),
				'fk_usuario'	=> session()->userID
			];
			$this->logAlteracoes->saveLog($data);
			$response = array(
				"success"           =>  true,
				"success_message"   =>  "<p>O registro foi excluído com sucesso<\p>"
			);
			$data['getResponse'] = json_encode($response);
			$this->tipos_status->setActive($id);
			return redirect()->to('cadastro/tipos_status');
		}
	}
}