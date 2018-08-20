<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
?>
<html>
    <head>
        <!--importacion de los archivos con los estilos del template-->
        <meta charset="utf-8">
        <link rel="icon" href="views/media/img/favicon.png" sizes="16x16">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Control de Alumnos</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="views/media/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="views/media/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="views/media/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="views/media/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="views/media/dist/css/skins/_all-skins.min.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="views/media/bower_components/morris.js/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="views/media/bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="views/media/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="views/media/bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="views/media/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="views/media/plugins/iCheck/all.css">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="views/media/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="views/media/plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="views/media/bower_components/select2/dist/css/select2.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="views/media/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">


        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <!--codigo css para añadir estilo a ciertas partes del template-->
        <style>
            .example-modal .modal 
            {
                position: relative;
                top: auto;
                bottom: auto;
                right: auto;
                left: auto;
                display: block;
                z-index: 1;
            }

            .example-modal .modal 
            {
                background: transparent !important;
            }

            .ocultar
            {
                display: none;
            }

            .info_product
            {
                font-size: 20px;
            }

            .image
            {
                width: 300px;
                height: 300px;
            }
        </style>

    </head>

    <?php
    if(!(isset($_GET["section"]) && $_GET["section"] == "admin"))
    {
    ?>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="#" class="navbar-brand"><b>TAW</b></a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- incluimos el menu -->
                        <?php
        include "modules/menu.php";
                        ?>

                        <?php
                        if(isset($_SESSION["nombre"]))
                        {
                        ?>
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">                                
                                <!-- User Account Menu -->
                                <li class="dropdown user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- The user image in the menu -->
                                        <li class="user-header">
                                            <!--<img src="views/media/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->

                                            <p>
                                                <?php echo $_SESSION["nombre"]; ?>
                                            </p>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <a href="index.php?section=logout" class="btn btn-default btn-flat">Cerrar Sesion</a>
                                        </li>
                                        <!-- Menu Body -->
                                        <li class="user-body">
                                            <div class="row">

                                            </div>
                                            <!-- /.row -->
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-custom-menu -->
                        <?php 
                        } 
                        ?>
                        
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>
            <?php
            }
            ?>
            
            <?php
            if(!(isset($_GET["section"]) && $_GET["section"] == "admin"))
            {
                echo "<!-- Content Wrapper. Contains page content -->
                      <div class='content-wrapper'>";
            }

            //creamos un objeto de mvcController
            $mvc = new mvcController();
            //y obtenemos el controlador para el redireccionamiento
            $mvc -> urlController();

            if(!(isset($_GET["section"]) && $_GET["section"] == "admin"))
            {
                echo"</div>
                     <!-- /.content-wrapper -->";
            }
            ?>

            <?php
            if(!(isset($_GET["section"]) && $_GET["section"] == "admin"))
            {
            ?>
            <footer class="main-footer">
                <div class="container">
                    <strong>Copyright &copy; 2018 <a href="#">Francisco Isaac Perales Morales</a>.</strong> All rights
                    reserved.
                </div>
                <!-- /.container -->
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">

                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
            <?php
            }
            ?>
        </div>
        <!-- ./wrapper -->

        <!--importacion de scripts para el funcionamiento de los compenentes del template-->
        <!-- jQuery 3 -->
        <script src="views/media/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="views/media/bower_components/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="views/media/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="views/media/bower_components/raphael/raphael.min.js"></script>
        <script src="views/media/bower_components/morris.js/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="views/media/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="views/media/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="views/media/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="views/media/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="views/media/bower_components/moment/min/moment.min.js"></script>
        <script src="views/media/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="views/media/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="views/media/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="views/media/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="views/media/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="views/media/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="views/media/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="views/media/dist/js/demo.js"></script>
        <!-- Select2 -->
        <script src="views/media/bower_components/select2/dist/js/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="views/media/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="views/media/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="views/media/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- date-range-picker -->
        <script src="views/media/bower_components/moment/min/moment.min.js"></script>
        <script src="views/media/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="views/media/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <!-- bootstrap time picker -->
        <script src="views/media/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="views/media/plugins/iCheck/icheck.min.js"></script>
        <!-- DataTables -->
        <script src="views/media/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="views/media/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- ChartJS -->
        <script src="views/media/bower_components/chart.js/Chart.js"></script>
        <script>
            $(
                function ()
                {
                    //Initialize Select2 Elements
                    $('.select2').select2()

                    //Date picker
                    $('#datepicker').datepicker({autoclose: true})
                    $('#datepicker2').datepicker({autoclose: true})

                    $('#example1').DataTable
                    (
                        {
                            'paging'      : true,
                            'lengthChange': false,
                            'searching'   : true,
                            'ordering'    : true,
                            'info'        : true,
                            'autoWidth'   : false
                        }
                    )

                    $('#example2').DataTable
                    (
                        {
                            'paging'      : true,
                            'lengthChange': false,
                            'searching'   : true,
                            'ordering'    : true,
                            'info'        : true,
                            'autoWidth'   : false
                        }
                    )

                    $('#example3').DataTable
                    (
                        {
                            'paging'      : true,
                            'lengthChange': false,
                            'searching'   : true,
                            'ordering'    : true,
                            'info'        : true,
                            'autoWidth'   : false
                        }
                    )

                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck
                    (
                        {
                            checkboxClass: 'icheckbox_minimal-blue',
                            radioClass   : 'iradio_minimal-blue'
                        }
                    )
                }
            )
        </script>
    </body>
</html>


