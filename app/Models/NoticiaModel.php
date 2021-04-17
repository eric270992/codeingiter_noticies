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
    protected $allowedFields = ['Id','Titol','Data_publicacio','Contingut','imatge_id'];

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
        $builder = $this->db->table("Noticies as n");
        $builder->select('n.Id, n.Titol, n.Contingut, c.Nom as Categoria, i.Nom as imatge_nom');
        $builder->join('noticies_categories as nc','n.Id = nc.id_noticia');
        $builder->join('categories as c','c.Id = nc.id_categoria');
        $builder->join('imatges as i', 'n.imatge_id = i.Id','left');
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
        // $resultats = $this->db->query(
        //     "SELECT n.Id as noticia_id, n.Titol, n.Contingut, c.Id, c.Nom as categoria_nom, i.Nom as imatge_nom FROM noticies as n 
        //     INNER JOIN noticies_categories as nc ON n.Id = nc.id_noticia 
        //     INNER JOIN categories as c ON c.Id = nc.id_categoria
        //     LEFT JOIN imatges as i ON i.Id = n.imatge_id
        //     LIMIT $limit OFFSET $page")->getResultArray();

        $resultats = $this->db->query(
            "SELECT n.Id as noticia_id, n.Titol, n.data_publicacio FROM noticies as n 
            LIMIT $limit OFFSET $page")->getResultArray();


        return $resultats;
    }

    public function getNoticiesPageNew($page){
        $builder = $this->db->table("Noticies as n");
        $builder->select('n.Id, n.Titol, n.Contingut, c.Nom as Categoria, i.Nom as imatge_nom');
        $builder->join('noticies_categories as nc','n.Id = nc.id_noticia');
        $builder->join('categories as c','c.Id = nc.id_categoria');
        $builder->join('imatges as i', 'n.imatge_id = i.Id','left');
        $query = $builder->get()->getResultArray();
        return $query;
    }



    public function getNoticiaById($id){
        
        $builder = $this->db->table("noticies as n");
        $builder->select("n.Id, n.Titol,n.Contingut,n.data_publicacio,c.Nom as categoria, i.Nom as imatge_nom");
        $builder->join("noticies_categories as nc","nc.id_noticia = n.Id");
        $builder->join("categories as c","c.id = nc.id_categoria");
        $builder->join("imatges as i","i.Id = n.imatge_id","Left");
        $builder->where("n.Id=$id");
        $builder->orderBy("n.Id ASC");
        $query=$builder->get()->getResultArray();

        return $query;
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

    public function getNoticiesByCategoriaNom($nomCategoria){
        $builder = $this->db->table("noticies as n");
        $builder->select("n.Id,n.Titol,n.data_publicacio");
        $builder->join("noticies_categoires as nc","nc.id_noticia = m.Id");
        $builder->join("categories as c","nc.id_categoria = c.Id AND LOWER(c.Nom) = LOWER($nomCategoria)");
        $query = $builder->get()->getResultArray();
        return $query;
    }

    
}