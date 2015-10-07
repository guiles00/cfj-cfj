 <?php
include_once('Db.php');
include_once('Alumno.php');
include_once('Beca.php');

//$db = Db::getInstance();
$params = $_POST;
$alumno = new Alumno();
$beca = new Beca();
//Agrego alumno, devuelve id
//@params : Formatear solo campos de alumno
$alumno_id = $alumno->save($params);
//print_r($r);

$d_beca = array('tipo_beca_id'=>$params['tipo_beca'],'alumno_id'=>$alumno_id);

$res_beca = $beca->save($d_beca);
//Traigo datos alumno y beca
$n_alumno = $alumno->getAlumnoById($alumno_id);
$n_beca = $beca->getBeca($res_beca);

//echo "<pre>";
//print_r($n_beca);
//print_r($n_alumno);
//echo "Ingresado con exito";
//echo "<br> Imprimir documento";
//echo json_encode(array("data"=>$res_beca));
$datetime = new DateTime($n_beca['timestamp']);
//print_r($datetime);
//echo $datetime->format("d");	
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>MEMORANDO CFJ</title>
	<style type="text/css">
	<!--
		@page { size: 8.5in 14in; margin-right: 0.79in; margin-top: 0.59in; margin-bottom: 0.59in }
		p { margin-bottom: 0in; direction: ltr; color: #000000; text-align: justify; widows: 2; orphans: 2 }
		p.western { font-family: "Times New Roman", serif; font-size: 12pt; }
		p.cjk { font-family: "Times New Roman", serif; font-size: 12pt }
		p.ctl { font-family: "Times New Roman", serif; font-size: 12pt; so-language: ar-SA }
		h4 { margin-top: 0in; margin-bottom: 0in; direction: ltr; color: #000000; text-align: justify; widows: 2; orphans: 2 }
		h4.western { font-family: "Times New Roman", serif; }
		h4.cjk { font-family: "Times New Roman", serif }
		h4.ctl { font-family: "Times New Roman", serif; so-language: ar-SA }
		p.sdfootnote-western { font-family: "Times New Roman", serif; font-size: 10pt; so-language: es-ES; text-align: left }
		p.sdfootnote-cjk { font-family: "Times New Roman", serif; font-size: 10pt; text-align: left }
		p.sdfootnote-ctl { font-family: "Times New Roman", serif; font-size: 10pt; so-language: ar-SA; text-align: left }
		a:link { color: #0000ff }
		a:visited { color: #800080 }
		a.cjk:visited { so-language: zh-CN }
		a.ctl:visited { so-language: hi-IN }
		a.sdfootnoteanc { font-size: 57% }
	-->
@media print {

	.noprint { display: none; }
}
	</style>
	<script type="text/javascript">
		//window.print();
		function imprimir(){
		window.print();
		}
	</script>

</head>
<body lang="en-US" text="#000000" link="#0000ff" vlink="#800080" dir="ltr">
<div align="center" style="color:blue"><i class="noprint" >Solicitud Generada con &Eacute;xito </i></div>
<div title="header">
	<p align="center"><img src="./print-logo.jpg" align="bottom" width="197" height="80" border="0"></p>
	<p align="center"><font face="Verdana, sans-serif"><font size="2" style="font-size: 9pt"><i>"2015,
	Buenos Aires Capital Mundial de la milanesa"</i></font></font></p>
	<p class="western" align="left" style="margin-right: 0.2in">
	<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt"><b>ANEXO II
	</b></font></font></p>
	<p class="western" align="left" style="margin-right: 0.2in">
	<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt"><b>RES.
	CACFJ N°: 25/11</b></font></font></p>
</div>
<p  align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt"><b>SISTEMA
DE BECAS DEL CENTRO DE FORMACIÓN JUDICIAL</b></font></font>
</p>
<p  align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt"><b>(Res.
CACFJ Nº 25/11)</b></font></font></p>
<p  class="western" align="justify" style="margin-left: 1.5in; text-indent: 0.5in">
<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt"><b>FORMULARIO
DE SOLICITUD</b></font></font><sup><font face="Verdana, sans-serif">
<font size="2" style="font-size: 10pt"><a class="sdfootnoteanc" name="sdfootnote1anc" href="#sdfootnote1sym"><sup>1</sup></a></font></font></sup></p>
<p  class="western" align="right">
<font size="2" style="font-size: 10pt" face="Verdana, sans-serif">Buenos
Aires, <?=$datetime->format("d");?> de <?=$datetime->format("m");?> de <?=$datetime->format("Y");?></font></p>
</p>

<input class="noprint" type="button" onClick="imprimir()" value="Imprimir Informe"/>

<table>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><?if($n_beca['tipo_beca_id']==1) echo "X";?>
			</p>
		</td>
		<td style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">Acogimiento
			a beneficio convenio</font></font></p>
		</td>
	</tr>
	<tr valign="top">
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><?if($n_beca['tipo_beca_id']==2) echo "X";?>
			</p>
		</td>
		<td style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Acogimiento
			a beneficio convenio y beca</font></font></p>
		</td>
	</tr>
	<tr valign="top">
		<td width="33" height="8" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><?if($n_beca['tipo_beca_id']==3) echo "X";?>
			</p>
		</td>
		<td width="517" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">Beca
			(sin convenio)</font></font></p>
		</td>
	</tr>
</table>


<p  class="western" align="justify"><br>
</p>
<table width="575" cellpadding="5" cellspacing="0">
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">APELLIDO:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify">
			<?=$n_alumno['apellido']?>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify">
			<font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">NOMBRES:
			</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify">
			<?=$n_alumno['nombre']?>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify">
			<font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">DNI
			Nº:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify">
			<?=$n_alumno['nro_documento']?>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif">
			<font size="2" style="font-size: 10pt">LEGAJO
			Nº:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify">
			<?=$n_alumno['legajo']?>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">DOMICILIO
			CONSTITUIDO (en el radio de CABA):</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">TEL.
			PARTICULAR:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">TEL.
			LABORAL: </font></font>
			</p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">CORREO
			ELECTRÓNICO OFICIAL: </font></font>
			</p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify">                  
			  <font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">@jusbaires.gov.ar</font></font></p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">FECHA
			DE INGRESO AL PJCABA:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">CARGO
			ACTUAL:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">DEPENDENCIA:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">TITULO
			DE GRADO: </font></font>
			</p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">INSTITUCIÓN:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">FACULTAD:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">INSTITUCIÓN
			PROPUESTA PARA LA ACTIVIDAD:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">CARRERA/CURSO/ACTIVIDAD:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">FECHA
			DE INICIO:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">FECHA
			DE FINALIZACIÓN: </font></font>
			</p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">DURACIÓN
			TOTAL DE LA CARRERA/CURSO/ACTIVIDAD:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">COSTO
			TOTAL DE LA CARRERA/ CURSO/ACTIVIDAD</font></font><sup><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt"><a class="sdfootnoteanc" name="sdfootnote2anc" href="#sdfootnote2sym"><sup>2</sup></a></font></font></sup><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">:
			: </font></font>
			</p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">MONTO
			SOLICITADO: </font></font>
			</p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">DICTAMEN
			EVALUATIVO SUSCRIPTO POR:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<td width="280" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.05in; padding-right: 0in">
			<p  class="western" align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">SUPERPOSICIÓN
			HORARIA SI/NO:</font></font></p>
		</td>
		<td width="273" style="border: 1px solid #000000; padding: 0in 0.05in">
			<p  class="western" align="justify"><br>
			</p>
		</td>
	</tr>
</table>
<p  class="western" align="justify"><br>
</p>
<p  align="justify" style="margin-right: -0.1in; page-break-before: always">
<font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">OBSERVACIONES:
</font></font>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p  align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Detalle
sus objetivos profesionales y cómo cree Ud. que el curso o carrera
de posgrado influirá en ellos.</font></font></p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><a name="OLE_LINK1"></a><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p  align="justify"><br>
</p>
<p  align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Indique
cuáles son los elementos que vinculan su actividad en el Poder
Judicial de la CABA con los contenidos del curso o carrera de
posgrado y qué entiende que aportará el curso o carrera para su
función.</font></font></p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p lang="en-US" align="justify"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAABCAYAAACxKkdkAAAACXBIWXMAAA7EAAAaCwHCZs42AAAAHElEQVR4nGN5//69wJkzZ0wYRsEoGAWjYBQQBQCF/AV61vml7AAAAABJRU5ErkJggg==" align="left" hspace="12"><br>
</p>
<p  align="justify"><br>
</p>
<p  align="justify"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Manifiesto
en carácter de declaración jurada que los datos aportados son
completos y correctos y que conozco y acepto el régimen establecido
en la Res. CACFJ Nº   /11.</font></font></p>
<p  align="justify"><br>
</p>
<p  align="justify"><br>
</p>
<p  align="center"><br>
</p>
<p  align="left"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Firma:....................................</font></font></p>
<p  align="left"><br>
</p>
<p  align="left"><br>
</p>
<p  align="left"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">Aclaración:..............................</font></font></p>
<p  align="left"><br>
</p>
<p  align="left"><br>
</p>
<p  align="left"><font face="Verdana, sans-serif"><font size="2" style="font-size: 10pt">DNI
Nº:...................................</font></font></p>
<h4  class="western" align="left"></h4>
<div id="sdfootnote2">
	<p  class="sdfootnote-western"><a class="sdfootnotesym" name="sdfootnote2sym" href="#sdfootnote2anc">2</a><font face="Verdana, sans-serif"><font size="2" style="font-size: 9pt">
	</font></font><font face="Verdana, sans-serif"><font size="2" style="font-size: 9pt">En
	los casos de convenios académicos, indicar el monto resultante una
	vez efectuado el descuento.</font></font></p>
</div>
</body>
</html>