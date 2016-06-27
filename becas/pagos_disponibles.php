<?php
include_once('./src/Db.php');
include_once('./src/PagoBecario.php');

$pago = new PagoBecario();
$pagos = $pago->getPagos();
  
?>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


</head>
<body>

<div class="panel-body">
  <div style="background-color:#6796C8;">
    <img src="./iso-logo.png" width="205" height="89"></img>
  </div>
<hr>
  <div align="center">
  <h2><b>REINTEGRO BECARIOS</br></h2>
  Informaci&oacute;n importante: los cheques se retiran <span style="color:red">martes y jueves de 11:00 a 16:00</span>
 en el Centro de Formaci&oacute;n Judicial, Bolivar 177, 3º piso</b>
  </div>
<br>
<hr>
<div align="center">
<p><i>Deber&aacute; comparecer personalmente el beneficiario con documento de identidad</i></p>
</div>
<hr>

  <div class="table-responsive">
        <table class="table table-responsive table-striped table-bordered table-hover" id="actuacion">
            <thead>
                <tr>                   
                   <th>BECARIO</th>
                   <th>PAGO DISPONIBLE</th>
                   <th>OBSERVACIONES</th>
               </tr>
           </thead>
           <tbody>
            
            <?php  while($array = mysqli_fetch_array($pagos)) {?>
            <tr>
                <td> <?= $array['usi_nombre'] ?> </td>
                <td> <?= ($array['disponible_id'] == 1)? 'SI' : 'NO' ?></td>
                <td> <?= $array['observaciones'] ?></td>
            </tr>
            <?}?>
        </tbody>
    </table>
  </div>

</div>


</body>
