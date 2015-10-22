 <?php
include_once('Db.php');
include_once('Alumno.php');
include_once('Beca.php');
include_once('Mailer.php');
include_once('./lib/PHPMailer/PHPMailerAutoload.php');

$params = $_POST;

//Tengo que formatear la fecha para la base de datos
//$f_ingreso_caba = date("Y-m-d", strtotime($params['f_ingreso_caba'])); ;
//$fecha_inicio = date("Y-m-d", strtotime($params['f_inicio_b'])); ;
//$fecha_fin = date("Y-m-d", strtotime($params['f_final_b'])); ;

//echo "<pre>";
//print_r($params);
//exit;

$fecha_ingreso_caba = $params['b_f_a_ingreso_caba'].'-'.$params['b_f_m_ingreso_caba'];
$f_i_caba_datetime = new DateTime($fecha_ingreso_caba);

$md5 = md5(time());
$alumno = new Alumno();
$beca = new Beca();

$params['usi_dni'] = $params['nro_documento'];
//Agrego alumno, devuelve id
$alumno_id = $alumno->save($params);


//Le agrego unos campos que no vienen desde el formulario
$d_beca = $params;
$d_beca['alumno_id'] = $alumno_id;
$d_beca['md5'] = $md5;
$d_beca['f_ingreso_caba'] = $f_i_caba_datetime->format('Y-m-d');

$fecha_inicio = '1-'.$params['f_sem_inicio_b'].'-'.$params['f_inicio_b'];
$f_i_datetime = (new DateTime($fecha_inicio))->format('Y-m-d');;

$fecha_fin = '1-'.$params['f_sem_final_b'].'-'.$params['f_final_b'];
$f_f_datetime = (new DateTime($fecha_fin))->format('Y-m-d');;

$d_beca['f_inicio_b'] = $f_i_datetime;
$d_beca['f_final_b'] = $f_f_datetime;


$res_beca = $beca->save($d_beca);

//Traigo datos alumno y beca
$n_alumno = $alumno->getAlumnoById($alumno_id);
$n_beca = $beca->getBeca($res_beca);

$datetime = new DateTime($n_beca['timestamp']);

//if($params['mail'] == $params['mail'])//if ok - send email

$mailer = new Mailer();
$params['md5'] = $md5;
$mailer->sendEmail($params);

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title></title>
<script type="text/javascript" charset="utf8" src="./js/jquery-1.11.2.js"></script>

<script>
	$(document).ready(function() {
		
		$('#show').click(function(){
			$('#b_print_container').toggle();
			
		});
	});
</script>
	<style type="text/css">
	#b_table_content td{
		border: 1px solid #000000; 
		padding: 0in 0.05in;
		width:"273";
	}
	#b_table_content p {
		align:"justify";
		font-family: "Times New Roman", serif; font-size: 12pt;
	}
	#b_header p{
		font-family:"Verdana, sans-serif";
		font size: "font-size: 9pt";
	}

@media print {

	.noprint { display: none; }
}

@media screen {

	.nodisplay { display: none; }
}
	</style>
	<script type="text/javascript">
		//window.print();
		function imprimir(){
		window.print();
		}
	</script>

</head>
<body>

<div align="center" style="background-color:#6796C8;">
<img src="./img/iso-logo.png" width="205" height="89"></img>
</div>
<br>
<div class="noprint" align="center">
<span style="color:blue; font-size:22px">Solicitud Generada con &Eacute;xito
<b>(Nro:<?=$n_beca['beca_id']?>)</b></span>
<br>
<span style="color:black; font-size:20px"><br>Recibir&aacute; un email para confirmar su solicitud dentro de las pr&oacute;ximas 24 hs.</span>
<br>
<br><i style="color:black; font-size:15px">Por cualquier inconveniente comun&iacute;quese al Centro de Formaci&oacute;n Judicial - Tel: 4014-5846/6144 - Email: cursos@jusbaires.gov.ar</i>
</div>
<!--input id="show" class="noprint" type="button" value="Mostrar impresion"/-->
<!--div class="noprint" align="center">
<input class="noprint" type="button" onClick="imprimir()" value="Imprimir Formulario"/>
</div-->
<div class="nodisplay" id="b_print_container">

<div title="header" id="b_header">
	<p align="center"><img src="./print-logo.jpg" align="bottom" width="197" height="80" border="0"></p>
	<p align="center"><i>"2015,
	Buenos Aires Capital Mundial de ..."</i></p>
	<p align="center"><b>ANEXO II
	</b></p>
</div>
<p  align="center"><b>SISTEMA
DE BECAS DEL CENTRO DE FORMACIÓN JUDICIAL (Res. CACFJ Nº 25/11)</b>
</p>
<p align="center">
<b>FORMULARIO
DE SOLICITUD</b></p>
<p align="right">
<font size="2" style="font-size: 10pt">Buenos
Aires, <?=$datetime->format("d");?> de <?=$datetime->format("m");?> de <?=$datetime->format("Y");?></font></p>
</p>

