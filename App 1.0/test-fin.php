
<?php
	$fecha = "21-02-1992";
	
	//	$month = '1992-02';
	$month = date('Y-m',strtotime("$fecha"));
	$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
	$ultimodiadelmes = date('d', strtotime("{$aux} - 1 day"));

echo "fecha: ".$fecha."<br>";			
echo "mes: ".$month."<br>";			
echo "ultimo dia: ".$ultimodiadelmes."<br>";			

?>