<?php
require_once "conexion.php";

class CRUDTienda
{
    //modelo para registrar una tienda en la base de datos
    public static function agregarTiendaModel($data,$tabla)
    {
        //se prepara la sentencia para realizar el insert
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (nombre,direccion,estado) VALUES (:nombre,:direccion,:estado)");

        //se realiza la asignacion de los datos a insertar
        $stmt -> bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
        $stmt -> bindParam(":direccion",$data["direccion"],PDO::PARAM_STR);
        $stmt -> bindParam(":estado",$data["estado"],PDO::PARAM_STR);

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
        $stmt -> close();
    }

    //modelo para obtener la informacion de los usuarios registradas
    public static function listadoTiendaModel($tabla)
    {
        //preparamos la consulta y la ejecutamos
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
        $stmt -> execute();

        //retornamos la informacion de la tabla
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para borrar una tienda de la base de datos
    public static function eliminarTiendaModel($data,$tabla1,$tabla2,$tabla3)
    {
        //preparamos la sentencia para realizar el delete
        $stmt1 = Conexion::conectar() -> prepare("DELETE FROM $tabla1 WHERE id_tienda = :id");

        //se realiza la asignacion de los datos a eliminar
        $stmt1 -> bindParam(":id",$data,PDO::PARAM_INT);

        //preparamos la sentencia para realizar el delete
        $stmt2 = Conexion::conectar() -> prepare("DELETE FROM $tabla2 WHERE id_tienda = :id");

        //se realiza la asignacion de los datos a eliminar
        $stmt2 -> bindParam(":id",$data,PDO::PARAM_INT);

        //preparamos la sentencia para realizar el delete
        $stmt3 = Conexion::conectar() -> prepare("DELETE FROM $tabla3 WHERE id_tienda = :id");

        //se realiza la asignacion de los datos a eliminar
        $stmt3 -> bindParam(":id",$data,PDO::PARAM_INT);



        //se ejecuta la sentencia
        if($stmt1 -> execute() && $stmt2 -> execute() && $stmt3 -> execute())
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

    //modelo para obtener la informacion de un tienda
    public static function editarTiendaModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_tienda = :id");

        //se realiza la asignacion de los datos para la consulta
        $stmt->bindParam(":id",$data, PDO::PARAM_INT);	

        //se ejecuta la sentencia
        $stmt->execute();

        //retornamos la fila obtenida con el select
        return $stmt->fetch();

        //cerramos la conexion
        $stmt->close();
    }

    //modelo para modificar la informacion de un usuario registrada en la base de datos
    public static function modificarTiendaModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el update
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, direccion = :direccion, estado = :estado WHERE id_tienda = :id");

        //se realiza la asignacion de los datos para el update
        $stmt -> bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":direccion", $data["direccion"], PDO::PARAM_STR);
        $stmt -> bindParam(":estado", $data["estado"], PDO::PARAM_STR);

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

    //modelo para obtener la informacion de la tienda
    public static function infoTiendaModel($data,$tabla1,$tabla2,$tabla3,$tabla4)
    {
        $info = array();

        //preparamos la consulta para obtener las ventas realizadas en la tienda
        $stmt = Conexion::conectar() -> prepare("SELECT COUNT(*) as venta FROM $tabla1 WHERE id_tienda = :tienda");
        //asignamos los datos nesesarios para la consulta
        $stmt -> bindParam(":tienda",$data,PDO::PARAM_INT);
        //ejecutamos la consulta
        $stmt -> execute();
        //obtenemos el valor devuelto por la consulta
        $res = $stmt -> fetch();
        //y la almacenamos en info
        $info["venta"] = $res["venta"];

        //preparamos la consulta para obtener a los usuarios registrados en la tienda
        $stmt = Conexion::conectar() -> prepare("SELECT COUNT(*) as user FROM $tabla2 WHERE id_tienda = :tienda");
        //asignamos los datos nesesarios para la consulta
        $stmt -> bindParam(":tienda",$data,PDO::PARAM_INT);
        //ejecutamos la consulta
        $stmt -> execute();
        //obtenemos el valor devuelto por la consulta
        $res = $stmt -> fetch();
        //y la almacenamos en info
        $info["user"] = $res["user"];

        //preparamos la consulta para obtener los productos registrados en la tienda
        $stmt = Conexion::conectar() -> prepare("SELECT COUNT(*) as producto FROM $tabla3 WHERE id_tienda = :tienda");
        //asignamos los datos nesesarios para la consulta
        $stmt -> bindParam(":tienda",$data,PDO::PARAM_INT);
        //ejecutamos la consulta
        $stmt -> execute();
        //obtenemos el valor devuelto por la consulta
        $res = $stmt -> fetch();
        //y la almacenamos en info
        $info["producto"] = $res["producto"];

        //preparamos la consulta para saber si la tienda esta activa o desactivada
        $stmt = Conexion::conectar() -> prepare("SELECT estado FROM $tabla4 WHERE id_tienda = :tienda");
        //asignamos los datos nesesarios para la consulta
        $stmt -> bindParam(":tienda",$data,PDO::PARAM_INT);
        //ejecutamos la consulta
        $stmt -> execute();
        //obtenemos el valor devuelto por la consulta
        $res = $stmt -> fetch();
        //y la almacenamos en info
        $info["estado"] = $res["estado"];

        //retornamos info
        return $info;

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para obtener los productos con bajo stock para el super admin
    public static function stockBajoRootModel($tabla1,$tabla2,$tabla3)
    {
        //preparamos la consulta para obtener los productos con bajo stock
        $stmt = Conexion::conectar() -> prepare("SELECT t.id_tienda, p.id_producto, t.nombre as nombre_tienda, p.nombre_producto FROM $tabla1 as p 
                                                 JOIN $tabla2 as pt on pt.id_producto = p.id_producto
                                                 JOIN $tabla3 as t on t.id_tienda = pt.id_tienda
                                                 WHERE pt.stock <= 10");

        //ejecutamos la consulta
        $stmt -> execute();

        //obtenemos el valor devuelto por la consulta
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }

    public static function stockBajoModel($tienda,$tabla1,$tabla2)
    {
        //preparamos la consulta para obtener los productos con bajo stock
        $stmt = Conexion::conectar() -> prepare("SELECT pt.id_tienda, p.id_producto, p.nombre_producto FROM $tabla1 as p 
                                                 JOIN $tabla2 as pt on pt.id_producto = p.id_producto
                                                 WHERE pt.stock <= 10 AND pt.id_tienda = :tienda");

        $stmt -> bindParam(":tienda",$tienda,PDO::PARAM_INT);

        //ejecutamos la consulta
        $stmt -> execute();

        //obtenemos el valor devuelto por la consulta
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }
}
?>