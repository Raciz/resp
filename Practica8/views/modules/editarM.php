<?php
//se verifica que el usuario haya iniciado sesion y sea super usuario
if(!(isset($_SESSION) && $_SESSION["superUser"]))
{
    header("location:index.php");
}
//creamos un objeto de mvcController
$editar = new mvcController();
//obtenemos el controller para actualizar la informacion en el sistema
$editar -> updateMaestroController();

?>
<h1>Modificar Maestro</h1>

<form method="post">
	
	<?php
  //obtenemos la informacion del maestro
	$editar -> editMaestroController();
	?>

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