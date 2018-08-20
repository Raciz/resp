<?php
require_once "conexion.php";

//clase para realizar operaciones a la base de datos
class CRUD
{
    //modelo para registrar carrera en la base de datos
    public static function registroCarreraModel($data,$tabla)
    {
        //se prepara la sentencia para realizar el insert
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (nombre) VALUES (:nombre)");

        //se realiza la asignacion de los datos a insertar
        $stmt -> bindParam(":nombre",$data,PDO::PARAM_STR);

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

    //modelo para obtener la informacion de las carreras registradas
    public static function listaCarreraModel($tabla)
    {
        //preparamos la consulta y la ejecutamos
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
        $stmt -> execute();

        //retornamos la informacion de la tabla
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }

    //modelo para borrar una carrera de la base de datos
    public static function deleteCarreraModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el delete
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");

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

    //modelo para modificar la informacion de una carrera
    public static function editCarreraModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
        
        //se realiza la asignacion de los datos para la consulta
        $stmt->bindParam(":id", $data, PDO::PARAM_INT);	
        
        //se ejecuta la sentencia
        $stmt->execute();
        
        //retornamos la fila obtenida con el select
        return $stmt->fetch();

        //cerramos la conexion
        $stmt->close();
    }

    //modelo para modificar la informacion de una carrera registrada en la base de datos
    public static function updateCarreraModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el update
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id = :id");

