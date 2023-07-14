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
}