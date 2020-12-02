<?php
require ("config.php");
?>



<?php
/* si no es la sesion de el USUARIO regresar a login.*/
session_start();

if(!isset($_SESSION['usuario'])) 
{  
  header('Location: login.php'); 
  exit();
}

?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php   echo '<title>'; 
		echo $nombresistema;
		echo ', ';
		echo $nombreversion;
		echo '</title>';

 ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/misol1.css" rel="stylesheet" type="text/css" />


</head>
<body  topmargin="0" bottommargin="0">
<center>
<table style="display: inline-table;" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="495">
  
  <tr><td bgcolor="#000000" class="menu1" align="center"><img src="img/home.png" /><a href="index.php"> Regresar al MENU </a></td></tr>
  
  <tr>
    <td align="left" valign="top">
    
    <p align="center" class="titulo1">LISTA DE GRUPOS:    

<?php
require ("config.php");
require ("funciones.php");


	mysql_connect('localhost', 'root', 'admin');
	mysql_select_db('bd');
	$sql = "SELECT * FROM grupos";
	$resultado=mysql_query($sql);

	
	while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		echo '<hr><p align="left" class="normal">';
		echo $id.'.- <b>'.$nombre.'</b> <br>';
		
			$sql2 = "SELECT * FROM clientes WHERE grupo='".$nombre."'";
			$resultado2=mysql_query($sql2);
			while ($fila2 = mysql_fetch_array($resultado2)){
				extract($fila2);
				echo $fila2["nombre"].', <b>'.$fila2["grupo_cargo"].'</b><br>';
				
				}
		
		echo '<BR>Configurar la distribucion:<br>';
			$sql3 = "SELECT * FROM cuentas WHERE grupo='".$fila["nombre"]."'";
			$resultado3=mysql_query($sql3);
			while ($fila3 = mysql_fetch_array($resultado3)){
				extract($fila3);
				echo '<a href="distri.php?grupo='.$fila["nombre"].'&nosol='.$fila3["nosol"].'">'.$fila3["nosol"].'</a>, ';
				
				}
				echo '<br>';
		
		
		echo '<a href="grupo_configurar.php?grupo='.$fila["nombre"].'"> Configurar cargos del grupo</a>';
			
		echo '</p>';
		}




?>



    
    
    
    
    
    </td>
  </tr>
  <tr>
    <td bgcolor="#000000">
    <p class="pie1" align="center">
    <?php
    echo $pie1;
	echo $pie2;
	echo '<br/>';
	echo $pie3_yo;
	echo '<br/>';
	echo '<a href="http://facebook.com/eltecnicodelpueblo">', $pie4_fb, '</a>';

	
    ?>
    </p>
    
    </td>
  </tr>
</table>
</center>
</body>
</html>