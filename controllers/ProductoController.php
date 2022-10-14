<?php
//require_once 'models/producto.php';

class ProductoController{
    
    public function index(){
       /*  $producto=new producto();
        $productos=$producto->getRamdom(6); */
        //renderizar vista
        require_once 'views/producto/index.php';
    }


   
}