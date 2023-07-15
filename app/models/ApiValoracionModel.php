<?php

class ApiValoracionModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;db_name=coleccion_albunes;charset=utf8','root','');
    }

    public function addValoracion($valoracion, $id_album, $id_usuario) {
        $query = $this->db->prepare('INSERT INTO valoracion (valoracion, id_album, id_usuario) VALUES (?,?,?)');
        $query->execute([$valoracion, $id_album, $id_usuario]);

        return $this->db->lastInsertId();
    }

    public function getValoracionById($id) {
        $query = $this->db->prepare('SELECT * FROM valoracion WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updateValoracion($valoracion, $id) {
        $query = $this->db->prepare('UPDATE valoracion SET valoracion = ? WHERE id = ?');
        $query->execute([$valoracion, $id]);
    }
}