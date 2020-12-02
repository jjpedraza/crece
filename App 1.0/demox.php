<?PHP
require("config.php");
require("funciones.php");

			mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
			mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
			$curp='NUEVO';
			$sql = 'SELECT * FROM cuentas WHERE curp="'.$curp.'"';
				echo $sql;
				$re=mysql_query($sql);
			
					while ($f = mysql_fetch_array($re)){
					extract($f);				
					if (_debevencidos($f["nosol"])>0){echo '<img src="img\mal.jpg">';}
					else{echo '<img src="img\bien.jpg">';}
					echo ' <a href="estatus2.php?nosol='.$f["nosol"].'">'.$f["nosol"].'</a></span>';
				
						}

?>