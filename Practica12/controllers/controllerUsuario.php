<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class mvcUsuario
{
    //Control para manejar el registro de un nuevo usuario en el sistema
    function agregarUsuarioController()
    {
        //se verifica si mediante el formulario de registro se envio informacion
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion de usuario
            $data = array("nombre" => $_POST["nombre"],
                          "apellido" => $_POST["apellido"],
                          "usuario" => $_POST["usuario"],
                          "password" => $_POST["contraseña"],
                          "email" => $_POST["email"],
                          "tienda" => $_GET["shop"],
                          "root" => $_POST["root"]);

            //se manda la informacion al modelo con su respectiva tabla en la que se registrara
            $resp = CRUDUsuario::agregarUsuarioModel($data,"Usuario");

            //en caso de que se haya registrado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "agregar";

                //nos redireccionara al listado de usuarios
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

    //Control para mostrar un listado de los usuarios registrados en el sistema
    function listadoUsuarioController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de los usuarios 
        $data = CRUDUsuario::listadoUsuarioModel("Usuario");

        //se imprime la informacion de cada uno de los usuarios registrados
        foreach($data as $rows => $row)
        {
            //e imprimimos la informacion de cada uno de los usuarios con su respectivo boton de editar y eliminar
            echo "<tr>
                <td>".$row["id_usuario"]."</td>
                <td>".$row["nombre"]."</td>
                <td>".$row["apellido"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["fecha_de_registro"]."</td>
                <td>
                    <center>
                        <div class='btn-group'>

                                <button type='button' title='Editar Usuario' class='btn btn-default' data-toggle='modal' data-target='#modal-info-confirm-edit' onclick='idEdit(".$row["id_usuario"].")'>
                                    <i class='fa fa-edit'></i>
                                </button>

                            <button type='button' title='Eliminar Usuario' class='btn btn-default' data-toggle='modal' data-target='#modal-info-eliminar' onclick='idDel(".$row["id_usuario"].")'>
                                <i class='fa fa-trash-o'></i>
                            </button>
                        </div>
                    </center>
                </td>
            </tr>";
        }
    }

    //Control para borrar un usuario del sistema
    public function eliminarUsuarioController()
    {
        //se verifica si se envio el id del usuario a eliminar
        if(isset($_POST["del"]))
        {
            //de ser asi se guarda el id del usuario
            $data = $_POST["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUDUsuario::eliminarUsuarioModel($data,"Historial","Usuario");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "eliminar";

                //nos redireccionara al listado de usuarios
                echo "<script>
                        window.location.replace('index.php?section=dashboard&shop=".$_GET["shop"]."');
                      </script>";
            }
        }
    }

    //Control para poder mostrar la informacion de un usuario a editar
    public function editarUsuarioController()
    {
        //se obtiene el id del usuario a mostrar su informacion
        $data = $_POST["edit"];

        //se manda el id del usuario y el nombre de la tabla donde esta almacenada
        $resp = CRUDUsuario::editarUsuarioModel($data,"Usuario");

        //se imprime la informacion del usuario en inputs de un formulario
        echo "
                    <input type=hidden value=".$resp["id_usuario"]." name='id'>

                    <div class='form-group'>
                        <label>Nombres</label>
                        <input type='text' value='".$resp["nombre"]."' class='form-control' name='nombre' placeholder='Ingrese Nombre' required>
                    </div>

                    <div class='form-group'>
                        <label>Apellidos</label>
                        <input type='text' value='".$resp["apellido"]."' class='form-control' name='apellido' placeholder='Ingrese Apellido' required>
                    </div>

                    <div class='form-group'>
                        <label>Usuario</label>
                        <input type='text' value='".$resp["usuario"]."' class='form-control' name='usuario' placeholder='Ingrese Usuario' required>
                    </div>

                    <div class='form-group'>
                        <label>Email</label>
                        <input type='email' value='".$resp["email"]."' class='form-control' name='email' placeholder='Ingrese Email' required>
                    </div>

                    <div class='form-group'>
                        <label>Contraseña</label>
                        <input type='password' value='".$resp["password"]."' class='form-control' name='contraseña' placeholder='Ingrese Contraseña' required>
                    </div>

             ";
    }

    //Control para modificar la informacion de un usuario
    public function modificarUsuarioController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion de usuario
            $data = array("id" => $_POST["id"],
                          "nombre" => $_POST["nombre"],
                          "apellido" => $_POST["apellido"],
                          "usuario" => $_POST["usuario"],
                          "password" => $_POST["contraseña"],
                          "email" => $_POST["email"]);

            //se manda la informacion del usuario y la tabla en la que esta almacenada
            $resp = CRUDUsuario::modificarUsuarioModel($data,"Usuario");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "editar";

                //nos redireccionara al listado de usuarios
                echo "<script>
                        window.location.replace('index.php?section=dashboard&shop=".$_GET["shop"]."');
                      </script>";
            }
        }
    }
}
?>


