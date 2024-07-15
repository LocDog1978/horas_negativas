<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\PostosModel;
use App\Models\HorasNegativasModel;

class LoginController extends BaseController
{
	protected $userModel;
	protected $currentUser;
	protected $postosModel;
	protected $horasNegativasModel;


	public function __construct()
	{
		$this->userModel = new UsuarioModel();
		$this->currentUser = $this->userModel->getUserData(session()->userID);
		$this->postosModel = new PostosModel();
		$this->horasNegativasModel = new HorasNegativasModel();
	}

	public function index()
	{
		$data['isSweetAlertPage'] =  true;
		helper('data_helper');
		$data['currentUser'] = $this->currentUser;
		$data['isChosenPage'] = true;
		$data['postosList'] = $this->postosModel->getAllData();

		$mes = $this->request->getPost('mes') ?? date('n');
		$ano = $this->request->getPost('ano') ?? date('Y');

		$data['somatorioPeriodo'] = $this->horasNegativasModel->somatorioPeriodo($mes, $ano);
		$data['intervaloDias'] = intervalo_dias_formatado($mes, $ano);
		$data['mesesPortugues'] = get_meses_portugues();
		$data['anos'] = get_years();
		if (!session()->usuario_logado) {
			helper('form');
			$data['isLoginPage'] = true;

			return view('login', $data);
		} else {
			return view('inicio', $data);
		}
	}

	public function signIn()
	{
		if (session()->usuario_logado) {
			return view('inicio');
		} else {
			$usuario = $this->request->getPost('login');
			$senha = $this->request->getPost('senha');

			$usuarioModel = new \App\Models\UsuarioModel();
			$dadosUsuario = $usuarioModel->getByUserName($usuario);

			if (count($dadosUsuario) > 0){
				$hashUsuario = $dadosUsuario['senha'];
				if (password_verify($senha, $hashUsuario)) {
					session()->set('usuario_logado', true);
					session()->set('userID', $dadosUsuario['id']);
					return redirect()->to(base_url());
				} else {
					session()->setFlashdata('msg', 'Usuário e/ou senha incorretos!');
					return redirect()->to('/login');
				}
			} else {
				session()->setFlashdata('msg', 'Usuário e/ou senha incorretos!');
				return redirect()->to('/login');
			}
		}
	}

	public function signOut() {
		session()->destroy();
		return redirect()->to(base_url());
	}
}