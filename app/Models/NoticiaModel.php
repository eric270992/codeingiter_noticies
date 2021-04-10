<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticiaModel extends Model{

    //Indiquem la taula que fa referència el model
    protected $table      = 'noticies';
    //Clau primaria de la taula
    protected $primaryKey = 'Id';
    //Indiquem que utilitza autoincrement
    protected $useAutoIncrement = true;

    //Retornem arrays
    protected $returnType     = 'array';
    //Llista de camps omplibles
    protected $allowedFields = ['Titol', 'Contingut'];

    protected $useTimestamps = false;
    //Iniquem que el camp createField que genera automàticament és Data_publicació.
    protected $createdField  = 'Data_publicacio';


    public function getNoticies(){
        //$db = \Config\Database::connect();

        //$resultats = $this->findAll();

        //Només mostrarem les notícies que tinguin categoria assignada, també podriem fer amb LeftJoins que es mostressin totes tinguin o no categories.
        $resultats = $this->db->query(
            "SELECT n.Id as noticia_id, n.Titol, n.Contingut, c.Id, c.Nom as categoria_nom, i.Nom as imatge_nom FROM noticies as n 
            INNER JOIN noticies_categories as nc ON n.Id = nc.id_noticia 
            INNER JOIN categories as c ON c.Id = nc.id_categoria
            LEFT JOIN imatges as i ON i.Id = n.imatge_id")->getResultArray();


        return $resultats;
    }

    //Funcio que retorna totes les noticies amb query builder
    public function getNoticiesNew(){
        $builder = $this->db->table("Noticies");
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getNoticiesPage($page){
        $limit = 10;
        //Calucla el offset segons el número de pàgina que rebem
        $page = $page>1?($page-1)*$limit:0;
        //var_dump($page);
        //$resultats = $this->findAll();

        //Només mostrarem les notícies que tinguin categoria assignada, també podriem fer amb LeftJoins que es mostressin totes tinguin o no categories.
        $resultats = $this->db->query(
            "SELECT n.Id as noticia_id, n.Titol, n.Contingut, c.Id, c.Nom as categoria_nom, i.Nom as imatge_nom FROM noticies as n 
            INNER JOIN noticies_categories as nc ON n.Id = nc.id_noticia 
            INNER JOIN categories as c ON c.Id = nc.id_categoria
            LEFT JOIN imatges as i ON i.Id = n.imatge_id
            LIMIT $limit OFFSET $page")->getResultArray();


        return $resultats;
    }




    public function getNoticiaById($id){
        
        $noticia = $this->find($id);

        return $noticia;
    }

    public function getNoticiesByCategoria($idCategoria){

        /* REVISAR FER CONUSLTES AMB QUERY BUILDER */
        // $builder = $this->db->table('noticies');
        // $query = $builder->get()->result_array();
        $resultats = $this->db->query(
            "SELECT n.Id, n.Titol, n.Data_publicacio FROM noticies as n
            INNER JOIN noticies_categories as nc ON n.Id = nc.id_noticia
            INNER JOIN categories as c ON c.Id = nc.id_categoria
            WHERE c.Id = :catId:",
            ["catId"=>$idCategoria]
        )->getResultArray();


        return $resultats;
    }

    
}