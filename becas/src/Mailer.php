<?php

class Mailer{
	
	public function sendEmail($params){
		
		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'postmaster@sandbox9b23acb4dacc4962a6a02153fe2cb923.mailgun.org';                 // SMTP username
		$mail->Password = '66a62590b2b25fbfb8c97869243e7831';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->From = 'cursos@jusbaires.gov.ar';
		$mail->FromName = 'Cursos';
		//$email = $params['email']."@jusbaires.gov.ar";
		$email = $params['email'];
		$mail->addAddress($email);     // Por ahora lo saco de parametros 
		$mail->addReplyTo('cursos@jusbaires.gov.ar', 'Cursos');
		$mail->addBCC('gcaserotto@jusbaires.gov.ar');
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Solicitud de Beca';
		$mail->Body    = 'Estimado/a: '.$params['nombre'].',<br>
		<p style="font-size:22px">
		Para validar su solicitud de beca <a href="http://cfj.gov.ar/test/becas/confirma_solicitud.php?a='.$params['md5'].'" style="color:red;">
		confirme su correo electr&oacute;nico aqu&iacute;</a>
		<p>
		<p style="font-size:22px">
		A los efectos de completar su solicitud deber&aacute; imprimir el formulario e ingresarlo por Mesa de Entradas del Centro de Formaci&oacute;n Judicial, Bol&iacute;var 177, piso 2&#176; de la CABA, en el horario de 11.00 a 16.00 hs. (conf. Disp. N&#176; SECFJ N&#176; 155/15)  junto con toda la documentaci&oacute;n que establece el Art. 13 del Reglamento de Becas, aprobado por la Res. CACFJ N&#176; 25/11.
		</p>
		<br>
		<p style="font-size:16px">
		Atte.<br> 
		Departamento de Coordinaci&oacute;n de Convenios, Becas y Publicaciones.
		</p>
 		<br><br>
		<div align="center"><b><i>
		Bolivar 177 Piso 3ro -  Ciudad Aut&oacute;noma de Buenos Aires  -   CP: C1066AAC   -  Tel: 4008-0284  -  Email: cursos@jusbaires.gov.ar
		</i></b><div>';
		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    return true;
		}

	}
}
?>