        //se realiza la asignacion de los datos para el update
        $stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":id", $data["id"], PDO::PARAM_INT);

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

    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //modelo para registrar un maestro en la base de datos 
    public static function registroMaestroModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (num_empleado,carrera,nombre,email,password,superUser) VALUES (:num_empleado,:carrera,:nombre,:email,:password,:superUser)");

        //se realiza la asignacion de los datos para la consulta
        $stmt -> bindParam(":num_empleado",$data["num_empleado"],PDO::PARAM_STR);
        $stmt -> bindParam(":carrera",$data["carrera"],PDO::PARAM_INT);
        $stmt -> bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
        $stmt -> bindParam(":email",$data["email"],PDO::PARAM_STR);
        $stmt -> bindParam(":password",$data["password"],PDO::PARAM_STR);
        $stmt -> bindParam(":superUser",$data["super"],PDO::PARAM_INT);

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

    //modelo para obtener la informacion de los maestro registrados
    public static function listaMaestroModel($tabla1,$tabla2)
    {
        //preparamos la consulta y la ejecutamos
        $stmt = Conexion::conectar() -> prepare("SELECT m.num_empleado,c.nombre as carrera,m.nombre,m.email,m.superUser FROM $tabla1 as m JOIN $tabla2 as c on m.carrera = c.id");
        $stmt -> execute();

        //retornamos la informacion de la tabla
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }
    
    //modelo para borrar un maestro de la base de datos
    public static function deleteMaestroModel($data,$tabla)
    {
        //se prepara la consulta para realizar el delete
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE num_empleado = :id");

        //se realiza la asignacion de los datos para el delete
        $stmt -> bindParam(":id",$data,PDO::PARAM_STR);

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

    //modelo para modificar la informacion de una carrera
    public static function editMaestroModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE num_empleado = :id");
		
        //se realiza la asignacion de los datos para la consulta
        $stmt->bindParam(":id", $data, PDO::PARAM_STR);	
		
        //se ejecuta la sentencia
        $stmt->execute();
		
        //retornamos la fila obtenida con el select
        return $stmt->fetch();

        //cerramos la conexion
		$stmt->close();
    }

    //modelo para modificar la informacion de un maestro registrado en la base de datos
    public static function updateMaestroModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el update
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET carrera = :carrera, nombre = :nombre, email = :email, password = :password, superUser = :super WHERE num_empleado = :num_empleado");
        
        //se realiza la asignacion de los datos para el update
		$stmt -> bindParam(":num_empleado", $data["num_empleado"], PDO::PARAM_STR);
		$stmt -> bindParam(":carrera", $data["carrera"], PDO::PARAM_INT);
		$stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":super", $data["super"], PDO::PARAM_INT);

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
    
    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    //modelo para registrar un alumno en la base de datos
    public static function registroAlumnoModel($data,$tabla)
    {
        //se prepara la sentencia para realizar el insert
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (matricula,nombre,carrera,tutor) VALUES (:matricula,:nombre,:carrera,:tutor)");

        //se realiza la asignacion de los datos a insertar
        $stmt -> bindParam(":matricula",$data["matricula"],PDO::PARAM_INT);
        $stmt -> bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
        $stmt -> bindParam(":carrera",$data["carrera"],PDO::PARAM_INT);
        $stmt -> bindParam(":tutor",$data["tutor"],PDO::PARAM_STR);

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

    //modelo para obtener la informacion de los alumnos registrados
    public static function listaAlumnoModel($tabla1,$tabla2,$tabla3)
    {
        //preparamos la consulta y la ejecutamos
        $stmt = Conexion::conectar() -> prepare("SELECT a.matricula,a.nombre,c.nombre as carrera, m.nombre as tutor FROM $tabla1 as a JOIN $tabla2 as c on a.carrera = c.id JOIN $tabla3 as m on a.tutor = m.num_empleado");
        $stmt -> execute();
        
        //retornamos la informacion de la tabla
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }
   
    
    //modelo para borar un alumno de la base de datos
    public static function deleteAlumnoModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el delete
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE matricula = :id");

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

    //modelo para modificar la informacion de un alumno
    public static function editAlumnoModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE matricula = :id");
        
        //se realiza la asignacion de los datos para la consulta
		$stmt->bindParam(":id", $data, PDO::PARAM_INT);	
        
        //se ejecuta la sentencia
		$stmt->execute();

        //retornamos la fila obtenida con el select
		return $stmt->fetch();

        //cerramos la conexion
		$stmt->close();
    }


    //modelo para modificar la informacion de un alumno registrado en la base de datos
    public static function updateAlumnoModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el update
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, carrera = :carrera, tutor = :tutor WHERE matricula = :matricula");
        
        //se realiza la asignacion de los datos para el update
		$stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":carrera", $data["carrera"], PDO::PARAM_INT);
		$stmt -> bindParam(":tutor", $data["tutor"], PDO::PARAM_STR);
		$stmt -> bindParam(":matricula", $data["matricula"], PDO::PARAM_STR);

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
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    //modelo para obtener la informacion para el login
    public static function loginModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar()->prepare("SELECT num_empleado, password, superUser FROM $tabla WHERE num_empleado = :id");	
        
        //se realiza la asignacion de los datos para la consulta
		$stmt->bindParam(":id", $data["num_empleado"], PDO::PARAM_STR);
        
        //se ejecuta la sentencia
		$stmt->execute();

        //retornamos la fila obtenida con el select
		return $stmt->fetch();

        //cerramos la conexion
		$stmt->close();
    }
    
    
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //modelo para obtener la informacion de los tutorados de un maestro
    public static function tutoradosModel($tabla,$tutor)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE tutor = :tutor");
        
        //se realiza la asignacion de los datos para la consulta
        $stmt -> bindParam(":tutor",$tutor,PDO::PARAM_STR);
        
        //se ejecuta la sentencia
        $stmt -> execute();
        
        //retornamos las filas obtenida con el select
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }
    
    //modelo para registrar una tutoria en la base de datos
    public static function registroTutoriaModel($data,$tabla)
    {
        //se prepara la sentencia para realizar el insert
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (alumno,tutor,fecha,hora,tipo,tutoria) VALUES (:alumno,:tutor,NOW(),NOW(),:tipo,:tutoria)");

        //se realiza la asignacion de los datos a insertar
        $stmt -> bindParam(":alumno",$data["alumno"],PDO::PARAM_INT);
        $stmt -> bindParam(":tutor",$data["tutor"],PDO::PARAM_STR);
        $stmt -> bindParam(":tipo",$data["tipo"],PDO::PARAM_STR);
        $stmt -> bindParam(":tutoria",$data["tutoria"],PDO::PARAM_STR);
        
        //se ejecuta la sentencia
        if($stmt -> execute())
        {
            //si se ejecuto correctamente nos retorna success
            return "success";
        }
        else
        {
            print_r($stmt->errorInfo());
            //en caso de no ser asi nos retorna fail
            return "fail";
        }

        //cerramos la conexion
        $stmt -> close();
    }
    
    //modelo para obtener la informacion de las tutorias registradas para un maestro
    public static function listaTutoriaMaestroModel($tabla1,$tabla2,$tabla3,$tutor)
    {
        //preparamos la consulta y la ejecutamos
        $stmt = Conexion::conectar() -> prepare("SELECT t.id, a.nombre as alumno,m.nombre as tutor, t.fecha, t.hora, t.tipo, t.tutoria FROM $tabla1 as t JOIN $tabla2 as m on t.tutor = m.num_empleado JOIN $tabla3 as a on a.matricula = t.alumno WHERE m.num_empleado = :tutor");
        $stmt -> bindParam(":tutor",$tutor,PDO::PARAM_STR);
        $stmt -> execute();
        
        //retornamos la informacion de la tabla
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }
    
    //modelo para borrar una tutoria de la base de datos
    public static function deleteTutoriaModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el delete
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");

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
    
    //modelo para modificar la informacion de una tutoria
    public static function editTutoriaModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el select
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
        
        //se realiza la asignacion de los datos para la consulta
		$stmt->bindParam(":id", $data, PDO::PARAM_INT);	
        
        //se ejecuta la sentencia
		$stmt->execute();

        //retornamos la fila obtenida con el select
		return $stmt->fetch();

        //cerramos la conexion
		$stmt->close();
    }
    
    //modelo para modificar la informacion de una tutoria registrada en la base de datos
    public static function updateTutoriaModel($data,$tabla)
    {
        //preparamos la sentencia para realizar el update
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET alumno = :alumno, tipo = :tipo, tutoria = :tutoria WHERE id = :id");
        
        //se realiza la asignacion de los datos para el update
		$stmt -> bindParam(":alumno", $data["alumno"], PDO::PARAM_INT);
		$stmt -> bindParam(":tipo", $data["tipo"], PDO::PARAM_STR);
		$stmt -> bindParam(":tutoria", $data["tutoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $data["id"], PDO::PARAM_INT);

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
    
    //modelo para obtener la informacion de todas las tutorias registradas en la base de datos
    public static function reporteTutoriaMaestroModel($tabla1,$tabla2,$tabla3)
    {
        //preparamos la consulta y la ejecutamos
        $stmt = Conexion::conectar() -> prepare("SELECT t.id, a.nombre as alumno,m.nombre as tutor, t.fecha, t.hora, t.tipo, t.tutoria FROM $tabla1 as t JOIN $tabla2 as m on t.tutor = m.num_empleado JOIN $tabla3 as a on a.matricula = t.alumno");
        $stmt -> execute();
        
        //retornamos la informacion de la tabla
        return $stmt -> fetchAll();

        //cerramos la conexion
        $stmt -> close();
    }
}
?>