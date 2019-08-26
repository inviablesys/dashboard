<html>
  <head>
      <?php
	
// leer datos de usuario y contraseña de la base de datos
include("config.php") ;

// ConexiÃ³n con el servidor
mysql_connect($server, $db_user, $db_pass) or die ("error1".mysql_error());

// SelecciÃ³n de Base de Datos
mysql_select_db($database) or die ("error2".mysql_error());

 
//preparamos la consulta
$SQLDatos = "SELECT * FROM tyh";
 
//ejecutamos la consulta
$result = mysql_query($SQLDatos);
//obtenemos número filas
$numFilas = mysql_num_rows($result);
 
//cargamos array con los nombres de las métricas a visualizar
$datos[0] = array('registro','temperatura');
 
//recorremos filas
for ($i=1; $i<($numFilas+1); $i++)
{
    $datos[$i] = array(mysql_result($result, $i-1, "registro"),
    (int) mysql_result($result, $i-1, "temperatura"));
}
// print_r ($datos);
mysql_close ();

?>   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
          
        var cargaDatos = <?php echo json_encode($datos); ?>;
        var data = google.visualization.arrayToDataTable(cargaDatos);

        var options = {
          title: 'Temperatura y Humedad',
          hAxis: {title: 'Fecha y Hora',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
       
      
      <div id="chart_div" style="width: 100%; height: 500px;"></div>
         
  </body>
</html>
