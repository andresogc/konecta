

<div class="d-flex justify-content-center">
    <div class="card mt-5 w-50 " >
        <div class="card-header">
            <h5>Nueva venta </h5>
           
            <div class="text-end">
                <a href="<?=base_url?>producto/index" class="btn btn-info">Ir a lista de productos</a>
            </div>
        </div>
       
        <div class="card-body ">
            <div class="mb-5">
                <?php if(isset($_SESSION['venta']) && $_SESSION['venta']['complete']):?>
                    <div class="row" id="msg" >
                        <div class="col">
                            <strong class="alert alert-success" role="alert">Venta exitosa</strong>
                        </div>
                        <div class="col">
                            <h6 class="text-success">Producto vendido: <?php  echo $_SESSION['venta']['producto'] ?></h6 class="text-success">
                            <h6 class="text-success">Cantidad: <?php  echo  $_SESSION['venta']['cantidad'] ?></h6 class="text-success">
                            <h6 class="text-success">Total: $<?php  echo  $_SESSION['venta']['total'] ?></h6 class="text-success">
                        </div>
                    </div>
                <?php elseif(isset($_SESSION['venta']) && $_SESSION['venta']!='complete'):?>
                    <strong class="alert alert-danger" role="alert">No fue posible generar la venta</strong>
                <?php endif;?>
                <?php Utils::deleteSession('venta');?>
            </div>
            <form action="<?=base_url.'/venta/add'?>" method="POST" id="form">
                <div class="mb-3">
                    <label for="producto" class="form-label">Producto</label>
                    <select class="form-select" aria-label="Default select example" id="producto" name="producto">
                        <option selected disabled>Seleccione una opción</option>
                        <?php  while ($producto = $productos->fetch_object()): ?>
                            <option value="<?= $producto->id ?>" producto-precio="<?= $producto->precio ?>"  producto-stock="<?= $producto->stock ?>"><?= $producto->nombre ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3 ">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" disabled >
                </div>
                <div class="mb-3 ">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" >
                </div>
                <div class="mb-3 ">
                        <label for="precio" class="form-label">Precio unidad($)</label>
                        <input type="number" class="form-control" id="precio" name="precio" disabled >
                </div>
                <div class="mb-3 ">
                        <label for="stock" class="form-label">Total($) </label>
                        <input type="number" class="form-control" id="total" name="total" disabled >
                </div>
                
            </form>
            
        </div>
        <button type="button" class="btn btn-success" id="enviar" >Generar venta</button>
                            
    </div>
</div>
<script>
    $( document ).ready(function() {
        
        totalGeneral=0;

        $('#producto').on('change', function(){

            let precio = $('select[name="producto"] option:selected').attr('producto-precio');
            let stock = $('select[name="producto"] option:selected').attr('producto-stock');
            $('#msg').remove();
            $('#precio').val(precio);
            $('#stock').val(stock);
            calcular();
        });
        $('#cantidad').keyup( function(){
            calcular();
        });

        $('#cantidad').on('change', function(){
            calcular();
        });

        $('#enviar').on('click',function(e){
            e.preventDefault();
            let stock = $('select[name="producto"] option:selected').attr('producto-stock');
            let cantidad = $('#cantidad').val();
            let producto = $('#producto').val(); console.log(cantidad)
            //validar campos
            if(!producto && !cantidad || cantidad == ''){
                getMessage('error','No es posible completar la venta','Debe completar los campos.');
                return;
            }
            //validar stock y conpletar la venta si hay existencias
            if( stock && (parseInt(stock) - parseInt(cantidad))>=0){
                $( "#form" ).submit();
            }else{
                getMessage('error','No es posible completar la venta','El producto no tiene stock');
            }
        });


        function calcular() {

            let precio = $('select[name="producto"] option:selected').attr('producto-precio');
            let cantidad = $('#cantidad').val();
            if(precio && cantidad){
                let total = parseInt(precio) * parseInt(cantidad);
                $("#total").val(total);
            }
        }


        function getMessage(icono,titulo,texto) {
            Swal.fire({
                    icon: icono,
                    title: titulo,
                    text: texto,
                    
                })
            
        }
    });
</script>