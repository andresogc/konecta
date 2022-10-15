<!-- tabla de productos -->


<div class="card mt-5" >
  <div class="card-header">
  <h5 class="card-title">Lista de productos</h5>
    <div class="text-end">
    <a href="<?=base_url?>producto/crear" class="btn btn-success">Crear producto</a>
    </div>
    <?php if(isset($_SESSION['producto']) && $_SESSION['producto']=='complete'):?>
        <strong class="alert alert-success" role="alert">El producto se ha creado correctamente</strong>
    <?php elseif(isset($_SESSION['producto']) && $_SESSION['producto']!='complete'):?>
        <strong class="alert alert-danger" role="alert">El producto no se ha creado correctamente</strong>
    <?php endif;?>
    <?php Utils::deleteSession('producto');?>

    <?php if(isset($_SESSION['delete']) && $_SESSION['delete']=='complete'):?>
       <strong class="alert alert-success" role="alert">El producto se ha borrado correctamente</strong>
    <?php elseif(isset($_SESSION['delete']) && $_SESSION['delete']!='complete'):?>
      <strong class="alert alert-danger" role="alert">El producto no se ha borrado correctamente</strong>
    <?php endif;?>
    <?php Utils::deleteSession('delete');?>
  </div>
  <div class="card-body">
  <div class="mt-5">
    
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Referencia</th>
            <th scope="col">Precio</th>
            <th scope="col">Peso</th>
            <th scope="col">Stock</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
            <?php while ($producto = $productos->fetch_object()): ?>
                <tr>
                    <td><?= $producto->nombre; ?></td>
                    <td><?= $producto->referencia; ?></td>
                    <td><?= $producto->precio; ?></td>
                    <td><?= $producto->peso; ?></td>
                    <td><?= $producto->stock; ?></td>
                    <td>
                      <a class="btn btn-warning btn-sm" href="<?=base_url?>producto/editar&id=<?=$producto->id?>" >Editar</a>
                      <a class="btn btn-danger btn-sm" href="<?=base_url?>producto/eliminar&id=<?=$producto->id?>" id="eliminar">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
  </div>
</div>
<script>
  $('#eliminar').on('click',function (e) { 
    e.preventDefault();
    let urlEliminar = $(this).prop('href')
    Swal.fire({
      icon: 'warning',
      title: 'Se dispone a eliminar un producto.Esta acción no se puede deshacer.',
      text: 'Desea continuar con esta acción?',
      showCancelButton: true,
      confirmButtonText: `<a style="text-decoration:none; color:white" href="${urlEliminar}" id="editar">Eliminar</a>`,
     
    })
  });

</script>
