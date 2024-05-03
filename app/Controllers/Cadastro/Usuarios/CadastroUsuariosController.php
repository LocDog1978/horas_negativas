<?php

namespace App\Controllers\Cadastro\Usuarios;
use App\Models\UsuarioModel;
use App\Models\TiposNiveisUsuariosModel;
use App\Models\LogAlteracoesModel;

class CadastroUsuariosController extends \CodeIgniter\Controller
{
	protected $userModel;
	protected $currentUser;
	protected $logAlteracoes;
	protected $tiposNiveisUsuarios;

	public function __construct()
	{
		helper('form');
		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
		$this->tiposNiveisUsuarios = new TiposNiveisUsuariosModel();
		$this->logAlteracoes = new LogAlteracoesModel();
	}

	public function index(){		
		$data['isDataTablesPage'] = true;
		$data['currentUser'] = $this->currentUser;
		$data['lastSegment'] = $this->request->uri->getSegment($this->request->uri->getTotalSegments());
		return view('cadastro/usuarios/index', $data);
	}

	public function table(){
		$data['isDataTablesPage'] = true;
		$data['currentUser'] = $this->currentUser;
		$data['userList'] = $this->userModel->getAllData();
		$data['environment'] = ENVIRONMENT;
		return view('cadastro/usuarios/table', $data);
	}

	public function add(){
		if ($this->currentUser->nivel == 3) {
			return redirect()->to('error/e403');
		} else {
			$data['jqueryRedirect'] = true;
			$data['state'] = "Adicionar Usuário";
			$data['environment'] = ENVIRONMENT;
			$data['niveisList'] = $this->tiposNiveisUsuarios->getAllDataExceptIdOne();
			$data['userList'] = $this->userModel->getAllData();
			$data['currentUser'] = $this->currentUser;
			return view('cadastro/usuarios/add', $data);
		}
	}

	public function validation(){
		$data['isThere'] = $this->userModel->existsUser($this->request->getPost('login'));
		return view('cadastro/usuarios/userAddValidation', $data);
	}

	public function store(){
		if (empty($this->request->getPost('flagToUpdate'))) {
			$this->userModel->save([
				'id'			=> $this->request->getPost('id'),
				'nome'			=> $this->request->getPost('v1'),
				'sobrenome'		=> $this->request->getPost('v2'),
				'login'			=> $this->request->getPost('v3'),
				'senha'			=> password_hash($this->request->getPost('v4'), PASSWORD_DEFAULT),
				'fk_nivel'		=> $this->request->getPost('v5'),
				'ativo'			=> 1
			]);
			$idInserted = $this->userModel->insertID();

			$data = [
				'tabela'		=> $this->userModel->tableName(),
				'info'			=> $this->request->getPost('v3'),
				'acao'			=> 'Cadastrou',
				'data_hora'		=> date('Y-m-d H:i:s'),
				'usuario'		=> $this->currentUser->login
			];
			$this->logAlteracoes->saveLog($data);
			return ($this->response->setJSON($idInserted));
		} else {

			$data = [
				'tabela'		=> $this->userModel->tableName(),
				'info'			=> $this->request->getPost('v3'),
				'acao'			=> 'Atualizou',
				'data_hora'		=> date('Y-m-d H:i:s'),
				'usuario'		=> $this->currentUser->login
			];
			$this->logAlteracoes->saveLog($data);

			$this->userModel->updateUsuario([
				'id'			=> $this->request->getPost('id'),
				'nome'			=> $this->request->getPost('v1'),
				'sobrenome'		=> $this->request->getPost('v2'),
				'login'			=> $this->request->getPost('v3'),
				'senha'			=> password_hash($this->request->getPost('v4'), PASSWORD_DEFAULT),
				'fk_nivel'		=> $this->request->getPost('v5'),
				'ativo'			=> 1
			]);
			return ($this->response->setJSON($this->request->getPost('id')));
		}
	}

