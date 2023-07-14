<?php

class ApiAlbumModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;db_name=coleccion_albunes;charset=utf8','root','');
    }

    public function getAll($sort, $startIndex, $limit) {
        $query = $this->db->prepare("SELECT * FROM album ORDER BY " . $sort . " LIMIT ?, ?");
        $query->execute([$startIndex, $limit]);
        return  $query->fetchAll(PDO::FETCH_OBJ);
    }
}