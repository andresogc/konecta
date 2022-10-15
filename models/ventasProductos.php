<?php

 
class VentaProducto{
    private $id;
    private $venta_id ;
    private $producto_id ;
    private $cantidad;
    private $db;

    
    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }

    function getVenta_id(){
        return $this->venta_id;
    }

    function getProducto_id(){
        return $this->producto_id;
    }

    function getCantidad(){
        return $this->cantidad;
    }

    
   
    function setId($id){
        $this->id=$id;
    }

    function setVenta_id($venta_id){
        $this->venta_id= $this->db->real_escape_string($venta_id);
    }

    function setProducto_id($producto_id){
        $this->producto_id = $this->db->real_escape_string($producto_id);
    }

    function setCantidad($cantidad){
        $this->cantidad= $this->db->real_escape_string($cantidad);
    }

           
    
    public function save(){
        $venta = $this->db->query("SELECT * FROM ventas ORDER BY id ASC LIMIT 1");
        $VentaObj = $venta->fetch_object();
          
        $insert="INSERT INTO ventas_productos VALUES(NULL,{$VentaObj->id},{$this->getProducto_id()},{$this->getCantidad()})";

        $save=$this->db->query($insert);
        
        $result=false;
        if($save){
            $result=true;
        }
        return $result;     
        
    }


}