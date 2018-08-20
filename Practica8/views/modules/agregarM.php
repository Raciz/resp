<?php
if(!(isset($_SESSION) && $_SESSION["superUser"]))
{
    header("location:index.php");
}
//creamos un objeto de mvcController
$registro = new mvcController();

//obtenemos el controller para registrar un maestro
$registro -> registroMaestroController();
?>
<center><h1>Agregar Maestro</h1></center>

<form method="post">
    <label>Numero de Empleado:</label>
    <input type="text" placeholder="Numero de Empleado" name="num_empleado" required>
    <br>
    <label>Carrera:</label>
    <select required  name="carrera" class="carrera">
        <option value="">Seleccione Carrera</option>
        <?php
        //obtenemos el nombre de las carreras registradas en el sistema
        $registro -> optionCarreraController();
        ?>
    </select>
    <label>Nombre:</label>
    <input type="text" placeholder="Nombre" name="nombre" required>
    <label>Correo:</label>
    <input type="email" placeholder="Email" name="email" required>
    <label>Contraseña:</label>
    <input type="password" placeholder="Contraseña" name="password" required>
    <br>
    <label>Super Usuario: </label>
    <select name="super" class="super">
        <option value="0">¿Es Super Usuario?</option>
        <option value="0">NO</option>
        <option value="1">Si</option>
    </select>

    <input type="submit" value="Enviar" name="enviar">
</form>

<script>
    //convertimos los selects en select2
    $(document).ready(function() {
        $('.carrera').select2();
    });
    
    $(document).ready(function() {
        $('.super').select2();
    });
</script>