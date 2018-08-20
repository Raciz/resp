<?php
//verificamos que el usuario haya iniciado sesion y sea super usuario
if(!(isset($_SESSION) && $_SESSION["superUser"]))
{
    header("location:index.php");
}
//creamos un objeto de mvcController
$registro = new mvcController();

//obtenemos el controller para registrar una carrera
$registro -> registroCarreraController();
?>
<center><h1>Agregar Carrera</h1></center>

<!--formulario para agregar una nueva carrera-->
<form method="post">
    <input type="text" placeholder="Nombre de la Carrera" name="carrera" required>
    <input type="submit" value="Enviar" name="enviar">
</form>