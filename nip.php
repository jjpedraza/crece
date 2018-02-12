<?php	include("config/html_head.php"); ?>


<?php //BARRA DE MENU
include("config/html_menu.php"); ?>



<h3>Proporcione los datos solicitados para cambiar su acceso a esta aplicacion</h3>
<form action="nip.php" method="post">
	<input type='text' name='nip_actual' placeholder="Escriba su nip actual" required="required">
	<input type='text' name='nip_nuevo1' placeholder="Escriba su nuevo nip" required="required">
	<input type='text' name='nip_nuevo2' placeholder="Repita su nuevo nip" required="required">
	<br><br>
	<input type='submit' name='submit'  class='btn btn-default' value="Cambiar NIP">
</form>

<?php
if (isset($_POST['submit'])){
	$sql = "SELECT * FROM empleados WHERE nuc='".$nuc."' and nip='".$_POST['nip_actual']."'";
	$rc= $conexion -> query($sql);
	if($f = $rc -> fetch_array())
	{
		if ($_POST['nip_nuevo1']==$_POST['nip_nuevo2']){
			//cambiar
			$sql = "UPDATE empleados SET nip='".$_POST['nip_nuevo1']."'  WHERE nuc='".$nuc."'";			
			if ($conexion->query($sql) == TRUE) 			
			{
				mensaje("NIP cambiado con exito",'../login/logout.php','');
			}
			else {
				historia($nuc,'ERROR: no se ha podido ejecutar la consulta sobre el cambio de nip '.$sql);
			}
	

		} else
		{
			mensaje("La confirmacion del NIP es incorrecta",'nip.php','error');	
		}
	}
	else
	{	historia($nuc,'Intento acceder con un nip incorrecto');
		mensaje("NIP incorrecto",'nip.php','error');
	}

					
}
?>
<?php include("config/html_footer.php"); ?>	