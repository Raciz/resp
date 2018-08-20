<!--Es la plantilla que vera el usuario al ejecutar la aplicación -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- importacion de los archivos para utilizar los datatable y select2-->
        <script src="views/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="views/dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="views/jquery.dataTables.min.css">
        <link href="views/select2.min.css" rel="stylesheet" type="text/css">
        <script src="views/select2.min.js" type="text/javascript"></script>

        <meta charset="UTF-8">
        <!--Codigo css para crear el diseño del sitio-->
        <style>

            nav
            {
                position:relative;
                margin:auto;
                width:100%;
                height:auto;
                background:black;
            }

            nav ul
            {
                position:relative;
                margin:auto;
                width:50%;
                text-align: center;
            }

            nav ul li
            {
                display:inline-block;
                width:24%;
                line-height: 50px;
                list-style: none;
            }

            nav ul li a
            {
                color:white;
                text-decoration: none;
            }

            section
            {
                position: relative;
                margin: auto;
                width:400px;
            }

            section h1
            {
                position: relative;
                margin: auto;
                padding:10px;
                text-align: center;
            }

            section form
            {
                position:relative;
                margin:auto;
                width:400px;
            }


            section form input, button,select,textarea
            {
                display:inline-block;
                padding:10px;
                width:95%;
                margin:5px;
            }

            section form input[type="submit"], button
            {
                position:relative;
                margin:20px auto;
                left:4.5%;

            }

            table
            {
                position:relative;
                margin:auto;
                width:100%;
                left:-10%;
            }

            table thead tr th
            {
                padding:10px;
                width: 200px;
            }

            table tbody tr td
            {
                width: 200px;
                padding:10px;
            }
        </style>
    </head>
    <body>
        <!--Incluimos al menu en esta seccion-->
        <?php include "modules/menu.php"; ?>
        <section>
            <?php 
            //creamos un objeto de mvcController
            $mvc = new mvcController();
            //y obtenemos el controlador para el redireccionamiento
            $mvc -> urlController();
            ?>
        </section>
    </body>
</html>