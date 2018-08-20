<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
   //si no ha iniciado sesion, lo redirigimos al login
    echo "<script>
            window.location.replace('index.php');
          </script>";
}

//verificamos si se debe llamar al controller para agregar un nueva unidad
if(isset($_GET["action"]) && $_GET["action"]=="add")
{
    //se crea un objeto de mvcUnidad
    $add = new mvcUnidad();

    //se manda a llamar el controller para agregar una nueva unidad al sistema
    $add -> agregarUnidadController();
}
?>

<!-- Modal para agregar una nueva unidad-->
<div id="agregar-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <!--Formulario para agregar una nueva unidad-->
        <form action="index.php?section=units&action=add" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title repairtext">Add a new unit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label repairtext">Name</label>
                            <input type="text" name="nombre" class="form-control" id="field-3" placeholder="Name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label repairtext">Beginning date</label>
                            <input type="date" name="inicio" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label repairtext">Finishing date</label>
                            <input type="date" name="fin" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-custom waves-effect waves-light">Save</button>
            </div>
        </div>
    </form>
    </div>
</div>
<!-- /.modal -->
