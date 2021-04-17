<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model{

    //Indiquem la taula que fa referència el model
    protected $table      = 'categories';
    //Clau primaria de la taula
    protected $primaryKey = 'Id';
    //Indiquem que utilitza autoincrement
    protected $useAutoIncrement = true;

    //Retornem arrays
    protected $returnType     = 'array';
    //Llista de camps omplibles
    protected $allowedFields = ['Nom','Descripcio'];



}