	public function update($id = null){
		$meuNivel = $this->currentUser->nivel;
		$row = $this->userModel->getUserData($id)->nivel;

		if ($id != session()->userID && $meuNivel == 3 || ($meuNivel == 2 && $row == 1)) { // só edita seu próprio usuário se não for dev/adm
			return redirect()->to('error/e403');
		} else {
			$data['state'] = "Editar Usuário";
			$data['currentUser'] = $this->currentUser;
			$data['niveisList'] = ($meuNivel == 1) ? $this->tiposNiveisUsuarios->getAllData() : $this->tiposNiveisUsuarios->getAllDataExceptIdOne();
			$data['jqueryRedirect'] = true;
			$data['environment'] = ENVIRONMENT;

			$data['user'] 	= $this->userModel->getUserData($id);
			$data['toUpdate'] 	= [
				'id'			=> $id,
				'nome'			=> $data['user']->nome,
				'sobrenome'		=> $data['user']->sobrenome,
				'login'			=> $data['user']->login,
				'senha'			=> password_hash($data['user']->senha, PASSWORD_DEFAULT),
				'fk_nivel'		=> $data['user']->fk_nivel
			];
			return view('cadastro/usuarios/add', $data);
		}
	}

	public function updateID(){
		$data['savedID'] = $this->request->getPost('savedID');
		return view('cadastro/usuarios/update', $data);
	}

	public function trash($id = null){
		if ($id == session()->userID || $this->currentUser->fk_nivel == 3) { // só envia para a lixeira seu próprio usuário se não for dev/adm
			return redirect()->to('error/e403');
		} else {
			$data = [
				'tabela'		=> $this->userModel->tableName(),
				'info'			=> $this->userModel->getUserData($id)->login,
				'acao'			=> 'Lixo',
				'data_hora'		=> date('Y-m-d H:i:s'),
				'usuario'		=> $this->currentUser->login
			];
			$this->logAlteracoes->saveLog($data);
			$this->userModel->unsetActive($id);
			$response = array(
				"success"			=>	true,
				"success_message"	=>	"<p>O registro foi enviado com sucesso para a lixeira<\p>"
			);
			$data['getResponse'] = json_encode($response);
			return view('cadastro/usuarios/trash', $data);
		}
	}

	public function restore($id = null){
		if ($id == session()->userID || $this->currentUser->nivel == 3) { // só restaura seu próprio usuário se não for dev/adm
			return redirect()->to('error/e403');
		} else {
			$data = [
				'tabela'		=> $this->userModel->tableName(),
				'info'			=> $this->userModel->getUserData($id)->login,
				'acao'			=> 'Restaurou',
				'data_hora'		=> date('Y-m-d H:i:s'),
				'usuario'		=> $this->currentUser->login
			];
			$this->logAlteracoes->saveLog($data);
			$this->userModel->setActive($id);
			$response = array(
				"success"			=>	true,
				"success_message"	=>	"<p>O registro foi restaurado com sucesso da lixeira<\p>"
			);
			$data['getResponse'] = json_encode($response);
			return view('cadastro/usuarios/trash', $data);
		}
	}

	public function delete($id = null){
		if ($id == session()->userID || $this->currentUser->nivel == 3) { // só restaura seu próprio usuário se não for dev/adm
			return redirect()->to('error/e403');
		} else {
			$data = [
				'tabela'		=> $this->userModel->tableName(),
				'info'			=> $this->userModel->getUserData($id)->login,
				'acao'			=> 'Excluiu',
				'data_hora'		=> date('Y-m-d H:i:s'),
				'usuario'		=> $this->currentUser->login
			];
			$this->userModel->delete($id);
			$this->logAlteracoes->saveLog($data);

			$response = array(
				"success"			=>	true,
				"success_message"	=>	"<p>O registro foi excluído com sucesso<\p>"
			);
			$data['getResponse'] = json_encode($response);
			return view('cadastro/usuarios/delete', $data);
		}
	}
}