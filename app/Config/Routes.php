<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('index', 'Home::index');




//utilisateur
$routes->get('gestionUtilisateur', 'UserController::AfficherUser');
$routes->get('createUser', 'UserController::create');
$routes->post('AjoutUser', 'UserController::AjoutUser');
$routes->get('DeleteUser/(:num)', 'UserController::DeleteUser/$1');
$routes->post('EditUser', 'UserController::EditUser');

