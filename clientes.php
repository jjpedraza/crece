<?php	include("config/html_head.php"); ?>


<?php //BARRA DE MENU
include("config/html_menu.php"); ?>

<?php
$id_aplicacion='ap3'; $nivel = aplicacion_nivel($id_aplicacion, $nuc);
if (sanpedro($id_aplicacion,$nuc)==TRUE){
if (isset($_GET['nuevo'])){ //usario seleccionado
echo "cliente nuevo";
			echo "<form action='clientes.php' method='get'>";
			echo "<input name='nuevo' type='hidden' value=''>";
			echo "<div><label>CURP: </label><input type='text' name='curp' value='' placerholder='CURP'></div>";
			echo "<div><label>Nombre del cliente:</label><input type='text' name='nombre' value=''></div>";
			echo "<div><label>Fecha de Nacimiento:</label><input type='date' name='nacimiento' value=''></div>";
			echo "<div><label>Domicilio: </label><input type='text' name='domicilio' value=''></div>";
			echo "<div><label>Municipio</label><input type='text' name='municipio' value=''></div>";
			echo "<div><label>Estado</label><input type='text' name='estado' value=''></div>";
			echo "<div><label>IFE:</label><input type='text' name='IFE' value=''></div>";
			echo "<div><label>Telefono</label><input type='text' name='telefono' value=''></div>";
			echo "<div><input type='submit' name='submit_nuevo' value='Guardar' class='btn btn-default'></div>";

			echo "</form>";

			if (isset($_GET['submit_nuevo'])){//guardar actualizacion
				$sql = "INSERT INTO clientes
				(curp, nombre, ife, domicilio, municipio, estado, telefono, fechadenacimiento)
			VALUES
				('".$_GET['curp']."', '".$_GET['nombre']."', '".$_GET['IFE']."', '".$_GET['domicilio']."', '".$_GET['municipio']."
				', '".$_GET['estado']."', '".$_GET['telefono']."', '".$_GET['nacimiento']."')";
			if ($conexion->query($sql) == TRUE) {
					historia($nuc,"Creo nuevo cliente ".$_GET['nombre'].", CURP: ".$_GET['curp']);
					mensaje('Cliente nuevo, registrado correctamente','clientes.php?x='.$_GET['curp'],'');
				}else
				{
					historia($nuc, "ERROR: al intentar guardar cliente nuevo ".$sql);
					mensaje('Ha habido un error'.$sql,'index2.php','error');
				}
			}

} else {

	if (isset($_GET['x'])){ //usario seleccionado
		//echo "Se ha seleccionado, cliente con CURP: <b> ".$_GET['x']."</b>";
		$sql = "SELECT * FROM clientes WHERE curp='".$_GET['x']."'";
		$rc= $conexion -> query($sql);
		if($cl = $rc -> fetch_array())
		{//mostrar pantalla para actualizar datos del cliente
			echo "<form action='clientes.php' method='get'>";
			echo "<input name='x' type='hidden' value='".$_GET['x']."'>";
			echo "<div><label>CURP: </label><input type='text' name='curp' readonly value='".$cl['curp']."'></div>";
			echo "<div><label>Nombre del cliente:</label><input type='text' name='nombre' value='".$cl['nombre']."'></div>";
			echo "<div><label>Fecha de Nacimiento:</label><input type='date' name='nacimiento' value='".$cl['fechadenacimiento']."'></div>";
			echo "<div><label>Domicilio: </label><input type='text' name='domicilio' value='".$cl['domicilio']."'></div>";
			echo "<div><label>Municipio</label><input type='text' name='municipio' value='".$cl['municipio']."'></div>";
			echo "<div><label>Estado</label><input type='text' name='estado' value='".$cl['estado']."'></div>";
			echo "<div><label>IFE:</label><input type='text' name='IFE' value='".$cl['IFE']."'></div>";
			echo "<div><label>Telefono</label><input type='text' name='telefono' value='".$cl['telefono']."'></div>";
			echo "<div><input type='submit' name='submit_act' value='Guardar' class='btn btn-default'></div>";

			echo "</form>";

			if (isset($_GET['submit_act'])){//guardar actualizacion
				$sql="UPDATE clientes SET
				nombre='".$_GET['nombre']."',
				ife='".$_GET['IFE']."',
				domicilio='".$_GET['domicilio']."',
				municipio='".$_GET['municipio']."',
				estado='".$_GET['estado']."',
				telefono='".$_GET['telefono']."',
				fechadenacimiento='".$_GET['nacimiento']."'
				WHERE curp='".$_GET['curp']."'";
				if ($conexion->query($sql) == TRUE) {
					historia($nuc,"Actualizo datos del cliente ".$_GET['nombre'].", CURP: ".$_GET['curp']);
					mensaje('Cliente Actualizado correctamente','clientes.php','');
				}else
				{
					historia($nuc, "ERROR: al intentar guardar ".$sql);
					mensaje('Ha habido un error'.$sql,'index2.php','error');
				}


			}

		}
		else {
			historia($nuc, "ERROR: ".$sql);
			mensaje("Ha habido un error, cliente no se encontro",'','error');
			//sugerir hacer cliente nuevo
		}


	} else {
	if (isset($_GET['q'])){	//ejecutamos la consulta
		$sql = "SELECT * FROM clientes WHERE nombre like'%".$_GET['q']."%' ";
		historia($nuc,$sql);
		historia($nuc,"busco a ".$_GET['q']);
		$r2= $conexion -> query($sql);
		echo "<h3>Resultados de <b style='color: #2A2C2E;'>".$_GET['q']."</b>:</h3>";
		echo "<table class='tabla'>";
		echo "<th class='pc' width=200px>CURP</th>";
		echo "<th>Nombre</th>";
		echo "<th></th>";
		$c=0;
		while($fr = $r2 -> fetch_array())
		{
			echo "<tr>";
			echo "<td class='pc'>".$fr['curp']."</td>";
			echo "<td><b>".$fr['nombre']."</b><br><span style='font-size:8pt;'>".$fr['domicilio']."</span><span class='pc' style='font-size: 8pt; color:#2A2C2E;'> | ".$fr['telefono']."</span></td>";
			echo "<td width=50px>"; //acciones
				echo "<a class='btn btn-default' style='display:block;' href='?x=".$fr['curp']."' style='text-decoration:none '><img src='icon/entrar.png'></a>";
			echo "</td>";

			echo "</tr>";
			$c = $c +1 ;

		}
		echo "</table>";

		echo "<hr>";
		echo "<p>Si no encontro al cliente, puede <a class='btn btn-default' href='clientes.php?nuevo='> Registrarlo </a> y asi agregarlo a su base de datos</p>";
	}
	else {//ponemos la opcion para buscar
		echo "<div style='margin-top: 200px;  		'>";
		buscar('clientes.php','Escriba el nombre del cliente');
		echo "</div>";


	}
	}

}

}else {mensaje("Acceso denegado a esta aplicacion",'','error');}

?>
<?php include("config/html_footer.php"); ?>
