<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>DASHBOARD</title>
    <script src="raphael-2.1.4.min.js"></script>
    <script src="justgage.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>
    <h1>TOALLERO</h1>

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
if($estado==0)
    $estadotoallero='OFF';
else
    $estadotoallero='ON';

echo "El toallero est&aacute;: ".$estadotoallero."<br><br>";
?>

        <script type="text/javascript">
        function off(){

             alert("Toallero ON");
         }
        function on() {
            $.ajax({
                type: "POST",
                url: "pir.php"
                  });
        }

    </script>


    <form method="POST" action="dashboard.php">
     <input type="radio" name="toallero" value="on"> ON<br>
  <input type="radio" name="toallero" value="off"> OFF  <br>
  <input type="SUBMIT" value="EJECUTAR">
    </form>




    <div class="onoffswitch">
        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" onclick="on()"<?php if($estadotoallero=='ON') echo "checked";?> >
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>
  <?php


    if (isset($_POST[toallero])){
  system ('/home/pi/RELAY/relay_ok.py'.' '.$_POST[toallero]);
    }


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

$query = "select * from toallero";     // Esta linea hace la consulta
$result = mysql_query($query) or die(mysql_error());

echo "El horario configurado es:<br>";

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
     </table>
";
}
//$output2 = shell_exec('crontab -l');
//echo nl2br($output2);  //Imprime el crontab

    ?>

<form method="POST" action="toallero.php">
   <input type="SUBMIT" value="Cambiar Hora">
  </form>

    <br>
    <h1>TEMPERATURA Y HUMEDAD </h1>
    <br>

    <div id="temperatura">
        Temperatura: <span id="valor"></span>&ordm;C
    </div>
    <div id="humedad">
          Humedad: <span id="valor"></span>&percnt;
    </div>
      <div id="hora"></div>

      <div id="gauge" class="css_temp" >
      </div>
    <div id="gauge_h" class="css_temp" >
      </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Tiempo de actualización en milisegundos
            const tiempo = 10000;

           // alert("Los datos se actualizar�n cada " + tiempo / 1000 + " segundos");

            const getDatos = function () {
                $.ajax({
                  dataType: "json",
                  url: "datostemphum2.json",
                  success: function (data) {
                      const temperatura =$("#temperatura #valor");
                      const hum = $("#humedad #valor");
                     // const estado = $("#estado");
                      const hora = $("#hora");

                      hora.empty().html(new Date());

                      // Muestra el texto para la temperatura
                      temperatura.empty().html(data.temperatura);

                      // Se añade la clase CSS "valor-ok" para los valores entre 45 y 55
                     // if (data.humedad >= 45 && data.humedad <= 55) {
                     //     hum.addClass("valor-ok")
                      //}

                      // Muestra el texto para humedad
                      hum.empty().html(data.humedad);

                      // Limpia los estados para actualizar
                      //estado.empty();

                      // Recorrer el objeto data.estado y mostrar los elementos que contiene
                      // Por cada elemento se crea un <div> para el texto y el valor
                      //for (var clave in data.estado) {
                        //  if (data.estado.hasOwnProperty(clave)) {
                          //    estado.append("<div>Estado " + clave + ": <span id='valor'>" + data.estado[clave] + "</valor></div>");
                         // }
                      //}

                      g.refresh(data.temperatura);
                      h.refresh(data.humedad);

                    }
                 });
            };

            // Realizar la primera actualización
            getDatos();
            var g = new JustGage({
                id: "gauge",
                min: 0,
                max: 50,
                value: 10,
                title: "TEMPERATURA"
            });
             var h = new JustGage({
                id: "gauge_h",
                min: 0,
                max: 100,
                value: 10,
                title: "HUMEDAD"
             });

            // Programar la actualización a intérvalos
            window.setInterval(getDatos, tiempo);
        });



    </script>
  <style>
        .valor-ok { background-color: green; color: white}
    </style>
 <?php
//echo 'hola';
 // $th=shell_exec ('/home/pi/DHT11/dht11_adafruit.sh 11 4');

 //echo $th;

 //$temperatura = substr ($th,5,4);
 //echo $temperatura;
 //echo '<br>';
 //$humedad = substr ($th,21,4);
 //echo $humedad;
 //echo '</br>';

  ?>


  <br>
    <h1>ULTIMOS ACCESOS </h1>
    <br>
  <?php

  $query = "select * from pir order by registro desc limit 0,10";     // Esta linea hace la consulta
  $result = mysql_query($query) or die(mysql_error());

echo "Los ultimos accesos son:<br>";

echo "<table>";
while ($registro = mysql_fetch_array($result)){

    echo "
    <tr>
      <td>".$registro['registro']."</td> &nbsp;
    </tr>
     ";
}
echo "</table>";
//$output2 = shell_exec('crontab -l');
//echo nl2br($output2);  //Imprime el crontab
mysql_close ();
    ?>
   <br>
    <h1>AC</h1>
    <br>

    <form method="POST" action="dashboard.php">
  <input type="radio" name="ac" value="ON"> ON 21<br>
  <input type="radio" name="ac" value="ONHEAT"> ON 27<br>
  <input type="radio" name="ac" value="OFF"> OFF  <br>
  <input type="SUBMIT" value="EJECUTAR">
</form>
  <?php


    if (isset($_POST[ac])){
  system ('/home/pi/ac.sh'.' '.$_POST[ac]);
    }

  ?>

</body>
</html>
