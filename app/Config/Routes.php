<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
//Creem la ruta per carregar el metode index del NoticiesController
$routes->get('/noticies','NoticiaController::index');
/*
	Creem una ruta de noticia/numero que serà el ID de la noticia que hem seleccionat
	ademés indiquem que el valor que rebem serà paràmetre de la funció singleNoticia del controlador.
*/
$routes->get('/noticia/(:num)','NoticiaController::singleNoticia/$1');

/* TEST */
$routes->get("/noticiesTest",'NoticiaController::getNoticiesNew');
$routes->get("/noticiesTest/(:num)",'NoticiaController::getNoticiesPageNew/$1');

/* API ROUTES */
$routes->get('api/noticies/', 'NoticiesRestController::index');
$routes->get('api/noticies/(:num)', 'NoticiesRestController::getNoticiesPage/$1');
$routes->get('api/noticia/(:num)','NoticiesRestController::singleNoticia/$1');
$routes->get('api/categoria/(:num)','NoticiesRestController::getNoticiesByCategoria/$1');
$routes->get('api/(:any)','NoticiesRestController::getNoticiesByCategoriaNom/$1');

/* GROCERYCRUD */
$routes->get('gr/noticies', 'NoticiaController::grocery');
$routes->get('gr/noticies/add/', 'NoticiaController::grocery');
$routes->get('gr/noticies/edit/(:num)', 'NoticiaController::grocery/$1');
$routes->get('gr/noticies/delete/(:num)', 'NoticiaController::grocery/$1');
$routes->post('gr/noticies/insert_validation','NoticiaController::grocery');
$routes->post('gr/noticies/insert','NoticiaController::grocery');
$routes->post('gr/noticies/update_validation/(:num)','NoticiaController::grocery/$1');
$routes->post('gr/noticies/update/(:num)','NoticiaController::grocery/$1');

$routes->get('gr/categories', 'CategoriaController::grocery');
$routes->get('gr/categories/add/', 'CategoriaController::grocery');
$routes->get('gr/categories/edit/(:num)', 'CategoriaController::grocery/$1');
$routes->get('gr/categories/delete/(:num)', 'CategoriaController::grocery/$1');
$routes->post('gr/categories/insert_validation','CategoriaController::grocery');
$routes->post('gr/categories/insert','CategoriaController::grocery');
$routes->post('gr/categories/update_validation/(:num)','CategoriaController::grocery/$1');
$routes->post('gr/categories/update/(:num)','CategoriaController::grocery/$1');

$routes->get('gr/imatges', 'ImatgeController::grocery');
$routes->get('gr/imatges/add/', 'ImatgeController::grocery');
$routes->get('gr/imatges/edit/(:num)', 'ImatgeController::grocery/$1');
$routes->get('gr/imatges/delete/(:num)', 'ImatgeController::grocery/$1');
$routes->post('gr/imatges/insert_validation','ImatgeController::grocery');
$routes->post('gr/imatges/insert','ImatgeController::grocery');
$routes->post('gr/imatges/update_validation/(:num)','ImatgeController::grocery/$1');
$routes->post('gr/imatges/update/(:num)','ImatgeController::grocery/$1');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}