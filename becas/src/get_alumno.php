<?php
include_once('Db.php');
include_once('Alumno.php');

$params = $_GET;
$alumno = new Alumno();

//Agrego alumno, devuelve id
//@params : Formatear solo campos de alumno
$r = $alumno->getAlumno($params['dni']);

echo json_encode($r);
?>