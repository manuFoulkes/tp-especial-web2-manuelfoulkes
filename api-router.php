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


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);