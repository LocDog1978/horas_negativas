<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model {

	protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $db;
    protected $allowedFields = ['id', 'nome', 'sobrenome', 'login', 'senha', 'fk_nivel', 'ativo'];

	public function __construct() {
		parent::__construct();
		$this->db = db_connect();
	}

	public function getByUserName(string $usuario) : array {
		$rq = $this->where('login', $usuario)->first();
		return !is_null($rq) ? get_object_vars($rq) : [];
	}

	public function getUserData($userId) {
	    $query = $this->db->table($this->table)
	        ->select('usuarios.id as id_usuario, tipos_niveis_usuario.id as id_tipos_niveis_usuario, 	
				usuarios.nome, usuarios.sobrenome, usuarios.login, usuarios.senha, usuarios.fk_nivel,
				usuarios.ativo, tipos_niveis_usuario.nivel, tipos_niveis_usuario.descricao')
	        ->join('tipos_niveis_usuario', 'tipos_niveis_usuario.nivel = usuarios.fk_nivel')
	        ->where('usuarios.id', $userId)
	        ->get();
	    return $query->getRow();
	}


	public function getAllData() {
		$builder = $this->db->table($this->table);
		$builder->select('usuarios.id as userId, usuarios.*, tipos_niveis_usuario.*');
		$builder->join('tipos_niveis_usuario', 'tipos_niveis_usuario.id = usuarios.fk_nivel');
		$query = $builder->get();
		return $query->getResult();
	}

	public function updateUsuario($userData) {
		$this->update($userData['id'], $userData);
	}

	public function existsUser($chosenLogin) {
		$builder = $this->builder();
        $query   = $builder->where('login', $chosenLogin)->countAllResults();
        return $query;
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

	public function tableName() {
		return ($this->table);
	}
}