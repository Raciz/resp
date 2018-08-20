<?php
//clase para realizar el redireccionamiento del sitio
class url
{
    //modelo para realizar e l redireccionamiento del sitio
    public static function urlModel($section,$action)
    {
        //en caso de que se mande un link valido se redirecciona a su pagina correspondiene
        if(($section=="tienda" || $section=="inventario" || $section=="categoria" || $section=="usuario" || $section == "producto" || $section == "venta") && ($action=="listado" || $action=="agregar" || $action=="eliminar" || $action=="editar"))
        {
            $url = "views/".$section."/".$action.".php";
        }
        elseif($section == "venta" && $action=="modificarVenta")
        {
            $url = "views/venta/".$action.".php";
        }
        elseif($section == "producto" && $action=="actualizarStock")
        {
            $url = "views/producto/".$action.".php";
        }
        elseif($section == "producto")
        {
            $url = "views/producto/".$section.".php";
        }
        elseif($section=="dashboard")
        {
            $url = "views/modules/dashboard.php";
        }
        elseif($section=="logout")
        {
            $url = "views/modules/logout.php";
        }
        else //sino se le manda al login
        {
            $url = "views/modules/login.php";
        }
        
        //y se retorna la pagina a redireccionar
        return $url;
    }
}
?>