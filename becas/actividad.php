<?php
    include_once('Db.php');
    
    $db = Db::getInstance();
    $sqli = "select * from actividad";

    //execute query
    $res = $db->exec_query($sqli);
    //$res = mysqli_fetch_array($res);

//echo "<pre>";
$array_actividad = array();
while($array = mysqli_fetch_array($res)) {

$actividad['value']  = $array['actividad_id'];
$actividad['label']  = strtoupper($array['actividad']);
$array_actividad[] = $actividad;
};

//print_r($array_actividad);
echo json_encode($array_actividad)
?>