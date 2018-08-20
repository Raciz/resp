<?php
//verificamos que el usuario haya iniciado sesion y que sea super usuario
if(!(isset($_SESSION) && $_SESSION["superUser"]))
{
    header("location:index.php");
}

//creamos un objeto de mvcController
$vista = new mvcController();
?>

<center><h1>Listado de Maestros</h1></center>

<!--Tabla para mostrar los maestro registrados en el sistema-->
<table id="maestro" class="display dataTable" style="width:100%">
    <thead>
        <tr>
            <th>Numero de Empleado</th>
            <th>Carrera</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Super Usuario</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //traemos la informacion de los maestros
        $vista -> reporteMaestroController();
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Numero de Empleado</th>
            <th>Carrera</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Super Usuario</th>
        </tr>
    </tfoot>
</table>
<br>
<br>
<br>
<br>
<br>

<!--Tabla para mostrar los alumnos registrados en el sistema-->
<center><h1>Listado de Alumno</h1></center>
<table id="alumno" class="display dataTable" style="width:100%">
    <thead>
        <tr>
            <th>Matricula</th>
            <th>Nombre</th>
            <th>Carrera</th>
            <th>Tutor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //traemos la informacion de los alumno
        $vista -> reporteAlumnoController();
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Matricula</th>
            <th>Nombre</th>
            <th>Carrera</th>
            <th>Tutor</th>
        </tr>
    </tfoot>
</table>
<br>
<br>
<br>
<br>
<br>
<center><h1>Listado de Tutorias</h1></center>
<!--Tabla para mostrar las tutorias registradas en el sistema-->
<table id="tutoria" class="display dataTable" style="width:100%">
    <thead>
        <tr>
            <th>Alumno</th>
            <th>Tutor</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo</th>
            <th>Descripcion</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //traemos la informacion de las tutorias
        $vista -> reporteTutoriaMaestroController();
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
        </tr>
    </tfoot>
</table>

<script>
    //convertimos las tabla de los listado en datatables
    $(document).ready(function() {
        $('#maestro').DataTable();
    } );

    $(document).ready(function() {
        $('#alumno').DataTable();
    } );

    $(document).ready(function() {
        $('#tutoria').DataTable();
    } );
</script>