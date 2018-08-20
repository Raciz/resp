<?php
//verificamos que el usuario haya iniciado sesion y que sea super usuario
if(!(isset($_SESSION) && $_SESSION["superUser"]))
{
    header("location:index.php");
}
//se crea un objeto de mvcController
$vista = new mvcController();
//y el controller para eliminar un maestro
$vista -> deleteMaestroController();
?>
<center><h1>Listado de Maestros</h1></center>
<!--boton para agregar un nuevo maestro-->
<a href="index.php?action=agregarM"><button>Agregar Maestro</button></a>

<!--tabla para mostrar a los maestros registrados en el sistema-->
<table id="listaMaestro" class="display dataTable" style="width:100%">
    <thead>
        <tr>
            <th>Numero de Empleado</th>
            <th>Carrera</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Super Usuario</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //obtenemos la informacion de los maestros
        $vista -> listaMaestroController();
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Numero de Empleado</th>
            <th>Carrera</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Super Usuario</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </tfoot>
</table>

<script>
    //convertimos la tabla del listado de maestros en un datatable
    $(document).ready(function() {
        $('#listaMaestro').DataTable();
    } );
</script>
