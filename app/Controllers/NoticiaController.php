<?php

namespace App\Controllers;


use CodeIgniter\Controller;
use App\Models\NoticiaModel;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\GroceryCrud;

class NoticiaController extends Controller{


    //Funció incial al cridar el nostre controlador
    function index(){
       $noticiaModel = new NoticiaModel();
       $noticies = $noticiaModel->getNoticies();
       $data=array("noticies"=>$noticies);
        return view('noticies/noticies',$data);
        
    }

    //Rebrem el id de la noticia a recuperar.
    function singleNoticia($id){
        $noticiaModel = new NoticiaModel();
        $noticia = $noticiaModel->getNoticiaById($id);
        return view("noticies/noticia",["noticia"=>$noticia]);
    }

    function getNoticiesNew(){
        $noticiaModel = new NoticiaModel();
        $results = $noticiaModel->getNoticiesNew();
        var_dump($results);
    }

    function getNoticiesPageNew($page){
        $noticiaModel = new NoticiaModel();
        $results = $noticiaModel->getNoticiesPageNew($page);
        var_dump($results);
    }

    /* GroceryCRUD */
    function grocery(){
        $crud = new GroceryCrud();
        $crud->setTable('noticies');
        $crud->setTheme('datatables');
        $crud->columns(['Id','Titol','Contingut']);

        $output = $crud->render();

        return $this->_exampleOutput($output);

    }

    private function _exampleOutput($output = null) {
        return view('noticies/noticia_crud', (array)$output);
    }

    
}