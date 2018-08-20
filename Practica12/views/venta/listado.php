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

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <!--caja para mostrar el listado de las ventas de la tienda-->
            <div class="box box-success">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="box-title">Listado de Ventas</h3>
                        </div>
                        <div class="col-xs-6">
                            <a href="index.php?section=venta&action=agregar&shop=<?php echo $_GET["shop"]; ?>">
                                <button type="button" class="btn btn-success pull-right">
                                    <i class="fa fa-plus"></i> Agregar Venta
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <!--tabla para mostrar el listado de las ventas de la tienda-->
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Productos</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //creamos un objeto de mvcVenta
                            $listado = new mvcVenta();

                            //se manda a llamar el control para enlistar a las ventas de la tienda                            
                            $listado -> listadoVentaController();
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Productos</th>
                                <th>Total</th>
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
    //incluimos los archivos con los modales para eliminar una venta
    include_once "views/venta/eliminar.php";
    ?>
</section>
<!-- /.content -->

