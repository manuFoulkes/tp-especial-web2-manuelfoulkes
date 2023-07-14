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
}