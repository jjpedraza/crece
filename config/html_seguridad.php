<?php
//AUTORIZACION PARA ADMINISTRADOR

	
	session_start();	
	if (isset($_SESSION['user'])){
		$nuc = $_SESSION['user']; // refrescamos la variable
	}
	else
	{		
		header("location:../login/index.php");		
	}

	
?>