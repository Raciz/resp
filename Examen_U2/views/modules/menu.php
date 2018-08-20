<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav">
        <?php
        //verificamos si esta logeado para mostrar las secciones a las que tiene acceso
        if(isset($_SESSION["nombre"]))
        {
        ?>
            <!--secciones a las que el usuario tiene acceso si esta logeado-->
            <li><a href="index.php?section=dashboard">Dashboard<span class="sr-only">(current)</span></a></li>
            <li><a href="index.php?section=alumno&action=listado">Alumnos</a></li>
            <li><a href="index.php?section=grupo&action=listado">Grupos</a></li>
            <li><a href="index.php?section=pago&action=listado">Pagos</a></li>
        <?php
        }
        else
        {
        ?>
            <!--secciones a las que el usuario tiene acceso si no esta logeado-->
            <li><a href="index.php?section=registro">Registro<span class="sr-only">(current)</span></a></li>
            <li><a href="index.php?section=listado">Listados</a></li>
        <?php
        }
        ?>
    </ul>
</div>