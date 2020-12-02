
<?php
/* si no es la sesion de el USUARIO regresar a login.*/
session_start();

if(!isset($_SESSION['usuario'])) 
{  
  header('Location: login.php'); 
  exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MANTENIMIENTO: cambiar password</title>
<link href="css/mantenimiento.css" rel="stylesheet" type="text/css" />

</head>

<body >
<center>
<P class="titulo">
MANTENIMIENTO: <br/> modificacion de mi password
<?php
require ("config.php");
mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());


/*caturamos nuestros datos que fueron enviados desde el formulario mediante el metodo POST
**y los almacenamos en variables.*/
$usuario = $_SESSION['usuario'];   
$password_nuevo = $_POST["passnuevo1"];

	 $sql = "UPDATE usuarios SET password='$password_nuevo' WHERE usuario='".$usuario."'";
	 $result = mysql_query($sql);
	 echo '<P class="texto">';
	 echo 'PASSWORD CAMBIADO CON EXITO';
	 echo '</p>';
	 
 
 


mysql_close();
?>


</P>
  
</center>
</body>
</html>