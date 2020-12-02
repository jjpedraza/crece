<?php
require ("config.php");
require ("funciones.php");
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);
$nosol=$_GET["nosol"];
$result=mysql_query("SELECT * FROM tabladepagos WHERE nosol=".$nosol." LIMIT 0,30",$link);
$fila=mysql_fetch_array($result);
echo $fila["no"].'<br>';
while ($fila = mysql_fetch_array($result,MYSQL_ASSOC))
		{
		extract($fila);	
		echo $fila["no"].'<br>';
		}

?>