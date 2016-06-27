<?php
class PagoBecario {
	var $nombre;
	var $apellio;
	var $dni;
	var $legajo;
	var $_db;
	
	
	function getPagos(){
		//acoplo conexion a DB
		$db = Db::getInstance();
		
				$sqli = "select * from usuario_sitio inner join beca on usuario_sitio.usi_id = beca.alumno_id
		 inner join pago_cheque on pago_cheque.beca_id = beca.beca_id 
		 order by pago_cheque.pago_cheque_id desc"; //ESTO ES VIEJO


		 $sqli = "SELECT pago_cheque.* , usuario_sitio.usi_nombre FROM pago_cheque INNER JOIN beca ON pago_cheque.beca_id = beca.beca_id 
		 INNER JOIN usuario_sitio ON beca.alumno_id = usuario_sitio.usi_id
		 WHERE pago_cheque.entregado_por_id = 0
		 ORDER BY usuario_sitio.usi_nombre ASC ";
            					
		


		//execute query
		$res = $db->exec_query($sqli);
		
	
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

}

?> 