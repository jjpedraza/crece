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
    
    
<form name="configurargrpo" method="POST" action="grupo_configurar_validar.php">

<p align="center" class="t1"><b>CONFIGURAR GRUPO</b></p>    
Nombre del grupo:<br />
<?php
require("funciones.php");
$grupo=$_GET["grupo"];    

mysql_connect($servidor, $usuario, $clave);
mysql_select_db($basededatos);

if(_grupo_esta($grupo)=="SI"){
		echo  '<input name="grupo" readonly="readonly" value="'.$grupo.'"><br>';
		echo 'Seleccione los cargos para el grupo:<br><br>';
		echo 'PRESIDENTE:<BR>';
		echo '<select name="presidente">';		
			$sql = "SELECT * FROM clientes WHERE grupo='".$grupo."'";
			$resultado=mysql_query($sql);
			while ($fila = mysql_fetch_array($resultado))
				{
				extract($fila);
				echo '<option value="'.$fila["curp"].'">'.$fila["nombre"].'</option>';
				}
		echo '</select><br><br>';
		
		
		echo 'SECRETARIO:<BR>';
		echo '<select name="secretario">';		
			$sql = "SELECT * FROM clientes WHERE grupo='".$grupo."'";
			$resultado=mysql_query($sql);
			while ($fila = mysql_fetch_array($resultado))
				{
				extract($fila);
				echo '<option value="'.$fila["curp"].'">'.$fila["nombre"].'</option>';
				}
		echo '</select><br><br>';
		
		echo 'TESORERO:<BR>';
		echo '<select name="tesorero">';		
			$sql = "SELECT * FROM clientes WHERE grupo='".$grupo."'";
			$resultado=mysql_query($sql);
			while ($fila = mysql_fetch_array($resultado))
				{
				extract($fila);
				echo '<option value="'.$fila["curp"].'">'.$fila["nombre"].'</option>';
				}
		echo '</select><br><br>';
		echo'<input type="submit" name="button" id="button" value="Guardar" />';

	}



?>
      
</form>













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