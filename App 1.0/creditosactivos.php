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
    <span class="titulo" > Lista de prestamos</span><br />
    
    

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

echo '</tr>';
$fila = mysql_fetch_array($resultado);
 if ( _debevencidos($fila["nosol"])>0)
		{
   		echo '<tr id="caj" colspan="5" background="img/_rojo.jpg" align="center">';
	   }
	else{
		
   		echo '<tr id="caj" colspan="5" background="img/_verde.jpg" align="center">';
	   }
		//echo '  <tr class="tabla-contenido" bordercolor="#E7E7E7"> ';
		

		echo '    <td class="tabla-text"> ', $fila["curp"],' </td>';
		echo '    <td class="tabla-text"> <b>', nombre($fila["curp"]),'</b><br>';
		if (_tipodecredito($fila["nosol"])=="INDIVIDUAL"){
			echo 'INDIVIDUAL';
			}else{
			echo 'GRUPO:'._aquegrupopertenece($fila["curp"]).' </td>';}
		
		if (_valoracion($fila["nosol"])=="APROBADO"){
			echo '    <td class="tabla-text">
			<a href="caja_v2.php?nosol='.$fila["nosol"].'">'.'
			<img src="img\pagar.jpg"></a> 
			
			<a href="tabladepagos2.php?nosol='.$fila["nosol"].'">'.'
			<img src="img\tabla.jpg"></a> 
			
			<a href="contrato.php?nosol='.$fila["nosol"].'">'.'
			<img src="img\contrato.jpg"></a> 
			
			<a href="liquida.php?nosol='.$fila["nosol"].'">'.'
			<img src="img\g.jpg"></a> 
			
			<a href="liquidar.php?nosol='.$fila["nosol"].'">'.'
			<img src="img\l.jpg"></a> 
			
			<a href="solicitud_mostrar.php?nosol='.$fila["nosol"].'">'.'
			<img src="img\sol.jpg"></a> 			
			<a href="socioeconomico_mostrar.php?curp='.$fila["curp"].'">'.'
			<img src="img\soc.jpg"></a>	
			<a href="estatus2.php?nosol='.$fila["nosol"].'"><img src="img\e.jpg" border="0"></a><BR>',$fila["nosol"],'</td>';
		}else{
			echo '    <td class="tabla-text">	 ',$fila["nosol"],'</td>';
		}
		
		
		echo '    <td class="tabla-text"> ',$fila["fechasol"],' </td>';

		echo '  </tr>';

while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		//debe algunoo,para queno salgan los queya sepagaron
        if (_debealguno($nosol)>0){
			
	   if ( _debevencidos($nosol)>0)
		{
   		echo '<tr id="caj" colspan="5" background="img/_rojo.jpg" align="center">';
	   }
	else{
		
   		echo '<tr id="caj" colspan="5" background="img/_verde.jpg" align="center">';
	   }
	//	echo '  <tr class="tabla-contenido" bordercolor="#E7E7E7"> ';
		
		echo '    <td class="tabla-text"> ', $curp,' </td>';
		echo '    <td class="tabla-text"> <b>', nombre($fila["curp"]),'</b><br>';
		if (_tipodecredito($fila["nosol"])=="INDIVIDUAL"){
			echo 'INDIVIDUAL';
			}else{
			echo 'GRUPO:'._aquegrupopertenece($fila["curp"]).' </td>';}
		if (_valoracion($nosol)=="APROBADO"){
			echo '    <td class="tabla-text">
			<a href="caja_v2.php?nosol='.$nosol.'">'.'
			<img src="img\pagar.jpg"></a> 
			
			<a href="tabladepagos2.php?nosol='.$nosol.'">'.'
			<img src="img\tabla.jpg"></a> 
			
			<a href="contrato.php?nosol='.$fila["nosol"].'">'.'
			<img src="img\contrato.jpg"></a> 
			
			<a href="liquida.php?nosol='.$fila["nosol"].'">'.'
			<img src="img\g.jpg"></a> 

			<a href="liquidar.php?nosol='.$fila["nosol"].'">'.'
			<img src="img\l.jpg"></a> 
			<a href="solicitud_mostrar.php?nosol='.$fila["nosol"].'">'.'
			<img src="img\sol.jpg"></a> 	
			<a href="socioeconomico_mostrar.php?curp='.$fila["curp"].'">'.'
			<img src="img\soc.jpg"></a>					
			<a href="estatus2.php?nosol='.$nosol.'"><img src="img\e.jpg" border="0"></a><br>'.$nosol.'</td>';
		}else{
			echo '    <td class="tabla-text">	 ',$nosol,'</td>';
		}
		
		echo '    <td class="tabla-text"> ',$fechasol,' </td>';
		
		echo '  </tr>';}
		}
echo '</table>';


echo '<br><br><p align="left">';
echo '<img src="img\pagar.jpg"> PAGAR <br> 
	<img src="img\tabla.jpg"> TABLA DE CONTROL <br> 
	<img src="img\contrato.jpg">CONTRATO<br> 
	<img src="img\E.jpg"> ESTADO<br> 
	<img src="img\g.jpg"> Recibo de Garantia Liquida<br> 
		<img src="img\l.jpg"> Liquidacion<br></p> ';

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