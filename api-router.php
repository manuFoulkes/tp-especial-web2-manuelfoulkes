<?php

require_once 'libs/Router.php';
require_once 'app/controllers/ApiAlbumController.php';
require_once 'app/controllers/ApiArtistaController.php';
require_once 'app/controllers/ApiValoracionController.php';

$router = new Router();

// Ver todos los albunes
$router->addRoute('albunes','GET','ApiAlbumController','getAlbunes');

// Ver un album por su id
$router->addRoute('album/:ID','GET','ApiAlbumController','getAlbumById');

// Agregar un album
$router->addRoute('album','POST','ApiAlbumController','addAlbum');

// Editar un album
$router->addRoute('album/:ID','PUT','ApiAlbumController','editAlbum');

//Valorar un album
$router->addRoute('album/:ID/valoracion','POST','ApiValoracionController','valorarAlbum');

// Listar artistas por nombre, cantidad de albunes
$router->addRoute('artistas','GET','ApiArtistaController','getArtistas');

// Agregar un artista
$router->addRoute('artista','POST','ApiArtistaController','addArtista');

// - Editar un artista
$router->addRoute('artista/:ID','PUT','ApiArtistaController','updateArtista');

// - Editar una valoracion
$router->addRoute('valoracion/:ID','PUT','ApiValoracionController','updateValoracion');

// Eliminar una valoracion 
$router->addRoute('valoracion/:ID','DELETE','ApiValoracionController','deleteValoracion');

// Eliminar un album
$router->addRoute('album/:ID','DELETE','ApiAlbumController','deleteAlbum');

// Eliminar un artista
$router->addRoute('artista/:ID','DELETE','ApiArtistaController','deleteArtista');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);