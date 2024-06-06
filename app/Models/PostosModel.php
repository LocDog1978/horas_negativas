<?php

namespace App\Models;

use CodeIgniter\Model;

class PostosModel extends Model
{
    protected $table            = 'posto';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'nome'];
    protected $returnType       = 'object';

    public function getAlldata(){
        return $this->findAll();
    }
}