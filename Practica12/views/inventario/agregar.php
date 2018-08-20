<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo redireccionara al login
    echo "<script>
            window.location.replace('index.php');
          </script>";
}

//verificamos si se debe llamar al controller para agregar un nuevo producto al inventario
if(isset($_GET["action"]) && $_GET["action"]=="agregar")
{
    //se crea un objeto de mvcInventario
    $agregar = new mvcInventario();

    //se manda a llamar el controller para agregar un nuevo producto al inventario 
    $agregar -> agregarInventarioController();
}
?>

<!--modal para agregar un nuevo producto al inventario-->
<div class="modal modal-info fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nuevo Producto</h4>
            </div>

            <!--Formulario para introducir los datos del nuevo producto-->
            <form enctype="multipart/form-data" role="form" method="post" autocomplete="off" action="index.php?section=inventario&action=agregar">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Codigo</label>
                        <input type="text" class="form-control" name="codigo" placeholder="Ingrese Codigo" required>
                    </div>

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese Nombre" required>
                    </div>

                    <div class="form-group">
                        <label>Categoria</label>
                        <select name="categoria" class="form-control select2" style="width: 100%;" required>
                            <option value="">Seleccione Una Categoria</option>
                            <?php
                            //creamos un objeto de mvcCategoria
                            $option = new mvcCategoria();

                            //mandamos a llamar el controller para traer todad las categorias en options de un select
                            $option -> optionCategoriaController();
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" step="0.01" class="form-control" name="precio" placeholder="Ingrese Precio" required>
                    </div>

                    <div class="form-group">
                        <label>Imagen (tamaño maximo: 300 KB)</label>
                        <input type="file" name="img" accept="image/jpeg, image/png">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline">Registrar</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>