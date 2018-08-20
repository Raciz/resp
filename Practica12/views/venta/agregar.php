<?php
//verificamos si el usuario ya ha iniciado session
if(!isset($_SESSION["nombre"]))
{
    //si no ha iniciado sesion, lo redireccionara al login
    echo "<script>
            window.location.replace('index.php');
          </script>";
}

if(!isset($_SESSION["compra"]))
{
    $_SESSION["compra"] = [];
}

?>

<section class="content-header">
    <h1>
        Nueva Venta 

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
            //verificamos si se va a mostrar un mensaje relacionados con la ventas
            if(!empty($_SESSION["mensaje"]))
            {
                //si el producto no esta registrado para esta tienda
                if($_SESSION["mensaje"]=="existe")
                {
                    echo"
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-ban'></i> Error
                        </h4>
                        El producto no existe en la tienda.
                    </div>
                    ";
                }
                //si el producto no tiene stock
                elseif($_SESSION["mensaje"]=="agotado")
                {
                    echo"
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-warning'></i> Sin Stock
                        </h4>
                        No hay Stock disponible para este producto.
                    </div>
                ";
                }

                //si el producto fue eliminado de la venta
                elseif($_SESSION["mensaje"]=="borrar")
                {
                    echo"
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-warning'></i> Borrado Exitoso
                        </h4>
                        El producto se ha eliminado de la venta.
                    </div>
                ";
                }

                //si se cancela la venta
                elseif($_SESSION["mensaje"]=="cancelar")
                {
                    echo"
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4>
                            <i class='icon fa fa-warning'></i> Venta Cancelada
                        </h4>
                        La venta ha sido cancelada.
                    </div>
                ";
                }

                $_SESSION["mensaje"]="";
            }
            ?>
        </div>
    </div>

    <!--Seccion para agrgar los producto a comprar-->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="box-title">Agregar Producto</h3> 
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <!--formulario para agregar un nuevo producto a la venta-->
                    <form action="index.php?section=venta&action=modificarVenta&status=1&shop=<?php echo $_GET["shop"]; ?>" method="post">

                        <div class='form-group'>
                            <label>Codigo del Producto</label>
                            <input type='text' class='form-control' name='codigo' id='codigo' placeholder='Codigo'>
                        </div>
                        <button type='submit' class='btn btn-primary'>Aceptar</button>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>



    <!--Seccion para mostrar los producto a comprar-->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="box-title">Productos a Comprar</h3>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <!--Tabla para mostrar los productos de la venta-->
                    <form id="compra" name="compra" action="index.php?section=venta&action=modificarVenta&status=4&shop=<?php echo $_GET["shop"]; ?>" method="post">
                        <table id="example1 lista" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Quitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //variable para guardar el total de la venta
                                $total = 0;
                                
                                //se imprime la inforacion de los articulos en la venta
                                foreach($_SESSION["compra"] as $rows => $row)
                                {
                                    $total += $row -> total;
                                    echo"<tr>
                                        <td>".$row -> codigo_producto."</td>
                                        <td>".$row -> nombre_producto."</td>
                                        <td>".$row -> precio."</td>
                                        <td>".$row -> cantidad."</td>
                                        <td>".$row -> total."</td>
                                        <td>
                                            <center>
                                                <a class='btn btn-danger' href='index.php?section=venta&action=modificarVenta&status=2&del=".$rows."&shop=".$_GET["shop"]."'>
                                                    <i class='fa fa-trash'></i>
                                                </a>
                                            <center>
                                        </td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Quitar</th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="row">
                            <div class="col-xs-4">

                                <div class='form-group'>
                                    <label>Total</label>
                                    <input type='number' class='form-control' name='total' value=<?php echo $total; ?> readonly>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?section=venta&action=modificarVenta&status=3&shop=<?php echo $_GET["shop"]; ?>">
                            <button type='button' class='btn btn-warning'>Cancelar</button>
                        </a>
                        <button type='submit' class='btn btn-primary'>Aceptar</button>
                    </form>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>