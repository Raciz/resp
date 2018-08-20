<?php
//se verifica que el usuario haya iniciado sesion y sea super usuario
if(!(isset($_SESSION) && $_SESSION["superUser"]))
{
    header("location:index.php");
}

//creamos un objeto de mvcController
$editar = new mvcController();

//obtenemos el controller para modificar su informacion en el sistema
$editar -> updateAlumnoController();
?>
<h1>Modificar Alumno</h1>

<form method="post">

    <?php
    //obtenemos la informacion del alumno a modificar
    $editar -> editAlumnoController();
    ?>

</form>

<script>
    //convertimos los selects en select2
    $(document).ready(function() {
        $('.carrera').select2();
    });

    $(document).ready(function() {
        $('.tutor').select2();
    });

</script>