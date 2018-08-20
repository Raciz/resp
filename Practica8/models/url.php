<?php
//clase para realizar el redireccionamiento del sitio
class url
{
    //modelo para realizar e l redireccionamiento del sitio
    public static function urlModel($link)
    {
        //en caso de que se mande un link valido se redircciona a su pagina correspondiene
        if($link == "maestro" || $link == "alumno" || $link == "carrera" || $link == "tutoria" || $link == "reporte" || $link == "logout" || $link == "agregarC" || $link == "editarC" || $link == "agregarM" || $link == "editarM" || $link == "agregarA" || $link == "editarA" || $link == "agregarT" || $link == "editarT")
        {
            $url = "views/modules/".$link.".php";
        }
        else if($link = "index")//sino se le manda al login
        {
            $url = "views/modules/login.php";
        }
        
        //y se retorna la pagina a redireccioar
        return $url;
    }
}
?>