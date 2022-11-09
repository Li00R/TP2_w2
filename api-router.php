<?php
require_once './libs/Router.php';
require_once './app/controllers/champs-api.controller.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('champs', 'GET', 'ChampsApiController', 'getChamps');
$router->addRoute('champs/:ID', 'GET', 'ChampsApiController', 'getChamp');
$router->addRoute('champs', 'POST', 'ChampsApiController', 'addChamp');
$router->addRoute('champs/:ID', 'PUT', 'ChampsApiController', 'editChamp');
$router->addRoute('champs/:ID', 'DELETE', 'ChampsApiController', 'deleteChamp');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);