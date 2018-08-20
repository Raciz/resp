<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class mvcInventario
{
    //Control para manejar el registro de un nuevo producto en el sistema
    function agregarInventarioController()
    {
        //se verifica si mediante el formulario de registro se envio informacion
        if(isset($_POST["nombre"]))
        {

            //se guardan la informacion del producto
            $data = array("nombre" => $_POST["nombre"],
                          "codigo" => $_POST["codigo"],
                          "categoria" => $_POST["categoria"],
                          "precio" => $_POST["precio"],
                          "img" => "views/media/img/noimg.png");

            //se verifica si se envio una imagen para el producto
            if(!empty($_FILES["img"]["name"]))
            {
                //se extrae el tipo de la imagen
                $type = $_FILES["img"]["type"];
                //se extrae el tamaño de la imagen
                $size = $_FILES["img"]["size"];
                //se extrae el nombre de la imagen
                $name = $_FILES["img"]["name"];
                //se extrae la ubicacion temporal de la imagen
                $tmp = $_FILES["img"]["tmp_name"];

                //se verifica si se envio una imagen jpg o png
                if($type == "image/jpeg" || $type == "image/png")
                {
                    //en caso de que si sea png o jpg
                    //se verifica que el tamaño de la imagen no supere los 300KB
                    if($size < 300000)
                    {
                        //en caso de que no supere el tamaño de 300KB
                        //se mueve la imagen a la carpeta de imagenes de los productos
                        if(!move_uploaded_file($tmp, "./views/media/img/".$name))
                        {
                            //en caso de que no se pudiera mover se asigna el error copy en session error
                            $_SESSION["error"] = "copy";
                            //nos redireccionamos al listado de inventario
                            echo "<script>
                                    window.location.replace('index.php?section=inventario&action=listado');
                                 </script>";
                            //y se detiene la ejecucion del script
                            exit;
                        }
                        else
                        {
                            //asignamos en data el url real de la imagen
                            $data["img"] = "views/media/img/".$name;
                        }
                    }
                    else
                    {
                        //en caso de que la imagen supere el el tamaño de 300KB se asigna el error size en session error
                        $_SESSION["error"] = "size";
                        //nos redireccionamos al listado de inventario
                        echo "<script>
                                    window.location.replace('index.php?section=inventario&action=listado');
                                 </script>";
                        //y se detiene la ejecucion del script
                        exit;
                    }
                }
                else
                {
                    //en caso de que la imagen no sea png o jpg se asigna el error type en session error
                    $_SESSION["error"] = "type";
                    //nos redireccionamos al listado de inventario
                    echo "<script>
                            window.location.replace('index.php?section=inventario&action=listado');
                          </script>";
                    //y se detiene la ejecucion del script
                    exit;
                }
            }

            
            //se manda la infomacion nesesaria a los modelos para ingresar el producto en el sistema
            $resp = CRUDInventario::agregarInventarioModel($data,"Producto");

            //en caso de que se haya registrado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "agregar";

                //nos redireccionara al listado de productos
                echo "<script>
                        window.location.replace('index.php?section=inventario&action=listado');
                      </script>";
            }
            else
            {
                //sino mandara un mensaje de error
                echo "error";
            }
        }
    }

    //Control para mostrar un listado de los producto registrados en el sistema
    function listadoInventarioController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de los productos
        $data = CRUDInventario::listadoInventarioModel("Producto","Categoria");

        //se imprime la informacion de cada uno de los producto registrados en el sistema
        foreach($data as $rows => $row)
        {
            //e imprimimos la informacion de cada uno de los productos
            echo "<tr>
                <td>".$row["codigo_producto"]."</td>
                <td>".$row["nombre_producto"]."</td>
                <td>".$row["categoria"]."</td>
                <td>
                    <center>
                        <img height=100 width=100 src='".$row["img"]."'>
                    </center>
                </td>
                <td>
                    <center>
                       <div class='btn-group'>
                       
                            <button type='button' title='Editar Producto' class='btn btn-default' data-toggle='modal' data-target='#edit-producto' onclick='idEdit(".$row["id_producto"].")'>                       
                                <i class='fa fa-edit'></i>
                            </button>
                            
                            <button type='button' title='Eliminar Producto' class='btn btn-default' data-toggle='modal' data-target='#eliminar-producto' onclick='idDelP(".$row["id_producto"].")'>
                                <i class='fa fa-trash-o'></i>
                            </button>
                        </div>
                    </center>
                </td>
            </tr>";
        }
    }


    //Control para borrar un producto del sistema
    public function eliminarInventarioController()
    {
        //se verifica si se envio el id del producto a eliminar
        if(isset($_POST["delP"]))
        {
            //de ser asi se guarda el id del producto
            $data = $_POST["delP"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUDInventario::eliminarInventarioModel($data,"Historial","Tienda_Producto","Producto");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "eliminar";

                //nos redireccionara al listado de productos
                echo "<script>
                        window.location.replace('index.php?section=inventario&action=listado');
                      </script>";
            }
        }
    }

    //Control para poder mostrar la informacion de un producto a editar
    public function editarInventarioController()
    {
        $data = $_POST["edit"];
        
        //se manda el id del producto y el nombre de la tabla donde esta almacenada
        $resp = CRUDInventario::editarInventarioModel($data,"Producto");

        //se imprime la informacion del producto en inputs de un formulario
        echo "
                    <input type=hidden value=".$resp["id_producto"]." name='id'>

                    <div class='form-group'>
                        <label>Nombre</label>
                        <input type='text' value='".$resp["nombre_producto"]."' class='form-control' name='nombre' placeholder='Ingrese Nombre' required>
                    </div>

                    <div class='form-group'>
                        <label>Categoria</label>
                        <select name='categoria' id='categoria' class='form-control select2' style='width: 100%;' required>
                            <option value=''>Seleccione Una Categoria</option>";

        //creamos un objeto de mvcCategoria
        $option = new mvcCategoria();

        //mandamos a llamar el controller para traer todad las categorias en options de un select
        $option -> optionCategoriaController();

        echo "   </select>
                    </div>

                    <div class='form-group'>
                        <label>Precio</label>
                        <input type='number' step='0.01' value='".$resp["precio"]."' class='form-control' name='precio' placeholder='Ingrese Usuario' required>
                    </div>

             ";

        //script para seleccionar en el select el option de la categoria al que pertenece el producto
        echo "<script>
                var categoria = document.getElementById('categoria');

                for(var i = 1; i < categoria.options.length; i++)
                {
                    if(categoria.options[i].value ==".$resp["id_categoria"].")
                    {
                        categoria.selectedIndex = i;
                    }
                }
                </script>";
    }

    //Control para modificar la informacion de un producto
    public function modificarInventarioController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion de producto
            $data = array("id" => $_POST["id"],
                          "nombre" => $_POST["nombre"],
                          "categoria" => $_POST["categoria"],
                          "precio" => $_POST["precio"]);

            //se manda la informacion del producto y la tabla en la que esta almacenada
            $resp = CRUDInventario::modificarInventarioModel($data,"Producto");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "editar";

                //nos redireccionara al listado de producto
                echo "<script>
                        window.location.replace('index.php?section=inventario&action=listado');
                      </script>";
            }
        }
    }

    //control para modificar el inventario de los productos
    public function stockInventarioController()
    {
        //se verifica si mediante el formulario se envio la informacion
        if(isset($_POST["cantidad"]))
        {
            //se guarda la informacion de la modificacion del inventario
            $data = array("stock" => $_POST["type"] * $_POST["cantidad"],
                          "codigo" => $_POST["referencia"]);

            //se le manda la informacion a los modelos para modificar la informacion del stock del producto
            $resp1 = CRUDInventario::updateStockInventarioModel("Producto",$data,$_GET["product"]);
            
            $resp2 = CRUDInventario::historialInventarioModel("Historial",$data,$_SESSION["id"],$_SESSION["nombre"],$_GET["product"]);

            //en caso de haberse actualizado correctamente
            if($resp1 == "success" && $resp2 == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "stock";

                //nos redireccionara a la descripcion del producto
                echo "<script>
                        window.location.replace('index.php?section=producto&product=".$_GET["product"]."');
                      </script>";
            }
        }
    }
}
?>


