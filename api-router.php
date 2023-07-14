<?php

require_once 'app/controllers/ApiAlbumController.php';
require_once 'app/controllers/ApiArtistaController.php';
require_once 'app/controllers/ApiValoracionController.php';

$router = new Router();

// Ver todos los albunes
$router->addRoute('api/albunes','GET','ApiAlbumController','getAlbunes');

// Ver un album por su id
$router->addRoute('api/album/:ID','GET','ApiAlbumController','getAlbumById');

// Agregar un album
$router->addRoute('api/album','POST','ApiAlbumController','addAlbum');

// Editar un album
$router->addRoute('api/album/:ID','PUT','ApiAlbumController','editAlbum');

//Valorar un album
$route->addRoute('api/album/:ID/valoracion','POST','ApiValoracionController','valorarAlbum');

// Listar artistas por nombre, cantidad de albunes
$router->addRoute('api/artistas','GET','ApiArtistaController','getArtistas');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);