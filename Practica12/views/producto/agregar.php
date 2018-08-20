<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo redireccionara al login
    echo "<script>
            window.location.replace('index.php');
          </script>";
}

//verificamos si se debe llamar al controller para agregar un nuevo producto a la tienda
if(isset($_GET["action"]) && $_GET["action"]=="agregar")
{
    //se crea un objeto de mvcProducto
    $agregar = new mvcProducto();

    //se manda a llamar el controller para agregar un nuevo producto a la tienda 
    $agregar -> agregarProductoController();
}
?>

<!--modal para agregar un nuevo producto a la tienda-->
<div class="modal modal-info fade" id="modal-info-producto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nuevo Producto</h4>
            </div>

            <!--Formulario para introducir los datos del nuevo producto-->
            <form enctype="multipart/form-data" role="form" method="post" autocomplete="off" action="index.php?section=producto&action=agregar&shop=<?php echo $_GET["shop"]; ?>">
                <div class="modal-body">

                   <div class="form-group">
                        <label>Producto</label>
                        <select name="producto" class="form-control select2" style="width: 100%;" required>
                            <?php
                            //creamos un objeto de mvcProducto
                            $option = new mvcProducto();

                            //mandamos a llamar el controller para traer todad los productos en options de un select
                            $option -> optionProductoController();
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Referencia</label>
                        <input type="text" class="form-control" name="referencia" placeholder="Referencia" required>
                    </div>

                    

                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock" placeholder="Stock" required>
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