<?php

namespace App\Controllers\Cadastro;
use App\Libraries\GroceryCrud;
use App\Models\UsuarioModel;
use App\Models\PostosModel;
use App\Models\LogAlteracoesModel;

class PostosController extends \CodeIgniter\Controller
{
	protected $userModel;
	protected $currentUser;
	protected $postosModel;
	protected $logAlteracoes;
	protected $groceryCrud;

	public function __construct()
	{
		helper('form');

		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
		$this->postosModel = new PostosModel();
		$this->logAlteracoes = new LogAlteracoesModel();
		$this->groceryCrud = new GroceryCrud();
	}

	public function postos(){
		$crud = $this->groceryCrud;
		$crud->setTable('posto');
		$crud->setSubject('Postos');
		$crud->columns(['nome', 'ativo']);
		$crud->fields(['nome']);
		$crud->requiredFields(['nome']);
		$crud->uniqueFields(['nome']);

		$output = $crud->render();
		return $this->_postoOutput($output);
	}

	private function _postoOutput($output = null) {
		$output->currentUser = $this->currentUser;
		return view('cadastro/postos', (array)$output);
	}

}