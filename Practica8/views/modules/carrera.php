<?php
//se verifica que el usuario haya iniciado sesion y sea super usuario
if(!(isset($_SESSION) && $_SESSION["superUser"]))
{
    header("location:index.php");
}

//creamos un objeto de mvcController
$vista = new mvcController();

//obtenemos el controller para eliminar una carrera
$vista -> deleteCarreraController();
?>
<center><h1>Listado de Carreras</h1></center>
<!--boton para agregar una nueva carrera-->
<a href="index.php?action=agregarC"><button>Agregar Carrera</button></a>

<!--tabla para mostrar la informacion de las carreras registradas en el sistema-->
<table id="listaCarrera" class="display dataTable" style="width:100%">
    <thead>
        <tr>
            <th>Nombre de la Carrera</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //obtenemos la informacion de las carreras
        $vista -> listaCarreraController();
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Nombre de la Carrera</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </tfoot>
</table>

<script>
    //convertimos la tabla en dataTable
    $(document).ready(function() {
        $('#listaCarrera').DataTable();
    } );
</script>
