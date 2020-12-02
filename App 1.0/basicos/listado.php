<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
require ("config.php");
mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());

	$result = mysql_query("SELECT * FROM basicos");
	// comienza un bucle que leerá todos los registros existentes
	while($row = mysql_fetch_array($result)) {
		echo "<hr>";
		echo "Nombre: ".$row['nombre']."<br>";
		echo "fecha: ".$row['fecha']."<br>";
	} // fin del bucle de instrucciones
mysql_free_result($result); // Liberamos los registros
mysql_close(); // Cerramos la conexion con la base de datos
echo "<hr>";




?>


</body>
</html>