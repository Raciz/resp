<?php

//verificamos si por get se vio el status 
if(isset($_GET["status"]))
{
    
    //en caso de que si se crea un objeto de mvcVenta
    $agregar = new mvcVenta();

    //si status es igual a 1
    if($_GET["status"] == 1)
    {
        //se manda a llamar el controller para agregar un nuevo producto a la venta
        $agregar -> agregarProductoController();
    }
    //si status es igual a 2
    elseif($_GET["status"] == 2)
    {
        //se manda a llamar el controller para borrar un producto a la venta 
        $agregar -> quitarProductoController();
    }
    //si status es igual a 3
    elseif($_GET["status"] == 3)
    {
        //se manda a llamar el controller para borrar todos los productos venta 
        $agregar -> cancelarVentaController();
    }
    //si status es igual a 4
    elseif($_GET["status"] == 4)
    {
        //se manda a llamar el controller para borrar todos los productos venta 
        $agregar -> agregarVentaController();
    }

}

//nos derireccionamos denuevo al la seccion de registro de venta
echo "<script>
    window.location.replace('index.php?section=venta&action=agregar&shop=".$_GET["shop"]."');
</script>";
?>