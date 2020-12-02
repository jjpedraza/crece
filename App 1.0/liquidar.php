<link href="css/contrato.css" rel="stylesheet" type="text/css" />
<?php

require ("funciones.php");
require("config.php");
$nosol=$_GET["nosol"];

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."'";
$resultado=mysql_query($sql);
echo '<table border="0">';
echo '<tr><td>';
echo '<form action="liquidar_valida.php" method="post">';

echo '<img src="img/logotipo.jpg" width="80" height="55"  /></td><td>';
echo '<span class="contrato_titulo" align="center"><b><br>LIQUIDACION DEL PRESTAMO</b><br></span>';
echo '<span class="contrato_texto" align="center">';

echo 'Contrato: <input name="nosol" value="'.$nosol. '"> ('._tipodecredito($nosol).')   ';
if (_tipodecredito($nosol)=="GRUPO"){
	echo ''.	_aquegrupoperteneceestecontrato($nosol).'<br>';
	}
	else{
		
	}

echo 'Nombre:'._nombre($nosol).'<br>';
'Localidad y sociedad:'.localidad(_quecurptiene($nosol)).'<br>	</span>';
echo '</td></tr></table>';



//$nodepago =1;
//$saldo=cantidad;}
$X_queda=0;
$X_recargos=0;
$X_extra=0;

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

$cv=0; // las ocupo para
$d=0; // los ajustes
$na=0;// del ultimo pago

while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);    
       
        $cv=$cv+$abono;	
        $saldo=$saldo-$abonof;
        if ($fila["no"]==_cuantospagos($nosol)){ // lleva -1 porq no alcanza a llegar al ultimo
        	    $d = $abonof + $saldo; 
            	}else{}

		if ($fila["estado"]<>"X"){$X_queda=$X_queda+$abonof;}

		//calculo de semanas de recargo
		$hoy=date("Y-m-d");	
		$debe=0;	
		if ($fila["fin"]<=$hoy){
			$dias_diferencia=diasvencidos($fila["fin"]);
			$semanas=round($dias_diferencia/7);
			if ($semanas<=0){$semanas=0;}
			if (_dia_grupo($hoy)=="SI"){}else{
				$semanas=$semanas+1;	
				}
				
					if (_tipodecredito($nosol)=="INDIVIDUAL"){
					$debe=$semanas*_cargo($nosol);
					if (_estado($nosol,$fila["no"])<>"X"){$X_recargos=$X_recargos+$debe;}
					}
					else{
					$debe=$semanas*(_cargo($nosol)*(_cuantosgrupo(_aquegrupoperteneceestecontrato($nosol))));
					if (_estado($nosol,$fila["no"])<>"X"){$X_recargos=$X_recargos+$debe;}}						
					
				
						
					if ($debe>0){
						if (_estado($nosol,$fila["no"])=="X"){echo'<td>  ';
						}else{
						}
					}else{
					}
							
		}else{
			}
		

        $cv=$cv+$abono;
        if ($fila["no"]==_cuantospagos($nosol)){ // lleva -1 porq no alcanza a llegar al ultimo

        $abonof = $abonof + $saldo ; 
		}else{
		}
		
		if (_estado($nosol,$fila["no"])=="X"){}
		
		$ahorrof=$ahorrof+$fila["ahorro"];
		if ($fila["estado"]<>"X"){
				if ($fila["fin"]<=$hoy){		
                $grant=$grant+ _cuantosextras($fila["nosol"],$fila["no"],"no");
				$X_extra=$X_extra+$grant;}}
				
		
		if (_cuantosextras($fila["nosol"],$fila["no"],"no")<=0){}else{		
		}     
		}
        
echo '<br><br>';
echo 'Queda del prestamo: <input name="queda" value="'.number_format($X_queda,2,".",",").'"><br>';
echo 'Cuenta con recargos: <input name="recargos" value="'.number_format($X_recargos,2,".",",").'"><br>';
echo 'y cargos extraordinarios: <input name="extras" value="'.number_format($X_extra,2,".",",").'"><br>';
echo '<br><input type="submit" name="guardar" 
						  id="guardar" value="LIQUIDAR" /></form>';

?>