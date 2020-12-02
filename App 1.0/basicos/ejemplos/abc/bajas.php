<html>
<head><TITLE>Registro de Alumnos</TITLE></head>
<link rel="StyleSheet" type="text/css" href="stilo.css" media="screen" title="Normal" />
<div id="encabezado">
 <h1 class="sitio_nombre">Registro de Alumnos</h1>
 <h3 class="slogan">ITL</h3>
</div>
<div id="publicacion">
<center><h2 class="titulo">Bajas:</h2></center>
</div>
</div>
<body>
<br>
<?php
include("conexion.php"); //Archivo de Conexión con Mysql

$consulta = mysql_query("SELECT * FROM `alumnos`"); 
?>
<center>
<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1>
      <TR><TD>&nbsp;<B>Nombre</B></TD> <TD>&nbsp;<B>Apellidos</B>&nbsp;</TD> <TD>&nbsp;<B>No.Control</B>&nbsp;</TD>
      <TD>&nbsp;<B>Carrera</B></TD> <TD>&nbsp;<B>Correo</B>&nbsp;</TD> <TD>&nbsp;<B>Ingreso</B>&nbsp;</TD><TD>&nbsp;<B>Egreso</B>&nbsp;</TD>
<TD>&nbsp;<B>Borrar</B>&nbsp;</TD></TR>
</center>
<center>
<a href="index.php">
Volver
</a>
</center>
<?php

   while($row = mysql_fetch_array($consulta)) 
   {
       
      printf("<tr><td>&nbsp;%s</td><td>&nbsp;%s</td><td>&nbsp;%s</td><td>&nbsp;%s</td><td>&nbsp;%s</td><td>&nbsp;%s</td><td>&nbsp;%s&nbsp;</td><td><a href=\"borra.php?id=%d\">Borra</a></td></tr>", $row["nombre"],$row["apellidos"],$row["no_control"],$row["carrera"],$row["correo"],$row["ingreso"],$row["egreso"],$row["id"]);
   } 
   mysql_free_result($consulta); 
 
?>


</body>
</html>
