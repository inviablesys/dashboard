    <?php
	echo "<p>Esta parte es PHP!</p>";

include("config.php") ;

// Conexión con el servidor
mysql_connect($server, $db_user, $db_pass) or die ("error1".mysql_error());

// Selección de Base de Datos
mysql_select_db($database) or die ("error2".mysql_error());

//mysql_query ("INSERT INTO $database.registro values ()");

$query = "select * from registro";     // Esta linea hace la consulta 
$result = mysql_query ($query);  
//echo "$result";

$query2 = "insert into registro values ('$_POST[hinicio]')";
$result2 = mysql_query ($query2);
echo $result2;

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
