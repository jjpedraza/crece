<link href="css/contrato.css" rel="stylesheet" type="text/css" />
<?php

/**
 * @author gencyolcu
 * @copyright 2014
 */
require ("funciones.php");
$fecha=date("Y-m-d");
$n=0;

$cantidad=$_GET["cantidad"];
$plazo=$_GET["plazo"];

$plazo2=$plazo*4; //semanas
$tasainteres=5;
$tasamoratorio=1.19;


$interes=($cantidad/100)*$tasainteres;
$cantidad =$cantidad+$interes;
$abono=$cantidad/$plazo2;
$abono=$abono;
//$interes=$interes/$plazo2;
//$abonofinal=$abono+$interes;

echo 'PRESUPUESTO DE PRESTAMO<BR>';
echo '<br> Cantidad: '.$cantidad.', incluye el 5% de interes';

echo'
<table border="1" cellpadding="1" cellspacing="0" >
<tr bgcolor="#990000" class="tabla_tit">
	<td ><b>No.</b></td>
	<td>Inicio</td>
	<td>Fin</td>
	<td >Saldo</td>
	<td >Abono</td>
	

</tr>
';
$nodepago =1;
$saldo=$cantidad;

$cv=0; // las ocupo para
$d=0; // los ajustes
$na=0;// del ultimo pago

while($n<$plazo2){
    $fecha = date('Y-m-d', strtotime("$fecha + 1day"));
    
    if (dia($fecha)=="Lunes"){
		echo'<tr class="tabla">';
			echo '<td>'.$nodepago.'</td>';
		
		// fechas de vencimiento deLun a Mie
			$finicio=$fecha;
			echo '<td >'.dia($fecha).', '.$fecha.'</td>';
			
			$fecha = date('Y-m-d', strtotime("$fecha + 2day"));
			$ffin=$fecha;
			 echo '<td >'.dia($fecha).', '.$fecha.'</td>';
			 $nodepago= $nodepago+1;
		
		echo '<td>'.number_format($saldo,2,".",",").'</td>';
		$saldo=$saldo-$abono;
		
	   $cv=$cv+$abono;
       if ($n==($plazo2-1)){ // lleva -1 porq no alcanza a llegar al ultimo
        echo '<td>';
            $d=$cv-$cantidad; // diferencia
            //echo 'diferencia: '.$d.'<br>';
            $na = $abono - $d;
            echo $na;
        
        
       
        echo '</td>';
		
       }else{
        echo '<td>'.$abono.'</td>';
		
       }

		
		echo '</tr>';
    $n=$n+1;
		}
        

}

?>