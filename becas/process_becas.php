<?php
require_once('Db.php');
require_once('Beca.php');
$beca = new Beca();
$res_becas = $beca->getBecasCompletas_Maqueta();
$recordsTotal = $res_becas->num_rows;;

$data = array();
while($array = mysqli_fetch_array($res_becas)) {
//print_r($array);

	$row['beca_id'] = $array['beca_id'];
    $row['tipo_beca_label'] = $array['tipo_beca_id'];
    $row['nombre'] = $array['nombre']; 
    $row['apellido'] = $array['apellido'];
    $row['estado_label'] = $array['estado_id'];

    if($array['tipo_beca_id'] == 1) $row['tipo_beca_label'] = 'Convenio';
    if($array['tipo_beca_id'] == 2) $row['tipo_beca_label'] = 'Convenio y Beca';
    if($array['tipo_beca_id'] == 3) $row['tipo_beca_label'] = 'Beca';
	
	$row['estado_label'] = ($array['estado_id'] == 0 )? 'Pendiente':'Confirmada';      

	$row['monto'] = rand(500,5000).' $';


$data[] = $row;
}
//print_r($data);
//exit;
$recordsFiltered = $recordsTotal;
/*$data = array();
for ($i=0; $i < 50; $i++) { 
 $data[]= array('beca_id'=>1,'tipo_beca_label'=>'aa','nombre'=>'guille','apellido'=>'case','estado_label'=>'Confirmada');   
}*/

$res = array("draw"=>true,"recordsTotal"=>$recordsTotal,"recordsFiltered"=>$recordsFiltered,"data"=>$data);
echo json_encode($res);

?>
