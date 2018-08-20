<!-- Full Width Column -->
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Festival 2018
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php
                //verificamos si se va a mostrar un mensaje de aviso al realizar alguna operacion de crud
                if(!empty($_SESSION["mensaje"]))
                {
                    //si session en mensaje es agregar un pago
                    if($_SESSION["mensaje"]=="agregar")
                    {
                        //se muestra el alert de agregar un pago
                        echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Registro Exitoso
                        </h4>
                        Se ha registrado el pago en el sistema.
                    </div>
                    ";
                    }

                    //se elimina el contenido de session en mensaje
                    $_SESSION["mensaje"]="";
                }
                ?>
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <!--tabla para mostrar la informacion de los Pagos-->
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Alumno</th>
                                    <th>Fecha de Envio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //creamos un objeto de mvcPago
                                $listado = new mvcPago();

                                //se manda a llamar el control para enlistar los pagos
                                $listado -> listadoPagoPublicoController();
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Alumno</th>
                                    <th>Fecha de Envio</th>
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
    </section>
    <!-- /.content -->
</div>
<!-- /.container -->