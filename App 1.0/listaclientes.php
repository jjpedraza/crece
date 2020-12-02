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
<?php   echo '<title> BUSCAR CLIENTE '; 
		
		echo '</title>';

 ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/misol1.css" rel="stylesheet" type="text/css" />


</head>
<body  topmargin="0" bottommargin="0">
<center>
<table style="display: inline-table;" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="495">

<tr><td bgcolor="#000000" class="menu1" align="center"><img src="img/home.png" /><a href="index.php"> Regresar al MENU </a></td></tr>

    <td align="left" valign="top">
    
    <p align="center" class="titulo1"> CONSULTA DE CLIENTES</p>




     
<?PHP
require ("config.php");

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());

$sql = "SELECT curp,nombre, estado, domicilio, municipio FROM clientes ";
$resultado=mysql_query($sql);
echo "<center><p>";
echo '<table  align="center" class="t1" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
<tr class="normal2"><td> Foto </td>
	<td> CURP </td>
    <td> Nombre </td>
    <td> Domicilio </td>
<tr>';
while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
	echo '<tr class="t2">';
	echo '<td> <img src="foto_mostrar.php?curp=', $curp,'" width="100" height="80"> </td>';
	echo '<td>', $curp,'</td>';
    echo '<td>', $nombre,'</td>';
    echo '<td>' , $domicilio,' <br/>', $estado,' <br/>', $municipio,' </td>';
	echo '</tr>';
		}
	echo '</table>';

echo "</p></center>";
             


mysql_close();
?>      
      
      
      
    
    
    
    
    
    </td>
  </tr>
  <tr>
    <td <?php echo 'bgcolor="', $tabla, '"' ?>>
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