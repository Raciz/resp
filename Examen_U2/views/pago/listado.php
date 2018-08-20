<!-- Full Width Column -->
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pagos
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de Pagos</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <!--tabla para mostrar la informacion de los Pagos-->
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Alumno</th>
                                    <th>Mama</th>
                                    <th>Fecha de Pago</th>
                                    <th>Fecha de Envio</th>
                                    <th>Imagen</th>
                                    <th>Folio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //creamos un objeto de mvcPago
                                $listado = new mvcPago();

                                //se manda a llamar el control para enlistar los pagos
                                $listado -> listadoPagoAdminController();
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Alumno</th>
                                    <th>Mama</th>
                                    <th>Fecha de Pago</th>
                                    <th>Fecha de Envio</th>
                                    <th>Imagen</th>
                                    <th>Folio</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col (left) -->
        </div>
        <?php
        //incluimos el archivo con el modal para editar y eliminar un pago
        include_once "views/pago/editar.php";
        include_once "views/pago/eliminar.php";
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.container -->