<div id="b_table_content">
<table>
	<tr>
		<td>
			<?if($n_beca['tipo_beca_id']==1) echo "X";?>
		</td>
		<td>
			<font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">Acogimiento
			a beneficio convenio</font></font>
		</td>
	</tr>
	<tr>
		<td>
			<?if($n_beca['tipo_beca_id']==2) echo "X";?>
			
		</td>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Acogimiento
			a beneficio convenio y beca</font></font>
		</td>
	</tr>
	<tr>
		<td>
			<?if($n_beca['tipo_beca_id']==3) echo "X";?>
		</td>
		<td>
			<font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">Beca
			(sin convenio)</font></font>
		</td>
	</tr>
</table>
<br>
<table>
	<tr>
		<td>
			<font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">APELLIDO:</font></font>
		</td>
		<td width="273">
			
			<?=$n_alumno['apellido']?>
			
		</td>
	</tr>
	<tr>
		<td>
			
			<font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">NOMBRES:
			</font></font>
		</td>
		<td width="273">
			
			<?=$n_alumno['nombre']?>
			
		</td>
	</tr>
	<tr>
		<td>
			
			<font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">DNI
			Nº:</font></font>
		</td>
		<td width="273">
			
			<?=$n_alumno['nro_documento']?>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">LEGAJO
			Nº:</font></font>
		</td>
		<td width="273">
			
			<?=$n_alumno['legajo']?>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">DOMICILIO
			CONSTITUIDO (en el radio de CABA):</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">TEL.
			PARTICULAR:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">TEL.
			LABORAL: </font></font>
			
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">CORREO
			ELECTRÓNICO OFICIAL: </font></font>
			
		</td>
		<td width="273">
			                  
			  <font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">@jusbaires.gov.ar</font></font>
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">FECHA
			DE INGRESO AL PJCABA:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">CARGO
			ACTUAL:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">DEPENDENCIA:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">TITULO
			DE GRADO: </font></font>
			
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">INSTITUCIÓN:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">FACULTAD:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">INSTITUCIÓN
			PROPUESTA PARA LA ACTIVIDAD:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">CARRERA/CURSO/ACTIVIDAD:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">FECHA
			DE INICIO:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">FECHA
			DE FINALIZACIÓN: </font></font>
			
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">DURACIÓN
			TOTAL DE LA CARRERA/CURSO/ACTIVIDAD:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">COSTO
			TOTAL DE LA CARRERA/ CURSO/ACTIVIDAD</font></font><sup><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt"><a class="sdfootnoteanc" name="sdfootnote2anc" href="#sdfootnote2sym"><sup>2</sup></a></font></font></sup><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">:
			: </font></font>
			
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">MONTO
			SOLICITADO: </font></font>
			
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">DICTAMEN
			EVALUATIVO SUSCRIPTO POR:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
	<tr>
		<td>
			<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">SUPERPOSICIÓN
			HORARIA SI/NO:</font></font>
		</td>
		<td width="273">
			<br>
			
		</td>
	</tr>
</table>
</div>


<p style="page-break-before: always"></p>
<p  align="justify" style="margin-right: -0.1in; page-break-before: always">
<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">OBSERVACIONES:
</font></font>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p  align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Detalle
sus objetivos profesionales y cómo cree Ud. que el curso o carrera
de posgrado influirá en ellos.</font></font>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><a name="OLE_LINK1"></a><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p  align="justify"><br>

<p  align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Indique
cuáles son los elementos que vinculan su actividad en el Poder
Judicial de la CABA con los contenidos del curso o carrera de
posgrado y qué entiende que aportará el curso o carrera para su
función.</font></font>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>

<p  align="justify"><br>

<p  align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Manifiesto
en carácter de declaración jurada que los datos aportados son
completos y correctos y que conozco y acepto el régimen establecido
en la Res. CACFJ Nº   /11.</font></font>
<p  align="justify"><br>

<p  align="justify"><br>

<p  align="center"><br>

<p  align="left"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Firma:....................................</font></font>
<p  align="left"><br>

<p  align="left"><br>

<p  align="left"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Aclaración:..............................</font></font>
<p  align="left"><br>

<p  align="left"><br>

<p  align="left"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">DNI
Nº:...................................</font></font>
<h4  class="western" align="left"></h4>
<div id="sdfootnote2">
	<p  class="sdfootnote-western"><a class="sdfootnotesym" name="sdfootnote2sym" href="#sdfootnote2anc">2</a><font face="Verdana, sans-serif"><font size="2" style="font-size: 9pt">
	</font></font><font face="Verdana, sans-serif"><font size="2" style="font-size: 9pt">En
	los casos de convenios académicos, indicar el monto resultante una
	vez efectuado el descuento.</font></font>
</div>

<input class="noprint" type="button" onClick="imprimir()" value="Imprimir"/>

<!-- Don not display on screen Class -->
</div>

</body>
</html>
