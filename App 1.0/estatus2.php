<link href="css/contrato.css" rel="stylesheet" type="text/css" />
<?php

/**
 * @author gencyolcu
 * @copyright 2014
 */
require ("funciones.php");
require("config.php");
$nosol=$_GET["nosol"];

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."'";
$resultado=mysql_query($sql);
echo '<table border="0">';
echo '<tr><td>';
echo '<img src="img/logotipo.jpg" width="80" height="55"  /></td><td>';
echo '<span class="contrato_titulo" align="center"><b><br>ESTADO DEL PRESTAMO</b><br></span>';
echo '<span class="contrato_texto" align="center">';

echo 'Contrato: '.$nosol. ' ('._tipodecredito($nosol).')   ';
if (_tipodecredito($nosol)=="GRUPO"){
	echo ''.	_aquegrupoperteneceestecontrato($nosol).'<br>';
	}
	else{
		
	}

echo 'Nombre:'._nombre($nosol).'<br>';
'Localidad y sociedad:'.localidad(_quecurptiene($nosol)).'<br>	</span>';
echo '</td></tr></table>';


echo'
<table border="1" cellpadding="1" cellspacing="0" >
<tr bgcolor="#990000" class="tabla_tit">
	<td ><b>No.</b></td>
	<td>Inicio</td>
	<td>Fin</td>
	<td >Saldo</td>
	<td >Abono</td>
	<td>Recargos</td>
	<td>Total</td>
	<td ></td>
	<td bgcolor="#FFFFFF"></td>
	<td>Ahorro</td>
	<td bgcolor="#FFFFFF"></td>
	<td>Cargos extraordinarios</td>

</tr>
';
//$nodepago =1;
//$saldo=cantidad;
$cantidad=0;
$saldo=_cantidad($nosol);
$interesf = ($saldo/100)*_tasainteres($nosol);
$interesf= $interesf * plazo_de_pago($nosol);
$cantidad=$saldo + $interesf;
		$forma=forma_de_pago($nosol);	
		//echo $forma;
		$plazo=plazo_de_pago($nosol); //meses
		 //semanas
		 $x=0;
			if ($forma==7){$x=4;}
			if ($forma==15){$x=2;}
			if ($forma==30){$x=1;}

$abonof=$cantidad/(plazo_de_pago($nosol)*$x);
//$abonof=$abonof+.6;
//$abonof=round($abonof);
$saldo=$cantidad;
$grant=0;
$ahorrof=0;

$xtotal=0;
$xahorro=0;

$cv=0; // las ocupo para
$d=0; // los ajustes
$na=0;// del ultimo pago

while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);    
		echo'<tr class="tabla">';
		echo '<td>'.$fila["no"].'</td>';
		echo'<td>'.dia($fila["inicio"]).' '.$fila["inicio"].'</td>';
		echo'<td>'.dia($fila["fin"]).' '.$fila["fin"].'</td>';

		echo'<td>'.number_format($saldo,2,".",",").'</td>';
        
        $cv=$cv+$abono;	
        $saldo=$saldo-$abonof;
        if ($fila["no"]==_cuantospagos($nosol)){ // lleva -1 porq no alcanza a llegar al ultimo
        echo '<td>';
            $d = $abonof + $saldo; 
            
           echo number_format($d,2,".",",");
         echo '</td>';}else{
		echo '<td><b>'.number_format($abonof,2,".",",").'</b></td>';}
		
        
		//echo'<td>'.number_format($abonof,2,".",",").'</td>';

	
				

		//calculo de semanas de recargo
		$hoy=date("Y-m-d");	
		$debe=0;	
		if ($fila["fin"]<$hoy){
			$dias_diferencia=diasvencidos($fila["fin"]);
			$semanas=round($dias_diferencia/7);
			if ($semanas<=0){$semanas=0;}
			
			
//			if (_dia_grupo($hoy)=="SI"){
//				//				
//				if ($semanas>=2){$semanas=$semanas+1;
//				}			
//			}else{$semanas=$semanas+1;}
				
				
			//si esta vencido el pago, cobrale la semana actual +1
			if (_vencidono($fila["nosol"],$fila["no"]) == 1) {
				$semanas=$semanas+1;
				//echo _vencidono($fila["nosol"],$fila["no"]);
				}

			//--------------
			if (_tipodecredito($nosol)=="INDIVIDUAL"){
						
						if (forma_de_pago($nosol)=="15"){
							
							$semanas = $semanas -1;
							$debe= $semanas*_cargo($nosol);
							$debe = $debe + 60;
								
							}
							else {
						
						
							$debe=$semanas*_cargo($nosol);
							}
					}
					else{
					$debe=$semanas*(_cargo($nosol)*(_cuantosgrupo(_aquegrupoperteneceestecontrato($nosol))));}						
						if ($debe>0){
						if (_estado($nosol,$fila["no"])=="X"){echo'<td>  
							</td>'; }else{
						echo'<td> ('.$semanas.' sem.)'.number_format($debe,2,".",",").'</td>';
						}
					}else{
						echo'<td>  </td>';
					}
							
		
		
		
		
		}else{
					echo'<td>  </td>';
		}
		

        $cv=$cv+$abono;
        if ($fila["no"]==_cuantospagos($nosol)){ // lleva -1 porq no alcanza a llegar al ultimo
        echo '<td>';
        $abonof = $abonof + $saldo ; 
           echo '<b>'.number_format($abonof,2,".",",").'</b>';
         echo '</td>';}else{
		echo '<td><b>'.number_format($abonof,2,".",",").'</b></td>';}
		
        
        
        
        
        echo '<td>';
		
		if (_estado($nosol,$fila["no"])=="X"){echo'	<img src="img\bien.jpg">';}
		
		$ahorrof=$ahorrof+$fila["ahorro"];
		
		echo '<td width="20"></td>';
		
		echo '<td>'.number_format($fila["ahorro"],2,".",",").'</td>';
		
		
		echo ' </td>';
		
		if ($fila["estado"]<>"X"){
				if ($fila["fin"]<=$hoy){		
                $grant=$grant+$abonof+$debe+ _cuantosextras($fila["nosol"],$fila["no"],"no");}}
				
       echo '<td>';
	   
	   echo '</td>';		


	   	echo '<td>';		
	   	echo _cuantosextras($fila["nosol"],$fila["no"],"no");
		
		if (_cuantosextras($fila["nosol"],$fila["no"],"no")<=0){}else{		
			echo '<span class="contrato_leyedas">('._cuantosextras($fila["nosol"],$fila["no"],"SI").')</span>';
		}
		echo '</td>';


		echo '</tr>';
    
		}
        
echo '<br><br>';
echo '<B>DEBE en Total : $'.number_format($grant,2,".",",").'</b> y un ahorro de '.$ahorrof;

?>