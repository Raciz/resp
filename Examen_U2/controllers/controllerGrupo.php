<?php

class mvcGrupo
{
    //Control para manejar el registro de un nuevo grupo
    function agregarGrupoController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion de grupo
            $data = $_POST["nombre"];

            //se manda la informacion al modelo con su respectiva tabla en la que se registrara
            $resp = CRUDGrupo::agregarGrupoModel($data,"Grupo");

            //en caso de que se haya registrado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "agregar";

                //nos redireccionara al listado de grupos
                echo "<script>
                        window.location.replace('index.php?section=grupo&action=listado');
                      </script>";
            }
            else
            {
                //sino mandara un mensaje de error
                echo "error";
            }
        }
    }

    //Control para mostrar un listado de los grupos registrados en el sistema
    function listadoGrupoController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de los grupos 
        $data = CRUDGrupo::listadoGrupoModel("Grupo");

        //se imprime la informacion de cada uno de los grupos registrados
        foreach($data as $rows => $row)
        {
            //e imprimimos la informacion de cada uno de los grupos
            echo "<tr>
                <td>".$row["id_grupo"]."</td>
                <td>".$row["nombre"]."</td>
                <td>
                    <center>
                        <div class='btn-group'>
                                <button type='button' title='Editar Grupo' class='btn btn-default' data-toggle='modal' data-target='#edit-grupo' onclick='idEdit(".$row["id_grupo"].")'>
                                    <i class='fa fa-edit'></i>
                                </button>

                            <button type='button' title='Eliminar Grupo' class='btn btn-default' data-toggle='modal' data-target='#del-grupo' onclick='idDel(".$row["id_grupo"].")'>
                                <i class='fa fa-trash-o'></i>
                            </button>
                        </div>
                    </center>
                </td>
            </tr>";
        }
    }

    //Control para borrar un Grupo del sistema
    public function eliminarGrupoController()
    {
        //se verifica si se envio el id del grupo a eliminar
        if(isset($_POST["del"]))
        {
            //de ser asi se guarda el id del grupo
            $data = $_POST["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUDGrupo::eliminarGrupoModel($data,"Alumna","Grupo");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "eliminar";

                //nos redireccionara al listado de grupos
                echo "<script>
                        window.location.replace('index.php?section=grupo&action=listado');
                      </script>";
            }
        }
    }

    //Control para poder mostrar la informacion de un grupo a editar
    public function editarGrupoController()
    {
        //se obtiene el id del grupo a mostrar su informacion
        $data = $_POST["edit"];

        //se manda el id del grupo y el nombre de la tabla donde esta almacenada
        $resp = CRUDGrupo::editarGrupoModel($data,"Grupo");

        //se imprime la informacion del grupo en inputs de un formulario
        echo "
                <input type=hidden value=".$resp["id_grupo"]." name='id'>

                <div class='form-group'>
                    <label>Nombre</label>
                    <input type='text' value='".$resp["nombre"]."' class='form-control' name='nombre' placeholder='Ingrese Nombre' required>
                </div>
             ";
    }

    //Control para modificar la informacion de un grupo
    public function modificarGrupoController()
    {
        //se verifica si mediante el formulario se envio informacion
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion del grupo
            $data = array("id" => $_POST["id"], "nombre" => $_POST["nombre"]);

            //se manda la informacion del grupo y la tabla en la que esta almacenada
            $resp = CRUDGrupo::modificarGrupoModel($data,"Grupo");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "editar";

                //nos redireccionara al listado de grupos
                echo "<script>
                        window.location.replace('index.php?section=grupo&action=listado');
                      </script>";
            }
        }
    }
    
    //Control para mostrar los grupos en un select
    public function optionGrupoController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar su informacion
        $data = CRUDGrupo::listadoGrupoModel("Grupo");

        //mostramos el nombre de cada una de los grupos
        foreach($data as $rows => $row)
        {
            //se muestra cada una de los grupos en un option del select
            echo "<option value=".$row["id_grupo"].">".$row["nombre"]."</option>";
        }
    }
}
?>


