<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Config\Services;
use App\Models\UsuarioModel;

class Nivel implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		$colaborador = 3; // Caso seja colaborador
		$currentUser = new UsuarioModel();
		if (empty($currentUser->getUserData(session()->userID)->nivel)) {
			return redirect()->to('/error/e403');
		}
		if ($currentUser->getUserData(session()->userID)->nivel == $colaborador) {
			return redirect()->to('/error/e403');
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Não é necessário implementar nada aqui para esse filtro
	}
}