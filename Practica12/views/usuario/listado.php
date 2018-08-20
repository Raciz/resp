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

            <!--caja para mostrar el listado de usuarios registrados en la tienda-->
            <div class="box box-success">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="box-title">Listado de Usuarios</h3>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-info">
                                <i class="fa fa-user-plus"></i> Agregar Usuario
                            </button>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <!--tabla para mostrar el listado de usuarios en la tienda-->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Agregado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //creamos un objeto de mvcUsuario
                            $listado = new mvcUsuario();
                            
                            //se manda a llamar el control para enlistar a los usuarios registrados en la tienda
                            $listado -> listadoUsuarioController();
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Agregado</th>
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
    //incluimos los archivos con los modales para agregar, editar y eliminar un usuario
    include_once "views/usuario/agregar.php";
    include_once "views/usuario/eliminar.php";
    include_once "views/usuario/editar.php";
    ?>
</section>
<!-- /.content -->

