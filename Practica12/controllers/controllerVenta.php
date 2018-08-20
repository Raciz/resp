<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class mvcVenta
{
    //control para agregar un nuevo producto al sistema
    function agregarProductoController()
    {
        //se verifica si se envio el codigo del producto
        if(isset($_POST["codigo"]))
        {
            //se guarda la informacion del roducto
            $data = array("codigo" => $_POST["codigo"], 
                          "tienda" => $_GET["shop"]);

            //se manda a llamar al modelo para obtener la informacion del producto
            $product = CRUDVenta::agregarProductoController($data,"Producto","Tienda_Producto");

            //si el modelo nos retorna un producto
            if($product)
            {
                //verificamos si hay stock de ese producto
                if($product -> stock >= 1)
                {
                    $pos = -1;

                    //si si hay stock de ese producto verificamos si el producto ya lo enemos registrado en la venta
                    for($i = 0; $i < count($_SESSION["compra"]); $i++)
                    {
                        //si si lo esta
                        if($_SESSION["compra"][$i] -> codigo_producto == $data["codigo"])
                        {
                            //guardamos la posicion en que se encuentra
                            $pos = $i;
                            break;
                        }
                    }

                    //si el producto no estava registrado en la venta enonces
                    if($pos == -1)
                    {
                        //se le asigna en cantidad 1
                        $product->cantidad = 1;

                        //y en total lo que cuesta
                        $product->total = $product->precio;

                        //y por ultimo se registra en la venta
                        array_push($_SESSION["compra"], $product);
                    }
                    else
                    {
                        //si ya se encontraba en la venta entosces aumentamos su cantidad en 1
                        $_SESSION["compra"][$pos] -> cantidad++;
                        //y recalculamos el total
                        $_SESSION["compra"][$pos] -> total = $_SESSION["compra"][$pos] -> cantidad * $_SESSION["compra"][$pos] -> precio;
                    }
                }
                else
                {
                    //si no enia stock entonces session en mensaje se le asigna agotado
                    $_SESSION["mensaje"] = "agotado";
                }
            }
            else
            {
                //si no esta registrado en la tienda entonces session en mensaje se le asigna existe
                $_SESSION["mensaje"] = "existe";
            }
        }         
    }

    //control para quitar un producto de la venta
    function quitarProductoController()
    {
        // si verifica que se haya enviado la posicion en la que se encuentra el producto registrado
        if(isset($_GET["del"]))
        {
            //se guarda su posicion
            $data = $_GET["del"];

            //y se elimina de la venta
            array_splice($_SESSION["compra"], $data, 1);
        } 

        //en mensaje se le asigna borrar
        $_SESSION["mensaje"] = "borrar";
    }

    //modelo para cancelar la venta
    function cancelarVentaController()
    {
        //se elimina todo el contenido registrado en la venta
        $_SESSION["compra"] = [];

        //en mensaje se le asigna cancelar
        $_SESSION["mensaje"] = "cancelar";
    }

    //control para agregar una venta a la tienda
    function agregarVentaController()
    {
        //se verifica si mediante el formulario de registro se envio informacion
        if(isset($_POST["total"]))
        {

            //se manda la informacion al modelo con su respectiva tabla en la que se registrara
            $resp = CRUDVenta::agregarVentaModel($_SESSION["compra"],$_POST["total"],"Venta","Venta_Producto","Tienda_Producto","Historial",$_GET["shop"],$_SESSION["id"],$_SESSION["nombre"]);

            //en caso de que se haya registrado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "agregarV";

                //y se borra el contenido de la tienda
                $_SESSION["compra"] = [];

                //nos redireccionara al listado de categorias
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

    //Control para mostrar un listado de las ventas registrados en el sistema
    function listadoVentaController()
    {
        //se le manda al modelo con el nombre de la tabla a mostrar la informacion de las ventas 
        $data1 = CRUDVenta::listadoVentaModel("Venta",$_GET["shop"]);

        //se imprime la informacion de cada uno de las ventas registrados
        foreach($data1 as $rows => $row)
        {
            //e imprimimos la informacion de cada uno de las ventas
            echo "<tr>
                <td>".$row["id_venta"]."</td>
                <td>

            <table id='example4' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>";

            //se le manda al modelo con el nombre de la tabla a mostrar la informacion de los productos de la venta
            $data2 = CRUDVenta::listadoProductoVentaModel("Venta_Producto","Producto",$row["id_venta"]);
            foreach($data2 as $rows2 => $row2)
            {
                echo "<tr>
                                    <td>".$row2["nombre_producto"]."</td>
                                    <td>".$row2["cantidad"]."</td>
                                    <td>".$row2["total"]."</td>
                                  </tr>";
            }

            echo"       </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </tfoot>
                    </table>

            </td>
                <td>".$row["total"]."</td>
                <td>
                    <center>
                        <div class='btn-group'>
                            <button type='button' title='Eliminar Categoria' class='btn btn-default' data-toggle='modal' data-target='#eliminar-Venta' onclick='idDelV(".$row["id_venta"].")'>
                                <i class='fa fa-trash-o'></i>
                            </button>
                        </div>
                    </center>
                </td>
            </tr>";
        }
    }

    //Control para borrar una venta de la tienda
    public function eliminarVentaController()
    {
        //se verifica si se envio el id del producto a eliminar
        if(isset($_POST["del"]))
        {
            //de ser asi se guarda el id de la venta
            $data = $_POST["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUDVenta::eliminarVentaModel($data,"Venta_Producto","Venta");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "eliminarV";
                //nos redireccionara al listado de productos
                echo "<script>
                        window.location.replace('index.php?section=dashboard&shop=".$_GET["shop"]."');
                      </script>";
            }
        }
    }
}