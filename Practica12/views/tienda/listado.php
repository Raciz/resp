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

<!--mostramos al usuario en que seccion del sistema se encuentra-->
<section class="content-header">
    <h1>
        Tiendas
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Tiendas</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <?php
            //verificamos si se va a mostrar un mensaje de aviso al realizar alguna operacion de crud
            if(!empty($_SESSION["mensaje"]))
            {
                //si session en mensaje es agregar una tienda
                if($_SESSION["mensaje"]=="agregar")
                {
                    //se muestra el alert de agregar una tienda
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Registro Exitoso
                        </h4>
                        Se ha registrado una nueva tienda en el sistema.
                    </div>
                    ";
                }
                //si session en mensaje es eliminar una tienda
                elseif ($_SESSION["mensaje"]=="eliminar")
                {
                    //se muestra el alert de eliminar una tienda
                    echo"
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-warning'></i> Advertencia
                        </h4>
                        Se ha eliminado una tienda del sistema.
                    </div>
                    ";

                }
                //si session en mensaje es editar una tienda
                elseif ($_SESSION["mensaje"]=="editar")
                {
                    //se muestra el alert de editar una tienda
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Editado Exitoso
                        </h4>
                        La Información de la tienda ha sido actualizada.
                    </div>
                    ";

                }
                
                //se elimina el contenido de session en mensaje
                $_SESSION["mensaje"]="";
            }
            ?>

            <!--caja para mostrar el listado de tiendas registradas en el sistema-->
            <div class="box box-success">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="box-title">Listado de Tiendas</h3>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-info">
                                <i class="fa fa-plus"></i> Agregar Tienda
                            </button>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <!--tabla para mostrar el listado de tiendas en el sistema-->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Ubicacion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //creamos un objeto de mvcTienda
                            $listado = new mvcTienda();
                            
                            //se manda a llamar el control para enlistar las tiendas registradas en el sistema
                            $listado -> listadoTiendaController();
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Ubicacion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <?php
    //incluimos los archivos con los modales para agregar, editar y eliminar una tienda
    include_once "views/tienda/agregar.php";
    include_once "views/tienda/eliminar.php";
    include_once "views/tienda/editar.php";
    ?>
</section>
<!-- /.content -->

