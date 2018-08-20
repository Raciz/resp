<?php

//incluimos en esta seccion todo lo nesesario para el funcionamiento del sitio
require_once "controllers/controller.php";
require_once "controllers/controllerUsuario.php";
require_once "controllers/controllerCategoria.php";
require_once "controllers/controllerInventario.php";
require_once "controllers/controllerTienda.php";
require_once "controllers/controllerProducto.php";
require_once "controllers/controllerVenta.php";
require_once "models/crudUsuario.php";
require_once "models/crudCategoria.php";
require_once "models/crudInventario.php";
require_once "models/crudTienda.php";
require_once "models/crudProducto.php";
require_once "models/crudVenta.php";
require_once "models/url.php";
require_once "models/crud.php";

//creamos un objeto de mvcController
$MVC = new mvcController();

//y obtenemos el template
$MVC -> template();


?>