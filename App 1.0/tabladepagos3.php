<link href="css/contrato.css" rel="stylesheet" type="text/css" />
<?php

/**
 * @author gencyolcu
 * @copyright 2014
 */
require ("funciones.php");
require("config.php");
$nosol=$_GET["nosol"];
$cantidad=$_GET["cantidad"];
$nombre=$_GET["nombre"];

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."'";
$resultado=mysql_query($sql);


echo '<table border="0">';
echo '<tr><td>';
echo '<img src="img/logotipo.jpg" width="80" height="55"  /></td><td>';
echo '<span class="contrato_titulo" align="center"><b><br>TARJETA DE CONTROL Y ABONOS SEMANALES</b><br></span>';
echo '<span class="contrato_resaltado" align="center">Tel.de Oficina:  836.274.22.27<br></span>';

echo '<span class="contrato_texto" align="center">';

echo 'Contrato: '.$nosol. '    ';
//if (_tipodecredito($nosol)=="GRUPO"){
//	echo ''.	_aquegrupoperteneceestecontrato($nosol).'<br>';
//	}
//	else{
//		
//	}
//
echo 'Nombre:'.$nombre.'<br>';
'Localidad y sociedad:'.localidad(_quecurptiene($nosol)).'<br>	</span>';
echo '</td></tr></table>';



echo  '<br>Plazo: '.plazo_de_pago($nosol).' meses,  '.'Forma de pago: '.forma_como($nosol).'<br></span>';



echo'
<table border="1" cellpadding="1" cellspacing="0" >
<tr bgcolor="#990000" class="tabla_tit">
	<td ><b>No.</b></td>
	<td>Inicio</td>
	<td>Fin</td>
	<td >Saldo</td>
	<td >Abono</td>
	<td >Firma</td>
	<td bgcolor="#FFFFFF"></td>
	<td>Saldo Anterior</td>
	<td>Ahorro</td>
	<td> Saldo Actual </td>
	<td>Firma</td>
</tr>
';
//$nodepago =1;
//$saldo=cantidad;
		
		$plazo=plazo_de_pago($nosol); //meses
		$forma=forma_de_pago($nosol);	
		//echo $forma;
		 //semanas
			if ($forma==7){$plazo2=$plazo*4;}
			if ($forma==15){$plazo2=$plazo*2;}
			if ($forma==30){$plazo2=$plazo*1;}
	
//calculo de cantidades
//$cantidad=_cantidad($nosol);
//$interes=($cantidad/100)*_tasainteres($nosol);
//$interes=$interes*plazo_de_pago($nosol);
//$cantidad=$cantidad+$interes;
$abonof=$cantidad/$plazo2;
//$abonof=$abonof+0.6;
//$abonof=round($abonof);


$saldo=$cantidad;
$cv=0;
while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);    
		echo'<tr class="tabla">';
		echo '<td>'.$fila["no"].'</td>';
		echo'<td>'.dia($fila["inicio"]).' '.$fila["inicio"].'</td>';
		echo'<td>'.dia($fila["fin"]).' '.$fila["fin"].'</td>';

		echo'<td>'.number_format($saldo,2,".",",").'</td>';
		$saldo=$saldo-$abonof;
			$plazo=forma_de_pago($nosol); //meses
			$plazo2=$plazo*4; //semanas
            
                $cv=$cv+$abono;
        
        if ($fila["no"]==_cuantospagos($nosol)){ // lleva -1 porq no alcanza a llegar al ultimo
        echo '<td>';
            $d = $abonof + $saldo; 
           echo '<b>'.number_format($d,2,".",",").'</B>';
         echo '</td>';}else{
		echo '<td><b>'.number_format($abonof,2,".",",").'</b></td>';}    
            
		//echo '<td>'.number_format($abonof,2,".",",").'</td>';
//		echo '<td>'.number_format($fila["interes"],2,".",",").'</td>';


	//	$abonof=$fila["abono"]+$fila["interes"];
		
//		echo '<td>'.number_format($abono,2,".",",").'</td>';
echo '<td width="100"> </td>';
		echo '<td width="10"> </td>';
		echo '<td width="100"> </td>';
		echo '<td width="70"> </td>';
		echo '<td width="80"> </td>';
		echo '<td width="100"> </td>';
		
		echo '</tr>';
    
		}
        


?>