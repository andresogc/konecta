<?php

 
class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $referencia;
    private $precio;
    private $peso;
    private $stock;
    private $fecha_creacion;
    private $db;

    
    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }

    function getCategoria_id(){
        return $this->categoria_id;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getReferencia(){
        return $this->referencia;
    }

    function getPrecio(){
        return $this->precio;
    }

    function getPeso(){
        return $this->peso;
    }

    function getStock(){
        return $this->stock;
    }

    function getFechaCreacion(){
        return $this->fecha_creacion;
    }
   
    function setId($id){
        $this->id=$id;
    }

    function setCategoria_id($categoria){
        $this->categoria_id= $this->db->real_escape_string($categoria);
    }

    function setNombre($nombre){
        $this->nombre= $this->db->real_escape_string($nombre);
    }

    function setReferencia($referencia){
        $this->referencia= $this->db->real_escape_string($referencia);
    }

    function setPrecio($precio){
        $this->precio=$this->db->real_escape_string($precio); 
    }

    function setPeso($peso){
        $this->peso=$this->db->real_escape_string($peso); 
    }

    function setStock($stock){
        $this->stock=$this->db->real_escape_string($stock);
    }

    function setFechaCreacion($fechaCreacion){
        $this->fecha_creacion=$this->db->real_escape_string($fechaCreacion);
    }

    public function getAll(){
        $productos= $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;

    }

    public function getAllCategory(){
        $sql="SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
            ."INNER JOIN categorias c ON c.id = p.categoria_id "
            ."WHERE p.categoria_id = {$this->getCategoria_id()} "
            ."ORDER BY id DESC";
        $productos= $this->db->query($sql);
        return $productos;

    }

    public function getRamdom($limit){
        $productos=$this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit ");
        return $productos;
    }
    
    public function getOne(){
        $productos= $this->db->query("SELECT * FROM productos WHERE id= {$this->getId()}");
        return $productos->fetch_object();

    }


    public function save(){
        $sql="INSERT INTO productos VALUES(NULL,'{$this->getCategoria_id()}','{$this->getNombre()}','{$this->getReferencia()}',{$this->getPrecio()},{$this->getPeso()},{$this->getStock()},CURDATE());";
        $save = $this->db->query($sql); 

        $result=false;
        if($save){
            $result=true;
        }
        return $result;
        
    }

    public function edit(){
    $sql="UPDATE productos SET  categoria_id={$this->getCategoria_id()} , nombre='{$this->getNombre()}',referencia='{$this->getReferencia()}', precio={$this->getPrecio()},peso={$this->getPeso()},stock={$this->getStock()}";
              
        $sql.=" WHERE id={$this->id};";

        $save = $this->db->query($sql); 

        $result=false;
        if($save){
            $result=true;
        }
        return $result;
       
    }


    public function delete(){
    $sql="DELETE FROM productos WHERE id={$this->id}";
    $delete=$this->db->query($sql);
    
    $result=false;
        if($delete){
            $result=true;
        }
        return $result;


    }


    public function updateStock(){
        $sql="UPDATE productos SET  stock={$this->getStock()}";
              
        $sql.=" WHERE id={$this->id};";

        $save = $this->db->query($sql); 

        $result=false;
        if($save){
            $result=true;
        }
        return $result;
    
    }
    


}