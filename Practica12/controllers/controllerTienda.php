<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class mvcTienda
{
    //Control para manejar el registro de una nueva tienda en el sistema
    function agregarTiendaController()
    {
        //se verifica si mediante el formulario de registro se envio informacion
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion de la tienda
            $data = array("nombre" => $_POST["nombre"],
                          "direccion" => $_POST["direccion"],
                          "estado" => $_POST["estado"]);

            //se manda la informacion al modelo con su respectiva tabla en la que se registrara
            $resp = CRUDTienda::agregarTiendaModel($data,"Tienda");

            //en caso de que se haya registrado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "agregar";

                //nos redireccionara al listado de tiendas
                echo "<script>
                        window.location.replace('index.php?section=tienda&action=listado');
                      </script>";
            }
            else
            {
                //sino mandara un mensaje de error
                echo "error";
            }
        }
    }

    //Control para mostrar un listado de las usuarios registrados en el sistema
    function listadoTiendaController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de las tiendas 
        $data = CRUDTienda::listadoTiendaModel("Tienda");

        //se imprime la informacion de cada una de las tiendas registradas
        foreach($data as $rows => $row)
        {
            if($row["estado"])
            {
                $row["estado"] = "Activada";
            }
            else
            {
                $row["estado"] = "Desactivada";
            }
            //e imprimimos la informacion de cada uno de las tiendas 
            echo "<tr>
                <td>".$row["nombre"]."</td>
                <td>".$row["direccion"]."</td>
                <td>".$row["estado"]."</td>
                <td>
                    <center>
                        <button class='btn btn-app' data-toggle='modal' data-target='#eliminar-tienda' onclick='idDel(".$row["id_tienda"].")'>
                            <i class='fa fa-trash'></i> Eliminar
                        </button>

                        <button class='btn btn-app' data-toggle='modal' data-target='#edit-tienda' onclick='idEdit(".$row["id_tienda"].")'>
                            <i class='fa fa-edit'></i> Editar
                        </button>

                        <a class='btn btn-app' href='index.php?section=dashboard&shop=".$row["id_tienda"]."'>
                            <i class='fa fa-home'></i> Entrar A Tienda
                        </a>
                    </center>
                </td>
            </tr>";
        }
    }

    //Control para borrar una tienda del sistema
    public function eliminarTiendaController()
    {
        //se verifica si se envio el id de la tienda a eliminar
        if(isset($_POST["del"]))
        {
            //de ser asi se guarda el id de la tienda
            $data = $_POST["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUDTienda::eliminarTiendaModel($data,"Historial","Tienda_Producto","Tienda");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "eliminar";

                //nos redireccionara al listado de tiendas
                echo "<script>
                        window.location.replace('index.php?section=tienda&action=listado');
                      </script>";
            }
        }
    }

    //Control para poder mostrar la informacion de una tienda a editar
    public function editarTiendaController()
    {
        //se obtiene el id de la tienda a mostrar su informacion
        $data = $_POST["edit"];

        //se manda el id de la tienda y el nombre de la tabla donde esta almacenada
        $resp = CRUDTienda::editarTiendaModel($data,"Tienda");

        //se imprime la informacion en inputs de un formulario
        echo "
                    <input type=hidden value=".$resp["id_tienda"]." name='id'>

                    <div class='form-group'>
                        <label>Nombres</label>
                        <input type='text' value='".$resp["nombre"]."' class='form-control' name='nombre' placeholder='Ingrese Nombre' required>
                    </div>

                    <div class='form-group'>
                        <label>Apellidos</label>
                        <input type='text' value='".$resp["direccion"]."' class='form-control' name='direccion' placeholder='Direccion' required>
                    </div>

                    <div class='form-group'>
                        <label>Estado</label>
                        <br>
                        <label>";

        if($resp["estado"])
        {
            echo "<input value='1' type='radio' name='estado' class='minimal' required checked> Activa";
        }
        else
        {
            echo "<input value='1' type='radio' name='estado' class='minimal' required> Activa";
        }
        echo "</label>
                        <br>
                        <label>";
        if($resp["estado"])
        {
            echo "<input value='0' type='radio' name='estado' class='minimal' required> Desactivada";
        }
        else
        {
            echo "<input value='0' type='radio' name='estado' class='minimal' required checked> Desactivada";
        }

        echo "</label>
            </div>";
    }

    //Control para modificar la informacion de una tienda
    public function modificarTiendaController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion de usuario
            $data = array("id" => $_POST["id"],
                          "nombre" => $_POST["nombre"],
                          "direccion" => $_POST["direccion"],
                          "estado" => $_POST["estado"]);

            //se manda la informacion de la tienda y la tabla en la que esta almacenada
            $resp = CRUDTienda::modificarTiendaModel($data,"Tienda");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "editar";

                //nos redireccionara al listado de tiendas
                echo "<script>
                        window.location.replace('index.php?section=tienda&action=listado');
                      </script>";
            }
        }
    }

    //control para obtener la informacion de la tienda
    public function infoTiendaController()
    {
        $data = $_GET["shop"];

        //llamamos al modelo para obtener la informacion de la tienda
        $info = CRUDTienda::infoTiendaModel($data,"Venta","Usuario","Tienda_Producto","Tienda");

        if($info["estado"])
        {
            echo"
            <!--widget para mostrar la informacion de los usuarios-->
            <div class='col-md-4 col-sm-6 col-xs-12'>
                <div class='info-box bg-red'>
                    <span class='info-box-icon'><i class='fa fa-user-o'></i></span>

                    <div class='info-box-content'>
                        <span class='info-box-text'>Usuarios</span>
                        <span class='info-box-number'>".$info["user"]."</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!--widget para mostrar la informacion de los productos-->
            <div class='col-md-4 col-sm-6 col-xs-12'>
                <div class='info-box bg-yellow'>
                    <span class='info-box-icon'><i class='fa fa-truck'></i></span>

                    <div class='info-box-content'>
                        <span class='info-box-text'>Productos</span>
                        <span class='info-box-number'>".$info["producto"]."</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!--widget para mostrar la informacion de las ventas-->    
            <div class='col-md-4 col-sm-6 col-xs-12'>
                <div class='info-box bg-green'>
                    <span class='info-box-icon'><i class='fa fa-money'></i></span>

                    <div class='info-box-content'>
                        <span class='info-box-text'>Ventas</span>
                        <span class='info-box-number'>".$info["venta"]."</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->";
        }
        
        return $info["estado"];
    }

    //control para obtener la informacion de los productos con bajo 
    function stockBajoController()
    {
        //se verifica si el usuario es un super usuario
        if($_SESSION["root"])
        {
            //si es super usuario mandamos al llamar el modelo para obtener los productos con bajo stock para toodas las tiendas
            $resp = CRUDTienda::stockBajoRootModel("Producto","Tienda_Producto","Tienda");

            echo "
                <span class='label label-warning'>".count($resp)."</span>
                </a>
                <ul class='dropdown-menu'>
                <li class='header'>Hay ".count($resp)." Productos Con Stock Bajo</li>
                <li>
                <!-- inner menu: contains the actual data -->
                <ul class='menu'>
                ";

            //se imprime la informacion de los prodctos con bajo stock
            foreach($resp as $rows => $row)
            {
                echo"
                        <li>
                            <a href='index.php?section=producto&shop=".$row["id_tienda"]."&product=".$row["id_producto"]."'>
                                Bajo Stock De ".$row["nombre_producto"]." En ".$row["nombre_tienda"].".
                            </a>
                        </li> 
                        ";
            }
        }
        else
        {
            //si no es super usuario mandamos al llamar el modelo para obtener los productos con bajo stock para la tienda a la cual pertenece el usuario
            $resp = CRUDTienda::stockBajoModel($_SESSION["shop"],"Producto","Tienda_Producto");

            echo "
                <span class='label label-warning'>".count($resp)."</span>
                </a>
                <ul class='dropdown-menu'>
                <li class='header'>Hay ".count($resp)." Productos Con Stock Bajo</li>
                <li>
                <!-- inner menu: contains the actual data -->
                <ul class='menu'>
                ";

            //se imprime la informacion de los prodctos con bajo stock
            foreach($resp as $rows => $row)
            {
                echo"
                        <li>
                            <a href='index.php?section=producto&shop=".$row["id_tienda"]."&product=".$row["id_producto"]."'>
                                Bajo Stock De ".$row["nombre_producto"].".
                            </a>
                        </li> 
                        ";
            }
        }

        echo "</ul>";

    }

}
?>