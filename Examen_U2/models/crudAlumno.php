<?php
require_once "conexion.php";

//clase para realizar operaciones a la base de datos para la seccion de alumnos
class CRUDAlumno
{
    //modelo para registrar un alumno en la base de datos
    public static function agregarAlumnoModel($data,$tabla)
    {
        //se prepara la sentencia para realizar el insert
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (nombre,apellido,fechaNac,grupo) VALUES (:nombre,:apellido,:fecha,:grupo)");


        //cambiamos el formato de la fecha a yyyy/mm/dd
        $fecha = date("Y/m/d", strtotime($data["fecha"]));

        //se realiza la asignacion de los datos a insertar
        $stmt -> bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
        $stmt -> bindParam(":apellido",$data["apellido"],PDO::PARAM_STR);
        $stmt -> bindParam(":fecha",$fecha,PDO::PARAM_STR);
        $stmt -> bindParam(":grupo",$data["grupo"],PDO::PARAM_STR);

        //se ejecuta la sentencia
        if($stmt -> execute())
        {
            //si se ejecuto correctamente nos retorna success
            return "success";
        }
        else
        {
            //en caso de no ser asi nos retorna fail
            return "fail";
        }

        print_r($data);

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para obtener la informacion de los alumnos registrados
    public static function listadoAlumnoModel($tabla1,$tabla2)
    {
        //preparamos la consulta
        $stmt = Conexion::conectar() -> prepare("SELECT a.id_alumna, a.nombre, a.apellido, a.fechaNac, g.nombre as grupo FROM $tabla1 as a JOIN $tabla2 as g on a.grupo = g.id_grupo");

        //se ejecuta la consulta
        $stmt -> execute();

        //retornamos la informacion de la tabla
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para borrar un alumno de la base de datos
    public static function eliminarAlumnoModel($data,$tabla1,$tabla2)
    {
        //preparamos la sentencia para realizar el Delete
        $stmt1 = Conexion::conectar() -> prepare("DELETE FROM $tabla1 WHERE alumna = :id");

        //se realiza la asignacion de los datos a eliminar
        $stmt1 -> bindParam(":id",$data,PDO::PARAM_INT);

        //preparamos la sentencia para realizar el delete
        $stmt2 = Conexion::conectar() -> prepare("DELETE FROM $tabla2 WHERE id_alumna = :id");

        //se realiza la asignacion de los datos a eliminar
        $stmt2 -> bindParam(":id",$data,PDO::PARAM_INT);

        //se ejecuta las sentencias
        if($stmt1 -> execute() && $stmt2 -> execute())
        {
            //si se ejecuto correctamente nos retorna success
            return "success";
        }
        else
        {
            //en caso de no ser asi nos retorna fail
            return "fail";
        }

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para obtener la informacion de un alumno
    public static function editarAlumnoModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_alumna = :id");

        //se realiza la asignacion de los datos para la consulta
        $stmt->bindParam(":id",$data, PDO::PARAM_INT);	

        //se ejecuta la sentencia
        $stmt->execute();

        //retornamos la fila obtenida con el select
        return $stmt->fetch();

        //cerramos la conexion
        $stmt->close();
    }

    //modelo para modificar la informacion de un alumno registrada en la base de datos
    public static function modificarAlumnoModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el update
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, fechaNac = :fecha, grupo = :grupo WHERE id_alumna = :id");

        //cambiamos el formato de la fecha a yyyy/mm/dd
        $fecha = date("Y/m/d", strtotime($data["fecha"]));

        //se realiza la asignacion de los datos para el update
        $stmt -> bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellido", $data["apellido"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha", $fecha, PDO::PARAM_STR);
        $stmt -> bindParam(":grupo", $data["grupo"], PDO::PARAM_STR);

        //se ejecuta la sentencia
        if($stmt -> execute())
        {
            //si se ejecuto correctamente nos retorna success
            return "success";
        }
        else
        {
            print_r($stmt -> errorInfo());
            //en caso de no ser asi nos retorna fail
            return "fail";
        }

        //cerramos la conexion
        $stmt->close();
    }
}
?>