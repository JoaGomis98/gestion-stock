<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//=====ROUTES PUBLIQUES
$routes->get('/', 'LoginController::index');
$routes->post('login', 'LoginController::auth');
$routes->get('logout', 'LoginController::logout');

$routes->get('/', 'Home::index');



//=====ROUTES PROTÉGÉES (Nécessitent d'être connecté) 
$routes->group('', ['filter' => 'authF'], function($routes) {
    
    // Le Dashboard (Accueil)
    $routes->get('index', 'Home::index');
    $routes->get('produit', 'ProduitController::AfficherProduit');


//=====ROUTES RÉSERVÉES AUX ADMINS
    $routes->group('', ['filter' => 'isAdmin'], function($routes) {
        
        // Sécurité et Utilisateurs
        $routes->get('utilisateur','UserController::AfficherUser');    
        $routes->get('user/create', 'UserController::create');
        $routes->post('AjoutUser', 'UserController::AjoutUser');
        $routes->post('user/update', 'UserController::UpdateUser');
        $routes->get('DeleteUser/(:num)', 'UserController::DeleteUser/$1');
        $routes->get('produit/create', 'ProduitController::createProduit');
        $routes->post('EnregistrerProduit', 'ProduitController::EnregistrerProduit');
        $routes->post('produit/update', 'ProduitController::UpdateProduit');
       // $routes->delete('produit/delete/(:num)', 'ProduitController::DeleteProduit');
        
        // Configuration Système
       // $routes->get('methode', 'ConfigController::methode');
        //$routes->get('format_donnee', 'ConfigController::format');
    });


});