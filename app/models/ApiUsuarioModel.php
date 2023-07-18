<?php

class ApiUsuarioModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=coleccion_albunes;charset=utf8','root','');
    }

    public function getUserId() {
        $query = $this->db->prepare('SELECT id FROM usuario');
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        return $result ? $result->id : null;
    }
}