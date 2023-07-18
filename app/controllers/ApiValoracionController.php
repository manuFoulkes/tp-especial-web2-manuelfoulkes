<?php

require_once 'app/models/ApiValoracionModel.php';
require_once 'app/models/ApiAlbumModel.php';
require_once 'app/models/ApiUsuarioModel.php';
require_once 'app/views/ApiView.php';

class ApiValoracionController {

    private $valoracionModel;
    private $albumModel;
    private $usuarioModel;
    private $view;
    private $valoracionData;

    public function __construct() {
        $this->valoracionModel = new ApiValoracionModel();
        $this->albumModel = new ApiAlbumModel();
        $this->usuarioModel = new ApiUsuarioModel();
        $this->view = new ApiView();
        $this->valoracionData = file_get_contents('php://input');
    }

    public function getValoracionData() {
        return json_decode($this->valoracionData);
    }

    public function valorarAlbum($params = null) {
        if(!isset($params[':ID']) || !is_numeric($params[':ID']) || $params[':ID'] <= 0) {
            $this->view->response('Error: Parametro ID invalido', 400);
            return;
        }

        $album = $this->albumModel->getAlbumById($params[':ID']);

        if($album->id === null) {
            $this->view->response('El Album con el id ' . $params[':ID'] . ' no existe', 404);
            return;
        }

        $valoracionData = $this->getValoracionData();

        if(!isset($valoracionData->valoracion) || !is_numeric($valoracionData->valoracion) || $valoracionData->valoracion < 0 || $valoracionData->valoracion > 5) {
            $this->view->response('Error: Campo valoracion invalido', 400);
            return;
        }

        $id_album = $params[':ID'];
        $id_usuario = $this->usuarioModel->getUserId();
        $valoracion = $valoracionData->valoracion;

        $idUltimaValoracion = $this->valoracionModel->addValoracion($valoracion, $id_album, $id_usuario);
        
        if(empty($idUltimaValoracion)) {
            $this->view->response('Error: No se pudo agregar la valoracion', 500);
            return;
        }

        $this->view->response('Valoracion agregada con exito', 201);
    }

    public function updateValoracion($params = null) {
        if(!isset($params[':ID']) || !is_numeric($params[':ID']) || $params[':ID'] <= 0) {
            $this->view->response('Error: Parametro ID invalido', 400);
            return;
        }

        $valoracion = $this->valoracionModel->getValoracionById($params[':ID']);

        if(empty($valoracion)) {
            $this->view->response('Error: No existe una valoracion con el ID proporcionado', 404);
            return;
        }

        $valoracionData = $this->getValoracionData();

        if(!isset($valoracionData->valoracion) || !is_numeric($valoracionData->valoracion) || $valoracionData->valoracion < 0 || $valoracionData->valoracion > 5) {
            $this->view->response('Error: El campo valoracion no es valido', 400);
            return;
        }

        $idValoracion = $params[':ID'];
        $valoracion = $valoracionData->valoracion;

        $this->valoracionModel->updateValoracion($valoracion, $idValoracion);

        $this->view->response("Valoracion actualizada con exito", 201);
    }

    public function deleteValoracion($params = null) {
        if(!isset($params[':ID']) || !is_numeric($params[':ID']) || $params[':ID'] <= 0) {
            $this->view->response('Error: Parametro ID invalido', 400);
            return;
        }

        $valoracion = $this->valoracionModel->getValoracionById($params[':ID']);

        if(empty($valoracion)) {
            $this->view->response('Error: No se encontro ninguna valoracion con el ID proporcionado', 404);
            return;
        }

        $idValoracion = $params[':ID'];

        $this->valoracionModel->deleteValoracion($idValoracion);

        $this->view->response('Valoracion eliminada con exito', 201);
    }

    public function getValoracionPromedio($params = null) {
        if(!isset($params[':ID']) || !is_numeric($params[':ID']) || $params[':ID'] <= 0) {
            $this->view->response('Error: Parametro ID invalido', 400);
            return;
        }

        $album = $this->albumModel->getAlbumById($params[':ID']);

        if($album->id === null) {
            $this->view->response('Error: No se encontro el album', 404);
            return;
        }

        $valoracionPromedio = $this->valoracionModel->getPromedioByAlbum($album->id);

        if($valoracionPromedio->valoracion_promedio === null) {
            $this->view->response('El album no tiene valoraciones', 404);
            return;
        }

        $this->view->response($valoracionPromedio, 200);
    }

    public function getValoracionesAlbum($params = null) {
        if(!isset($params[':ID']) || !is_numeric($params[':ID']) || $params[':ID'] <= 0) {
            $this->view->response('Error: Parametro ID invalido', 400);
            return;
        }

        $album = $this->albumModel->getAlbumById($params[':ID']);

        if($album->id === null) {
            $this->view->response('Error: No se encontro el album', 404);
            return;
        }

        $valoraciones = $this->valoracionModel->getValoracionesAlbum($album->id);

        if(empty($valoraciones)) {
            $this->view->response("El album no tiene valoraciones", 404);
            return;
        }

        $this->view->response($valoraciones, 200);
    }

    public function generarValoraciones($params = null) {
        $id_usuario = 2;
        $ultimaInsersion = $this->valoracionModel->cargarRandom($id_usuario);

        if(!$ultimaInsersion) {
            $this->view->response('No se pudo realizar la insersion masiva', 500);
            return;
        }

        $this->view->response('Insersion masiva de valoraciones realizada con exito', 200);
    }
}