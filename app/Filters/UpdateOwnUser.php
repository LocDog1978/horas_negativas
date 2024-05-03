<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Config\Services;
use App\Models\UsuarioModel;

class UpdateOwnUser implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		$colaborador = 3; // Caso seja colaborador
		$currentUser = new UsuarioModel();
		$uri = new \CodeIgniter\HTTP\URI(current_url(true));

		if (empty($currentUser->getUserData(session()->userID)->nivel)) {
			return redirect()->to('/error/e403');
		}

		$currentUserId = $currentUser->getUserData(session()->userID)->id_usuario;
		$currentUserNivel = $currentUser->getUserData(session()->userID)->nivel;
		$updateId = ($uri->getTotalSegments() >= 5) ? $uri->getSegment(5) : '';
		$segment = $uri->getSegment(4);

		if ($currentUserNivel == $colaborador)
		{
			if (!empty($currentUserId) && $updateId != $currentUserId &&
					($segment != 'validation') && ($segment != 'store') && ($segment != 'updateID')
				)
			{
				return redirect()->to('/error/e403');
			}
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Não é necessário implementar nada aqui para esse filtro
	}
}