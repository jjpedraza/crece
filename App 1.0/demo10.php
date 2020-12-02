<?php
require ("funciones.php");

	mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$nosol="201504339";
	$n="1";
	$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."' AND no='".$n."'";
	$resultado=mysql_query($sql);
	$fila = mysql_fetch_array($resultado);
	
	$semanadelpago= $fila["semana"];
	
		
	$aniodelpago = substr($fila["vencimiento"],0,4);
	$anioaactual=date("Y");
	$semanaactual=_enquesemana(date("Y-m-d"));
	//echo 'año delpago'.$aniodelpago;
	//pero si esta fuera del año, necesitamos la diferencia de semanas con respecto alfin del año
	if ($anioaactual>$aniodelpago){
		$semanashastafindeanio=52-$semanadelpago;
		$diferenciaanio=$anioaactual-$aniodelpago;
		if ($diferenciaanio==1){
			$semanaactual=_enquesemana(date("Y-m-d")) + $semanashastafindeanio;			
			}
		if($diferenciaanio>=2){
			$semanasdemasanios=(($diferenciaanio - 1)*52);
			echo $semanasdemasanios;
			$semanaactual=_enquesemana(date("Y-m-d")) + $semanashastafindeanio + $semanasdemasanios;
						
			// semanaactua=		
			
			}
		}		
	else
	{	
	$semanaactual=_enquesemana(date("Y-m-d"));
		}
	$semanasquedebe=$semanaactual-$semanadelpago;
	echo 'semanadelpago:'.$semanadelpago.'<br>';
	echo 'semanaactual:'.$semanaactual.'<br>';
	echo 'debe ' .$semanasquedebe.' semanas';
?>