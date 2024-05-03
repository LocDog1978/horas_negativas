<?php namespace App\Models;

use CodeIgniter\Model;

class TiposNiveisUsuariosModel extends Model {
	protected $table      = 'tipos_niveis_usuario';
	protected $primaryKey = 'id';
	protected $returnType = 'object';

	public function getAllData()
	{
		return $this->findAll();
	}

	public function getNivelDescricao($id)
	{
		return $this->find($id);
	}

	public function getAllDataExceptIdOne()
	{
		return $this->where('id !=', 1)->findAll();
	}
}