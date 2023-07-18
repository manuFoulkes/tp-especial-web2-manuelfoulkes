<?php

require_once 'app/models/ApiArtistaModel.php';
require_once 'app/models/ApiAlbumModel.php';
require_once 'app/views/ApiView.php';

class ApiArtistaController {

    private $artistaModel;
    private $albumModel;
    private $view;
    private $artistaData;

    public function __construct() {
        $this->artistaModel = new ApiArtistaModel();
        $this->albumModel = new ApiAlbumModel();
        $this->view = new ApiView();
        $this->artistaData = file_get_contents('php://input');
    }

    public function getArtistaData() {
        return json_decode($this->artistaData);
    }

    public function getArtistas($params = null) {
        $sort = 'id';
        $page = 1;
        $limit = 5;

        if(isset($_GET['sort'])) {
            $validColumns = ['nombre', 'genero'];

            if(in_array($_GET['sort'], $validColumns)) {
                $sort = $_GET['sort'];
            } else {
                $this->view->response('Error: Verifique el campo sort',400);
                return;
            }
        }

        if(isset($_GET['page'])) {
            if(is_numeric($_GET['page']) && $_GET['page'] > 0) {
                $page = $_GET['page'];
            } else {
                $this->view->response('Error: Verifique campo page', 400);
                return;
            }
        }

        if(isset($_GET['limit'])) {
            if(is_numeric($_GET['limit']) && $_GET['limit'] > 0) {
                $limit = $_GET['limit'];
            } else {
                $this->view->response('Error: Verifique campo limit', 400);
                return;
            }
        }

        $startIndex = ($page - 1) * $limit;
        
        $artistas = $this->artistaModel->getAll($sort, $startIndex, $limit);

        if(empty($artistas)) {
            $this->view->response('Error: No se encontraron artistas', 404);
            return;
        }

        $this->view->response($artistas, 200);
    }

    public function addArtista($params = null) {
        $artistaData = $this->getArtistaData();

        $camposRequeridos = [
            'nombre' => 'string',
            'genero' => 'string'
        ];

        foreach($camposRequeridos as $campo => $tipo) {
            if(!isset($artistaData->$campo) || $artistaData->$campo === '') {
                $this->view->response('Error: Falta el campo requerido: ' . $campo, 400);
                return;
            }

            if(gettype($artistaData->$campo) !== $tipo) {
                $this->view->response('Error: El campo ' . $campo . ' debe ser del tipo ' . $tipo, 400);
                return;
            }
        }

        $artista = $this->artistaModel->getArtistaByName($artistaData->nombre);

        if($artista) {
            $this->view->response('Error: El artista ingresado ya existe', 400);
            return;
        }

        $nombre = $artistaData->nombre;
        $genero = $artistaData->genero;

        $idUltimoArtistaIngresado = $this->artistaModel->addArtista($nombre, $genero);

        if(empty($idUltimoArtistaIngresado)) {
            $this->view->response('Error: No se pudo agregar el artista', 500);
            return;
        }

        $this->view->response('Artista ingresado con exito', 201);
    }

    public function updateArtista($params = null) {
        if(!isset($params[':ID']) || !is_numeric($params[':ID']) || $params[':ID'] <= 0) {
            $this->view->response('Error: El parametro ID no es valido', 404);
            return;
        }

        $artista = $this->artistaModel->getArtistaById($params[':ID']);

        if(empty($artista)) {
            $this->view->response('Error: No existe ningun artista con el ID proporcionado', 404);
            return;
        }

        $artistaData = $this->getArtistaData();

        $camposRequeridos = [
            'nombre' => 'string',
            'genero' => 'string'
        ];

        foreach($camposRequeridos as $campo => $tipo) {
            if(!isset($artistaData->$campo) || $artistaData->$campo === '') {
                $this->view->response('Error: Falta el campo requerido: ' . $campo, 400);
                return;
            }

            if(gettype($artistaData->$campo) !== $tipo) {
                $this->view->response('Error: El campo ' . $campo . ' debe ser del tipo ' . $tipo, 400);
                return;
            }
        }

        $idArtista = $params[':ID'];
        $nombre = $artistaData->nombre;
        $genero = $artistaData->genero;

        $this->artistaModel->updateArtista($nombre, $genero, $idArtista);

        $this->view->response("Artista modificado con exito", 201);
    }

    public function deleteArtista($params = null) {
        if(!isset($params[':ID']) || !is_numeric($params[':ID']) || $params[':ID'] <= 0) {
            $this->view->response('Error: Parametro ID invalido', 400);
            return;
        }

        $artista = $this->artistaModel->getArtistaById($params[':ID']);

        if(empty($artista)) {
            $this->view->response('Error: No se encontro ningun artista con el ID proporcionado', 404);
            return;
        }

        $idArtista = $params[':ID'];

        $albunesAsociados = $this->albumModel->getAlbunesByArtista($idArtista);

        if($albunesAsociados) {
            $this->view->response('Error: El artista tiene albunes asociados, no se puede eliminar', 400);
            return;
        }

        $this->artistaModel->deleteArtista($idArtista);

        $this->view->response('Artista eliminado con exito', 200);
    }
}