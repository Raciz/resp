<?php
//se verifica que el usuario haya iniciado sesion y sea super usuario
if(!(isset($_SESSION) && $_SESSION["superUser"]))
{
    header("location:index.php");
}

//creamos un objeto de mvcController 
$editar = new mvcController();

//obtenemos el controller para modificar su informacion en el sistema
$editar -> updateCarreraController();
?>
<h1>Modificar Carrera</h1>

<form method="post">
	
	<?php
  //obtenemos la informacion de la carrera
	$editar -> editCarreraController();
	?>

</form>