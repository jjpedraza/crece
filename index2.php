<?php	include("config/html_head.php"); ?>

<?php //BARRA DE MENU
include("config/html_menu.php"); ?>






<div id='aplicaciones_free'>
	<?php
	$sql = "SELECT * FROM aplicaciones WHERE idapcat='0'";
	$rc= $conexion -> query($sql); while($f = $rc -> fetch_array())
	{
		echo "<article>";
		echo "<table width=100%><tr>";
		echo "<td width=32px><a href='".$f['vinculo']."'><img src='icon/".$f['icono']."' class='icono'></a></td><td>";
		echo "<a href='".$f['vinculo']."'><b>".$f['nombre']."</b><br>";
		echo "<label>".$f['descripcion']."</label></a></td></tr></table>";
		echo "</article>";


	}

	?>
</div>




<div id='aplicaciones' >
	<?php
	$sql = "SELECT * FROM aplicaciones WHERE idapcat<>'0'";
	$rc= $conexion -> query($sql); while($f = $rc -> fetch_array())
	{
		if (sanpedro($f['idapp'],$nuc)==TRUE){

		echo "<article >";
		echo "<table width=100% border=0><tr>";
		echo "<td width=32px><a href='".$f['vinculo']."'><img src='icon/".$f['icono']."' class='icono'></a></td><td>";
		echo "<a href='".$f['vinculo']."'><b>".$f['nombre']."</b><br>";
		echo "<label>".$f['descripcion']."</label></a></td></tr></table>";
		echo "</article>";
		}



	}

	?>
</div>


<?php include("config/html_footer.php"); ?>	