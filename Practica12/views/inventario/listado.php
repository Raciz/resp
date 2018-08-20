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
        Inventario
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Inventario</li>
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
                //si session en mensaje es agregar un producto
                if($_SESSION["mensaje"]=="agregar")
                {
                    //se muestra el alert de agregar un producto
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Registro Exitoso
                        </h4>
                        Se ha registrado un nuevo producto en el sistema.
                    </div>
                    ";
                }
                //si session en mensaje es eliminar un producto
                elseif ($_SESSION["mensaje"]=="eliminar")
                {
                    //se muestra el alert de eliminar un producto
                    echo"
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-warning'></i> Advertencia
                        </h4>
                        Se ha eliminado un producto del sistema.
                    </div>
                    ";

                }
                //si session en mensaje es editar un producto
                elseif ($_SESSION["mensaje"]=="editar")
                {
                    //se muestra el alert de editar un producto
                    echo"
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-check'></i> Editado Exitoso
                        </h4>
                        Se ha editado la informacion de un producto del sistema.
                    </div>
                    ";

                }
                //se elimina el contenido de session en mensaje
                $_SESSION["mensaje"]="";
            }

            //verificamos si se va a mostrar un mensaje de aviso al suceder un error
            if(!empty($_SESSION["error"]))
            {
                //si session en error es type
                if($_SESSION["error"]=="type")
                {
                    //se muestra el alert de type
                    echo"
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-ban'></i> Error: Formato de imagen invalido
                        </h4>
                        Solo se permite subir imagenes en formato JPG o PNG.
                    </div>
                    ";
                }
                //si session en error es size
                elseif ($_SESSION["error"]=="size")
                {
                    //se muestra el alert de size
                    echo"
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-ban'></i> Error: Tamaño superior al permitido
                        </h4>
                        No se permite subir imagenes de tamaño superior a 300 KB.
                    </div>
                    ";

                }
                //si session en error es copy
                elseif ($_SESSION["error"]=="copy")
                {
                    //se muestra el alert de copy
                    echo"
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-ban'></i> Error
                        </h4>
                        No se puede subir la imagen al sistema.
                    </div>
                    ";

                }

                //se elimina el contenido de session en mensaje
                $_SESSION["error"]="";
            }
            ?>

            <!-- caja para mostrar el listado de productos-->
            <div class="box box-success">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="box-title">Listado de Productos</h3>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-info">
                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Producto
                            </button>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <!--tabla para mostrar la informacion de los productos-->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //creamos un objeto de mvcInventario
                            $listado = new mvcInventario();

                            //se manda a llamar el control para enlistar los productos
                            $listado -> listadoInventarioController();
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Imagen</th>
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
    //incluimos el archivo con el modal para agregar, editar y eliminar productos
    include_once "views/inventario/agregar.php";
    include_once "views/inventario/editar.php";
    include_once "views/inventario/eliminar.php";
    ?>
</section>
<!-- /.content -->