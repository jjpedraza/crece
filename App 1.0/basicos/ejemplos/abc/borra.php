<?php
include("conexion.php");

$id=$_GET["id"];
mysql_query("DELETE FROM alumnos where id = $id"); //Método para eliminar

include("bajas.php");
?>
