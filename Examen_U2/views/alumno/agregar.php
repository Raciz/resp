<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo sacamos a la seccion publica
    echo "<script>
            window.location.replace('index.php');
          </script>";
}

//verificamos si se debe llamar al controller para agregar un nuevo alumno
if(isset($_GET["action"]) && $_GET["action"]=="agregar")
{
    //se crea un objeto de mvcAlumno
    $agregar = new mvcAlumno();

    //se manda a llamar el controller para agregar un nuevo Alumno al sistema 
    $agregar -> agregarAlumnoController();
}
?>

<!--modal para agregar un nuevo Alumno-->
<div class="modal modal-info fade" id="new-alumno">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Nuevo Alumno</h4>
            </div>

            <!--Formulario para introducir los datos del nuevo Alumno-->
            <form role="form" method="post" autocomplete="off" action="index.php?section=alumno&action=agregar">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese Nombre" required>
                    </div>

                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-control" name="apellido" placeholder="Ingrese Apellido" required>
                    </div>


                    <div class="form-group">
                        <label>Fecha de Nacimiento</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input name="fecha" type="text" class="form-control pull-right" id="datepicker">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Grupo</label>
                        <select name="grupo" class="form-control select2" style="width: 100%;" required>
                            <?php
                            //creamos un objeto de mvcGrupo
                            $option = new mvcGrupo();
                            
                            //se manda a llamar al control para traer a los grupos en options
                            $option -> optionGrupoController();
                            ?>
                        </select>
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