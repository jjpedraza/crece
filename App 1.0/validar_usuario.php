<?php
session_start();
?>

<?php
require ("config.php");

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());


/*caturamos nuestros datos que fueron enviados desde el formulario mediante el metodo POST
**y los almacenamos en variables.*/
$usuario = $_POST["form_usuario"];   
$password = $_POST["form_pass"];



$result = mysql_query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
 
//Validamos si el nombre del administrador existe en la base de datos o es correcto
if($row = mysql_fetch_array($result))
{     
//Si el usuario es correcto ahora validamos su contraseña
 if($row["password"] == $password)
 {
  //Creamos sesión
  session_start();  
  //Almacenamos el nombre de usuario en una variable de sesión usuario
  $_SESSION['usuario'] = $usuario;  
  //Redireccionamos a la pagina: index.php
  header("Location: index.php");  
 }
 else
 {
  //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
  	echo '<center><br>';
	echo 'CLAVE INCORRECTA <br>';
    echo '<a href="login.php"> Intentarlo de nuevo  /<a>';
	echo '</center>';
  
             
 }
}
else
{
 //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
	echo '<center><br>';
	echo 'NOMBRE DE USUARIO INCORRECTO <br>';
    echo '<a href="login.php"> Intentarlo de nuevo  /<a>';
	echo '</center>';
  



         
}
 
//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
mysql_free_result($result);
 
/*Mysql_close() se usa para cerrar la conexión a la Base de datos y es 
**necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
**programar una aplicación que tendrá muchas visitas ;) .*/
mysql_close();
?>