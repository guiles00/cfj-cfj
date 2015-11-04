<?php
    include_once('Db.php');
    
    $db = Db::getInstance();

    $fuero_id = (empty($_GET['fuero_id']))?1:$_GET['fuero_id'];
    $sqli = "select * from dependencia where fuero_id=".$fuero_id;

    //execute query
    $res = $db->exec_query($sqli);
    //$res = mysqli_fetch_array($res);

//echo "<pre>";
//print_r($_GET);

$array_dependencia = array();
while($array = mysqli_fetch_array($res)) {

$dependencia['value']  = $array['dep_id'];
$dependencia['label']  = strtoupper($array['dep_nombre']);
$array_dependencia[] = $dependencia;
};

//print_r($array_dependencia);
echo json_encode($array_dependencia)
?>