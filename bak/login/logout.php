<?php
//include ("../unica/body_head.php");
?>
<?php 


$nitavu="";
 //Crear sesión
 session_start();
 //Vaciar sesión
 $_SESSION = array();
 //Destruir Sesión
 session_destroy();
 //Redireccionar a login.php

	if (isset($_GET['modo'])){
		if ($_GET['modo']=='desktop'){
 			header("location:../index.php?modo=desktop");
 		}
 	}else {
 			header("location:../index2.php");
 	}
?>