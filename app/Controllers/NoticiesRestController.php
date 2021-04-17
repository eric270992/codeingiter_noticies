<?php

namespace App\Controllers;

use App\Models\NoticiaModel;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class NoticiesRestController extends ResourceController{

    //Funció incial al cridar el nostre controlador
    function index(){
       $noticiaModel = new NoticiaModel();
       $noticies = $noticiaModel->getNoticies();
       $data=array("noticies"=>$noticies);
        //return json_encode($data);
       return $this->respond($data);

        
    }

    function getNoticiesPage($pagina){
        $noticiaModel = new NoticiaModel();
        $noticies = $noticiaModel->getNoticiesPage($pagina);
       // return json_encode($noticies);
       return $this->respond($noticies);
    }

    //Rebrem el id de la noticia a recuperar.
    function singleNoticia($id){
        $noticiaModel = new NoticiaModel();
        $noticia = $noticiaModel->getNoticiaById($id);
        //return json_encode($noticia);
        return $this->respond($noticia);
    }

    //Retornar noticies segons categoria
    function getNoticiesByCategoria($idCategoria){
        $noticiaModel = new NoticiaModel();
        $noticies = $noticiaModel->getNoticiesByCategoria($idCategoria);
        return json_encode($noticies);
        //return $this->respond($noticies);

    }
}