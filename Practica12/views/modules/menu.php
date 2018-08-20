<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- lista para mostrar el menu de navegacion del sistema -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU PRINCIPAL</li>
            <?php
            //verificamos si el usuario es un super usuario
            if($_SESSION["root"])
            {
            //si, si es super usuario le mostramos la seccion de tiendas 
            ?>
            <li>
                <a href="index.php?section=tienda&action=listado">
                    <i class="fa fa-home"></i> 
                    <span>Tienda</span>
                </a>
            </li>
            <?php
            }
            else
            {
                //si no es super usuario le mostramos la seccion de dashboard
            ?>
            <li>
                <a href="index.php?section=dashboard&shop=<?php echo $_SESSION["shop"]?>">
                    <i class="fa fa-dashboard"></i> 
                    <span>Dashboard</span>
                </a>
            </li>
            <?php
            }
            ?>
            <li>
                <a href="index.php?section=categoria&action=listado">
                    <i class="fa fa-tags"></i> 
                    <span>Categoria</span>
                </a>
            </li>

            <li>
                <a href="index.php?section=inventario&action=listado">
                    <i class="fa fa-truck"></i> 
                    <span>Producto</span>
                </a>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>