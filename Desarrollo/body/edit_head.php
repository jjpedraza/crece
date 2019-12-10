
<?php 
include("admin_seguridad.php"); 
?>
</!DOCTYPE html>


<html>
	
	<head>
		<title></title>	
		<meta charset="utf-8" />		
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="index,follow">
		<meta name="googlebot" content="index,follow">
		
		<link rel="stylesheet" href="body/edit_estilo.css"/>
		<link rel="shortcut icon" href="../icon/tam.ico" />
		<script src="lib/jquery-3.3.1.min.js"></script> 
		<link rel="stylesheet" href="lib/jquery.toast.min.css">
		<script type="text/javascript" src="lib/jquery.toast.min.js"></script>
		<script type="text/javascript" src="lib/pdz_functions.js"></script>
		<script type="text/javascript" src='lib/pdz_sintetizadodevoz.js'></script>
		<script>
			function habla(quedigo){
				// alert(quedigo);
				// responsiveVoice.speak(quedigo); 
				responsiveVoice.speak(quedigo, 'Spanish Latin American Female', {volume: 100});
			}
				
		</script>
		<style>
		body{
			/* background-image: url('https://source.unsplash.com/random/1920x1080/?nature,trees,green');
			 */
			/* background-image: url("img/dot1.png"); */
		}
		</style>

	<link rel="stylesheet" type="text/css" href="lib/datatables.min.css"/> 
	<script type="text/javascript" src="lib/datatables.min.js"></script>
		
</head>

<body>
<div id='GranContenido'>
