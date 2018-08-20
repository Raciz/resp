<?php

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
            $action = "index";
        }

        //se llama al modelo utilizado para el direccionaiento 
        $url = url::urlModel($section,$action);

        //y se incluye la pagina a la que se va a derireccionar
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
            if($resp["username"] == $_POST["user"]  && $resp["password"] == $_POST["password"])
            {
                //en caso de que coincida se inicia sesion y se guardan cierto datos del usuario
                $_SESSION["nombre"] = $resp["nombre"];
                $_SESSION["password"] = $resp["password"];

                //si no se direccionara al dashboard
                echo "<script>
                        window.location.replace('index.php?section=dashboard');
                      </script>";
            }
        }
    }
    
    //contron para obtener la informacion del sistema
    public function infoSistemaController()
    {
        //llamamos al modelo para obtener la informacion de la tienda
        $data = CRUD::infoSistemaModel("Grupo","Alumna","Pago");
        
        return $data;
    }
}
?>