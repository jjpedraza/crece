<?php 	require("../config/funciones.php"); ?>
<?php 	require("../config/config.php"); ?>
<?php // error_reporting(E_ALL ^ E_NOTICE);

if (isset($_POST['submit']))
{//VALIDAR USUARIO
	$sql="SELECT * FROM empleados WHERE (nuc='".$_POST['usuario']."' and nip='".$_POST['pass']."')";
	$r = $conexion -> query($sql);	if($f = $r -> fetch_array())	
	{
		session_start();
		$_SESSION['user']=$f['nuc'];	
		
		global $nuc;
		$nuc = $f['nuc'];	
		historia($nitavu,'Acceso <br>'.detectar().'');
		header('location:../index.php');			
	}else 
	{
		historia('','Acceso fallido con nip ');		
		mensaje("Error en el usuario y nip",'index.php','error');
	} 
		


}

?>
<!DOCTYPE html>
<head>
	<title>Crece y mas: Identificate</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" >
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../config/estilo_base.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<style>
	body {
		background-color: #64002B;
		color: white;
		font-size: 10pt;
		font-family: "Light";

	}
	form {
		background-color: rgba(0, 0, 0, 0.2);
		width: 50%; padding: 10px;
		display:inline-block;
		
		top: 25%; position: absolute;
		left: 25%;
		

		border-radius: 10px;
		border: 0px solid white;
		

	}

	input[type='submit'] {
		height: 50px;
		background-color: white;
		border-radius: 5px;
	}

	input[type='text'], input[type='password'] {
		height: 30px; font-size: 10pt;
		color: pink;
		
		background-color: rgba(0, 0, 0, 0.5);
		border: 0px solid white; border-radius: 5px; margin: 4px;
		width:95%;
	}
	input[type='text']:hover, input[type='password']:hover {
		background-color: black; color:white;
	}

	@media only screen and (max-width:500px) 
	{
	 form {
	 	margin: 0px;
	 	border-radius: 0px;
	 	height: 100%;
	 }
	 .centrar_mensaje_padre{
	 	margin: 0px;
	 }
	}
</style>
</head>
<body >
<div id='login'>
	<form action='../login/index.php' method='post'>
		<table width="100%" border=0>
			<tr><td width=50% align="right" valign="center">Usuario: </td><td width=50%  align="left" valign="center"><input type='text' name='usuario' required="required"></td></tr>
			<tr><td align="right" valign="center">NIP: </td><td align="left" valign="center"><input type='password' name='pass' required="required"></td></tr>
			<tr><td colspan="2"><button name='submit' class='btn btn-default2'>Entrar</button></td></tr>

		</table>
	</form>

</div>
	
	
	
</body>
</html>