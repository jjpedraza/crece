<?php	include("config/html_head.php"); ?>


<?php //BARRA DE MENU
include("config/html_menu.php"); ?>


<?php

$id_aplicacion='ap2'; $nivel = aplicacion_nivel($id_aplicacion, $nuc);	
if (sanpedro($id_aplicacion,$nuc)==TRUE){

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
				echo "<a class='btn btn-default' href='?x=".$fr['nuc']."' style='text-decoration:none '>Eliminar</a>";
			echo "</td>";

			echo "</tr>";
			$c = $c +1 ;

		}
		echo "</table>";

		if ($c==0){// si no se encontro, sugerir crear nuevo empleado

			echo "<p>No se encontraron resultados de tu busqueda, puedes crear un nuevo empleado en tu base de datos </p>";
			echo "<form action='empleados.php' method='post'>";
			echo "<input type='text' name='nuc' placeholder='Username o NUC' required='required'>";
			echo "<input type='text' name='nombre' placeholder='Nombre completo del empleado' required='required'>";
			echo "<input type='submit' name='submit_empleados' value='Crear' class='btn btn-default'>";


			echo "</form>";

		}
	}
	else {//ponemos la opcion para buscar
		echo "<div style='margin-top: 200px;  		'>";
		buscar('empleados.php','Escriba el nombre del empleado');
		echo "</div>";
	}

	if (isset($_POST['submit_empleados'])){//GUARDAR
	$sql = "INSERT INTO empleados (nuc, nip, nombre) VALUES ('".$_POST['nuc']."', '".$_POST['nuc']."', '".$_POST['nombre']."')";
		if ($conexion->query($sql) == TRUE)
		{ 	historia($nuc, "Agrego al empleado ".$_POST['nombre']);
			mensaje("Empleado guardado con exito, su nip es el mismo nuc o username. (indique que puede cambiarlo en su primera sesion)",'','');
		}
		else {mensaje("Error al guardar, indique al dpto de informatica",'','error');}

	}

	if (isset($_GET['x'])){//GUARDAR
	$sql = "DELETE FROM empleados WHERE nuc='".$_GET['x']."' and nuc<>'".$nuc."'";
		if ($conexion->query($sql) == TRUE)
		{ 	historia($nuc, "Elimino al empleado ".$_GET['x']);
			mensaje("Empleado borrado con exito",'','');
		}
		else {mensaje("Error al borrar, indique al dpto de informatica",'','error');}

	}

}else {mensaje("Acceso denegado a esta aplicacion",'','error');}

?>
<?php include("config/html_footer.php"); ?>	