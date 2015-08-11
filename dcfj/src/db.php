<?php

class DBConn {


function connect() {
//Archivo temporal
//$username = 'guiles';
//$password = 'guiles';
//$dbname = 'sitio_cfj';
$username = 'uv1777';
$password = 'astro5578pep';
$dbname = 'uv1777_sitio';



$connection = mysqli_connect('localhost',$username,$password,$dbname);
// If connection was not successful, handle the error
if($connection === false) {
    // Handle error - notify administrator, log to a file, show an error screen, etc.
}
return $connection;	
}

}
?>
