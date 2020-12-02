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

<?
if(isset($_POST[enviar]))	
 {
	include("conexion.php"); // Conectar con MySQL

$busca=mysql_query("SELECT * FROM alumnos WHERE no_control = $_POST[control]"); //Busqueda por medio del Num. de Ctrl.
$control=$_POST["control"];
$row = @mysql_fetch_array($busca); //Arreglo
$nombre=$row[1];
$apellidos=$row[2];
$no_control=$row[3];
$carrera=$row[4];
$correo=$row[5];
$ingreso=$row[6];
$egreso=$row[7];

if(mysql_num_rows($busca))
 {   
 	$datos=mysql_fetch_row($busca);
	echo "<form name=formulario  action=cambiar.php method=POST >
		<center><b>Modifica el formulario</b><br>
		<table><tr><td>
		Nombre:</td> <td><input type=text name=nombre value=$nombre> <br></td></tr>
		<tr><td>Apellidos:</td> <td><input type=text name=apellidos value=$apellidos> <br></td></tr>
		<tr><td>No. Control:</td> <td><input type=text name=no_control value=$no_control> <br></td></tr>
		<tr><td>Carrera:</td> <td><input type=text name=carrera value=$carrera> <br></td></tr>
		<tr><td>Correo:</td> <td><input type=text name=correo value=$correo> <br></td></tr>
		<tr><td>Ingreso:</td> <td><input type=text name=ingreso value=$ingreso> <br></td></tr>
		<tr><td>Egreso:</td> <td><input type=text name=egreso value=$egreso> <br></td></tr>
		<tr><td><input type=submit value=enviarDatos name=enviarDatos /></td></tr>
                    </form></table></center>    ";
 }
 else
 echo "No se encontre el numero de control seleccionado";
  		
}

else {
?>
<center>
<form name="cambios" action="cambios.php" method="POST">
Busca el alumno por No. de Control: <input type="text" name="control" /><br>
<input type="submit" value="enviar" name="enviar" />
</form>
</center>
<?
}
?>
</body>
</html>
