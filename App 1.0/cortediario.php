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




<?php   echo '<title>'; 
		echo $nombresistema;
		echo ', ';
		echo $nombreversion;
		echo '</title>';

 ?>


    
    

<?php
require ("config.php");
require ("funciones.php");
mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$fecha1=$_POST["fecha1"];
$fecha2=$_POST["fecha2"];
$sql = "SELECT * FROM corte WHERE fecha>='".$fecha1."' AND fecha<='".$fecha2."'";
$resultado=mysql_query($sql);



echo '<p align="center"> CORTE DEL DIA '.$fecha1.' al '.$fecha2. '<BR>';
echo '<table  border="1" cellpadding="0" cellspacing="0" align="center" }
bordercolor="#E7E7E7"> ';
echo '<tr class="tabla-encabezado" bordercolor="#E7E7E7">';

echo '    <td class="tabla-encabezado-letra">FECHA</td>';
echo '    <td class="tabla-encabezado-letra">NO. SOL</td>';
echo '    <td class="tabla-encabezado-letra">NO</td>';
echo '    <td class="tabla-encabezado-letra">AHORRO</td>';
echo '    <td class="tabla-encabezado-letra">PAGO</td>';
echo '    <td class="tabla-encabezado-letra">USUARIO</td>';
echo '    <td class="tabla-encabezado-letra">*</td>';

echo '</tr>';

$xahorro=0;
$xpago=0;
$fila = mysql_fetch_array($resultado);
 
		echo '<tr><td class="tabla-text"> ', $fila["fecha"],' </td>';
		echo '<td><a href="estatus2.php?nosol='.$fila["nosol"].'"> '.$fila["nosol"].'</a></td>';
		echo '<td>'.$fila["no"].'</td>';
		echo '<td>'.$fila["ahorro"].'</td>';
		echo '<td>'.$fila["valor"].'</td>';
		echo '<td>'.$fila["usuario"].'</td>';
		echo '<td>'.$fila["comentario"].'</td></tr>';

		$xahorro=$fila["ahorro"];
		$xpago=$fila["valor"];

while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		echo '<tr><td class="tabla-text"> ', $fila["fecha"],' </td>';
		echo '<td><a href="estatus2.php?nosol='.$fila["nosol"].'"> '.$fila["nosol"].'</a></td>';
		echo '<td>'.$fila["no"].'</td>';
		echo '<td>'.$fila["ahorro"].'</td>';
		echo '<td>'.$fila["valor"].'</td>';
		echo '<td>'.$fila["usuario"].'</td>';
        		echo '<td>'.$fila["comentario"].'</td></tr>';

		$xahorro=$xahorro+$fila["ahorro"];
		$xpago=$xpago+$fila["valor"];
		
		}
		echo '<tr><td class="tabla-text"> </td>';
		echo '<td> </td>';
		echo '<td> </td>';
		echo '<td><b>'.number_format($xahorro,2,".",",").'</b></td>';
		echo '<td><b>'.number_format($xpago,2,".",",").'</b></td>';
		echo '<td> </td></tr>';
		
echo '</table>';




echo "</p>";

?>
    
    
    
   


