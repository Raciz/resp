<?php
//verificamos si el usuario ya ha iniciado session
if(isset($_SESSION["nombre"]))
{
    //en caso de ser asi, lo redireccionaremos

    //si es super usuario
    if($_SESSION["root"])
    {
        //lo redireccionaremos al listado de tiendas
        echo "<script>
            window.location.replace('index.php?section=tienda&action=listado');
          </script>";
    }
    //si no es super usuario
    else
    {
        //lo redireccionaremos al dashboard de la tienda en la cual pertenece
        echo "<script>
            window.location.replace('index.php?section=dashboard&shop=".$_SESSION["shop"]."');
          </script>";
    }
}

//creamos un objeto de mvcController
$login = new mvcController();

//se manda a llamar el control para manejar el inicio de sesion
$login -> loginController();
?>

<body class="hold-transition login-page">
    <!--caja para mostrar el formulario de inicio de sesion-->
    <div class="login-box">
        <div class="login-logo">
            <h1>Inventario TAW</h1>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">
                Iniciar Sesion
            </p>

            <!--formulario para ingresar la informacion para que un usuario pueda iniciar sesion en el sistema-->
            <form method="post" autocomplete="off">

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Ingrese Usuario O Correo" name="user" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesion</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

