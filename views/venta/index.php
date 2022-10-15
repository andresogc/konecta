

<div class="d-flex justify-content-center">
    <div class="card mt-5 w-50 " >
        <div class="card-header">
        <h5>Nueva venta </h5>
            <div class="text-end">
            <a href="<?=base_url?>producto/index" class="btn btn-info">Ir a lista de productos</a>
            </div>
        </div>
        <div class="card-body ">
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
            $('#precio').val(precio);
            $('#stock').val(stock);
            calcular();
        });
        $('#cantidad').on('change', function(){
            calcular();
        });

        $('#enviar').on('click',function(e){
            e.preventDefault();
            let stock = $('select[name="producto"] option:selected').attr('producto-stock');
            let cantidad = $('#cantidad').val();
                       

            if( stock && cantidad && (parseInt(stock) - parseInt(cantidad))>=0){
                alert('venta ok')
                $( "#form" ).submit();
            }else{
                alert('venta no posible')
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
    });
</script>