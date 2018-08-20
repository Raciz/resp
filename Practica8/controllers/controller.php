<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//clase para controar todo lo realizado en el sistema
class mvcController
{
    //Control para invocar la platilla con el diseño del sitio
    public function template()
    {
        //incluimos el archivo con la plantilla
        include "views/template.php";
    }

    //Control para manejar el redireccionamiento de las distintas secciones del sitio
    public function urlController()
    {
        //verifica si de debe dirigir a una pagina en especifico con GET
        if(isset($_GET["action"]))
        {
            //encaso de ser asi guarda el nombre de la pagina
            $link = $_GET["action"];
        }
        else
        {
            //en caso de no ser asi se le direccionara al index
            $link = "index";
        }

        //se llama al modelo utilizado para el direccionaiento 
        $url = url::urlModel($link);

        //y se incluye la pagina a la qu se va a derireccionar
        include $url;
    }

    //Control para manejar el registro de una nueva carrera en el sistema
    public function registroCarreraController()
    {
        //se verifica si mediante el formulario de registro se envio informacion
        if(isset($_POST["carrera"]))
        {
            //se gardan la informacion de la carrera
            $data = $_POST["carrera"];

            //se manda la informacion al modelo con su respectiva tabla en la que se registrara
            $resp = CRUD::registroCarreraModel($data,"Carrera");

            //en caso de que se haya registrado corectamente
            if($resp == "success")
            {
                //nos redireccionara a carrera
                header("location:index.php?action=carrera");
            }
            else
            {
                //sino mandara un mensaje de error
                echo "error";
            }
        }
    }

    //Control para mostrar un listado de las carreras registradas en el sistema
    public function listaCarreraController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de las carreras
        $data = CRUD::listaCarreraModel("Carrera");

