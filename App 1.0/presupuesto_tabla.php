<link href="css/contrato.css" rel="stylesheet" type="text/css" />
<?php

/**
 * @author gencyolcu
 * @copyright 2014
 */
require ("funciones.php");
require("config.php");

$cantidad=$_GET["cantidad"];
$plazo=$_GET["plazo"];

echo '<img src="img/logotipo.jpg" width="105" height="75" />';
echo '<span class="contrato_titulo" align="center"><b> TARJETA DE CONTROL Y ABONOS SEMANALES</b><br></span>';
echo '<span class="contrato_resaltado" align="center">Tel.de Oficina:  836.274.22.27<br></span>';

echo '</span>';



echo'
<table border="1" cellpadding="1" cellspacing="0" >
<tr bgcolor="#990000" class="tabla_tit">
	<td ><b>No.</b></td>
	<td>Inicio</td>
	<td>Fin</td>
	<td >Saldo</td>
	<td >Abono</td>
	<td>Interes</td>
	<td>Total</td>
	<td >Firma</td>
</tr>
';
//$nodepago =1;
//$saldo=cantidad;
$saldo=$cantidad;
$plazo2=$plazo*4; //semanas
$n=0;
while ($n>=$plazo2)
		{
		echo'<tr class="tabla">';
		echo '<td>'.$n.'</td>';
		echo'<td>'.dia($fila["inicio"]).' '.$fila["inicio"].'</td>';
		echo'<td>'.dia($fila["fin"]).' '.$fila["fin"].'</td>';

		echo'<td>'.number_format($saldo,2,".",",").'</td>';
		$saldo=$saldo-$fila["abono"];
			$plazo=forma_de_pago($nosol); //meses
			$plazo2=$plazo*4; //semanas
			if ($fila["no"]==$plazo2){
				$abono=$abono+$saldo;				
				echo '<td>'.number_format($abono,2,".",",").'</td>';
				}else{
				echo '<td>'.number_format($fila["abono"],2,".",",").'</td>';
				}
		echo '<td>'.number_format($fila["interes"],2,".",",").'</td>';


		$abonof=$fila["abono"]+$fila["interes"];
		echo '<td>'.number_format($abonof,2,".",",").'</td>';
		echo '<td width="100"> </td>';
		echo '</tr>';
    
		}
        


?>