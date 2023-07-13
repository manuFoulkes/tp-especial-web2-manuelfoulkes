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
}