<?php

//incluimos en esta seccion todo lo nesesario para el funcionamiento del sitio
require_once("controllers/controller.php");
require_once("controllers/controllerGrupo.php");
require_once("controllers/controllerAlumno.php");
require_once("controllers/controllerPago.php");
require_once("models/crud.php");
require_once("models/crudGrupo.php");
require_once("models/crudAlumno.php");
require_once("models/crudPago.php");
require_once("models/url.php");

//creamos un objeto de mvcController
$MVC = new mvcController();

//y obtenemos el template
$MVC -> template();
?>



  

