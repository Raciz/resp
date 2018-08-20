<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo redireccionara al login
    echo "<script>
            window.location.replace('index.php');
          </script>";
}

//verificamos si se debe llamar al controller para agregar una categoria nueva
if(isset($_GET["action"]) && $_GET["action"]=="agregar")
{
    //se crea un objeto de mvcCategoria
    $agregar = new mvcCategoria();
    
    //se manda a llamar al controller que sirve para agregar una nueva categora
    $agregar -> agregarCategoriaController();
}
?>

<!--modal para agregar una nueva categoria-->
<div class="modal modal-info fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nueva Categoria</h4>
            </div>
            <!--formulario para mostrar los datos para registrar una categoria-->            
            <form role="form" method="post" autocomplete="off" action="index.php?section=categoria&action=agregar">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese Nombre" required>
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3" placeholder="Ingrese Descripción"></textarea>
                    </div>

                </div>
                <!--boton para enviar la informacion ingresada en el sistema-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline">Registrar</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>