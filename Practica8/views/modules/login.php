<?
//verificamos que el usuario se haya logeado
if(isset($_SESSION["maestro"]))
{
    header("location:index.php?action=tutoria");
}
?>
<center><h1>Iniciar Sesion</h1></center>

<!--formulario para que el usuario inicie sesion-->
<form method="post">
    <input type="text" placeholder="Numero de Empleado" name="num_empleado">
    <input type="password" placeholder="Contraseña" name="password">
    <input type="submit" value="Enviar" name="enviar">
</form>

<?php
//creamos un objeto de mvcController
$login = new mvcController();

//obtenemos el controller para iniciar sesion
$login -> loginController();
?>