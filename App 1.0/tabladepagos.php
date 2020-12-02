
<center>
     <p><img src="img\logotipo.jpg"  width="136" height="58"/>
    
     <BR />
     Aldama, Tamaulipas.     </p>
      <p>PRESUPUESTO<br /><br />
<?php
require ("config.php");
require ("funciones.php");
$cantidad=$_GET["cantidad"];
$plazo=$_GET["plazo"];
//variables para calculo
	$formadepago=7;

	$fvencimiento=date("Y-m-d");
	$npago = (30/$formadepago) * $plazo;
	$capital =$cantidad;
	$tasaiva=16;
	$tasainteres=5;
	$tasamoratorio=15;

	$abonoacapital = $capital / $npago;
	$interes = (($capital /100) * $tasainteres); //int mensual
	$interes = $interes * $plazo; //int de todo el plazo
	$interes = $interes / $npago; // int por pago	
	$iva = ($interes /100)* $tasaiva; // iva sobre el interes
	$pago = $abonoacapital + $interes; // subtotal pago fijo	
	
	echo '	TABLA DE PAGO<br>';	
	echo '<table border=1 cellpadding="3" cellspacing="0"n style="border-collapse:collapse">';
	echo '<tr  bgcolor="#CCCCCC" class="normal">
	<td>Semana </td>
    <td>No de Pago</td>
	<td>Vencimiento</td>
	<td>Saldo </td>
	<td>Abono</td>
	<td>Int('.$tasainteres.'%)</td>
	<td>Retraso</td>
    <td>Total</td>

	
	</<tr>';
	
	$saldo = $capital;
	for ( $n = 1 ; $n <= $npago ; $n ++) 
	{	
		echo '<tr>';
        echo '<td>'._enquesemana($fvencimiento).'</td>';
		echo '<td>'.$n.'<br></td>';
	
        // para crear los pagos aumentando 7 dias para generarlos por semana	
		$fvencimiento = date('Y-m-d', strtotime("$fvencimiento + ".$formadepago." day")); //suma

        // si no es una fecha valida para (LUNES, MARTES O MIERCOLES, aumentar 1 hasta que sea)
            while (_dia_grupo($fvencimiento)=="NO") {		
                    $fvencimiento = date('Y-m-d', strtotime("$fvencimiento + 1day"));
            }
        echo '<td> '.dia($fvencimiento).', '.$fvencimiento.'<br></td>'; 
        
		
		
		echo '<td>'.number_format($saldo,2,".",",").'</td>'.'<td>
		'.number_format($abonoacapital,2,".",",").'</td>'.'<td> '.number_format($interes,2,".",",").'</td>';
		echo '<td></td>'; // retraso
		echo '<td bgcolor="#F2F2F2"><b>'.number_format($pago,2,".",",").'</b></td>';
		$saldo = $saldo - $abonoacapital;
		
		
		
		
		echo '</tr>';
		
		
	}

	echo '</table>';
	
	

?>
</center>
