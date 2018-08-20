<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo redireccionara al login
    echo "<script>
            window.location.replace('index.php');
          </script>";
}
?>


<!--section para mostrar al Usuario el lugar donde se encuentra-->
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!--Widgets para mostrar la informacion de la tienda-->
    <div class="row">
        <?php
        
        //creamos un objeto de mvcTienda
        $informacion = new mvcTienda();
        
        //llamamos al controler para obtener informacion de la tienda
        $estado = $informacion -> infoTiendaController();
        ?>
    </div>
    <!-- /.row -->

    <?php
    //funcion para mostrar el panel de administacion de la tienda dependiendo si esta activa o no
    if($estado)
    {
    //si esta activa se mostrara el panel de administracion
    ?>
    <div class="row">
        <div class="col-md-12">

            <?php
            //verificamos si se va a mostrar un mensaje de aviso al realizar alguna operacion de crud
            if(!empty($_SESSION["mensaje"]))
            {
                //si session en mensaje es agregar producto
                if($_SESSION["mensaje"]=="agregarP")
                {
                    //se muestra el alert de agregar producto
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Registro Exitoso
                        </h4>
                        Se ha agregado un nuevo producto a la tienda.
                    </div>
                    ";
                }
                //si session en mensaje es eliminar producto
                elseif ($_SESSION["mensaje"]=="eliminarP")
                {
                    //se muestra el alert de eliminar producto
                    echo"
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-warning'></i> Advertencia
                        </h4>
                        Se ha eliminado un producto de la tienda.
                    </div>
                    ";

                }

                //si session en mensaje es agregar usuario
                if($_SESSION["mensaje"]=="agregar")
                {
                    //se muestra el alert de agregar usuario
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Registro Exitoso
                        </h4>
                        Se ha registrado un nuevo usuario en la tienda.
                    </div>
                    ";
                }
                //si session en mensaje es eliminar usuario
                elseif ($_SESSION["mensaje"]=="eliminar")
                {
                    //se muestra el alert de eliminar usuario
                    echo"
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-warning'></i> Advertencia
                        </h4>
                        Se ha eliminado un usuario de la tienda.
                    </div>
                    ";

                }
                //si session en mensaje es editar usuario
                elseif ($_SESSION["mensaje"]=="editar")
                {
                    //se muestra el alert de editar usuario
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Editado Exitoso
                        </h4>
                        La Información del usuario ha sido actualizada.
                    </div>
                    ";

                }

                //si session en mensaje es agregar una venta
                if($_SESSION["mensaje"]=="agregarV")
                {
                    //se muestra el alert de agregar una venta
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Registro Exitoso
                        </h4>
                        Se ha registrado una nueva venta en la tienda.
                    </div>
                    ";
                }
                //se elimina el contenido de session en mensaje
                $_SESSION["mensaje"]="";
            }
            ?>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <!--Tabs para mostrar diferentes acciones e informacion de la tienda-->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <!--Titulos de las tabs-->
                    <li class="active"><a href="#personal" data-toggle="tab">Personal</a></li>
                    <li><a href="#producto" data-toggle="tab">Inventario</a></li>
                    <li><a href="#venta" data-toggle="tab">Ventas</a></li>                    
                </ul>
                <div class="tab-content">
                    <!--en esta tab se muestra la informacion de los usuarios registrados en la tienda-->
                    <div class="tab-pane active" id="personal">
                        <?php
                        include_once "views/usuario/listado.php";
                        ?>
                    </div>
                    <!--en esta tab se muestra la informacion de los productos registrados en la tienda-->
                    <div class="tab-pane" id="producto">
                        <?php
                        include_once "views/producto/listado.php";
                        ?>
                    </div>
                    <!--en esta tab se muestra la informacion de las ventas realizadas en la tienda-->
                    <div class="tab-pane" id="venta">
                        <?php
                        include_once "views/venta/listado.php";
                        ?>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
    </div>
    <?php
    }
    else
    {
        //sino esta activa se muestra un alert
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class='alert alert-warning alert-dismissible'>
                <h4>
                    <i class='icon fa fa-warning'></i> Tienda Desactivada
                </h4>
                Consulte con el administrador del sistema para mas informacion.
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</section>
<!-- /.content -->