<!-- Full Width Column -->
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Festival 2018
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <?php
                //verificamos si se va a mostrar un mensaje de aviso al suceder un error
                if(!empty($_SESSION["error"]))
                {
                    //si session en error es type
                    if($_SESSION["error"]=="type")
                    {
                        //se muestra el alert de type
                        echo"
                                <div class='alert alert-danger alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                    <h4>
                                        <i class='icon fa fa-ban'></i> Error: Formato de imagen invalido
                                    </h4>
                                    Solo se permite subir imagenes en formato JPG o PNG.
                                </div>
                                ";
                    }
                    //si session en error es size
                    elseif ($_SESSION["error"]=="size")
                    {
                        //se muestra el alert de size
                        echo"
                                <div class='alert alert-danger alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                    <h4>
                                        <i class='icon fa fa-ban'></i> Error: Tamaño superior al permitido
                                    </h4>
                                    No se permite subir imagenes de tamaño superior a 5 MB.
                                </div>
                                ";
                    }
                    //si session en error es copy
                    elseif ($_SESSION["error"]=="copy")
                    {
                        //se muestra el alert de copy
                        echo"
                                <div class='alert alert-danger alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                    <h4>
                                        <i class='icon fa fa-ban'></i> Error
                                    </h4>
                                    No se puede subir la imagen al sistema.
                                </div>
                                ";
                    }

                    //se elimina el contenido de session en mensaje
                    $_SESSION["error"]="";
                }
                ?>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulario de Envio de Comprobantes</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" enctype="multipart/form-data" method="post" action="index.php?section=pago&action=agregar"> 
                            <div class="box-body">

                                <div class="form-group">
                                    <label>Grupo</label>
                                    <select id="grupo" name="grupo" class="form-control select2" style="width: 100%;" onchange="Alumno()">
                                        <option value=0 selected="selected">Seleccione Grupo</option>
                                        <?php
                                        //creamos un objeto de mvcGrupo
                                        $grupo = new mvcGrupo();

                                        //llamamos al controller para traer los grupos en options de un select
                                        $grupo -> optionGrupoController();
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group" id="divSelect">
                                    <label>Alumno</label>
                                    <select id="alumno" name="alumno" class="form-control select2" style="width: 100%;" required>
                                    </select>
                                </div>

                                <label>Nombre de la Madre</label>
                                <div class="row">
                                    <div class="form-group col-xs-6">
                                        <label>Nombre</label>
                                        <input name="nomMadre" type="text" class="form-control" placeholder="Nombre de la Madre" required>
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label>Apellido</label>
                                        <input name="apeMadre" type="text" class="form-control" placeholder="Apellido de la Madre" required>
                                    </div>
                                </div>

                                <!--Date-->
                                <div class="form-group">
                                    <label>Fecha de Pago</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="datePago" type="text" class="form-control pull-right" id="datepicker" required>
                                    </div>
                                    <!-- /.input group -->
                                </div>

                                <div class="form-group">
                                    <label>Imagen (tamaño maximo: 5 MB)</label>
                                    <input type="file" name="img" accept="image/jpeg, image/png" required>
                                </div>

                                <div class="form-group">
                                    <label>Folio</label>
                                    <input name="folio" type="number" class="form-control" placeholder="Folio" required>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <center>
                                    <button type="submit" class="btn btn-primary btn-lg btn-flat">Enviar</button>
                                </center>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col (left) -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.container -->

<script type="text/javascript">
    var alumnos = [];
    <?php
    //creamos un objeto de mvc alumno
    $info = new mvcAlumno();

    //llamamos al controler para traer la informacion de las alumnas
    $info -> infoAlumnoController();
    ?>

    //funcion para mostrar los alumnos de un grupo en especifico
    function Alumno()
    {
        var Select = document.getElementById("alumno");

        while(Select.options.length > 0)
        {
            Select.remove(Select.options.length - 1);
        }

        var grupo = document.getElementById("grupo");
        var nameGrupo = grupo.options[grupo.selectedIndex].text;

        for(i = 0; i < alumnos.length; i++)
        {
            var data = alumnos[i].split(",");

            if(data[2] == nameGrupo)
            {
                var opc = document.createElement("option");
                opc.setAttribute("value",data[0])
                opc.innerHTML = data[1];
                Select.appendChild(opc);
            }
        }

    }
</script>