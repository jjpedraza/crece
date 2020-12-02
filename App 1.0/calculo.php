<?php
require("funciones.php");
$nosol="20140519";
$cantidad=_cantidad($nosol);
$tasainteres=_tasainteres($nosol);
$tasamoratorio=_tasamoratorio($nosol);
$formadepago=forma_de_pago($nosol);
$tasaiva=_ivatipo($nosol);
//	$formadepago=15;
	$plazo=plazo_de_pago($nosol);
	$fvencimiento=date("Y-m-d");

	
	
	$npago = (30/$formadepago) * $plazo;
	echo $npago.'<br>';
	
	$npago=round($npago);
	
	
		echo '<br>numero:'.$npago.'   ---';


	$capital =$cantidad;
	

	$abonoacapital = $capital / $npago;
	$interes = (($capital /100) * $tasainteres); //int mensual
	$interes = $interes * $plazo; //int de todo el plazo
	$interes = $interes / $npago; // int por pago	
	$iva = ((($interes+$abonoacapital) /100))* $tasaiva; // iva sobre el interes
	$pago = $abonoacapital + $interes + $iva; // subtotal pago fijo	
	
	echo '<br>forma:'.$formadepago;
	echo '<br>plazo:'.$plazo;
	echo '<br>npago:'.$pago;
	echo '<br>capital:'.$cantidad;
	echo '<br>tasa interes:'.$tasainteres;
	echo '<br>tasa mora:'.$tasamoratorio;
	echo '<br>abono:'.$abonoacapital;
	echo '<br>int:'.$interes;
	echo '<br>iva:'.$iva;
		echo '<br>pago total:'.$pago;


?>