        //se imprime la informacion de cada una de las carreras registradas
        foreach($data as $rows => $row)
        {
            //e imprimimos cada una de las carreras con su respectivo boton de editar y eliminar
            echo "<tr>
                <td>".$row["nombre"]."</td>
                <td><a href=index.php?action=editarC&edit=".$row["id"]."><button>Editar</button></a></td>
                <td><a href=index.php?action=carrera&del=".$row["id"]."><button>Eliminar</button></a></td>
            </tr>";
        }
    }

    //Control para mostrar las carreras en un select
    public function optionCarreraController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar su informacion
        $data = CRUD::listaCarreraModel("Carrera");

        //mostramos el nombre de cada una de las carreras
        foreach($data as $rows => $row)
        {
            //se muestra cada una en un option del select
            echo "<option value=".$row["id"].">".$row["nombre"]."</option>";
        }
    }

    //Control para borrar una carrera del sistema
    public function deleteCarreraController()
    {
        //se verifica si se envio el id de la carrera a eliminar
        if(isset($_GET["del"]))
        {
            //de ser asi se guarda el id de la carrera
            $data = $_GET["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUD::deleteCarreraModel($data,"Carrera");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //nos redireccionara a carrera
                header("location:index.php?action=carrera");
            }
        }
    }

    //Control para poder mostrar la informacion de una carrera a editar
    public function editCarreraController()
    {
        //se obtiene el id de la carrera a mostrar su informacion
        $data = $_GET["edit"];

        //se manda el id de la carrera y el nombre de la tabla donde esta almacenada
        $resp = CRUD::editCarreraModel($data,"Carrera");

        //se imprime la informacion de la carrera en inputs de un formulario
        echo "
             <input type=hidden value=".$resp["id"]." name=id>
             <label>Nombre:</label>
			 <input type=text value='".$resp["nombre"]."' name=nombre required>
             <input type=submit value=Actualizar name=enviar>
             ";
    }

    //Control para modificar la informacion de una carrera
    public function updateCarreraController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["nombre"]))
        {
            //se guarda la informacion de la carrera
            $data = array("id"=>$_POST["id"],"nombre"=>$_POST["nombre"]);

            //se manda la informacion de la carrera y la tabla en la que esta almacenada
            $resp = CRUD::updateCarreraModel($data,"Carrera");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //nos direccionara a carrera
                header("location:index.php?action=carrera");
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //Control para registrar un maestro en el sistema
    public function registroMaestroController()
    {
        //se verifica que se haya enviado la informacion del maestro desde un formulario
        if(isset($_POST["num_empleado"]))
        {
            //se guarda la informacion del maestro a registrar
            $data = array("num_empleado" => $_POST["num_empleado"],
                          "carrera" => $_POST["carrera"],
                          "nombre" => $_POST["nombre"],
                          "email" => $_POST["email"],
                          "password" => $_POST["password"],
                          "super" => $_POST["super"]);

            //se manda la informacion del maestro junto con la tabla en donde se va a registrar
            $resp = CRUD::registroMaestroModel($data,"Maestro");

            //en caso de que se haya registrado correctamente
            if($resp == "success")
            {
                //nos direccionara a maestro
                header("location:index.php?action=maestro");
            }
        }
    }

    //Control para mostrar un listado de los maestros registrados en el sistema
    public function listaMaestroController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de los maestros 
        $data = CRUD::listaMaestroModel("Maestro","Carrera");

        //se imprime la informacion de cada uno de los maestros registrados
        foreach($data as $rows => $row)
        {
            //e imprimimos cada uno de los maestros con su respectivo boton de editar y eliminar
            if($row["superUser"])
            {
                $super = "SI";
            }
            else
            {
                $super = "NO";
            }
            echo "<tr>
                <td>".$row["num_empleado"]."</td>
                <td>".$row["carrera"]."</td>
                <td>".$row["nombre"]."</td>
                <td>".$row["email"]."</td>
                <td>".$super."</td>
                <td><a href=index.php?action=editarM&edit=".$row["num_empleado"]."><button>Editar</button></a></td>
                <td><a href=index.php?action=maestro&del=".$row["num_empleado"]."><button>Eliminar</button></a></td>
            </tr>";
        }
    }

    //Control para eliminar un maestro del sistema
    public function deleteMaestroController()
    {
        //se verifica si se envio el id del maestro a eliminar
        if(isset($_GET["del"]))
        {
            //de ser asi se guarda el id del maestro
            $data = $_GET["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUD::deleteMaestroModel($data,"Maestro");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //nos redireccionara a maestro
                header("location:index.php?action=maestro");
            }
        }
    }

    //Control para poder mostrar la informacion de un maestro a editar
    public function editMaestroController()
    {
        //se obtinen el id del maestro a mostrar su informacion
        $data = $_GET["edit"];

        //se manda al modelo el id y el nombre de la tabla donde esta almacenada
        $resp = CRUD::editMaestroModel($data,"Maestro");

        //se imprime la informacion del maestro en inputs de un formulario
        echo "<input type=hidden name=num_empleado value=".$resp["num_empleado"]." required>
              <label>Carrera: <label>
              <select required id=carrera name=carrera class=carrera>
                    <option value='".$resp["carrera"]."'>Seleccione Carrera</option>";
        $edit = new mvcController();
        $edit -> optionCarreraController();
        echo "</select>
              <label>Nombre: <label>
              <input type=text placeholder=Nombre name=nombre value='".$resp["nombre"]."' required>
              <label>Correo: <label>
              <input type=email placeholder=Email name=email value=".$resp["email"]." required>
              <label>Contraseña: <label>
              <input type=password placeholder=Contraseña name=password value='".$resp["password"]."' required>
              <br>
              <label>Super Usuario: <label>
              <select id='S' name='super' class='super'>
                <option value=".$resp["superUser"].">¿Es Super Usuario?</option>
                <option value=0>NO</option>
                <option value=1>Si</option>
              </select>
              <input type=submit value=Actualizar name=enviar>
             ";
      
          echo "<script>
                var carrera = document.getElementById('carrera');
               var select2 = document.getElementById('S');
                
                for(var i = 1; i < carrera.options.length; i++)
                {
                    if(carrera.options[i].value ==".$resp["carrera"].")
                    {
                        carrera.selectedIndex = i;
                    }
                }
                for(var i = 1; i < S.options.length; i++)
                {
                    if(S.options[i].value ==".$resp["superUser"].")
                    {
                        S.selectedIndex = i;
                    }
                }
               
                </script>";
    }

    //Control para modificar la informacion de un maestro
    public function updateMaestroController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["num_empleado"]))
        {
            //se guarda la informacion del maestro
            $data = array("num_empleado" => $_POST["num_empleado"],
                          "carrera" => $_POST["carrera"],
                          "nombre" => $_POST["nombre"],
                          "email" => $_POST["email"],
                          "password" => $_POST["password"],
                          "super" => $_POST["super"]);

            //se manda la informacion del maestro y la tabla en la que esta almacenada
            $resp = CRUD::updateMaestroModel($data,"Maestro");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //nos direccionara a maestro
                header("location:index.php?action=maestro");
            }
        }
    }

    //Control para mostrar las carreras en un select
    public function optionMaestroController()
    {
        //se le mada al modelo el nombre de la tabla a mostrar su informacion
        $data = CRUD::listaMaestroModel("Maestro","Carrera");

        //mostramos el nombr de cada una de las carreras
        foreach($data as $rows => $row)
        {
            //se muestra cada uno en un option del select
            echo "<option value=".$row["num_empleado"].">".$row["nombre"]."</option>";
        }
    }

    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //Control para manejar el registro de un nuevo alumno en el sistema
    public function registroAlumnoController()
    {
        //se verifica si mediante el formulario de registro se envio informacion
        if(isset($_POST["matricula"]))
        {
            //se guarda la informacion del alumno
            $data = array("matricula" => $_POST["matricula"],
                          "nombre" => $_POST["nombre"],
                          "carrera" => $_POST["carrera"],
                          "tutor" => $_POST["tutor"]);

            //se le manda la informacion al modelo con su respectiva tabla en la que se registrara
            $resp = CRUD::registroAlumnoModel($data,"Alumno");

            //en caso de que se haya registrado correctamente
            if($resp == "success")
            {
                //nos redireccionara a alumno
                header("location:index.php?action=alumno");
            }
        }
    }

    //Control para mostrar un listado de los alumnos registrados en el sistema
    public function listaAlumnoController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de los alumnos
        $data = CRUD::listaAlumnoModel("Alumno","Carrera","Maestro");

        //se imprime la informacion de cada uno de los alumnos registrados
        foreach($data as $rows => $row)
        {
            //e imprimimos cada uno de los alumno con su respectivo boton de editar y eliminar
            echo "<tr>
                <td>".$row["matricula"]."</td>
                <td>".$row["nombre"]."</td>
                <td>".$row["carrera"]."</td>
                <td>".$row["tutor"]."</td>
                <td><a href=index.php?action=editarA&edit=".$row["matricula"]."><button>Editar</button></a></td>
                <td><a href=index.php?action=alumno&del=".$row["matricula"]."><button>Eliminar</button></a></td>
            </tr>";
        }
    }

    //Control para eliminar un alumno del sistema
    public function deleteAlumnoController()
    {
        //se verifica si se envio el id del alumno a eliminar 
        if(isset($_GET["del"]))
        {
            //de ser asi se guarda el id del alumno
            $data = $_GET["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUD::deleteAlumnoModel($data,"Alumno");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //nos redirecciona a alumno
                header("location:index.php?action=alumno");
            }
        }
    }

    //control para poder mostrar la informacion de un maestro a editar
    public function editAlumnoController()
    {
        //se obtiene el id del alumno a mostrar su informacion
        $data = $_GET["edit"];

        //se manda al modelo el id y el nombre de la tabla donde esta almacenada
        $resp = CRUD::editAlumnoModel($data,"Alumno");

        //se imprime la informacion del maestro en inputs de un formulario
        echo "<input type=hidden name=matricula value=".$resp["matricula"]." required>
        <label>Nombre: </label>
              <input type=text placeholder=Nombre name=nombre value='".$resp["nombre"]."' required>
              <br>
              <br>
              <label>Carrera: </label>
              <select required name='carrera' id='carrera' class='carrera'>
                    <option value='".$resp["carrera"]."'>Seleccione Carrera</option>";
                    $edit = new mvcController();
                    $edit -> optionCarreraController();
        echo "</select>
        <br>
        <br>
        <label>Tutor: </label>
        <select required id='tutor' name='tutor' class='tutor'>
                    <option value='".$resp["tutor"]."'>Seleccione Tutor</option>";
                    $edit -> optionMaestroController();
        echo "</select>
              <input type=submit value=Actualizar name=enviar>";

        echo "<script>
                var carrera = document.getElementById('carrera');
               var tutor = document.getElementById('tutor');
                
                for(var i = 1; i < carrera.options.length; i++)
                {
                    if(carrera.options[i].value ==".$resp["carrera"].")
                    {
                        carrera.selectedIndex = i;
                    }
                }
                for(var i = 1; i < tutor.options.length; i++)
                {
                    if(tutor.options[i].value =='".$resp["tutor"]."')
                    {
                        tutor.selectedIndex = i;
                    }
                }
               
                </script>";
    }

    //Control para modificar la informacion de un alumno
    public function updateAlumnoController()
    {
        //se verifica si mediante el formulario se envio la informacion
        if(isset($_POST["matricula"]))
        {
            $data = array("matricula" => $_POST["matricula"],
                          "nombre" => $_POST["nombre"],
                          "carrera" => $_POST["carrera"],
                          "tutor" => $_POST["tutor"]);

            //se manda la informacion del alumno y la tabla en la que esta almacenada
            $resp = CRUD::updateAlumnoModel($data,"Alumno");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //nos direccionara a alumno
                header("location:index.php?action=alumno");
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //Control para manejar el acceso al sistema
    public function loginController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["num_empleado"]))
        {
            //se guarda la informacion del login
            $data = array("num_empleado"=>$_POST["num_empleado"], 
                          "password"=>$_POST["password"]);

            //se manda al modelo la informacion del login
            $resp = CRUD::loginModel($data,"Maestro");

            //se verifica que la informacion mandada por el formulario sea igual a la devuelta por el modelo
            if($resp["num_empleado"] == $_POST["num_empleado"] && $resp["password"] == $_POST["password"])
            {
                //en caso de que coincida se inicia sesion y se guardan cierto datos del maestro
                session_start();
                $_SESSION["maestro"] = $resp["num_empleado"];
                $_SESSION["superUser"] = $resp["superUser"];

                //y nos redirecciona a tutoria
                header("location:index.php?action=tutoria");
            }

        }	
    }

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //control para registrar una tutoria
    public function registroTutoriaController()
    {
        //se verifica que se haya mandado informacion del formulario
        if(isset($_POST["alumno"]))
        {
            //se guarda la informacion de la tutoria
            $data = array("alumno" =>$_POST["alumno"],
                          "tipo" =>$_POST["tipo"],
                          "tutoria" =>$_POST["tutoria"],
                          "tutor" => $_SESSION["maestro"]);

            //se manda al modelo la informacion de la tutoria
            $resp = CRUD::registroTutoriaModel($data,"Tutoria");

            //en caso de que se haya almacenado correctamente  nos derirecciona a tutoria
            if($resp == "success")
            {
                header("location:index.php?action=tutoria");
            }
        }
    }

    //control para devolver los tutorados de un maestro
    public function tutoradosController()
    {
        //se manda al modelo la informacion del maestro
        $data = CRUD::tutoradosModel("Alumno",$_SESSION["maestro"]);

        //y se imprime a cada uno de los tutorados del maestro en options de un select
        foreach($data as $rows => $row)
        {
            echo "<option value=".$row["matricula"].">".$row["nombre"]."</option>";
        }
    }

    //control para mostrar cada una de las tutorias que hecho un maestro
    public function listaTutoriaMaestroController()
    {
        //se manda al modelo la informacion del maestro y el nombre de las tablas involucradas en esto
        $data = CRUD::listaTutoriaMaestroModel("Tutoria","Maestro","Alumno",$_SESSION["maestro"]);

        //se imprime la informacion de casa uno de las tutorias impartidas por el maestro
        foreach($data as $rows => $row)
        {
            echo "<tr>
                <td>".$row["alumno"]."</td>
                <td>".$row["tutor"]."</td>
                <td>".$row["fecha"]."</td>
                <td>".$row["hora"]."</td>
                <td>".$row["tipo"]."</td>
                <td>".$row["tutoria"]."</td>
                <td><a href=index.php?action=editarT&edit=".$row["id"]."><button>Editar</button></a></td>
                <td><a href=index.php?action=tutoria&del=".$row["id"]."><button>Eliminar</button></a></td>
            </tr>";
        }
    }

    //control para eliminar una tutoria del sistema
    public function deleteTutoriaController()
    {
        //se verifica que se envio el id de la tutoria a eliminar
        if(isset($_GET["del"]))
        {
            //de ser asi se guarda el id del alumno
            $data = $_GET["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUD::deleteTutoriaModel($data,"Tutoria");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //nos redirecciona a alumno
                header("location:index.php?action=tutoria");
            }
        }
    }


    public function editTutoriaController()
    {
        $data = $_GET["edit"];
        $resp = CRUD::editTutoriaModel($data,"Tutoria");

        echo "<input type=hidden name=matricula value=".$resp["id"]." required>
              <label>Tutorado: </label>
              <select name='alumno' class='alumno' id='alumno'>
                <option value=".$resp["alumno"].">Seleccione Alumno</option>";
        $registro = new mvcController();
        $registro -> tutoradosController();
        echo "</select>
              <br>
              <label>Tipo:</label>
              <select id='tipo' name='tipo' class='tipo' required>
                <option value=".$resp["tipo"].">Seleccione Tipo de Tutoria</option>
                <option value=Individual>Individual</option>
                <option value=Grupal>Grupal</option>
              </select>
              <br>
              <label>Descripcion de Tutoria: </label>
              <textarea name=tutoria placeholder=Descripcion de Tutoria>".$resp["tutoria"]."</textarea>
              <input type=submit value=Enviar name=enviar>";
      
      echo "<script>
               var alumno = document.getElementById('alumno');
               var tipo = document.getElementById('tipo');
                
                for(var i = 1; i < alumno.options.length; i++)
                {
                    if(alumno.options[i].value ==".$resp["alumno"].")
                    {
                        alumno.selectedIndex = i;
                    }
                }
                for(var i = 1; i < tipo.options.length; i++)
                {
                    if(tipo.options[i].value =='".$resp["tipo"]."')
                    {
                        tipo.selectedIndex = i;
                    }
                }
               
                </script>";
    }

    //control para modificarla informacion de una tutoria
    public function updateTutoriaController()
    {
        //se verifica si mediante el formulario se envio la informacion
        if(isset($_POST["alumno"]))
        {
            $data = array("alumno" => $_POST["alumno"],
                          "tipo" => $_POST["tipo"],
                          "tutoria" => $_POST["tutoria"],
                          "id" => $_POST["matricula"]);

            //se manda la informacion del alumno y la tabla en la que esta almacenada
            $resp = CRUD::updateTutoriaModel($data,"Tutoria");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //nos direccionara a alumno
                header("location:index.php?action=tutoria");
            }
        }
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //control para mostrar todas las carreras registradas en el sistema
    public function reporteCarreraController()
    {
        //se manda al modelo la tabla en donde estan almacenada
        $data = CRUD::listaCarreraModel("Carrera");

        //se imprime cada una de las carreras registradas
        foreach($data as $rows => $row)
        {
            echo "<tr>
                <td>".$row["nombre"]."</td>
            </tr>";
        }
    }

    //control para mostrar todos los maestros registrados en el sistema
    public function reporteMaestroController()
    {
        //se manda al modelo la tabla en donde estan almacenada
        $data = CRUD::listaMaestroModel("Maestro","Carrera");

        //se imprime cada uno de los maestros registrados
        foreach($data as $rows => $row)
        {
            if($row["superUser"])
            {
                $super = "SI";
            }
            else
            {
                $super = "NO";
            }
            echo "<tr>
                <td>".$row["num_empleado"]."</td>
                <td>".$row["carrera"]."</td>
                <td>".$row["nombre"]."</td>
                <td>".$row["email"]."</td>
                <td>".$super."</td>
            </tr>";
        }
    }

    //control para mostrar todos los alumnos registrados en el sistema
    public function reporteAlumnoController()
    {
        //se manda al modelo la tabla en donde estan almacenada
        $data = CRUD::listaAlumnoModel("Alumno","Carrera","Maestro");

        //se imprime cada uno de los maestros registrados
        foreach($data as $rows => $row)
        {
            echo "<tr>
                <td>".$row["matricula"]."</td>
                <td>".$row["nombre"]."</td>
                <td>".$row["carrera"]."</td>
                <td>".$row["tutor"]."</td>
            </tr>";
        }
    }

    public function reporteTutoriaMaestroController()
    {
        //se manda al modelo la tabla en donde estan almacenada
        $data = CRUD::reporteTutoriaMaestroModel("Tutoria","Maestro","Alumno");

        //se imprime cada uno de los maestros registrados
        foreach($data as $rows => $row)
        {
            echo "<tr>
                <td>".$row["alumno"]."</td>
                <td>".$row["tutor"]."</td>
                <td>".$row["fecha"]."</td>
                <td>".$row["hora"]."</td>
                <td>".$row["tipo"]."</td>
                <td>".$row["tutoria"]."</td>
            </tr>";
        }
    }
}
?>