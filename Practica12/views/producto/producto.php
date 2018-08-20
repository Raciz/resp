<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo redireccionara al login
    echo "<script>
            window.location.replace('index.php');
          </script>";
}

//verificamos si se envio por get el id del producto a mostrar su informacion
if(!isset($_GET["product"]))
{
    //si no se envio lo enviamos al listado de producto de inventarios
    echo "<script>
            window.location.replace(-1);
          </script>";
}

?>

<!--section para mostrar al Usuario el lugar donde se encuentra-->
<section class="content-header">
    <h1>
        Inventario
        <a href="index.php?section=dashboard&shop=<?php echo $_GET["shop"]; ?>">
            <button type='button' class='btn btn-success pull-right'><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</button>
        </a>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <?php
            //verificamos si se va a mostrar un mensaje de aviso al realizar alguna operacion de crud
            if(!empty($_SESSION["mensaje"]))
            {
                //si session en mensaje es modificacion de stock
                if($_SESSION["mensaje"]=="stock")
                {
                    //se muestra el alert de stock
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Registro Exitoso
                        </h4>
                         Se ha actualizado el stock del producto.
                    </div>
                    ";
                }

                //se elimina el contenido de session en mensaje
                $_SESSION["mensaje"]="";
            }
            ?>
            <!-- /.col -->
        </div>
    </div>

    <?php
    //creamos un objeto de mvcInventario
    $info = new mvcProducto();
    
    //se manda a llamar a el control para mostrar la informacion del producto
    $info -> infoProductoController();
    ?>
    
    
    <!--Seccion para mostrar la informacion del historial del producto-->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="box-title">Historial de Inventario</h3>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <!--Tabla para mostrar el historial del producto-->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Descripcion</th>
                                <th>Referencia</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //se crea un objeto de mvcProducto
                            $listado = new mvcProducto();
                            
                            //se manda a llamar el control para traer el historial del estock del producto
                            $listado -> listadoHistorialController();
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Descripcion</th>
                                <th>Referencia</th>
                                <th>Total</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <?php
    //incluimos los archivos con los modales para actualizar el stock del producto
    include_once "views/producto/actualizarStock.php";
    ?>
</section>
<!-- /.content -->