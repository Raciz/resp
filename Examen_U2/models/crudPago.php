<?php
require_once "conexion.php";

//clase para realizar operaciones a la base de datos para la seccion de alumnos
class CRUDPago
{
    //modelo para registrar un alumno en la base de datos
    public static function agregarPagoModel($data,$tabla)
    {
        //se prepara la sentencia para realizar el insert
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (alumna,mama,fecha_pago,fecha_envio,img_comprobante,folio) VALUES (:alumna,:mama,:fecha_pago,NOW(),:img,:folio)");


        //cambiamos el formato de la fecha a yyyy/mm/dd
        $fecha = date("Y/m/d", strtotime($data["pago"]));

        //se realiza la asignacion de los datos a insertar
        $stmt -> bindParam(":alumna",$data["alumno"],PDO::PARAM_INT);
        $stmt -> bindParam(":mama",$data["mama"],PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_pago",$fecha,PDO::PARAM_STR);
        $stmt -> bindParam(":img",$data["img"],PDO::PARAM_STR);
        $stmt -> bindParam(":folio",$data["folio"],PDO::PARAM_INT);
        
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

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para obtener la informacion de los Pagos registrados
    public static function listadoPagoModel($tabla1,$tabla2)
    {
        //preparamos la consulta
        $stmt = Conexion::conectar() -> prepare("SELECT p.id_pago,a.nombre,a.apellido,p.fecha_envio,p.fecha_pago,p.img_comprobante,p.folio,p.mama FROM $tabla1 as p JOIN $tabla2 as a on p.alumna = a.id_alumna ORDER BY p.fecha_envio ASC");

        //se ejecuta la consulta
        $stmt -> execute();

        //retornamos la informacion de la tabla
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para borrar un pago de la base de datos
    public static function eliminarPagoModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el delete
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id_pago = :id");

        //se realiza la asignacion de los datos a eliminar
        $stmt -> bindParam(":id",$data,PDO::PARAM_INT);

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

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para obtener la informacion de un pago
    public static function editarPagoModel($data,$tabla1,$tabla2)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar()->prepare("SELECT p.id_pago, p.fecha_envio, p.folio, p.fecha_pago, p.mama, a.nombre, a.apellido FROM $tabla1 as p JOIN $tabla2 as a on a.id_alumna = p.alumna WHERE p.id_pago = :id");

        //se realiza la asignacion de los datos para la consulta
        $stmt->bindParam(":id",$data, PDO::PARAM_INT);	

        //se ejecuta la sentencia
        $stmt->execute();

        //retornamos la fila obtenida con el select
        return $stmt->fetch();

        //cerramos la conexion
        $stmt->close();
    }

    //modelo para modificar la informacion de un pago registrado en la base de datos
    public static function modificarPagoModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el update
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_envio = :envio, mama = :mama, fecha_pago = :fecha, folio = :folio WHERE id_pago = :id");

        //cambiamos el formato de la fecha a yyyy/mm/dd
        $fecha = date("Y/m/d", strtotime($data["pago"]));

        //se realiza la asignacion de los datos para el update
        $stmt -> bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":mama", $data["mama"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha", $fecha, PDO::PARAM_STR);
        $stmt -> bindParam(":folio", $data["folio"], PDO::PARAM_INT);
        $stmt -> bindParam(":envio", $data["envio"], PDO::PARAM_STR);

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

        //cerramos la conexion
        $stmt->close();
    }
}
?>