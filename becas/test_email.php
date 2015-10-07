<?php
$params = $_GET;
//echo "<pre>";
//print_r($params);
?>
<?if(1):?>
<p>
<b>Solicitud confirmada con &eacute;xito</b>
</b>
<?endif;?>

<?php
require './lib/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'postmaster@sandbox9b23acb4dacc4962a6a02153fe2cb923.mailgun.org';                 // SMTP username
$mail->Password = '66a62590b2b25fbfb8c97869243e7831';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'guillermo.caserotto@gmail.com';
$mail->FromName = 'Mailer';
$mail->addAddress('guiles00@yaho.com', 'Joe Guiles');     // Add a recipient
$mail->addAddress('guillermo.caserotto@gmail.com');               // Name is optional
$mail->addAddress('gcaserotto@jusbaires.gov.ar');               // Name is optional
$mail->addReplyTo('guillermo.caserotto@gmail.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>

<?php

$url = 'https://api.sendgrid.com/';
$user = 'gcaserotto857';
$pass = 'epaapcsnha';

$params = array(
    'api_user'  => $user,
    'api_key'   => $pass,
    //'to'        => 'guillermo.caserotto@gmail.com',
    'to'        => 'gcaserotto@jusbaires.gov.ar',
    'subject'   => 'testing from curl',
    'html'      => 'testing body',
    'text'      => 'testing body',
    'from'      => 'example@sendgrid.com',
  );


$request =  $url.'api/mail.send.json';

// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);

// print everything out
print_r($response);

?>