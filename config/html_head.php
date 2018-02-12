</!DOCTYPE html>

<?php 	require("html_seguridad.php"); ?>
<?php 	require("funciones.php"); ?>
<?php 	require("config.php"); ?>

<html>
	<head>
	<title>CRECE y MAS</title>
	<?php //refresco		
	if (isset($_GET['r'])) {$r = $_GET['r'];}
	else{// sino esta configurada que se actualice cada 5min (300s)
		$r= 900;}
	echo '<meta http-equiv="refresh" content="'.$r.'" />';		
	?>
		
	<meta charset="utf-8" />		
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<meta name="description" content="Sistema Administrativo para CRECE y MAS en la nube">
	<meta name="robots" content="index,follow">
	<meta name="googlebot" content="index,follow">
	<meta name="geo.region" content="MX-TAM">
	<meta name="geo.placename" content="Ciudad Victoria">
	<meta name="geo.position" content="23.730969;-99.151375">
	<meta name="ICBM" content="23.730969, -99.151375">
	<link rel="author" href="">
	<link rel="publisher" href="">
	<link rel="stylesheet" href='config/estilo_base.css' />
	<link rel="shortcut icon" href="img/creceymas.ico" />

   	<script type="text/javascript" src="src/google_charts_loader.js"></script> <!--offline graficos de google -->
	<script src="src/jquery-3.3.1.js"></script>
<!-- 	<script src="src/jquery-1.12.4.js"></script>
	<script src="src/jquery-ui.js"></script>
	<script src='src/jquery.min.js' type='text/javascript'/></script> --> 
	<script src="src/jquery.min191.js"></script> <!-- Este funciona para el preloader -->

	<script type="text/javascript">//<![CDATA[
		$(function(){
		    $('#slider_ecologico div:gt(0)').hide();
		    setInterval(function(){
		      $('#slider_ecologico div:first-child').fadeOut(0)
		         .next('div').fadeIn(1000)
		         .end().appendTo('#slider_ecologico');}, 5000);
		});
		//]]>
	</script>

 	<script src="src/txtplus/txtplus_chat.js" type="text/javascript"></script>
	<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
	<script src='src/vozhumana.js'></script>
		
</head>
<body>