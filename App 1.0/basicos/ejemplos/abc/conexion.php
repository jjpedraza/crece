<?php
//Conexion con mysql.
$dbhost="localhost";
$dbuser="admin";
$dbpass="1234admin"; //el password se encuentra en blanco, ingresar su password de su cuenta de mysql.
$dbname="ejemplo"; //nombre de la base de datos
$tabla="alumnos";  // nombre de la tabla
mysql_connect($dbhost,$dbuser,$dbpass); //se hace la conexión con mysql 	
mysql_select_db($dbname); //se selecciona la base de datos
?>
