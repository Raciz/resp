<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class mvcCategoria
{
    //Control para manejar el registro de una nueva categoria en el sistema
    function agregarCategoriaController()
    {
        //se verifica si mediante el formulario de registro se envio la informacion de la categoria
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion de la categoria
            $data = array("nombre" => $_POST["nombre"],
                          "descripcion" => $_POST["descripcion"]);

            //se manda la informacion al modelo con su respectiva tabla en la que se registrara
            $resp = CRUDCategoria::agregarCategoriaModel($data,"Categoria");

            //en caso de que se haya registrado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "agregar";

                //nos redireccionara al listado de categorias
                echo "<script>
                        window.location.replace('index.php?section=categoria&action=listado');
                      </script>";
            }
            else
            {
                //sino mandara un mensaje de error
                echo "error";
            }
        }
    }

    //Control para mostrar un listado de las categorias registrados en el sistema
    function listadoCategoriaController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar la informacion de las categorias 
        $data = CRUDCategoria::listadoCategoriaModel("Categoria");

        //se imprime la informacion de cada uno de las categorias registrados
        foreach($data as $rows => $row)
        {
            //e imprimimos la informacion de cada uno de las categorias
            echo "<tr>
                <td>".$row["nombre_categoria"]."</td>
                <td>".$row["descripcion_categoria"]."</td>
                <td>".$row["fecha_de_registro"]."</td>
                <td>
                    <center>
                        <div class='btn-group'>
                            <button type='button' title='Editar Categoria' class='btn btn-default' data-toggle='modal' data-target='#edit-categoria' onclick='idEdit(".$row["id_categoria"].")'>
                                <i class='fa fa-edit'></i>
                            </button>
                            
                            <button type='button' title='Eliminar Categoria' class='btn btn-default' data-toggle='modal' data-target='#modal-info-eliminar' onclick='idDel(".$row["id_categoria"].")'>
                                <i class='fa fa-trash-o'></i>
                            </button>
                        </div>
                    </center>
                </td>
            </tr>";
        }
    }

    //Control para borrar una categoria del sistema
    public function eliminarCategoriaController()
    {
        //se verifica si se envio el id de la categoria a eliminar
        if(isset($_POST["del"]))
        {
            //de ser asi se guarda el id de la categoria
            $data = $_POST["del"];

            //y se manda al modelo el id y el nombre de la tabla de donde se va a eliminar
            $resp = CRUDCategoria::eliminarCategoriaModel($data,"Producto","Categoria");

            //en caso de haberse eliminado correctamente
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "eliminar";

                //nos redireccionara al listado de categorias
                echo "<script>
                        window.location.replace('index.php?section=categoria&action=listado');
                      </script>";
            }
        }
    }

    //Control para poder mostrar la informacion de una categoria a editar
    public function editarCategoriaController()
    {
        //se obtiene el id de la categoria a mostrar su informacion
        $data = $_POST["edit"];

        //se manda el id de la categoria y el nombre de la tabla donde esta almacenada
        $resp = CRUDCategoria::editarCategoriaModel($data,"Categoria");

        //se imprime la informacion de la categoria en inputs de un formulario
        echo "
                    <input type=hidden value=".$resp["id_categoria"]." name='id'>

                    <div class='form-group'>
                        <label>Nombres</label>
                        <input type='text' value='".$resp["nombre_categoria"]."' class='form-control' name='nombre' placeholder='Ingrese Nombre' required>
                    </div>
                    <div class='form-group'>
                        <label>Descripción</label>
                        <textarea name='descripcion' class='form-control' rows='3' placeholder='Ingrese Descripción'>".$resp["descripcion_categoria"]."</textarea>
                    </div>
             ";
    }
    
    //Control para modificar la informacion de una categoria
    public function modificarCategoriaController()
    {
        //se verifica si mediante el formulario se envio la informacion de la categoria
        if(isset($_POST["nombre"]))
        {
            //se guardan la informacion de la categoria
            $data = array("id" => $_POST["id"],
                          "nombre" => $_POST["nombre"], 
                          "descripcion" => $_POST["descripcion"]);
            
            //se manda la informacion de la categoria y la tabla en la que esta almacenada
            $resp = CRUDCategoria::modificarCategoriaModel($data,"Categoria");

            //en caso de que se haya editado correctamente 
            if($resp == "success")
            {
                //asignamos el tipo de mensaje a mostrar
                $_SESSION["mensaje"] = "editar";
                
                //nos redireccionara al listado de categorias
                echo "<script>
                        window.location.replace('index.php?section=categoria&action=listado');
                      </script>";
            }
        }
    }
    
    //Control para mostrar las categorias en un select
    public function optionCategoriaController()
    {
        //se le manda al modelo el nombre de la tabla a mostrar su informacion
        $data = CRUDCategoria::listadoCategoriaModel("Categoria");

        //mostramos el nombre de cada una de las categorias
        foreach($data as $rows => $row)
        {
            //se muestra cada una de las categorias en un option del select
            echo "<option value=".$row["id_categoria"].">".$row["nombre_categoria"]."</option>";
        }
    }
}
?>


