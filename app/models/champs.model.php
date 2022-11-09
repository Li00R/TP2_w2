<?php

class ChampsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_lol;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }


    public function getAll() {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase

        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM champs_table");
        $query->execute();

        // 3. obtengo los resultados
        $champs = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $champs;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM champs_table WHERE ID_champ = ?");
        $query->execute([$id]);
        $champ = $query->fetch(PDO::FETCH_OBJ);
        
        return $champ;
    }

    public function add($Champ_name, $ID_rol, $Line_name) {
        $query = $this->db->prepare("INSERT INTO champs_table (Champ_name, ID_rol, Line_name) VALUES (?, ?, ?)");
        $query->execute([$Champ_name, $ID_rol, $Line_name]);
        return $this->db->lastInsertId();
    }

    public function edit($Champ_name, $ID_rol, $Line_name, $id) {
        $query = $this->db->prepare('UPDATE champs_table SET Champ_name = ?, ID_rol = ?, Line_name = ? WHERE ID_champ = ?');
        try {
            $query->execute([$Champ_name, $ID_rol, $Line_name, $id]);
            return(true);
        }
        catch (PDOException $error){
            //error_log('PDO Exception: '.$error->getMessage());
            return;
        }
        //var_dump($query->errorInfo()); // y eliminar la redireccion
    }

    function delete($id) {
        $query = $this->db->prepare('DELETE FROM champs_table WHERE ID_champ = ?');
        $query->execute([$id]);
    }

}