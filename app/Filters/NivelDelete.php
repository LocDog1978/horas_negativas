<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Config\Services;
use App\Models\UsuarioModel;

class NivelDelete implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		$colaborador = 2; // Caso seja administrador
		$userData = new UsuarioModel();
		if (empty($userData->getUserData(session()->userID)->nivel)) {
			return redirect()->to('/error/e403');
		}
		if ($userData->getUserData(session()->userID)->nivel == $colaborador) {
			return redirect()->to('/error/e403');
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Não é necessário implementar nada aqui para esse filtro
	}
}