<html>
<head><TITLE>Registro de Alumnos</TITLE></head>
<link rel="StyleSheet" type="text/css" href="stilo.css" media="screen" title="Normal" />
<div id="encabezado">
 <h1 class="sitio_nombre">Registro de Alumnos</h1>
 <h3 class="slogan">ITL</h3>
</div>
<div id="publicacion">
<center><h2 class="titulo">Registro:</h2></center>
</div>
</div>
<body>

<?
include("funciones.php"); //Se incluye el archivo funciones.php donde se encuentran las validaciones del e-mail y número de control.

if(isset($_POST[enviar])) //Si el botón enviar es pulsado, hacer lo siguiente:
{
include("conexion.php"); //Se incluye el archivo conexion.php para conectar con MySQL.

//Pase de variables.
  $nombre=$_POST["nombre"];
  $apellidos=$_POST["apellidos"];   // Se pasan las variables de Nombre, Apellidos, no_control, carrera, etc.. por 						medio del método POST.
  $no_control=$_POST["no_control"];   //
  $carrera=$_POST["carrera"];         //	
  $correo=$_POST["correo"];
  $ingreso=$_POST["ingreso"];		
  $egreso=$_POST["egreso"];


if($nombre=="") //validaciones
echo "Ingresa un nombre<br>"; 
 else
  if(!no_control($no_control))  //validación del número de control
  echo "Hubo errores en el numero de control, debe ser de 8 digitos<br>";
 else
   if(!comprobar_email($correo)) //validación del correo electrónico
     echo "El mail <b>$correo</b> es incorrecto<br>";
   else
  {
  
$sql= "INSERT INTO alumnos (id , nombre , apellidos , no_control , carrera , correo , ingreso , egreso) VALUES ('', '$nombre', '$apellidos', '$no_control', '$carrera', '$correo', '$ingreso', '$egreso');";  //se insertan los datos en una variable llamada sql.
}
if(!mysql_query($sql))  //la variable se ingresa a la función mysql_query que esta es la que inserta a la base de datos.

echo "No se pudieron registrar los datos";
else
echo "<center>El registro se ha realizado satisfactoriamente<br><br> <b>Nombre:</b>".$nombre." <br> <b>Apellidos:</b>".$apellidos."<br> <b>No. control:</b>".$no_control."<br> <b>Carrera:</b>".$carrera."<br> <b>Correo:</b>".$correo."<br> <b>Ingreso:</b>".$ingreso."<br> <b>Egreso:</b>".$egreso." ";
  


?>
<br><br>
<a href="index.php">Volver</a></center>
<? 
}
else
{
 ?>

<center>
<form name="alumnos" action="altas.php" method="POST">
<table>
  <tbody>
    <tr>
      <td>Nombre:</td>
      <td><input type="text" name="nombre" /></td>
    </tr>
    <tr>
      <td>Apellido:</td>
      <td><input type="text" name="apellidos" /></td>
    </tr>
    <tr>
      <td># Control:</td>
      <td><input type="text" name="no_control" /></td>
    </tr>
    <tr>
      <td>Carrera:</td>
      <td><SELECT name="carrera">
         <OPTION>Ing. Sistemas
	<OPTION>Administracion
	<OPTION>Ing. Electrica
        <OPTION> Ing. Electronica
	<OPTION> Ing. Industrial
	<OPTION> Ing. Quimica
          </SELECT></td>
    </tr>
    <tr>
      <td>Correo:</td>
      <td><input type="text" name="correo" /></td>
    </tr>
    <tr>
      <td>Ingreso:</td>
      <td><SELECT name="ingreso">
        <OPTION>1983</OPTION>
	<OPTION>1984</OPTION>
	<OPTION>1985</OPTION>
	<OPTION>1986</OPTION>
	<OPTION>1987</OPTION>	
	<OPTION>1988</OPTION>
	<OPTION>1989</OPTION>
	<OPTION>1990</OPTION>
	<OPTION>1991</OPTION>
	<OPTION>1992</OPTION>
	<OPTION>1993</OPTION>
	<OPTION>1994</OPTION>
	<OPTION>1995</OPTION>
	<OPTION>1996</OPTION>
	<OPTION>1997</OPTION>
	<OPTION>1998</OPTION>
	<OPTION>1999</OPTION>
	<OPTION>2000</OPTION>
	<OPTION>2001</OPTION>
	<OPTION>2002</OPTION>
	<OPTION>2003</OPTION>
	<OPTION>2004</OPTION>
	<OPTION>2005</OPTION>
	<OPTION>2006</OPTION>
	<OPTION>2007</OPTION>
	<OPTION>2008</OPTION>
          </SELECT></td>
    </tr>
    <tr>
      <td>Egreso:</td>
       <td><SELECT name="egreso">
        < <OPTION>1983</OPTION>
	<OPTION>1984</OPTION>
	<OPTION>1985</OPTION>
	<OPTION>1986</OPTION>
	<OPTION>1987</OPTION>	
	<OPTION>1988</OPTION>
	<OPTION>1989</OPTION>
	<OPTION>1990</OPTION>
	<OPTION>1991</OPTION>
	<OPTION>1992</OPTION>
	<OPTION>1993</OPTION>
	<OPTION>1994</OPTION>
	<OPTION>1995</OPTION>
	<OPTION>1996</OPTION>
	<OPTION>1997</OPTION>
	<OPTION>1998</OPTION>
	<OPTION>1999</OPTION>
	<OPTION>2000</OPTION>
	<OPTION>2001</OPTION>
	<OPTION>2002</OPTION>
	<OPTION>2003</OPTION>
	<OPTION>2004</OPTION>
	<OPTION>2005</OPTION>
	<OPTION>2006</OPTION>
	<OPTION>2007</OPTION>
	<OPTION>2008</OPTION>
      </SELECT></td>
    </tr>
   <tr><TD><input type="submit" value="enviar" name="enviar" /></TD>
   <td><input type="reset" value="borrar"/></td>
</tr>
  </tbody>
</table>
</form>
<a href="index.php">Volver</a></center>
<?
}
?>
</body>
</html>
