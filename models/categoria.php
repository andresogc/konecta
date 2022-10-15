<?php

class Categoria{
    private $id;
    private $nombre;
    private $db;

    
    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }

    function getNombre(){
        return $this->nombre;
    }

    function setId($id){
        $this->id=$id;
    }

    function setNombre($nombre){
        $this->nombre=$this->db->real_escape_string($nombre);
    }

    public function getAll(){
        $categorias=$this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        return $categorias; 
    }

}    