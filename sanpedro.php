<?php	include("config/html_head.php"); ?>


<?php //BARRA DE MENU
include("config/html_menu.php"); ?>

<?php
$id_aplicacion='ap1'; $nivel = aplicacion_nivel($id_aplicacion, $nuc);	
if (sanpedro($id_aplicacion,$nuc)==TRUE){
	if (isset($_GET['x'])){ //usario seleccionado

		if (isset($_GET['x'])){//GUARDAR
		echo "<p>Seleccione los parametros necesarios para otorgar acceso a <b>".nuc_nombre($nuc)."</b> </p>";
			echo "<form action='sanpedro.php' method='get'>";
			echo "<input type='text' name='nuc' placeholder='Username o NUC' readonly='readonly' value='".$_GET['x']."'>";
			echo "<input type='hidden' name='x' value='".$_GET['x']."'>";
				$sql = "SELECT * FROM aplicaciones where version > 0";
				$r3= $conexion -> query($sql);
				echo "<select name='idap' required>";				
				echo "<option value='' >Seleccione una aplicacion </option>";
				while($ap = $r3 -> fetch_array())
				{
					echo "<option value='".$ap['idapp']."'>".$ap['nombre']."</option>";
				}
					
				echo "</select>";
					

				$sql = "SELECT * FROM aplicaciones_nivelusuario";
				$r4= $conexion -> query($sql);
				echo "<select name='nivel' required>";				
				echo "<option value='' >Seleccione un nivel</option>";
				echo "<option value='0'>Sin Acceso</option>";
				while($apn = $r4 -> fetch_array())
				{
					echo "<option value='".$apn['id']."'>".$apn['modo']."</option>";
				}
					
				echo "</select>";
				

			echo "<input type='submit' name='submit_ap' value='Aceptar' class='btn btn-default'>";


			echo "</form>";

			if (isset($_GET['submit_ap'])){				
			echo "listo ";

				if ($_GET['nivel']=='0'){//update del permiso
					$sql = "DELETE FROM aplicaciones_permisos WHERE (nuc='".$_GET['nuc']."' AND idapp='".$_GET['idap']."')";
				$rc= $conexion -> query($sql);
				historia($nuc,"Elimino un permiso (".$sql.")");	
				mensaje("Se eliminaron los permisos correctamente",'','');
				} else {

					$sql = "SELECT * FROM aplicaciones_permisos WHERE (nuc='".$_GET['nuc']."' AND idapp='".$_GET['idap']."')";
					//echo $sql;
					$rcx= $conexion -> query($sql);				
					if($fx = $rcx -> fetch_array()){ // SE ENCONTRARON PERMISOS Y SE ACTUALIZARON
						$sql="UPDATE aplicaciones_permisos SET 
						nivel='".$_GET['nivel']."', 
						quien_autorizo='".$nuc."', 
						fecha_autorizacion='".$fecha."'						
						WHERE (nuc='".$_GET['nuc']."' AND idapp='".$_GET['idap']."')";
						if ($conexion->query($sql) == TRUE){
							historia($nuc,"Actualizo un permiso (".$sql.")");
							mensaje("Permiso actualizado con exito",'','');
						}else {mensaje("Ha habido un problema al actualizar los permisos",'','');}

					} else {// AGREGAR UN PERMISO NUEVO

					$sql = "INSERT INTO aplicaciones_permisos(nuc, idapp, nivel, quien_autorizo, fecha_autorizacion)
					VALUES ('".$_GET['nuc']."', '".$_GET['idap']."', '".$_GET['nivel']."', '".$nuc."','$fecha')";
					echo $sql;
						if ($conexion->query($sql) == TRUE){
							historia($nuc,"Creo un permiso (".$sql.")");
							mensaje("Permiso creado exitosamente",'','');
						}


					}



				}


			}

		}

	} else {
	if (isset($_GET['q'])){	//ejecutamos la consulta
		$sql = "SELECT * FROM empleados WHERE nombre like'%".$_GET['q']."%' ";
		$r2= $conexion -> query($sql);
		echo "<h3>Resultados de <b style='color: #2A2C2E;'>".$_GET['q']."</b>:</h3>";
		echo "<table class='tabla'>";
		$c=0;
		while($fr = $r2 -> fetch_array())
		{
			echo "<tr>";
			echo "<td>".$fr['nuc']."</td>";
			echo "<td>".$fr['nombre']."</td>";
			echo "<td width=50px>"; //acciones
				echo "<a class='btn btn-default' href='?x=".$fr['nuc']."' style='text-decoration:none '>Seleccionar</a>";
			echo "</td>";

			echo "</tr>";
			$c = $c +1 ;

		}
		echo "</table>";				
	}
	else {//ponemos la opcion para buscar
		echo "<div style='margin-top: 200px;  		'>";
		buscar('sanpedro.php','Escriba el nombre del empleado');
		echo "</div>";


	}
	}



}else {mensaje("Acceso denegado a esta aplicacion",'','error');}

?>
<?php include("config/html_footer.php"); ?>	