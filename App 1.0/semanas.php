<?php

/**
 * @author J.J. Pedraza
 * @copyright 2014
 */
require ("funciones.php");
require ("config.php");




mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());


setlocale(LC_TIME, "es_ES"); 

function WeekToDate ($week, $year) 
{ 
$Jan1 = mktime (1, 1, 1, 1, 1, $year); 
$iYearFirstWeekNum = (int) strftime("%W",mktime (1, 1, 1, 1, 1, $year)); 

if ($iYearFirstWeekNum == 1) 
{ 
$week = $week - 1; 
} 

$weekdayJan1 = date ('w', $Jan1); 
$FirstMonday = strtotime(((4-$weekdayJan1)%7-3) . ' days', $Jan1); 
$CurrentMondayTS = strtotime(($week) . ' weeks', $FirstMonday); 
return ($CurrentMondayTS); 
} 
$iYear = '2014'; 



for ($i = 0; $i <= 52; $i++) { 
    

$sStartTS = WeekToDate ($i, $iYear); 
$sLunes = date ("Y-m-d", $sStartTS); 
list($year,$mon,$day) = explode('-',$sLunes); 
$sDomingo = date('Y-m-d',mktime(0,0,0,$mon,$day+6,$year));     
echo 'Semana: '.$i.'  de  '.$sLunes.' al '.$sDomingo;  
echo '<br>';  


$sql = "INSERT INTO semanas (no, inicio, fin, anio) 
VALUES(
'$i',
'$sLunes',
'$sDomingo',
'$iYear'
)";



if(!mysql_query($sql))//checamos si hay curp
{
	echo '<img src="img\mal.jpg"> NO SE HA creado';
}else{//si esta, preraramos la actualizacion
	//echo '<img src="img\bien.jpg">'.$i.'<br>';	
             
}


     

  
} 
mysql_close();

?>