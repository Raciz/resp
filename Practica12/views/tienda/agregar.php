<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo redireccionara al login
    echo "<script>
            window.location.replace('index.php');
          </script>";
}

//se verifica si se deve llamar al controller para agregar una nueva tienda
if(isset($_GET["action"]) && $_GET["action"]=="agregar")
{
    //se crea un objeto de mvcTienda
    $agregar = new mvcTienda();
    
    //se manda a llamar el controller para agregar una tienda
    $agregar -> agregarTiendaController();
}
?>

<!--modal para agregar una nueva Tienda-->
<div class="modal modal-info fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nueva Tienda</h4>
            </div>
            <!--formulario para mostrar los datos a ingresar para registrar la tienda-->            
            <form role="form" method="post" autocomplete="off" action="index.php?section=tienda&action=agregar">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                    </div>

                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" name="direccion" placeholder="Direccion" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Estado</label>
                        <br>
                        <label>
                            <input value="1" type="radio" name="estado" class="minimal" required> Activa
                        </label>
                        <br>
                        <label>
                            <input value="0" type="radio" name="estado" class="minimal" required> Desactivada
                        </label>
                    </div>


                </div>
                <!--boton para enviar la informacon ingresada en le sistema-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline">Registrar</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>