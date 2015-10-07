<?php
    include_once('Db.php');
    
    $db = Db::getInstance();
    $sqli = "select * from dependencia_fueros";

    //execute query
    $res = $db->exec_query($sqli);
    //$res = mysqli_fetch_array($res);

//echo "<pre>";
$array_dependencia = array();
while($array = mysqli_fetch_array($res)) {

$dependencia['value']  = $array['dependencia_id'];
$dependencia['label']  = strtoupper($array['dependencia']);
$array_dependencia[] = $dependencia;
};

//print_r($array_dependencia);
echo json_encode($array_dependencia)
?>