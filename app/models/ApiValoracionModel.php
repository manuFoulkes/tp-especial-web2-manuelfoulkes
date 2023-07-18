<?php

class ApiValoracionModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=coleccion_albunes;charset=utf8','root','');
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

    public function deleteValoracion($id) {
        $query = $this->db->prepare('DELETE FROM valoracion WHERE id = ?');
        $query->execute([$id]);
    }

    public function getPromedioByAlbum($id_album) {
        $query = $this->db->prepare('SELECT AVG(valoracion) AS valoracion_promedio FROM valoracion WHERE id_album = ?');
        $query->execute([$id_album]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getValoracionesAlbum($id_album) {
        $query = $this->db->prepare('SELECT * FROM valoracion WHERE id_album = ?');
        $query->execute([$id_album]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function cargarRandom($id_usuario) {
        $stmt = "INSERT IGNORE INTO valoracion (valoracion, id_album, id_usuario)
                SELECT FLOOR(RAND() * 5) + 1, id, :id_usuario FROM album";

        $query = $this->db->prepare($stmt);
        $query->execute([':id_usuario' => $id_usuario]);

        return $this->db->lastInsertId();
    }

}