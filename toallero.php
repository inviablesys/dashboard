<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
        <title>TOALLERO</title>
  </head>
  <body>
    <h1>ALTA DE HORA</h1>
    <p>MA&NtildeANA</p>

  <form method="POST" action="horatoallero.php">
   Hora On&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora Off<br>       
   <input type="TIME" name="horaonM" >
  <input type="TIME" name="horaoffM" ><br>
  <p> TARDE </p>
  Hora On&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora Off<br>
  <input type="TIME" name="horaonT" >
  <input type="TIME" name="horaoffT"> <br>
  <br>
  <input type="SUBMIT" value="Guardar"> 
  </form>
    
    <?php
	
// leer datos de usuario y contrase�a de la base de datos
include("config.php") ;

// Conexión con el servidor
mysql_connect($server, $db_user, $db_pass) or die ("error1".mysql_error());

// Selección de Base de Datos
mysql_select_db($database) or die ("error2".mysql_error());

//mysql_query ("INSERT INTO $database.registro values ()");
//echo "$result";
//echo $_POST[horaonM];
//$query2 = "insert into toallero (horaonM,horaoffM,horaonT,horaoffT,estado) values ('$_POST[horaonM]','$_POST[horaoffM]','$_POST[horaonT]','$_POST[horaoffT]',1)";

$estado = exec ('/home/pi/RELAY/relay_ok.py estado');

/* $query2 = "update toallero set horaonM='$_POST[horaonM]',horaoffM='$_POST[horaoffM]',horaonT='$_POST[horaonT]',horaoffT='$_POST[horaoffT]',estado='$estado'";
$resultado = mysql_query($query2) or die(mysql_error());

$horaonM = substr ($_POST[horaonM],0,2);
if ($horaonM == null)
        $horaonM=0;
$minonM = substr ($_POST[horaonM],3,2);
if ($minonM == null)
        $minonM=0;
$horaoffM = substr ($_POST[horaoffM],0,2);
if ($horaoffM == null)
        $horaoffM=0;
$minoffM = substr ($_POST[horaoffM],3,2);
if ($minoffM == null)
        $minoffM=0;

$horaonT = substr ($_POST[horaonT],0,2);
if ($horaonT == null)
        $horaonT=0;
$minonT = substr ($_POST[horaonT],3,2);
if ($minonT == null)
        $minonT=0;
$horaoffT = substr ($_POST[horaoffT],0,2);
if ($horaoffT == null)
        $horaoffT=0;
$minoffT = substr ($_POST[horaoffT],3,2);
if ($minoffT == null)
        $minoffT=0;

//GUARDA EN EL CRON
echo "<br>";
exec ('rm -f /tmp/crontab.txt');
exec("crontab -r"); 

$output = shell_exec('crontab -l');
$cron_file = "/tmp/crontab.txt";
file_put_contents($cron_file, $output.$minonM." ".$horaonM." * * * /home/pi/RELAY/relay_ok.py on".PHP_EOL.$minoffM." ".$horaoffM." * * * /home/pi/RELAY/relay_ok.py off".PHP_EOL.$output.$minonT." ".$horaonT." * * * /home/pi/RELAY/relay_ok.py on".PHP_EOL.$minoffT." ".$horaoffT." * * * /home/pi/RELAY/relay_ok.py off".PHP_EOL);
echo exec("crontab $cron_file");
*/
/*
$query = "select * from toallero";     // Esta linea hace la consulta 
$result = mysql_query($query) or die(mysql_error());  

echo "<br>";
echo "El horario configurado es:<br><br>";

while ($registro = mysql_fetch_array($result)){  

    echo "<table>  
    <tr>
        <td>HoraonM</td>&nbsp;
        <td>HoraoffM</td>&nbsp;
    </tr>
    <tr>  
      <td>".$registro['horaonM']."</td> &nbsp;  
      <td>".$registro['horaoffM']."</td> &nbsp;  
    </tr>
    <tr>
        <td>HoraonT</td>&nbsp;
        <td>HoraoffT</td>&nbsp;
    </tr>
    <tr>
      <td>".$registro['horaonT']."</td>  &nbsp; 
      <td>".$registro['horaoffT']."</td> &nbsp;  
    </tr>
    <tr>
      <td>ESTADO: ".$registro['estado']."</td> &nbsp;  
      <td></td>  
    </tr>  </table>
";  
}
$output2 = shell_exec('crontab -l');
echo nl2br($output2);  //Imprime el crontab
 * 
 */
mysql_close ();
//header('Location: dashboard.php');
    ?>
  </body>
</html>
