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

    public function getAlbumData( ) {
        return json_decode($this->albumData);
    }
}