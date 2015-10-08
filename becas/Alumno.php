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
		//$sqli = "select usi_id from usuario_sitio where usi_dni='$dni'";
		$sqli = "select usi_id from usuario_sitio where usi_dni = '$dni'";
		
		//execute query
		$res = $db->exec_query($sqli);
		$res = mysqli_fetch_array($res);
		
		if(empty($res)){ 
			return false;
		}else{
			return $res['usi_id'];
		}
	}
	function getAlumno($dni){
		//acoplo conexion a DB
		$db = Db::getInstance();
		$sqli = "select * from usuario_sitio where usi_dni='$dni'";

		//execute query
		$res = $db->exec_query($sqli);
		$res = mysqli_fetch_array($res);
		
		if(empty($res)){ 
			return false;
		}else{
			return $res;
		}
	}

	function getAlumnoById($usi_id){
		//acoplo conexion a DB
		$db = Db::getInstance();
		$sqli = "select * from usuario_sitio where usi_id=$usi_id";
		//LEFT JOIN titulo on usuario_sitio.titulo_id = titulo.titulo_id";

		//execute query
		$res = $db->exec_query($sqli);
		$res = mysqli_fetch_array($res);
		
		if(empty($res)){ 
			return false;
		}else{
			return $res;
		}
	}
	function getDatosAlumnos($usi_id,$params){
		//acoplo conexion a DB
		$db = Db::getInstance();
		$sqli = "select * from usuario_sitio 
		LEFT JOIN titulo on usuario_sitio.titulo_id = titulo.titulo_id
		where usi_id=$usi_id";

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
		$usi_id = $this->getAlumnoId($params['usi_dni']);

		//Si no esta inserto
		if(!$usi_id){
			
			$sqli = "insert into usuario_sitio (usi_nombre,usi_dni,usi_legajo,usi_email,usi_genero,usi_tel_particular)
			values ('$params[nombre]','$params[usi_dni]','$params[legajo]'
				,'$params[email]','$params[b_genero]','$params[tel]')";
//,domicilio,telefono_particular,email) 
//,'$params[domicilio]','$params[tel]'
			//execute query
			$res = $db->exec_query($sqli);
			//echo "last inserted id";
			return mysqli_insert_id($db->getConnection());

		}else{

			$sqli = "update usuario_sitio set usi_nombre = '$params[nombre]', 
			 usi_dni = '$params[usi_dni]', usi_legajo = '$params[legajo]', 
			 usi_tel_particular = '$params[tel]',usi_genero = '$params[b_genero]',usi_email = '$params[email]'
			where usi_id = $usi_id";
		//, domicilio = '$params[domicilio]',
			$res = $db->exec_query($sqli);
		
		//echo "acutalizo y devuelvo id";
		return $usi_id;	
		}
	}
}

?> 