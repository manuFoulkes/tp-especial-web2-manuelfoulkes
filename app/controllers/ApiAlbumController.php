<?php

require_once 'app/models/ApiAlbumModel.php';
require_once 'app/models/ApiArtistaModel.php';
require_once 'app/models/ApiValoracionModel.php';
require_once 'app/views/ApiView.php';

class ApiAlbumController {

    private $albumModel;
    private $artistaModel;
    private $valoracionModel;
    private $view;
    private $albumData;

    public function __construct() {
        $this->albumModel = new ApiAlbumModel();
        $this->artistaModel = new ApiArtistaModel();
        $this->valoracionModel = new ApiValoracionModel();
        $this->view = new ApiView();
        $this->albumData = file_get_contents('php://input');
    }

    //-ALBUM (id, nombre, genero, fecha_lanzamiento, id_artista)

    public function getAlbumData( ) {
        return json_decode($this->albumData);
    }

    public function getAlbunes($params = null) {
        $sort = 'id';
        $page = 1;
        $limit = 5;

        if(isset($_GET['sort'])) {
            $validColumns = ['nombre', 'genero', 'id_artista', 'valoracion'];

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
        
        $albunes = $this->albumModel->getAll($sort, $startIndex, $limit);

        if(empty($albunes)) {
            $this->view->response('No se encontro ningun album', 404);
            return;
        }

        $this->view->response($albunes, 200);
    }

    public function getAlbumById($params = null) {
        if(!isset($params[':ID']) || !is_numeric($params[':ID']) || $params[':ID'] <= 0) {
            $this->view->response('Error: Verificar el parametro ID', 400);
            return;
        }

        $album = $this->albumModel->getById($params[':ID']);

        if(empty($album)) {
            $this->view->response('No se encontro ningun album con el ID suministrado', 404);
            return;
        }

        $album->valoracion_promedio = (float) $album->valoracion_promedio;

        $this->view->response($album, 200);
    }

    //-ALBUM (id, nombre, genero, id_artista)
    public function addAlbum($params = null) {
        $albumData = $this->getAlbumData();

        $camposRequeridos = [
            'nombre' => 'string',
            'genero' => 'string',
            'id_artista' => 'integer'
        ];

        foreach($camposRequeridos as $campo => $tipo) {
            if(!isset($albumData->$campo) || $albumData->$campo === '') {
                $this->view->response('Error: Falta el campo requerido: ' . $campo, 400);
                return;
            }

            if(gettype($albumData->$campo) !== $tipo) {
                $this->view->response('Error: El campo ' . $campo . ' debe ser del tipo ' . $tipo, 400);
                return;
            }
        }

        $artista = $this->artistaModel->getArtistaById($albumData->id_artista);

        if(empty($artista)) {
            $this->view->response('Error: No se encontro ningun artista con id proporcionado', 404);
            return;
        }

        $nombre = $albumData->nombre;
        $genero = $albumData->genero;
        $id_artista = $albumData->id_artista;

        $idUltimoAlbumInsertado = $this->albumModel->addAlbum($nombre, $genero, $id_artista);

        if(empty($idUltimoAlbumInsertado)) {
            $this->view->response('Error: No se pudo insertar el album', 500);
            return;
        }

        $this->view->response('Album insertado con exito', 201);
    }

    public function editAlbum($params = null) {
        if(!isset($params[':ID']) || !is_numeric($params[':ID']) || $params[':ID'] <= 0) {
            $this->view->response('Error: Parametro ID invalido', 400);
            return;
        }

        $album = $this->albumModel->getById($params[':ID']);

        if(empty($album)) {
            $this->view->response('Error: No existe ningun album con el ID proporcionado', 404);
            return;
        }

        $id_album = $params[':ID'];

        $albumData = $this->getAlbumData();

        $camposRequeridos = [
            'nombre' => 'string',
            'genero' => 'string',
            'id_artista' => 'integer'
        ];

        foreach($camposRequeridos as $campo => $tipo) {
            if(!isset($albumData->$campo) || $albumData->$campo === '') {
                $this->view->response('Error: Falta el campo requerido: ' . $campo, 400);
                return;
            }

            if(gettype($albumData->$campo) !== $tipo) {
                $this->view->response('Error: El campo ' . $campo . ' debe ser del tipo ' . $tipo, 400);
                return;
            }
        }

        $artista = $this->artistaModel->getArtistaById($albumData->id_artista);

        if(empty($artista)) {
            $this->view->response('Error: No se encontro ningun artista con id proporcionado', 404);
            return;
        }

        $nombre = $albumData->nombre;
        $genero = $albumData->genero;
        $id_artista = $albumData->id_artista;

        $this->albumModel->update($nombre, $genero, $id_artista, $id_album);

        $this->view->response('Album editado con exito', 201);
    }
}