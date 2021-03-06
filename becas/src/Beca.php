<?php
class Beca {
	var $nro_tramite;
	var $tipo_beca_id;
	/*
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
	}*/
	function getBeca($beca_id){
		//acoplo conexion a DB
		$db = Db::getInstance();
		$sqli = "select * from beca 
		LEFT JOIN titulo on beca.titulo_id = titulo.titulo_id
		where beca_id=$beca_id";

		//execute query
		$res = $db->exec_query($sqli);
		$res = mysqli_fetch_array($res);
		
		if(empty($res)){ 
			return false;
		}else{
			return $res;
		}
	}
	function getBecaByMd5($md5){
		//acoplo conexion a DB
		
		$db = Db::getInstance();
		//$sqli = "select * from beca where md5='".$md5."'";
		$sqli = "select *,prop.universidad as institucion_propuesta_label  from beca 
		LEFT JOIN titulo on beca.titulo_id = titulo.titulo_id
		LEFT JOIN cargo on beca.cargo_id = cargo.car_id
		LEFT JOIN dependencia on beca.dependencia_id = dependencia.dep_id
		LEFT JOIN universidad_sigla as prop on beca.institucion_propuesta = prop.universidad_id
		LEFT JOIN universidad_sigla on beca.universidad_id = universidad_sigla.universidad_id
		LEFT JOIN facultad on beca.facultad_id = facultad.facultad_id
		where md5='".$md5."'";
//LEFT JOIN actividad on beca.actividad_id = actividad.actividad_id
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
		
		//Siembre agrego beca
		$domicilio = addslashes($params['domicilio']);		
		$sqli = "insert into beca (tipo_beca_id,alumno_id,md5,cargo_id,fuero_id,dependencia_id,dependencia_otro
			,universidad_id,universidad_otro,f_ingreso_caba,facultad_id,facultad_otro,titulo_id,titulo_otro,telefono_laboral,telefono_particular
			,institucion_propuesta,fecha_inicio,fecha_fin,duracion
			,costo,monto,dictamen_por,sup_horaria,tipo_actividad_id,actividad_nombre,domicilio_constituido,observaciones,objetivo,vinculacion,renovacion_id) 
			values ('$params[tipo_beca_id]','$params[alumno_id]','$params[md5]','$params[cargo_id]','$params[b_fuero]'
			,'$params[dependencia_id]','$params[dependencia_otro]','$params[universidad_id]', '$params[universidad_otro]', '$params[f_ingreso_caba]'
			,'$params[facultad_id]','$params[facultad_otro]','$params[titulo_id]','$params[titulo_otro]','$params[telefono_laboral]','$params[tel]',
			'$params[inst_prop_id]','$params[f_inicio_b]','$params[f_final_b]'
			,'$params[duracion]','$params[costo]','$params[monto]'
			,'$params[dictamen]','$params[s_horaria]'
			,'$params[tipo_actividad_id]','$params[actividad_nombre]','$domicilio','$params[observaciones]'
			,'$params[objetivo]','$params[vinculacion]','$params[renovacion_id]')";
			//echo $sqli;
			//execute query
			$res = $db->exec_query($sqli);
			//echo "last inserted id";
			return mysqli_insert_id($db->getConnection());
	}
	function confirmar($beca_id){
		$db = Db::getInstance();		
		$sqli = "update beca set estado_id = 1 where beca_id =".$beca_id;
		$res = $db->exec_query($sqli);
		return $res;
	}
	function getBecasCompletas_Maqueta(){
		$db = Db::getInstance();		
		$sqli = "select * from beca b 
		JOIN alumno a on b.alumno_id = a.alumno_id 
		order by beca_id desc"; 
		$res = $db->exec_query($sqli);
		return $res;	
	}
}

?> 