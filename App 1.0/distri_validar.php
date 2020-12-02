<?php
require ("config.php");
require ("funciones.php");
mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());

$curp=$_POST["cliente"];
$cantidad=$_POST["cantidad"];		
$nosol=$_POST["nosol"];

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$result = mysql_query("SELECT * 
					FROM distribuciones 
					WHERE nosol = '".$nosol."' AND curp='".$curp."'");
 
//checamos si hay curp
if($row = mysql_fetch_array($result)){//si  hay, preparar la captura
//actualizar
		$sqlx = "UPDATE distribuciones SET distri='".$cantidad."'	WHERE curp='".$curp."' AND nosol='".$nosol."'";
		//		$r=mysql_query($sqlx);
		if(!mysql_query($sqlx)){}else{echo 'Actualizado  correctamente<br><a href="index.php">Regresar al menu</a>';}

}
else{
	
			
		$sql = "INSERT INTO distribuciones (curp, nosol, cantidad) 
		VALUES(
		'$curp',
		'$nosol',
		'$cantidad'
		)";
		if(!mysql_query($sql))//checamos si hay curp
		{
			echo '<img src="img\mal.jpg"> NO SE HA creado';
		}else{//si esta, preraramos la actualizacion
			echo '<img src="img\bien.jpg">Distrubucion creada satisfactoriamente<br>';	
					 
		}
		
	
	
}






		

?>
