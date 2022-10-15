<?php
require_once 'models/producto.php';

class ProductoController{
    
    public function index(){
        $producto = new producto();
        $productos = $producto->getAll();
        //renderizar vista
        require_once 'views/producto/index.php';
    }

    public function crear(){
        $producto = new producto();
        $productos = $producto->getAll();
        //renderizar vista
        require_once 'views/producto/crear.php';
    }

    public function save(){
       
        if(isset($_POST)){
                        
            $nombre= isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $categoria= isset($_POST['categoria_id']) ? $_POST['categoria_id'] : false;
            $referencia = isset($_POST['referencia']) ? $_POST['referencia'] : false;
            $precio= isset($_POST['precio']) ? $_POST['precio'] : false;
            $peso = isset($_POST['peso']) ? $_POST['peso'] : false;
            $stock= isset($_POST['stock']) ? $_POST['stock'] : false;
            
            //$imagen= isset($_POST['imagen']) ? $_POST['imagen'] : false;
            if($nombre && $categoria && $referencia && $precio && $peso && $stock){
               
                $producto= new Producto();
                $producto->setNombre($nombre);
                $producto->setCategoria_id($categoria);
                $producto->setReferencia($referencia);
                $producto->setPrecio($precio);
                $producto->setPeso($peso);
                $producto->setStock($stock);
                
                //
                if($_GET['id']){
                    $id=$_GET['id'];

                    $producto->setId($id);    
                    $save=$producto->edit();
                }else{
                    $save=$producto->save();
                }

                
                if($save){
                    $_SESSION['producto']="complete";

                }else{
                    $_SESSION['producto']="failed";
                }
            }else{
                    $_SESSION['producto']="failed";
            }
            header('Location:'.base_url.'producto/index');
        }
        
    }

    public function editar(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;
            
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();

            require_once 'views/producto/crear.php';
        }else{
            header('Location:'.base_url.'producto/index');
        }    
    }

    public function eliminar(){

        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $producto=new producto();
            $producto->setId($id);
            $delete=$producto->delete();
            
            if($delete){
                $_SESSION['delete']='complete';
            }else{
                $_SESSION['delete']='failed';
            }    
            
        }else{
            $_SESSION['delete']='failed';
        }
        
        header('Location:'.base_url.'producto/index');
    }

   
}