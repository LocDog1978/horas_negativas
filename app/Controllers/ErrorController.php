<?php

namespace App\Controllers;

class ErrorController extends BaseController
{
	public function e403()
	{
		return view('errors/custom/error_403');
	}

	public function e404()
	{
		return view('errors/custom/error_404');
	}
}