<!--Menu para navegar en el sistema-->
<nav>
    <ul>
        <?php
        session_start();
        
        if(isset($_SESSION["superUser"]))
        {
          if($_SESSION["superUser"] == 1)
          {
            echo 
            "<li><a href=index.php?action=maestro>Maestros</a></li>
             <li><a href=index.php?action=alumno>Alumnos</a></li>
             <li><a href=index.php?action=carrera>Carreras</a></li>
             <li><a href=index.php?action=reporte>Reportes</a></li>";
          }
          echo "<li><a href=index.php?action=tutoria>Tutorias</a></li>";
        }

        if(isset($_SESSION["maestro"]))
        {
            echo "<li><a href=index.php?action=logout>Cerrar Sesion</a></li>";
        }
        else
        {
            echo "<li><a href=index.php?action=login>Iniciar Sesion</a></li>";
        }
        ?>
    </ul>
</nav>