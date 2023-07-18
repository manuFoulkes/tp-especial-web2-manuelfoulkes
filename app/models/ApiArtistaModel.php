<?php

class ApiArtistaModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=coleccion_albunes;charset=utf8','root','');
    }

    public function getArtistaById($id) {
        $query = $this->db->prepare('SELECT * FROM artista WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getAll($sort, $startIndex, $limit) {        
        $stmt = 'SELECT *
                FROM artista
                ORDER BY ' . $sort . ' ASC
                LIMIT :startIndex, :limit';

        $query = $this->db->prepare($stmt);
        $query->bindParam(':startIndex', $startIndex, PDO::PARAM_INT);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getArtistaByName($nombre) {
        $query = $this->db->prepare('SELECT * FROM artista WHERE nombre = ?');
        $query->execute([$nombre]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function addArtista($nombre, $genero) {
        $query = $this->db->prepare('INSERT INTO artista (nombre, genero) VALUES (?,?)');
        $query->execute([$nombre, $genero]);
        return $this->db->lastInsertId();
    }

    public function updateArtista($nombre, $genero, $id_artista) {
        $query = $this->db->prepare('UPDATE artista SET nombre = ?, genero = ? WHERE id = ?');
        $query->execute([$nombre, $genero, $id_artista]);
    }

    public function deleteArtista($id) {
        $query = $this->db->prepare('DELETE FROM artista WHERE id = ?');
        $query->execute([$id]);
    }
}