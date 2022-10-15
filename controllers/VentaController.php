<?php
require_once 'models/venta.php';
require_once 'models/producto.php';
require_once 'models/ventasProductos.php';



class VentaController{
    
    public function hacer(){
        $producto = new producto();
        $productos = $producto->getAll();
        //renderizar vista
        require_once 'views/venta/index.php';
    }

    public function add(){
        
        $producto= isset($_POST['producto'])? $_POST['producto'] : false;
        $cantidad= isset($_POST['cantidad'])? $_POST['cantidad'] : false;
        if($producto && $cantidad){
            $id = $_POST['producto'];
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();
            $nuevoStock = $pro->stock - $cantidad;
            //comprobar stock y luego guardar venta
            if($nuevoStock >= 0 ){

                $coste = $pro->precio * $cantidad;
                //guardar datos en DB
                $venta = new Venta();
                $venta->setCostoTotal($coste);
                $save=$venta->save();
                //actualziar stock
                $producto->setStock($nuevoStock);
                $producto->updateStock();
                //guardar en tabla pivote ventas_productos
                $ventaProducto = new VentaProducto();
                $ventaProducto->setProducto_id($id); 
                $ventaProducto->setCantidad($cantidad);
                $save_ventas_productos = $ventaProducto->save();

                if($save && $save_ventas_productos){
                    $_SESSION['venta']=[ 'complete'=>true,'producto'=>$pro->nombre,'cantidad'=>$cantidad,'total'=>$coste ];
                    
                }else{
                    $_SESSION['venta']="failed";
                }
            }else{
                $_SESSION['venta']="failed";
            }
        }else{
            
            $_SESSION['pedido']="failed";
        }
        
        header("Location:".base_url.'venta/hacer');
    }


}