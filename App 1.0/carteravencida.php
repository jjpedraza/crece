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
    <td align="center" valign="top">
    <span class="titulo" > Lista de Creditos vencidos</span><br />
    
    

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
echo '    <td class="tabla-encabezado-letra"></td>';
echo '    <td class="tabla-encabezado-letra">CURP</td>';
echo '    <td class="tabla-encabezado-letra">NOMBRE</td>';
echo '    <td class="tabla-encabezado-letra">No.</td>';
echo '    <td class="tabla-encabezado-letra">FECHA</td>';

echo '</tr>';

$fila = mysql_fetch_array($resultado);
if (_debevencidos($fila["nosol"])>0){
		echo '  <tr class="tabla-contenido" bordercolor="#E7E7E7"> ';
		echo '    <td class="tabla-text">';
		echo '<a href="caja_v2.php?nosol='.$fila["nosol"].'">';
		echo '<img border="0" src="img\mal.jpg"></a>'; 
		echo _debevencidos($fila["nosol"]);


		echo '    </td>'; 
		echo '    <td class="tabla-text"> ', $fila["curp"],' </td>';
		echo '    <td class="tabla-text"> ', nombre($fila["curp"]),' </td>';
		if (_valoracion($fila["nosol"])=="APROBADO"){
			echo '    <td class="tabla-text"> <a href="estatus2.php?nosol='.$fila["nosol"].'">',$fila["nosol"],'</a></td>';
		}else{
			echo '    <td class="tabla-text"> ',$fila["nosol"],'</td>';
		}echo '    <td class="tabla-text"> ',$fila["fechasol"],' </td>';
		
		echo '  </tr>';}

while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		if (_debevencidos($nosol)>0){
        if (_debealguno($nosol)>0){
		echo '  <tr class="tabla-contenido" bordercolor="#E7E7E7"> ';
		echo '    <td class="tabla-text">';
		echo '<a href="caja_v2.php?nosol='.$fila["nosol"].'">';				
		echo '<img src="img\mal.jpg"></a>'; 
		echo _debevencidos($fila["nosol"]);


		echo '    </td>'; 
		echo '    <td class="tabla-text"> ', $curp,' </td>';
		echo '    <td class="tabla-text"> ', nombre($curp),' </td>';
		if (_valoracion($nosol)=="APROBADO"){
			echo '    <td class="tabla-text"> <a href="estatus2.php?nosol='.$nosol.'">',$nosol,'</a></td>';
		}else{
			echo '    <td class="tabla-text"> ',$nosol,'</td>';
		}echo '    <td class="tabla-text"> ',$fechasol,' </td>';
		
		echo '  </tr>';}}
		}
echo '</table>';




echo "</p>";

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