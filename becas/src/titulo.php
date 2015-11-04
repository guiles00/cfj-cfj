<?php
    include_once('Db.php');
    
    $db = Db::getInstance();
    $sqli = "select * from titulo";

    //execute query
    $res = $db->exec_query($sqli);
    //$res = mysqli_fetch_array($res);

//echo "<pre>";
$array_titulo = array();
while($array = mysqli_fetch_array($res)) {

$titulo['value']  = $array['titulo_id'];
$titulo['label']  = strtoupper($array['titulo']);
$array_titulo[] = $titulo;
};

//print_r($array_titulo);
echo json_encode($array_titulo)
?>