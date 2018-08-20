<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class mvcController
{
    //Control para invocar la platilla con el diseño del sitio
    public function template()
    {
        //incluimos el archivo con la plantilla
        include "views/template.php";
    }

    //Control para manejar el redireccionamiento de las distintas secciones del sitio
    public function urlController()
    {
        //verifica si de debe dirigir a una seccion en especifico con GET
        if(isset($_GET["section"]))
        {
            //se obtiene la seccion de direccionar
            $section = $_GET["section"];
        }
        else
        {
            //en caso de no ser asi se le direccionara al index
            $section = "index";
        }

        //se verifica si en dicha seccion se realizara una accion en especifico
        if(isset($_GET["action"]))
        {
            //se obtiene la accion a realizar
            $action = $_GET["action"];
        }
        else
        {
            //sino entonces no se realizara alguna accion en la seccion
            $action = "";
        }

        //se llama al modelo utilizado para el direccionaiento 
        $url = url::urlModel($section,$action);

        //y se incluye la pagina a la qu se va a derireccionar
        include $url;
    }

    //Control para manejar el acceso al sistema
    public function loginController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["user"]))
        {
            //se guarda la informacion del login
            $data = array("usuario"=>$_POST["user"],
                          "password"=>$_POST["password"]);

            //se manda al modelo la informacion del login
            $resp = CRUD::loginModel($data,"Usuario");

            //se verifica que la informacion mandada por el formulario sea igual a la devuelta por el modelo
            if((($resp["usuario"] == $_POST["user"]) || ($resp["email"] == $_POST["user"])) && $resp["password"] == $_POST["password"])
            {
                //en caso de que coincida se inicia sesion y se guardan cierto datos del usuario
                $_SESSION["nombre"] = $resp["nombre"]." ".$resp["apellido"];
                $_SESSION["password"] = $resp["password"];
                $_SESSION["id"] = $resp["id_usuario"];
                $_SESSION["root"] = $resp["root"];
                $_SESSION["shop"] = $resp["id_tienda"];

                //y nos redireccionamos dependiendo si somos o no super usuario
                if($resp["root"])
                {
                    //si somos super usuario nos redireccionara al listado de tiendas
                    header("location:index.php?section=tienda&action=listado");
                }
                else
                {
                    //si no se direccionara al dashboard de la tienda a la que pertenece
                    header("location:index.php?section=dashboard&shop=".$resp["id_tienda"]);
                }
            }
        }	
    }
}
?>