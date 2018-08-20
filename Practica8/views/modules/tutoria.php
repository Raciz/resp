<?php
//verificamos que el usuario haya iniciado sesion
if(!isset($_SESSION["maestro"]))
{
    header("location:index.php");
}

//creamos un objeto de mvcController
$vista = new mvcController();

//y el controller para eliminar una tutoria
$vista -> deleteTutoriaController();
?>

<center><h1>Listado de Tutorias</h1></center>

<!--boton para agregar una nueva tutoria-->
<a href="index.php?action=agregarT"><button>Agregar Tutoria</button></a>

<!--tabla para mostrar la tutorias impartidas por el maestro logeado-->
<table id="listaTutoria" class="display dataTable" style="width:100%">
    <thead>
        <tr>
            <th>Alumno</th>
            <th>Tutor</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo</th>
            <th>Descripcion</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //obtenemos la informacion de la tutorias impartidas por este maesto
        $vista -> listaTutoriaMaestroController();
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Alumno</th>
            <th>Tutor</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo</th>
            <th>Descripcion</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </tfoot>
</table>


<script>
    //convertimos la tabla del listado de tutorias en un datatable
    $(document).ready(function() {
        $('#listaTutoria').DataTable();
    } );
</script>
