<?php require ("config.php");
$curp=$_GET["curp"];
			mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
			mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
			  
			
			$result = mysql_query("SELECT * FROM `fotos` WHERE curp='".$curp."'");		
			if($row = mysql_fetch_array($result))
			{
//				
				echo '<img src="img\bien.jpg">';
			}else{//si esta, preraramos la actualizacion
				echo '<img src="img\mal.jpg">';
				# Cogemos el identificador con que se ha guardado
				
			}
?>