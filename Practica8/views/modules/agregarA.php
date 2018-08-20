<?php
//verificamos que el usuario haya iniciado sesion y que sea super usuario
if(!(isset($_SESSION) && $_SESSION["superUser"]))
{
    header("location:index.php");
}

//creamos un objeto de mvcController
$registro = new mvcController();

//obtenemos el controler para registrar alumnos
$registro -> registroAlumnoController();
?>
<center><h1>Agregar Alumno</h1></center>

<!--Formulario para agregar un nuevo alumno-->
<form method="post">
    <label>Matricula:</label>
    <input type="text" placeholder="Matricula" name="matricula" required>
    <label>Nombre:</label>
    <input type="text" placeholder="Nombre" name="nombre" required>
    <br>
    <label>Carrera:</label>
    <select required name="carrera" class="carrera">
        <option value="">Seleccione Carrera</option>
        <?php
        //obtenemos las carreras registradas en el sistema
        $registro -> optionCarreraController();
        ?>
    </select>
    <br>
    <label>Tutor:</label>
    <select required name="tutor" class="tutor">
        <option value="">Seleccione Tutor</option>
        <?php
        //otenemos a los maestros registrados en el sistema
        $registro -> optionMaestroController();
        ?>
    </select>

    <input type="submit" value="Enviar" name="enviar">
</form>

<?php

?>

<script>
    //convertimos los selects en select2
    $(document).ready(function() {
        $('.carrera').select2();
    });

    $(document).ready(function() {
        $('.tutor').select2();
    });
</script>
