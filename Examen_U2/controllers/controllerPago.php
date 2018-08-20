<?php

class mvcPago
{
    //Control para manejar el registro de un nuevo pago en el sistema
    function agregarPagoController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["alumno"]))
        {

            //se guardan la informacion del producto
            $data = array("alumno" => $_POST["alumno"],
                          "mama" => $_POST["nomMadre"]." ".$_POST["apeMadre"],
                          "pago" => $_POST["datePago"],
                          "img" => "views/media/img/noimg.png",
                          "folio" => $_POST["folio"]);

            //se verifica si se envio una imagen del boleto
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

                //se obtiene la fecha y hora en la que fue sibida la imagen
                $date = getdate();
                //se verifica si se envio una imagen jpg o png
                if($type == "image/jpeg" || $type == "image/png")
                {
                    //en caso de que si sea png o jpg
                    //se verifica que el tamaño de la imagen no supere los 5MB
                    if($size < 5000000)
                    {
                        //en caso de que no supere el tamaño de 300KB
                        //se mueve la imagen a la carpeta de imagenes de los boletos
                        if(!move_uploaded_file($tmp, "./views/media/img/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name))
                        {
                            //en caso de que no se pudiera mover se asigna el error copy en session error
                            $_SESSION["error"] = "copy";

                            //nos redireccionamos al formulario de registro
                            echo "<script>
                                    window.location.replace('index.php');
                                 </script>";
                            //y se detiene la ejecucion del script
                            exit;
                        }
                        else
                        {
                            //asignamos en data el url real de la imagen
                            $data["img"] = "views/media/img/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name;
                        }
                    }
                    else
                    {
                        //en caso de que la imagen supere el el tamaño de 300KB se asigna el error size en session error
                        $_SESSION["error"] = "size";

                        //nos redireccionamos al formulario de registro
                        echo "<script>
                                    window.location.replace('index.php');
                              </script>";

                        //y se detiene la ejecucion del script
                        exit;
                    }
                }
                else
                {
                    //en caso de que la imagen no sea png o jpg se asigna el error type en session error
                    $_SESSION["error"] = "type";

                    //nos redireccionamos al formulario de registro
                    echo "<script>
                            window.location.replace('index.php');
                          </script>";

                    //y se detiene la ejecucion del script
                    exit;
                }
            }


            //se manda la infomacion nesesaria a los modelos para ingresar el producto en el sistema
            $resp = CRUDPago::agregarPagoModel($data,"Pago");

            //en caso de que se haya registrado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "agregar";

                //nos redireccionara al listado de productos
                echo "<script>
                        window.location.replace('index.php?section=listado');
                      </script>";
            }
            else
            {
                //sino mandara un mensaje de error
                echo "error";
            }
        }
    }

    //Control para mostrar un listado de los pagos en la seccion publica
    function listadoPagoPublicoController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de los Pagos
        $data = CRUDPago::listadoPagoModel("Pago","Alumna");
        
        //variable para onbtener el lugar en el listado segun la fecha de envio
        $i = 1;
        
        //se imprime la informacion de cada uno de los Pagos
        foreach($data as $rows => $row)
        {
            //e imprimimos la informacion de cada uno de los Pagos
            echo "<tr>
                <td>".$i."</td>
                <td>".$row["nombre"]." ".$row["apellido"]."</td>
                <td>".$row["fecha_envio"]."</td>
            </tr>";
            
            $i++;
        }
    }

    //Control para mostrar un listado de los pagos en la seccion publica
    function listadoPagoAdminController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de los alumnos
        $data = CRUDPago::listadoPagoModel("Pago","Alumna");

        //variable para obtener el lugar en el listado segun la fecha de envio
        $i = 1;
        
        //se imprime la informacion de cada uno de los alumnos registrados
        foreach($data as $rows => $row)
        {
            //e imprimimos la informacion de cada uno de los alumnos
            echo "<tr>
                <td>".$i."</td>
                <td>".$row["nombre"]." ".$row["apellido"]."</td>
                <td>".$row["mama"]."</td>
                <td>".$row["fecha_pago"]."</td>
                <td>".$row["fecha_envio"]."</td>
                <td><a href='".$row["img_comprobante"]."'>Ver</a></td>
                <td>".$row["folio"]."</td>
                <td>
                    <center>
                        <div class='btn-group'>
                                <button type='button' title='Editar Pago' class='btn btn-default' data-toggle='modal' data-target='#edit-pago' onclick='idEdit(".$row["id_pago"].")'>
                                    <i class='fa fa-edit'></i>
                                </button>

                            <button type='button' title='Eliminar Pago' class='btn btn-default' data-toggle='modal' data-target='#Del-pago' onclick='idDel(".$row["id_pago"].")'>
                                <i class='fa fa-trash-o'></i>
                            </button>
                        </div>
                    </center>
                </td>
            </tr>";
            
            $i++;
        }
    }

    //Control para borrar un pago del sistema
    public function eliminarPagoController()
    {
        //se verifica si se envio el id del pago a eliminar
        if(isset($_POST["del"]))
        {
            //de ser asi se guarda el id del pago
            $data = $_POST["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUDPago::eliminarPagoModel($data,"Pago");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "eliminar";

                //nos redireccionara al listado de usuarios
                echo "<script>
                        window.location.replace('index.php?section=pago&action=listado');
                      </script>";
            }
        }
    }

    //Control para poder mostrar la informacion de un pago a editar
    public function editarPagoController()
    {
        //se obtiene el id del pago a mostrar su informacion
        $data = $_POST["edit"];

        //se manda el id del pago y el nombre de la tabla donde esta almacenada
        $resp = CRUDPago::editarPagoModel($data,"Pago","Alumna");

        //se imprime la informacion del pago en inputs de un formulario
        echo "
                <input type=hidden value=".$resp["id_pago"]." name='id'>

                <div class='form-group'>
                        <label>Nombre</label>
                        <input type='text' value='".$resp["nombre"]." ".$resp["apellido"]."' class='form-control' placeholder='Ingrese Nombre' required readOnly>
                    </div>

                    <div class='form-group'>
                        <label>Madre</label>
                        <input type='text' value='".$resp["mama"]."' class='form-control' name='mama' placeholder='Nombre Madre' required>
                    </div>


                    <div class='form-group'>
                        <label>Fecha de Pago</label>

                        <div class='input-group date'>
                            <div class='input-group-addon'>
                                <i class='fa fa-calendar'></i>
                            </div>
                            <input name='pago' type='text' class='form-control pull-right' id='datepicker2' value='".$resp["fecha_pago"]."'>
                        </div>
                    </div>
                    
                    <div class='form-group'>
                        <label>Fecha de Envio</label>

                        <div class='input-group date'>
                            <div class='input-group-addon'>
                                <i class='fa fa-calendar'></i>
                            </div>
                            <input name='envio' type='text' class='form-control pull-right' value='".$resp["fecha_envio"]."'>
                        </div>
                    </div>
                    
                    <div class='form-group'>
                        <label>Folio</label>
                        <input type='text' value='".$resp["folio"]."' class='form-control' name='folio' placeholder='Ingrese Folio' required>
                    </div>
                ";
    }

    //Control para modificar la informacion de un pago
    public function modificarPagoController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["id"]))
        {
            //se guardan la informacion del pago
            $data = array("id" => $_POST["id"],
                          "mama" => $_POST["mama"],
                          "pago" => $_POST["pago"],
                          "folio" => $_POST["folio"],
                          "envio" => $_POST["envio"]);

            //se manda la informacion del pa y la tabla en la que esta almacenada
            $resp = CRUDPago::modificarPagoModel($data,"Pago");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "editar";

                //nos redireccionara al listado de pagos
                echo "<script>
                        window.location.replace('index.php?section=pago&action=listado');
                    </script>";
            }
        }
    }  
}
?>