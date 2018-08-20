<?php
//verificamos qe el usuario haya iniciado sesion
if(!isset($_SESSION["maestro"]))
{
    header("location:index.php");
}
//Creamos un objeto de mvcController
$registro = new mvcController();

//obtenemos el controller para registrar una tutoria
$registro -> registroTutoriaController();
?>
<center><h1>Agregar Tutoria</h1></center>
<!--Formulario para agregar una nueva tutoria-->
<form method="post">
    <label>Tutorado: </label>
    <select name="alumno" class="alumno" required>
        <option value="">Seleccione Alumno</option>
        <?php
        //obtenemos a los tutorados del maestro
        $registro -> tutoradosController();
        ?>
    </select>
    <br>
    <label>Tipo de Tutoria: </label>
    <select name="tipo" class="tipo" required>
        <option value="">Seleccione Tipo de Tutoria</option>
        <option value="Individual">Individual</option>
        <option value="Grupal">Grupal</option>
    </select>
    <br>
    <label>Descripcion de la Tutoria: </label>
    <textarea name="tutoria" placeholder="Descripcion de Tutoria"></textarea>

    <input type="submit" value="Enviar" name="enviar">
</form>

<script>
    //convertimos los selects en select2
    $(document).ready(function() {
        $('.alumno').select2();
    });

    $(document).ready(function() {
        $('.tipo').select2();
    });
</script>