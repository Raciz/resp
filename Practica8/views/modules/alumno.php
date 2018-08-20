<?php
//verificamos que haya iniciado sesion y que sea super usuario
if(!(isset($_SESSION) && $_SESSION["superUser"]))
{
    header("location:index.php");
}

//creamos un objeto de mvcController
$vista = new mvcController();

//obtenemos el controller para borrar un alumno
$vista -> deleteAlumnoController();
?>
<center><h1>Listado de Alumno</h1></center>

<!--Boton para agregar un nuevo alumno-->
<a href="index.php?action=agregarA"><button>Agregar Alumno</button></a>

<!--tabla para mostrar a los alumnos registrados en el sistema-->
<table id="listaAlumno" class="display dataTable" style="width:100%">
    <thead>
        <tr>
            <th>Matricula</th>
            <th>Nombre</th>
            <th>Carrera</th>
            <th>Tutor</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //obtenemos la informacion de los alumnos
        $vista -> listaAlumnoController();
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Matricula</th>
            <th>Nombre</th>
            <th>Carrera</th>
            <th>Tutor</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </tfoot>
</table>

<script>
    //convertimos la tabla en dataTable
    $(document).ready(function() {
        $('#listaAlumno').DataTable();
    } );
</script>
