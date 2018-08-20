<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class mvcProducto
{
  
   //Control para borrar un producto de la tienda
    public function eliminarProductoController()
    {
        //se verifica si se envio el id del producto a eliminar
        if(isset($_POST["delP"]))
        {
            //de ser asi se guarda el id del producto
            $data = array("producto" => $_POST["delP"],
                          "tienda" => $_GET["shop"]);
            
            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUDProducto::eliminarProductoModel($data,"Historial","Tienda_Producto");
            
            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "eliminarP";
            
                //nos redireccionara al listado de productos
                echo "<script>
                        window.location.replace('index.php?section=dashboard&shop=".$_GET["shop"]."');
                      </script>";
            }
        }
    }
  
    //Control para manejar el registro de un nuevo producto en una tienda
    function agregarProductoController()
    {
        //se verifica si mediante el formulario de registro se envio informacion
        if(isset($_POST["producto"]))
        {

            //se guardan la informacion del producto
            $data = array("tienda" => $_GET["shop"],
                          "producto" => $_POST["producto"],
                          "stock" => $_POST["stock"],
                          "referencia" => $_POST["referencia"],
                          "usuario" => $_SESSION["id"],
                          "nombre" => $_SESSION["nombre"]);




            //se manda la infomacion nesesaria a los modelos para ingresar el producto en la tienda
            $resp1 = CRUDProducto::agregarProductoModel($data,"Tienda_Producto");
            $resp2 = CRUDProducto::agregarHistorialModel($data,"Historial");

            //en caso de que se haya registrado correctamente
            if($resp1 == "success" && $resp2 == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "agregarP";

                //nos redireccionara a la tienda
                echo "<script>
                        window.location.replace('index.php?section=dashboard&shop=".$_GET["shop"]."');
                      </script>";
            }
            else
            {
                //sino mandara un mensaje de error
                echo "error";
            }
        }
    }

    //Control para mostrar los productos en un select
    public function optionProductoController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar su informacion
        $data = CRUDProducto::listadoProductoModel("Producto","Tienda_Producto");

        //mostramos el nombre de cada una de los productos
        foreach($data as $rows => $row)
        {
            //se muestra cada una de las categorias en un option del select
            echo "<option value=".$row["id_producto"].">".$row["nombre_producto"]."</option>";
        }
    }

    //Control para mostrar un listado de los producto registrados en la tienda
    function listadoProductoTiendaController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de los productos en la tienda
        $data = CRUDProducto::listadoProductoTiendaModel("Producto","Tienda_Producto",$_GET["shop"]);

        //se imprime la informacion de cada uno de los producto registrados en la tienda
        foreach($data as $rows => $row)
        {
            //e imprimimos la informacion de cada uno de los productos
            echo "<tr>
                <td>".$row["nombre_producto"]."</td>
                <td>".$row["stock"]."</td>
                <td>
                    <center>
                       <button class='btn btn-app' data-toggle='modal' data-target='#eliminar-producto' onclick='idDelP(".$row["id_producto"].")'>
                            <i class='fa fa-trash'></i> Eliminar
                       </button>
                       <a class='btn btn-app' href='index.php?section=producto&shop=".$_GET["shop"]."&product=".$row["id_producto"]."'>
                            <i class='fa fa-edit'></i> Modificar Stock
                       </a>
                    </center>
                </td>
            </tr>";
        }
    }


    //Control para mostrar el historial de un producto
    function listadoHistorialController()
    {
        //obtenemos el id del producto
        $ids = array("producto" => $_GET["product"],
                     "tienda" => $_GET["shop"]);

        //se le manda al modelo el nombre de la tabla y el id del producto para extraer su historial
        $data = CRUDProducto::listadoHistorialModel("Historial",$ids);

        //se imprime del historial del producto
        foreach($data as $rows => $row)
        {
            echo "<tr>
                    <td>".$row["fecha"]."</td>
                    <td>".$row["hora"]."</td>
                    <td>".$row["nota"]."</td>
                    <td>".$row["referencia"]."</td>
                    <td>".$row["cantidad"]."</td>
                 </tr>";
        }
    }

    //Control para mostrar la informacion de un producto
    function infoProductoController()
    {
        //obtenemos el id del producto
        $ids = array("producto" => $_GET["product"],
                     "tienda" => $_GET["shop"]);

        //se le manda al modelo el nombre de la tabla y el id del producto para extraer su informacion
        $data = CRUDProducto::infoProductoModel("Producto","Tienda_Producto",$ids);

        //imprimimos la informacion del producto con los botones de modificar stock, editar y eliminar informacion
        echo"
        <div class='row'>
        <div class='col-xs-6'>

            <div class='box box-success'>
                <div class='box-header'>
                    <div class='row'>
                        <div class='col-xs-6'>
                            <h3 class='box-title'>Imagen del Producto</h3>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class='box-body'>
                    <center>
                        <img class='image' src=".$data["img"].">
                    </center>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class='col-xs-6'>

            <div class='box box-success'>
                <div class='box-header'>
                    <div class='row'>
                        <div class='col-xs-6'>
                            <h3 class='box-title'>Informacion del Producto</h3>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class='box-body'>
                    <p class='info_product'>
                        <b>Nombre:</b> ".$data["nombre_producto"]."
                        <br>
                        <br>
                        <b>Codigo:</b> ".$data["codigo_producto"]." 
                        <br>
                        <br>
                        <b>Stock Disponible:</b> ".$data["stock"]."
                        <br>
                        <br>
                        <b>Precio Venta:</b> $".$data["precio"]."
                        <br>
                        <br>
                    </p>
                    <center>
                        <a class='btn btn-app' data-toggle='modal' data-target='#modal-info-stock' onclick='typeOfUpdate(1)'>
                            <i class='fa fa-plus-square-o'></i> Agregar Stock
                        </a>
                        <a class='btn btn-app' data-toggle='modal' data-target='#modal-info-stock' onclick='typeOfUpdate(-1)'>
                            <i class='fa fa-minus-square-o'></i> Eliminar Stock
                        </a>
                    <center>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        </div>
        ";
    }


    //control para modificar el inventario de los productos
    public function stockProductoController()
    {
        //se verifica si mediante el formulario se envio la informacion
        if(isset($_POST["cantidad"]))
        {
            //se guarda la informacion de la modificacion del inventario
            $data = array("stock" => $_POST["type"] * $_POST["cantidad"],
                          "referencia" => $_POST["referencia"],
                          "tienda" => $_GET["shop"],
                          "usuario" => $_SESSION["id"],
                          "nombre" => $_SESSION["nombre"],
                          "producto" => $_GET["product"]);

            //se le manda la informacion a los modelos para modificar la informacion del stock del producto
            $resp1 = CRUDProducto::stockProductoModel("Tienda_Producto",$data);

            $resp2 = CRUDProducto::agregarHistorialModel($data,"Historial");

            //en caso de haberse actualizado correctamente
            if($resp1 == "success" && $resp2 == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "stock";

                //nos redireccionara a la descripcion del producto
                echo "<script>
                        window.location.replace('index.php?section=producto&shop=".$_GET["shop"]."&product=".$_GET["product"]."');
                      </script>";
            }
        }
    }
}
?>


