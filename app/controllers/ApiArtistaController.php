<?php

require_once 'app/models/ApiArtistaModel.php';
require_once 'app/models/ApiAlbumModel.php';
require_once 'app/models/ApiValoracionModel.php';
require_once 'app/views/ApiView.php';

class ApiArtistaController {

    private $artistaModel;
    private $albumModel;
    private $valoracionModel;
    private $view;
    private $artistaData;

    public function __construct() {
        $this->artistaModel = new ApiArtistaModel();
        $this->albumModel = new ApiAlbumModel();
        $this->valoracionModel = new ApiValoracionModel();
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
            $validColumns = ['nombre', 'genero', 'cantidad_albunes'];

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
}