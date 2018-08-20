<?php

class mvcAlumno
{
    //Control para manejar el registro de un nuevo alumno
    function agregarAlumnoController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion del alumno
            $data = array("nombre" => $_POST["nombre"],
                          "apellido" => $_POST["apellido"],
                          "fecha" => $_POST["fecha"],
                          "grupo" => $_POST["grupo"]);

            //se manda la informacion al modelo con su respectiva tabla en la que se registrara
            $resp = CRUDAlumno::agregarAlumnoModel($data,"Alumna");

            //en caso de que se haya registrado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "agregar";

                //nos redireccionara al listado de alumno
                echo "<script>
                        window.location.replace('index.php?section=alumno&action=listado');
                      </script>";
            }
            else
            {
                //sino mandara un mensaje de error
                echo "error";
            }
        }
    }

    //Control para mostrar un listado de los alumnos registrados en el sistema
    function listadoAlumnoController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de los alumnos
        $data = CRUDAlumno::listadoAlumnoModel("Alumna","Grupo");

        //se imprime la informacion de cada uno de los alumnos registrados
        foreach($data as $rows => $row)
        {
            //e imprimimos la informacion de cada uno de los alumnos
            echo "<tr>
                <td>".$row["id_alumna"]."</td>
                <td>".$row["nombre"]." ".$row["apellido"]."</td>
                <td>".$row["fechaNac"]."</td>
                <td>".$row["grupo"]."</td>
                <td>
                    <center>
                        <div class='btn-group'>
                                <button type='button' title='Editar Alumno' class='btn btn-default' data-toggle='modal' data-target='#edit-alumno' onclick='idEdit(".$row["id_alumna"].")'>
                                    <i class='fa fa-edit'></i>
                                </button>

                            <button type='button' title='Eliminar Alumno' class='btn btn-default' data-toggle='modal' data-target='#del-alumno' onclick='idDel(".$row["id_alumna"].")'>
                                <i class='fa fa-trash-o'></i>
                            </button>
                        </div>
                    </center>
                </td>
            </tr>";
        }
    }

    //Control para borrar un alumno del sistema
    public function eliminarAlumnoController()
    {
        //se verifica si se envio el id del alumno a eliminar
        if(isset($_POST["del"]))
        {
            //de ser asi se guarda el id del alumno
            $data = $_POST["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUDAlumno::eliminarAlumnoModel($data,"Pago","Alumna");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "eliminar";

                //nos redireccionara al listado de alumno
                echo "<script>
                        window.location.replace('index.php?section=alumno&action=listado');
                      </script>";
            }
        }
    }

    //Control para poder mostrar la informacion de un alumno a editar
    public function editarAlumnoController()
    {
        //se obtiene el id del alumno a mostrar su informacion
        $data = $_POST["edit"];

        //se manda el id del alumno y el nombre de la tabla donde esta almacenada
        $resp = CRUDAlumno::editarAlumnoModel($data,"Alumna");

        //se imprime la informacion del grupo en inputs de un formulario
        echo "
                <input type=hidden value=".$resp["id_alumna"]." name='id'>

                <div class='form-group'>
                        <label>Nombre</label>
                        <input type='text' value='".$resp["nombre"]."' class='form-control' name='nombre' placeholder='Ingrese Nombre' required>
                    </div>

                    <div class='form-group'>
                        <label>Apellido</label>
                        <input type='text' value='".$resp["apellido"]."' class='form-control' name='apellido' placeholder='Ingrese Apellido' required>
                    </div>


                    <div class='form-group'>
                        <label>Fecha de Nacimiento</label>

                        <div class='input-group date'>
                            <div class='input-group-addon'>
                                <i class='fa fa-calendar'></i>
                            </div>
                            <input name='fecha' type='text' class='form-control pull-right' id='datepicker2' value='".$resp["fechaNac"]."'>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label>Grupo</label>
                        <select name='grupo' id='grupo' class='form-control select2' style='width: 100%;' required>";

        //creamos un objeto de mvcGrupo
        $option = new mvcGrupo();

        //se manda a llamar al control para traer a los grupos en options
        $option -> optionGrupoController();

        echo"           </select>
                    </div>";
        
        //script para seleccionar en el select el option de la categoria al que pertenece el producto
        echo "<script>
                var grupo = document.getElementById('grupo');

                for(var i = 1; i < grupo.options.length; i++)
                {
                    if(grupo.options[i].value ==".$resp["grupo"].")
                    {
                        grupo.selectedIndex = i;
                    }
                }
                </script>";
        
    }

    //Control para modificar la informacion de un alumno
    public function modificarAlumnoController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion del alumno
            $data = array("id" => $_POST["id"],
                          "nombre" => $_POST["nombre"],
                          "apellido" => $_POST["apellido"],
                          "fecha" => $_POST["fecha"],
                          "grupo" => $_POST["grupo"]);

            //se manda la informacion del alumno y la tabla en la que esta almacenada
            $resp = CRUDAlumno::modificarAlumnoModel($data,"Alumna");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "editar";

                //nos redireccionara al listado de alumnos
                echo "<script>
                        window.location.replace('index.php?section=alumno&action=listado');
                    </script>";
            }
        }
    }

    //Control para obtener las informacion de los alumnos
    public function infoAlumnoController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar su informacion
        $data = CRUDAlumno::listadoAlumnoModel("Alumna","Grupo");

        //mostramos el nombre de cada una de los grupos
        foreach($data as $rows => $row)
        {
            echo "alumnos.push('".$row["id_alumna"].",".$row["nombre"]." ".$row["apellido"].",".$row["grupo"]."');";
        }
    }
    
}
?>


