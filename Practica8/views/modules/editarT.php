<?php
//se verifica que el usuario haya iniciado sesion y sea super usuario
if(!isset($_SESSION["maestro"]))
{
    header("location:index.php");
}

//creamos un objeto de mvcController
$editar = new mvcController();

//obtenemos el controller para actualizar la informacion en el sistema
$editar -> updateTutoriaController();
?>
<h1>Modificar Tutoria</h1>

<form method="post">
	
	<?php
  //obtenemos la informacion de la tutoria
	$editar -> editTutoriaController();
	?>

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