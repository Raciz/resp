<?php
require_once "conexion.php";

//clase para realizar operaciones a la base de datos
class CRUD
{
    //modelo para obtener la informacion para el login
    public static function loginModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE username = :id");	

        //se realiza la asignacion de los datos para la consulta
        $stmt->bindParam(":id", $data["usuario"], PDO::PARAM_STR);

        //se ejecuta la sentencia
        $stmt->execute();

        //retornamos la fila obtenida con el select
        return $stmt->fetch();

        //cerramos la conexion
        $stmt->close();
    }

    //modelo para obtener la informacion del sistema
    public static function infoSistemaModel($tabla1,$tabla2,$tabla3)
    {
        $info = array();

        //preparamos la consulta para obtener la cantidad de grupos registrados
        $stmt = Conexion::conectar() -> prepare("SELECT COUNT(*) as grupos FROM $tabla1");
        
        //ejecutamos la consulta
        $stmt -> execute();
        
        //obtenemos el valor devuelto por la consulta
        $res = $stmt -> fetch();
        
        //y la almacenamos en info
        $info["grupo"] = $res["grupos"];

        
        //preparamos la consulta para obtener a los alumnos registrados
        $stmt = Conexion::conectar() -> prepare("SELECT COUNT(*) as alumnos FROM $tabla2");
        
        //ejecutamos la consulta
        $stmt -> execute();
        
        //obtenemos el valor devuelto por la consulta
        $res = $stmt -> fetch();
        
        //y la almacenamos en info
        $info["alumno"] = $res["alumnos"];

        //preparamos la consulta para obtener los pagos registrados
        $stmt = Conexion::conectar() -> prepare("SELECT COUNT(*) as pagos FROM $tabla3");
        
        //ejecutamos la consulta
        $stmt -> execute();
        
        //obtenemos el valor devuelto por la consulta
        $res = $stmt -> fetch();
        
        //y la almacenamos en info
        $info["pago"] = $res["pagos"];

        //retornamos info
        return $info;

        //cerramos la conexion
        $stmt -> close();
    }
}