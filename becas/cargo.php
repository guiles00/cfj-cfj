<?php
  
    include_once('Db.php');
    
    $db = Db::getInstance();
    $sqli = "select * from cargo";

    //execute query
    $res = $db->exec_query($sqli);
    //$res = mysqli_fetch_array($res);

//echo "<pre>";
$array_cargo = array();
while($array = mysqli_fetch_array($res)) {
//print_r($array);
$cargo['value']  = $array['cargo_id'];
$cargo['label']  = strtoupper($array['cargo']);
$array_cargo[] = $cargo;
};
//print_r($array_cargo);

	echo json_encode($array_cargo)
?>