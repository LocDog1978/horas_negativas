<?php

namespace App\Controllers\Assets;

class DatatablesController extends \CodeIgniter\Controller
{
	public function traducao()
	{
		 return $this->response->download(ROOTPATH . 'public\assets\datatables\pt-BR.json', null);
	}	
}


/**
 * -------------------------------------------------------------------
 * ABAIXO - VERSÃO PRODUÇÃO
 * -------------------------------------------------------------------
 **/

/*namespace App\Controllers\Assets;

class DatatablesController extends \CodeIgniter\Controller
{
	public function traducao()
	{
		// Define o caminho completo para o arquivo de tradução
		$arquivoTraducao = FCPATH . 'public/assets/datatables/pt-BR.json';
		
		// Verifica se o arquivo existe
		if (file_exists($arquivoTraducao)) {
			// Lê o conteúdo do arquivo
			$conteudo = file_get_contents($arquivoTraducao);
			
			// Define o cabeçalho de resposta como JSON
			header('Content-Type: application/json');
			
			// Retorna o conteúdo do arquivo como resposta
			echo $conteudo;
		} else {
			// Se o arquivo não existir, retorna uma resposta vazia com status 404
			return $this->response->setStatusCode(404);
		}
	}	
}*/