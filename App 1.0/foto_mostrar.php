<?php
require ("config.php");
# Conectamos con la base de datos
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);
//$id="1";
//$id=$_GET["id"]; //utilizo get para obtener la variable id de pagina.php?id=1
$curp=$_GET["curp"];
# Buscamos la imagen a mostrar
$result=mysql_query("SELECT * FROM `fotos` WHERE curp='".$curp."'",$link);
$row=mysql_fetch_array($result);

# Mostramos la imagen
header("Content-type:".$row["tipo"]);
echo $row["imagen"];

?>
