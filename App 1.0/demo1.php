<?php

	$curp = "NUEVOddd";
	mysql_connect('localhost','root','admin');
	
	mysql_select_db('misol');
	$result = mysql_query("SELECT *	FROM clientes WHERE curp = '".$curp."'");
	$esta="";
	if($row = mysql_fetch_array($result)){//si se ha encontrado, capturar SOLICITUD			
		$esta="SI";
	
	}else{
		$esta="NO";}
	echo $esta
?>