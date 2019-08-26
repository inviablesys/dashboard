<?php
	
// leer datos de usuario y contraseña de la base de datos
include("config.php") ;

// Conexion con el servidor
mysql_connect($server, $db_user, $db_pass) or die ("error1".mysql_error());

// Seleccion de Base de Datos
mysql_select_db($database) or die ("error2".mysql_error());

$query = "INSERT INTO pir(registro) values (CURRENT_TIMESTAMP)";

$resultado = mysql_query($query) or die(mysql_error());

mysql_close ();

$hora= date ("h:i:s A");
echo $_POST;

$url= "https://api.telegram.org/bot542914764:AAH3hBQihxjRcvNMFHf-q7iqJN-r1wKrCBQ/sendmessage?chat_id=496122930&text=Acceso ".$hora;
$contenido=file_get_contents($url);
// echo $contenido;


?>
