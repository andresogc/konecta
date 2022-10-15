

<div class="d-flex justify-content-center">
    <div class="card mt-5 w-50 " >
        <div class="card-header">
        <?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
            <h5>Edición de producto <?=$pro->nombre ?></h5>
            <?php $url_action = base_url."producto/save&id=".$pro->id; ?>
        <?php else: ?>
            <h1>Creación de producto</h1>
            <?php $url_action = base_url."producto/save"; ?>
        <?php endif; ?>


            <div class="text-end">
            <a href="<?=base_url?>producto/index" class="btn btn-info">Volver a lista de productos</a>
            </div>
                      
        </div>
        <div class="card-body ">
                <form action="<?=$url_action?>" method="POST" id="form">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : '' ; ?>">
                    </div>
                    <?php $categorias = Utils::showCategorias(); ?>
                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">Categoria</label>
                        <select class="form-select" aria-label="Default select example" id="categoria_id" name="categoria_id">
                            <option selected disabled>Seleccione una opción</option>
                            <?php  while ($categoria = $categorias->fetch_object()): ?>
                                <option value="<?= $categoria->id ?>" <?=isset($pro) && is_object($pro) && $categoria->id == $pro->categoria_id ? 'selected' :''  ; ?>><?= $categoria->nombre ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3 ">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input type="text" class="form-control" id="referencia" name="referencia" value="<?=isset($pro) && is_object($pro) ? $pro->referencia : '' ; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio" value="<?=isset($pro) && is_object($pro) ? $pro->precio : '' ; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="peso" class="form-label">Peso</label>
                        <input type="number" class="form-control" id="peso" name="peso" value="<?=isset($pro) && is_object($pro) ? $pro->peso : '' ; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="<?=isset($pro) && is_object($pro) ? $pro->stock : '' ; ?>">
                    </div>
                
                    <button type="submit" class="btn btn-success" id="guardar">Guardar</button>
                </form>

        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
      

        $('#guardar').on('click',function (e) {
            e.preventDefault();
            var nombre = $('#nombre').val();
            var categoria_id = $('#categoria_id').val();
            var referencia = $('#referencia').val();
            var peso = $('#peso').val();
            var precio = $('#precio').val();
            var stock = $('#stock').val();
            var nombre = $('#nombre').val();

            if(!nombre  || !categoria_id  || !referencia  || !peso || !precio || !nombre  || categoria_id ==""){
                return Swal.fire({
                    icon: 'error',
                    title: 'Formulario incompleto',
                    text: 'Complete todos los campos',
                    
                });

                
            }else{
                $( "#form" ).submit();
            }

        })


    });


</script>