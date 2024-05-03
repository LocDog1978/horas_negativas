<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		if ((bool)session()->usuario_logado != true) {
			return redirect()->to('/login');
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Do something here
	}
}