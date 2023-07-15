<?php

require_once 'app/models/ApiValoracionModel.php';
require_once 'app/models/ApiAlbumModel.php';
require_once 'app/models/ApiArtistaModel.php';
require_once 'app/views/ApiView.php';

class ApiValoracionController {

    private $valoracionModel;
    private $albumModel;
    private $artistaModel;
    private $view;
    private $valoracionData;

    public function __construct() {
        $this->valoracionModel = new ApiValoracionModel();
        $this->albumModel = new ApiAlbumModel();
        $this->artistaModel = new ApiArtistaModel();
        $this->view = new ApiView();
        $this->valoracionData = file_get_contents('php://input');
    }

    public function getValoracionData() {
        return json_decode($this->valoracionData);
    }

    // TODO: Agregar Auth
    public function valorarAlbum($params = null) {
        if(!isset($params[':ID']) || !is_numeric($params[':ID']) || $params[':ID'] <= 0) {
            $this->view->response('Error: Parametro ID invalido', 400);
            return;
        }

        $album = $this->albumModel->getAlbumById($params[':ID']);

        if(empty($album)) {
            $this->view->response('El Album con el id ' . $params[':ID'] . ' no eciste', 404);
            return;
        }

        $valoracionData = $this->getValoracionData();

        if(!isset($valoracionData->valoracion) || !is_numeric($valoracionData->valoracion) || $valoracionData->valoracion < 0 || $valoracionData->valoracion > 5) {
            $this->view->response('Error: Campo valoracion invalido', 400);
            return;
        }

        $id_album = $params[':ID'];
        $id_usuario = $_SESSION['USER_ID'];
        $valoracion = $valoracionData->valoracion;

        $idUltimaValoracion = $this->valoracionModel->addValoracion($id_album, $id_usuario, $valoracion);
        
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
}