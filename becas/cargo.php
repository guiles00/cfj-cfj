<?php
  
    include_once('Db.php');
    
    $db = Db::getInstance();
    $sqli = "select * from cargo order by car_nombre";

    //execute query
    $res = $db->exec_query($sqli);
    //$res = mysqli_fetch_array($res);

//echo "<pre>";
$array_cargo = array();
while($array = mysqli_fetch_array($res)) {
//print_r($array);
$cargo['value']  = $array['car_id'];
$cargo['label']  = strtoupper($array['car_nombre']);
$array_cargo[] = $cargo;
};
//print_r($array_cargo);

	echo json_encode($array_cargo)
?>