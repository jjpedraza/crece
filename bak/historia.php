<?php	include("config/html_head.php"); ?>


<?php //BARRA DE MENU
include("config/html_menu.php"); ?>

<?php
$id_aplicacion='ap4'; $nivel = aplicacion_nivel($id_aplicacion, $nuc);
if (sanpedro($id_aplicacion,$nuc)==TRUE){
echo "<h1>SOLICITUD DE CREDITO</h1>";

}else {mensaje("Acceso denegado a esta aplicacion",'','error');}

?>
<?php include("config/html_footer.php"); ?>
