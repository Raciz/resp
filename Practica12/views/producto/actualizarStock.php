<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo redireccionara al login
    echo "<script>
            window.location.replace('index.php');
          </script>";
}

//verificamos si se debe llamar al controller para modificar el stock del producto
if(isset($_GET["action"]) && $_GET["action"]=="actualizarStock")
{
    //se crea un objeto de mvcInventario
    $agregar = new mvcProducto();

    //se manda a llamar el controller para modificar el stock del producto 
    $agregar -> stockProductoController();
}
?>

<!--modal para agregar un nuevo movimiento en el inventario de un producto-->
<div class="modal modal-info fade" id="modal-info-stock">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modificar Stock</h4>
            </div>

            <!--Formulario para modificar el stock-->
            <form role="form" method="post" autocomplete="off" action="index.php?section=producto&product=<?php echo $_GET["product"]; ?>&action=actualizarStock&shop=<?php echo $_GET["shop"]; ?>">
                <div class="modal-body">

                    <input type="hidden" id="type" name="type">

                    <div class="form-group">
                        <label>Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" placeholder="Cantidad" required>
                    </div>

                    <div class="form-group">
                        <label>Referencia</label>
                        <input type="text" class="form-control" name="referencia" placeholder="Referencia" required>
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

<script>
    //funcion para obtener el tipo de actualizacion del stock
    function typeOfUpdate(type)
    {
        //obtenemos el objeto del input hidden
        var input = document.getElementById("type");

        //le asignamos a en value el el tipo de modificacion 
        input.setAttribute("value",type);
    }
</script>