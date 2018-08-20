<?php
require_once "conexion.php";

//clase para realizar operaciones a la base de datos para la seccion de inventario
class CRUDProducto
{
    //modelo para registrar un producto en la base de datos
    public static function agregarProductoModel($data,$tabla)
    {
        //se prepara la sentencia para realizar el insert
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (id_producto,id_tienda,stock) VALUES (:producto,:tienda,:stock)");

        //se realiza la asignacion de los datos a insertar
        $stmt -> bindParam(":tienda",$data["tienda"],PDO::PARAM_INT);
        $stmt -> bindParam(":producto",$data["producto"],PDO::PARAM_INT);
        $stmt -> bindParam(":stock",$data["stock"],PDO::PARAM_INT);


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

    //modelo para registrar un producto en la base de datos
    public static function agregarHistorialModel($data,$tabla)
    {
        //se prepara la sentencia para realizar el insert
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (id_tienda,id_producto,id_usuario,fecha,hora,nota,referencia,cantidad) VALUES (:tienda,:producto,:usuario,NOW(),NOW(),:nota,:referencia,:stock)");

        //verificamos si es una entrada o salida del stock para el mensaje de modificacion
        if($data["stock"] < 0)
        {
            //si es de salida sacamos el valor absoluto de stock y creamos el mensaje de salida
            $data["stock"] = abs($data["stock"]);
            $nota = $data["nombre"] . " eliminó " . $data["stock"] . " producto(s) del inventario";
        }
        else
        {
            //si es entrada simplemente creamos el mensaje de entrada
            $nota = $data["nombre"] . " agregó " . $data["stock"] . " producto(s) al inventario";
        }

        //se realiza la asignacion de los datos a insertar
        $stmt -> bindParam(":tienda",$data["tienda"],PDO::PARAM_INT);
        $stmt -> bindParam(":producto",$data["producto"],PDO::PARAM_INT);
        $stmt -> bindParam(":stock",$data["stock"],PDO::PARAM_INT);
        $stmt -> bindParam(":nota",$nota,PDO::PARAM_STR);
        $stmt -> bindParam(":usuario",$data["usuario"],PDO::PARAM_INT);
        $stmt -> bindParam(":referencia",$data["referencia"],PDO::PARAM_STR);


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

    //modelo para obtener la informacion de los producto registrados en el sistema
    public static function listadoProductoModel($tabla1,$tabla2)
    {
        //preparamos la consulta y la ejecutamos
        $stmt = Conexion::conectar() -> prepare("SELECT p.id_producto,p.nombre_producto FROM $tabla1 as p LEFT JOIN $tabla2 as pt on pt.id_producto = p.id_producto AND pt.id_tienda = :tienda WHERE pt.id_producto IS NULL");
        $stmt -> bindParam(":tienda",$_GET["shop"],PDO::PARAM_INT);
        $stmt -> execute();

        //retornamos la informacion de la tabla
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }


    //modelo para actualizar el stock de un producto
    public static function stockProductoModel ($tabla,$data)
    {
        //obtenemos el stock actual del producto
        $stmt = Conexion::conectar() -> prepare("SELECT stock FROM $tabla WHERE id_producto = :producto AND id_tienda = :tienda");
        $stmt -> bindParam(":producto",$data["producto"],PDO::PARAM_INT);
        $stmt -> bindParam(":tienda",$data["tienda"],PDO::PARAM_INT);
        $stmt -> execute();
        $stock = $stmt -> fetch();
        $stock = $stock["stock"];

        //preparamos el update para actualizar el inventario
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET stock = :stock WHERE id_producto = :producto AND id_tienda = :tienda");

        //se realiza la asignacion de los datos a insertar
        $stock = $stock + $data["stock"];
        $stmt -> bindParam(":producto",$data["producto"],PDO::PARAM_INT);
        $stmt -> bindParam(":tienda",$data["tienda"],PDO::PARAM_INT);
        $stmt -> bindParam(":stock",$stock,PDO::PARAM_INT);

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

    //modelo para obtener la informacion de los producto registrados en la tienda 
    public static function listadoProductoTiendaModel($tabla1,$tabla2,$tienda)
    {
        //preparamos la consulta
        $stmt = Conexion::conectar() -> prepare("SELECT p.nombre_producto, pt.stock, p.id_producto FROM $tabla1 as p JOIN $tabla2 as pt on p.id_producto = pt.id_producto WHERE pt.id_tienda = :tienda");

        //asignamos las variables para filtrar los resultados
        $stmt -> bindParam(":tienda",$tienda,PDO::PARAM_INT);

        //ejecutamos la consulta
        $stmt -> execute();

        //retornamos la informacion de la tabla
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para obtener el historial de un producto 
    public static function listadoHistorialModel($tabla,$data)
    {
        //preparamos la consulta
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE id_producto = :producto AND id_tienda = :tienda");

        //se asigna el id del producto a mostrar su historial
        $stmt -> bindParam(":producto",$data["producto"],PDO::PARAM_INT);
        $stmt -> bindParam(":tienda",$data["tienda"],PDO::PARAM_INT);

        //se ejecuta la consulta
        $stmt -> execute();

        //retornamos la informacion del historial
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para obtener la informacion de un producto 
    public static function infoProductoModel($tabla1,$tabla2,$data)
    {
        //preparamos la consulta
        $stmt = Conexion::conectar() -> prepare("SELECT p.img, p.codigo_producto, p.nombre_producto, p.precio, pt.stock FROM $tabla1 as p JOIN $tabla2 as pt on pt.id_producto = p.id_producto WHERE pt.id_producto = :producto AND pt.id_tienda = :tienda");

        //se asigna el id del producto a mostrar su info
        $stmt -> bindParam(":producto",$data["producto"],PDO::PARAM_INT);
        $stmt -> bindParam(":tienda",$data["tienda"],PDO::PARAM_INT);

        //se ejecuta la consulta
        $stmt -> execute();

        //retornamos la informacion del historial
        return $stmt -> fetch();

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para borrar el historial de un producto de la base de datos
    public static function eliminarProductoModel($data,$tabla1,$tabla2)
    {
        //preparamos la sentencia para realizar el delete
        $stmt1 = Conexion::conectar() -> prepare("DELETE FROM $tabla1 WHERE id_producto = :producto AND id_tienda = :tienda");

        //se realiza la asignacion de los datos a eliminar
        $stmt1 -> bindParam(":producto",$data["producto"],PDO::PARAM_INT);
        $stmt1 -> bindParam(":tienda",$data["tienda"],PDO::PARAM_INT);

        //preparamos la sentencia para realizar el delete
        $stmt2 = Conexion::conectar() -> prepare("DELETE FROM $tabla2 WHERE id_producto = :producto AND id_tienda = :tienda");

        //se realiza la asignacion de los datos a eliminar
        $stmt2 -> bindParam(":producto",$data["producto"],PDO::PARAM_INT);
        $stmt2 -> bindParam(":tienda",$data["tienda"],PDO::PARAM_INT);

        //se ejecuta la sentencia
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


    /*/modelo para obtener la informacion de un producto
    public static function editarInventarioModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = :id");

        //se realiza la asignacion de los datos para la consulta
        $stmt->bindParam(":id",$data, PDO::PARAM_INT);	

        //se ejecuta la sentencia
        $stmt->execute();

        //retornamos la fila obtenida con el select
        return $stmt->fetch();

        //cerramos la conexion
        $stmt->close();
    }

    //modelo para modificar la informacion de un producto registrada en la base de datos
    public static function modificarInventarioModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el update
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_producto = :nombre, id_categoria = :categoria, precio = :precio WHERE id_producto = :id");

        //se realiza la asignacion de los datos para el update
        $stmt -> bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":categoria", $data["categoria"], PDO::PARAM_STR);
        $stmt -> bindParam(":precio", $data["precio"], PDO::PARAM_STR);

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
    }*/
}
?>