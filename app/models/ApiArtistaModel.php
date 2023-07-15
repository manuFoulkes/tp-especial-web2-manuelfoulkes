<?php

class ApiArtistaModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;db_name=coleccion_albunes;charset=utf8','root','');
    }

    public function getArtistaById($id) {
        $query = $this->db->prepare('SELECT * FROM artista WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getAll($sort, $startIndex, $limit) {
        $orderBy = ($sort === 'cantidad_albunes') ? 'al.id' : 'a. ' . $sort;
        
        $stmt = 'SELECT a.*, al.id 
                FROM artista a 
                LEFT JOIN album al ON a.id = al.id_artista 
                ORDER BY ' . $orderBy . ' LIMIT ?, ?';

        $query = $this->db->prepare($stmt);
        $query->execute([$startIndex, $limit]);

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