<?php

class ChampsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_lol;charset=utf8', 'root', '', 
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public function getColumns() {

        $columns= array("ID_champ", "Champ_name","Line_name", "Rol_name");
        return $columns;
        // Lo dejo hardcodeado para no hacer mas demanda a la db, de todas formas
        // las columnas no se cambian seguido
        }

    public function getItems($config) {
        try {  //ID_champ no porque seria el get el que ya esta
            $query = $this->db->prepare("SELECT * FROM champs_table 
            LEFT JOIN roles_table ON champs_table.ID_rol = roles_table.ID_rol 
            WHERE ('all' = ? OR Champ_name = ? OR Line_name = ? OR Rol_name = ?) 
            ORDER BY $config->sort $config->order 
            LIMIT $config->page,$config->limit");
            $query->execute([$config->filter, $config->filter, $config->filter, $config->filter]);
            $champs = $query->fetchAll(PDO::FETCH_OBJ);
            return $champs;
        }
        catch (PDOException $error) {
            //error_log('PDO Exception: '.$error->getMessage());
            return;
        }
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM champs_table 
        LEFT JOIN roles_table 
        ON champs_table.ID_rol = roles_table.ID_rol 
        WHERE ID_champ = ?");
        $query->execute([$id]);
        $champ = $query->fetch(PDO::FETCH_OBJ);
        
        return $champ;
    }

    public function add($Champ_name, $ID_rol, $Line_name) {
        $query = $this->db->prepare("INSERT INTO champs_table (Champ_name, ID_rol, Line_name) 
        VALUES (?, ?, ?)");
        $query->execute([$Champ_name, $ID_rol, $Line_name]);
        return $this->db->lastInsertId();
    }

    public function edit($Champ_name, $ID_rol, $Line_name, $id) {
        $query = $this->db->prepare('UPDATE champs_table 
        SET Champ_name = ?, ID_rol = ?, Line_name = ? 
        WHERE ID_champ = ?');
        try {
            $query->execute([$Champ_name, $ID_rol, $Line_name, $id]);
            return(true); //confirma que se ejecuto el query
        }
        catch (PDOException $error){
            //error_log('PDO Exception: '.$error->getMessage());
            return;
        }
    }

    function delete($id) { // try catch por las dudas??
        $query = $this->db->prepare('DELETE FROM champs_table 
        WHERE ID_champ = ?');
        $query->execute([$id]);
    }

}