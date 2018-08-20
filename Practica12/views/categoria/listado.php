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
        Categorias
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Categorias</li>
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
                //si session en mensaje es agregar una categoria
                if($_SESSION["mensaje"]=="agregar")
                {
                    //se muestra el alert de agregar una categoria
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Registro Exitoso
                        </h4>
                        Se ha registrado una nueva categoria en el sistema.
                    </div>
                    ";
                }
                //si session en mensaje es eliminar una categoria
                elseif ($_SESSION["mensaje"]=="eliminar")
                {
                    //se muestra el alert de eliminar una categoria
                    echo"
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-warning'></i> Advertencia
                        </h4>
                        Se ha eliminado una categoria del sistema.
                    </div>
                    ";

                }
                //si session en mensaje es editar una categoria
                elseif ($_SESSION["mensaje"]=="editar")
                {
                    //se muestra el alert de editar una categoria
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Editado Exitoso
                        </h4>
                        La Información de la categoria ha sido actualizada.
                    </div>
                    ";

                }

                //se elimina el contenido de session en mensaje
                $_SESSION["mensaje"]="";
            }
            ?>

            <!-- caja para mostrar la el listado de categorias -->
            <div class="box box-success">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="box-title">Listado de Categorias</h3>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-info"> 
                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Categoria
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box-body">

                    <!-- tabla para mostrar la el listado de categoriaa -->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Agregado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            //creamos un objeto de mvcCategoria
                            $listado = new mvcCategoria();
                            
                            //se manda a llamar el controller para mostrar el listado de categorias
                            $listado -> listadoCategoriaController();
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
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
    <?php
    //incluimos los archivos con los modales para agregar, editar y eliminar una categoria
    include_once "views/categoria/agregar.php";
    include_once "views/categoria/eliminar.php";
    include_once "views/categoria/editar.php";
    ?>
</section>
<!-- /.content -->