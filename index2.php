<?php	include("config/html_head.php"); ?>

<?php //BARRA DE MENU
include("config/html_menu.php"); ?>






<!-- <div id='aplicaciones_free'> -->
	<?php
	// $sql = "SELECT * FROM aplicaciones WHERE idapcat='0'";
	// $rc= $conexion -> query($sql); while($f = $rc -> fetch_array())
	// {
	// 	echo "<article>";
	// 	echo "<table width=100%><tr>";
	// 	echo "<td width=32px><a href='".$f['vinculo']."'><img src='icon/".$f['icono']."' class='icono'></a></td><td>";
	// 	echo "<a href='".$f['vinculo']."'><b>".$f['nombre']."</b><br>";
	// 	echo "<label>".$f['descripcion']."</label></a></td></tr></table>";
	// 	echo "</article>";


	// }

	?>
<!-- </div> -->


<?php
$sql = "select DISTINCT idapcat as IdCategoria, (select aplicaciones_categoria.nombre from aplicaciones_categoria where aplicaciones_categoria.idapcat = IdCategoria) as Categoria
from aplicaciones, aplicaciones_permisos where aplicaciones.idapp = aplicaciones_permisos.idapp and aplicaciones_permisos.nuc = '".$nuc."'";
$r= $conexion -> query($sql); while($cat = $r -> fetch_array())
{
	echo "<div id='aplicaciones'>";
	echo "<h3>".$cat['Categoria']."</h3>";
	$sql2="select * from aplicaciones, aplicaciones_permisos where aplicaciones.idapp = aplicaciones_permisos.idapp and aplicaciones_permisos.nuc = '".$nuc."' and idapcat = '".$cat['IdCategoria']."'";
	
	$rc2= $conexion -> query($sql2); while($f = $rc2 -> fetch_array())
	{
		echo "<article >";
		echo "<table width=100% border=0><tr>";
		echo "<td width=32px><a href='".$f['vinculo']."'><img src='icon/".$f['icono']."' class='icono'></a></td><td>";
		echo "<a href='".$f['vinculo']."'><b>".$f['nombre']."</b><br>";
		echo "<label>".$f['descripcion']."</label></a></td></tr></table>";
		echo "</article>";
	}
	
	echo "</div>";

}


?>

<?php include("config/html_footer.php"); ?>	