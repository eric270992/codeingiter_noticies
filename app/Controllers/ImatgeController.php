<?php

namespace App\Controllers;


use CodeIgniter\Controller;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\GroceryCrud;

class ImatgeController extends Controller{


    /* GroceryCRUD */
    function grocery(){
        $crud = new GroceryCrud();
        $crud->setTable('imatges');
        $crud->setTheme('datatables');
        $crud->columns(['Id','Nom']);

        $output = $crud->render();

        return $this->_exampleOutput($output);

    }

    private function _exampleOutput($output = null) {
        return view('noticies/noticia_crud', (array)$output);
    }
}