<?php

class ApiAlbumModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=coleccion_albunes;charset=utf8','root','');
    }

    public function getAll($sort, $startIndex, $limit) {
    
        $stmt = "SELECT a.*, artista.nombre AS nombre_artista
                FROM album a 
                LEFT JOIN artista ON a.id_artista = artista.id
                ORDER BY " . $sort . " LIMIT :startIndex, :limit";
    
        $query = $this->db->prepare($stmt);
        $query->bindParam(':startIndex', $startIndex, PDO::PARAM_INT);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
    
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    

    public function getAlbumById($id) {
        $stmt = 'SELECT a.*, AVG(v.valoracion) 
                AS valoracion_promedio 
                FROM album a 
                LEFT JOIN valoracion v ON a.id = v.id_album 
                WHERE a.id = ?';

        $query = $this->db->prepare($stmt);
        $query->execute([$id]);
        $album = $query->fetch(PDO::FETCH_OBJ);

        return $album !== false ? $album : false;
    }

    public function addAlbum($nombre, $genero, $id_artista) {
        $query = $this->db->prepare('INSERT INTO album (nombre, genero, id_artista) VALUES (?,?,?)');
        $query->execute([$nombre, $genero, $id_artista]);

        return $this->db->lastInsertId();
    }

    public function update($nombre, $genero, $id_artista, $id_album) {
        $query = $this->db->prepare('UPDATE album SET nombre = ?, genero = ?, id_artista = ? WHERE id = ?');
        $query->execute([$nombre, $genero, $id_artista, $id_album]);
    }

    public function deleteAlbum($id) {
        $query = $this->db->prepare('DELETE FROM album WHERE id = ?');
        $query->execute([$id]);
    }

    public function getAlbunesByArtista($id_artista) {
        $query = $this->db->prepare('SELECT * FROM album WHERE id_artista = ?');
        $query->execute([$id_artista]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}