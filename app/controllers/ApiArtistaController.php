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
}