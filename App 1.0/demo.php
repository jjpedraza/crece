<?php
//$numero = 15200.67;
//echo '$ '.number_format($numero,2);
// 
require ("config.php");
require ("funciones.php");

//$dias = 2;
//$fechadeinicio= date("Y-m-d");
//$nuevafecha = date('Y-m-d', strtotime("$fechadeinicio + ".$dias." day"));
//echo $fechadeinicio.'<br>';
//echo $nuevafecha.'<br>';


//setlocale(LC_ALL, 'es_MX'); 

//echo strftime("%A %d de %B del %Y");
//echo strftime("%A %d de %B del %Y");
//echo date("Y", $date); // Year (2003)
//echo date("m", $date); // Month (12)
//echo date("d", $date); // day (14)

//echo 'fecha dia'.fecha_dia(date("Y-m-d"));






$fecha=date("2014-02-18");
echo 'La fecha '.$fecha.' esta en la semana '._enquesemana($fecha).'    <br>';



 ?>