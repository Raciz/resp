<?php
//iniciamos y destruimos la sesion para cerrar la sesion del usuario 
session_start();
session_destroy();
header("location:index.php");
?>