<?php

 
class Venta{
    private $id;
    private $costo_total;
    private $fecha;
    private $hora;
    private $db;

    
    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }

    function getCostoTotal(){
        return $this->costo_total;
    }

    function getFecha(){
        return $this->fecha;
    }

    function getHora(){
        return $this->hora;
    }

    function setId($id){
        $this->id=$id;
    }

    function setCostoTotal($costo_total){
        $this->costo_total= $this->db->real_escape_string($costo_total);
    }

    function setFecha($fecha){
        $this->fecha= $this->db->real_escape_string($fecha);
    }

    function setHora($hora){
        $this->hora=$this->db->real_escape_string($hora); 
    }

       
    public function getAll(){
        $productos= $this->db->query("SELECT * FROM ventas ORDER BY id DESC");
        return $productos;
    }
    
    public function getOne(){
        $productos= $this->db->query("SELECT * FROM ventas WHERE id= {$this->getId()}");
        return $productos->fetch_object();
    }

    public function getProductosByVenta($id){

        $sql = "SELECT pr.*, lp.unidades  FROM productos pr"
                ." INNER JOIN ventas_productos lp ON pr.id = lp.producto_id"
                ." where lp.pedido_id={$id}";        
        
        $productos= $this->db->query($sql);
        return $productos;
        
    }



    public function save(){
        $sql="INSERT INTO ventas VALUES(NULL,{$this->getCostoTotal()},CURDATE(),CURTIME());";
        $save = $this->db->query($sql); 
                
        $result=false;
        if($save){
            $result=true;
        }
        return $result;
      
    }

    


    public function edit(){
        $sql="UPDATE ventas SET estado='{$this->getEstado()}'";
        $sql.=" WHERE id={$this->getId()};";
    
            $save = $this->db->query($sql); 
            
                            
            $result=false;
            if($save){
                $result=true;
            }
            return $result;
    
            
        }
    


}