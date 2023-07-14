<?php

class ApiValoracionModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;db_name=coleccion_albunes;charset=utf8','root','');
    }

    public function addValoracion($id_album, $id_usuario, $valoracion) {
        $query = $this->db->prepare('INSERT INTO valoracion (id_album, id_usuario, valoracion) VALUES (?,?,?)');
        $query->execute([$id_album, $id_usuario, $valoracion]);

        return $this->db->lastInsertId();
    }
}