<?php
    include_once('Db.php');
    
    $db = Db::getInstance();
    $sqli = "select * from facultad";

    //execute query
    $res = $db->exec_query($sqli);
    //$res = mysqli_fetch_array($res);

//echo "<pre>";
$array_facultad = array();
while($array = mysqli_fetch_array($res)) {

$facultad['value']  = $array['facultad_id'];
$facultad['label']  = strtoupper($array['facultad']);
$array_facultad[] = $facultad;
};

//print_r($array_facultad);
echo json_encode($array_facultad)
?>