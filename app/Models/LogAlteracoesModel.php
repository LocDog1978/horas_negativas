<?php namespace App\Models;

use CodeIgniter\Model;

class LogAlteracoesModel extends Model {

	protected $table      = 'log_alteracoes';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $allowedFields = ['tabela', 'info', 'acao', 'data_hora', 'usuario'];

	public function getAllData()
	{
		return $this->findAll();
	}

	public function getLogAlteracoes($id)
	{
		return $this->find($id);
	}

	public function setActive($insertId)
	{
		$data = ['ativo' => 1];
		$this->update($insertId, $data);
	}

	public function unsetActive($insertId)
	{
		$data = ['ativo' => 0];
		$this->update($insertId, $data);
	}

	public function saveLog($data) {
		$data = [
			'tabela' 		=> $data['tabela'],
			'info'			=> $data['info'],
			'acao'			=> $data['acao'],
			'data_hora'		=> $data['data_hora'],
			'usuario'		=> $data['usuario']
		];
		$this->insert($data);
	}
}