<?php

class Utils{

    public static function deleteSession($name){
        if(isset ($_SESSION[$name])){
           $_SESSION[$name]=null;
           unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function showCategorias(){
        require_once 'models/categoria.php';
        $categoria=new Categoria();
        $categorias=$categoria->getAll();
        return $categorias;
    }
}