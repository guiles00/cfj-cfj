<?php
class Alumno {
	var $nombre;
	var $apellio;
	var $dni;
	var $legajo;
	var $_db;
	
	/*function __construct(){
		$this->$_db = Db::getInstance();
	}*/
	function insert($params){
		print_r($params);
	}

	function getAlumnoId($dni){
		//acoplo conexion a DB
		$db = Db::getInstance();
		$sqli = "select alumno_id from alumno where nro_documento='$dni'";

		//execute query
		$res = $db->exec_query($sqli);
		$res = mysqli_fetch_array($res);
		
		if(empty($res)){ 
			return false;
		}else{
			return $res['alumno_id'];
		}
	}
	function getAlumno($dni){
		//acoplo conexion a DB
		$db = Db::getInstance();
		$sqli = "select * from alumno where nro_documento='$dni'";

		//execute query
		$res = $db->exec_query($sqli);
		$res = mysqli_fetch_array($res);
		
		if(empty($res)){ 
			return false;
		}else{
			return $res;
		}
	}

	function getAlumnoById($alumno_id){
		//acoplo conexion a DB
		$db = Db::getInstance();
		$sqli = "select * from alumno where alumno_id=$alumno_id";
		//LEFT JOIN titulo on alumno.titulo_id = titulo.titulo_id";

		//execute query
		$res = $db->exec_query($sqli);
		$res = mysqli_fetch_array($res);
		
		if(empty($res)){ 
			return false;
		}else{
			return $res;
		}
	}
	function getDatosAlumnos($alumno_id,$params){
		//acoplo conexion a DB
		$db = Db::getInstance();
		$sqli = "select * from alumno 
		LEFT JOIN titulo on alumno.titulo_id = titulo.titulo_id
		where alumno_id=$alumno_id";

		//execute query
		$res = $db->exec_query($sqli);
		$res = mysqli_fetch_array($res);
		
		if(empty($res)){ 
			return false;
		}else{
			return $res;
		}
	}

	function save($params){
		$db = Db::getInstance();		
		$alumno_id = $this->getAlumnoId($params['nro_documento']);
		//print_r($alumno_id);
		//Si no esta inserto
		if(!$alumno_id){
			//echo "inserto alumno y devuelvo id";
			$sqli = "insert into alumno (nombre,apellido,nro_documento,legajo,domicilio,telefono_particular,email) 
			values ('$params[nombre]','$params[apellido]','$params[nro_documento]','$params[legajo]'
				,'$params[domicilio]','$params[tel]','$params[email]')";
			//execute query
			$res = $db->exec_query($sqli);
			//echo "last inserted id";
			return mysqli_insert_id($db->getConnection());

		}else{

			$sqli = "update alumno set nombre = '$params[nombre]', apellido = '$params[apellido]' 
			, nro_documento = '$params[nro_documento]', legajo = '$params[legajo]' 
			, domicilio = '$params[domicilio]', telefono_particular = '$params[tel]'
			where alumno_id = $alumno_id";
		
			$res = $db->exec_query($sqli);
		
		//echo "acutalizo y devuelvo id";
		return $alumno_id;	
		}
	}
}

?> 