<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo sacamos a la seccion publica
    echo "<script>
            window.location.replace('index.php');
          </script>";
}

//verificamos si se debe llamar al controller para agregar un nuevo grupo
if(isset($_GET["action"]) && $_GET["action"]=="agregar")
{
    //se crea un objeto de mvcGrupo
    $agregar = new mvcGrupo();
    
    //se manda a llamar el controller para agregar un nuevo Grupo al sistema 
    $agregar -> agregarGrupoController();
}
?>

<!--modal para agregar un nuevo Grupo-->
<div class="modal modal-info fade" id="new_grupo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Nuevo Grupo</h4>
            </div>
            
            <!--Formulario para introducir los datos del nuevo grupo-->
            <form role="form" method="post" autocomplete="off" action="index.php?section=grupo&action=agregar">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nombres</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese Nombre" required>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline">Registrar</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>