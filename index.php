<html>
  <head>
    <title>DASHBORAD</title>
  </head>
  <body>
    <h1>CABECERA</h1>
    <p>Este es mi quinto ejemplo con partes de Php</p>
    <?php
	echo "<p>Esta parte es PHP!</p>";
	$v1 = 10 ; // Esta línea da valor a una variable
	$v2 = 5 ;
	###################################
	#También puedo poner esta tonteria
	###################################
	echo "La variable v1 es $v1</BR>";
	echo "La variable v2 es $v2</BR>";
	$resultado = $v1 + $v2;
	echo "La suma v1+v2 es $resultado";
	echo '<p>El valor de mi primera variable es \"$v1\".</p>' ; 

echo "<p>Voy a ver mis notas!</p>" ;
  $nota_primer_examen = 4;
  if ($nota_primer_examen < 5 )
  {
    echo "<p>Qué fracaso! Has suspendido con un $nota_primer_examen.</p>" ;
  }
  else
  {
     echo "<p>Enhorabuena, has aprobado con un $nota_primer_examen!</p>" ;
  }

 switch ( $nota_primer_examen )
  {
     case 0: echo "Imposible estudiar menos." ; break ;
     case 1: echo "Casi no has abierto el libro." ; break ;
     case 2: echo "A este paso no vamos bien." ; break ;
     case 3: echo "Solo estudiaste un día?" ; break ;
     case 4: echo "Hui! Te faltó muy poco!" ; break ;
     case 5: echo "Bien, aprobaste por los pelos." ; break ;
     default: echo "Eres un buen estudiante." ;
  }

$x = 48 ;
  $y = 50 ;
  while ( $x <= $y )
  {
    echo "<p>Vamos por el número $x.</p>" ;
    $x = $x + 1 ;
  }

for ( $contador = 47 ; $contador < 50 ; $contador = $contador + 1)
    {
      echo "<p>Vamos $contador.</p>" ;
    }

// leer datos de usuario y contraseña de la base de datos
include("config.php") ;

// Conexión con el servidor
mysql_connect($server, $db_user, $db_pass) or die ("error1".mysql_error());

// Selección de Base de Datos
mysql_select_db($database) or die ("error2".mysql_error());

mysql_query ("INSERT INTO $database.registro values ()");

$query = "select * from registro";     // Esta linea hace la consulta 
$result = mysql_query ($query);  
//echo "$result";

while ($registro = mysql_fetch_array($result)){  
echo "  
    <tr>  
      <td width='150'>".$registro['fecha']."</td>   
      <td width='150'></td>  

    </tr>  
";  
}

mysql_close ();

    ?>
  </body>
</html>
