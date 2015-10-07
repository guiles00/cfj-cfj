<?php
    include_once('Db.php');
    
    $db = Db::getInstance();
    $sqli = "select * from universidad_sigla";

    //execute query
    $res = $db->exec_query($sqli);
    
$array_universidad = array();
while($array = mysqli_fetch_array($res)) {

$universidad['value']  = $array['universidad_id'];
$universidad['label']  = strtoupper($array['universidad']);
$array_universidad[] = $universidad;
};

//print_r($array_universidad);
echo json_encode($array_universidad)
?>