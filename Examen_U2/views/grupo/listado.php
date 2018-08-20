<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo sacamos a la seccion publica
    echo "<script>
            window.location.replace('index.php');
          </script>";
}
?>
<!-- Full Width Column -->
<div class="container">
    <!--section para mostrar al Usuario el lugar donde se encuentra-->
    <section class="content-header">
        <h1>
            Grupos
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li class="active">Grupos</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <?php
                //verificamos si se va a mostrar un mensaje de aviso al realizar alguna operacion de crud
                if(!empty($_SESSION["mensaje"]))
                {
                    //si session en mensaje es agregar un grupo
                    if($_SESSION["mensaje"]=="agregar")
                    {
                        //se muestra el alert de agregar un grupo
                        echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Registro Exitoso
                        </h4>
                        Se ha registrado un nuevo grupo en el sistema.
                    </div>
                    ";
                    }
                    //si session en mensaje es eliminar un grupo
                    elseif ($_SESSION["mensaje"]=="eliminar")
                    {
                        //se muestra el alert de eliminar un grupo
                        echo"
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-warning'></i> Advertencia
                        </h4>
                        Se ha eliminado un grupo del sistema.
                    </div>
                    ";

                    }
                    //si session en mensaje es editar un editar
                    elseif ($_SESSION["mensaje"]=="editar")
                    {
                        //se muestra el alert de editar un editar
                        echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Editado Exitoso
                        </h4>
                        Se ha editado la informacion de un grupo.
                    </div>
                    ";

                    }
                    //se elimina el contenido de session en mensaje
                    $_SESSION["mensaje"]="";
                }

                ?>

                <!-- caja para mostrar el listado de grupos-->
                <div class="box box-success">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title">Listado de Grupos</h3>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#new_grupo">
                                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Grupo
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <!--tabla para mostrar la informacion de los grupos-->
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //creamos un objeto de mvcGrupo
                                $listado = new mvcGrupo();

                                //se manda a llamar el control para enlistar los grupos
                                $listado -> listadoGrupoController();
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
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
        <?php
        //incluimos el archivo con el modal para agregar, editar y eliminar grupos
        include_once "views/grupo/agregar.php";
        include_once "views/grupo/editar.php";
        include_once "views/grupo/eliminar.php";
        ?>
    </section>
    <!-- /.content -->
</div>