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
    
    <p align="center" class="titulo1"> LISTA DE SOLICITUDES</p>
    
    
   

<?php
require ("config.php");
require ("funciones.php");
mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$sql = "SELECT curp, nosol, fechasol, valoracion FROM cuentas";
$resultado=mysql_query($sql);


echo '<p align="center">';
echo '<table  border="1" cellpadding="0" cellspacing="0" align="center" }
bordercolor="#E7E7E7"> ';
echo '<tr class="tabla-encabezado" bordercolor="#E7E7E7">';
echo '    <td class="tabla-encabezado-letra">CURP</td>';
echo '    <td class="tabla-encabezado-letra">NOMBRE</td>';
echo '    <td class="tabla-encabezado-letra">No.</td>';
echo '    <td class="tabla-encabezado-letra">FECHA</td>';
echo '    <td class="tabla-encabezado-letra">ESTADO</td>';
echo '</tr>';
while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		echo '  <tr class="tabla-contenido" bordercolor="#E7E7E7"> ';
		echo '    <td class="tabla-text"> ', $curp,' </td>';
		echo '    <td class="tabla-text"> ', nombre($curp),' </td>';
		echo '    <td class="tabla-text"> <a href="solicitud_mostrar.php?nosol='.$nosol.'">',$nosol,'</a></td>';
		echo '    <td class="tabla-text"> ',$fechasol,' </td>';
		if ($valoracion == ""){
			echo '    <td class="tabla-text">PENDIENTE</td>';}else{
			echo '    <td class="tabla-text"> ',$valoracion,' </td>';}
		echo '  </tr>';
		}
echo '</table>';




echo "</p>";

?>
  
  
  
  
  
  
  
  
  
    
    <br />
    
    
    
    
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