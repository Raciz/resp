<?php

//incluimos en esta seccion todo lo nesesario para el fncionamiento del sitio
require_once "controllers/controller.php";
require_once "models/url.php";
require_once "models/crud.php";

//creamos un objeto de mvcController
$MVC = new mvcController();

//y obtenemos el template
$MVC -> template();

?>