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
    <td width="800" align="center" valign="top">
      <p><span class="titulo" > VENCIMIENTOS DEL DIA DE HOY</span></p>



<?php
require ("config.php");
require ("funciones.php");
mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$hoy=date("Y-m-d");	
$sql = "SELECT * FROM tabladepagos  WHERE fin='".$hoy."'";
//echo $sql;
$resultado=mysql_query($sql);
echo '<p class="normal2">';
echo '<b>HOY SE LES VENCE: </b><BR>';

while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		if ($fila["estado"]<>"X"){
		echo '<a href="estatus2.php?nosol='.$fila["nosol"].'">'.$fila["nosol"].'</a> No.'. $fila["no"].' de <b>'._nombre($fila["nosol"]).'</b><br>			';
		echo 'Tel: '.telefono($fila["curp"]).'<br><br>';
		}
		}
		echo '</p><BR>';







?>






      <p>&nbsp;</p>
      <p><br />
    </p></td>
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