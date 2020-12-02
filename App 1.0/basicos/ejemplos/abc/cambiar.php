<html>
<head><TITLE>Registro de Alumnos</TITLE></head>
<link rel="StyleSheet" type="text/css" href="stilo.css" media="screen" title="Normal" />
<div id="encabezado">
 <h1 class="sitio_nombre">Registro de Alumnos</h1>
 <h3 class="slogan">ITL</h3>
</div>
<div id="publicacion">
<center><h2 class="titulo">Cambios:</h2></center>
</div>
</div>
<body>
<?php
if (isset($_POST[enviarDatos]))
{
include("conexion.php"); //Archivo para conectar con MySQL

mysql_query("UPDATE alumnos SET nombre='{$_POST['nombre']}', apellidos='{$_POST['apellidos']}', no_control='{$_POST['no_control']}', carrera='{$_POST['carrera']}', correo='{$_POST['correo']}', ingreso='{$_POST['ingreso']}', egreso='{$_POST['egreso']}' WHERE no_control = '$_POST[no_control]'");

}
?>
<center>Los cambios se han realizado satisfactoriamente<br>
<a href="index.php">Volver</a></center>
</body>
</html>
  
 
