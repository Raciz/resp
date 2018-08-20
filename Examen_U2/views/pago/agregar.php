<?php
//verificamos si se debe llamar al controller para agregar un nuevo pago
if(isset($_GET["action"]) && $_GET["action"]=="agregar")
{
    //se crea un objeto de mvcPago
    $agregar = new mvcPago();

    //se manda a llamar el controller para agregar un nuevo pago al sistema 
    $agregar -> agregarPagoController();
}
else
{
    //si no ha iniciado sesion, lo sacamos a la seccion publica
    echo "<script>
            window.location.replace('index.php');
          </script>";
}
?>