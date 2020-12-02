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

	//Pase de variables.
	$nombre=$_POST["nombre"];
	$fecha=$_POST["fecha"];
	if($nombre=="") //hacemos validaciones
	echo "Ingresa un nombre<br>"; 
	else{ 
	$sql= "INSERT INTO basicos (nombre,fecha) VALUES ('$nombre','$fecha');";  
	//se insertan los datos en una variable llamada sql.
	
		if(!mysql_query($sql)) //cosulta si se guardo.
			echo "No se pudieron registrar los datos"; else {
			echo '<center>Guardado satisfactoriamente<br>';	}


	
	}	



?>


</body>
</html>