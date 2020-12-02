<link href="css/contrato.css" rel="stylesheet" type="text/css" />
<?php
require ("config.php");
?>



<?php
/* si no es la sesion de el USUARIO regresar a login.*/
session_start();

if(!isset($_SESSION['usuario'])) 
{  
  header('Location: login.php'); 
  exit();
}

?>


    
    <?PHP
require ("config.php");
require ("funciones.php");


mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$nosol=$_POST["nosol"];
$abono=$_POST["abono"];
//$interes=$_POST["interes"];
$total=$_POST["total"];
$moratorio=$_POST["moratorio"];
$no=$_POST["no"];
$extras =$_POST["extras"];
$descuento=$_POST["descuento"];
$ahorro=$_POST["ahorro"];
$recibo=$_POST["recibo"];

if ($recibo >= $total){

$sql = "UPDATE tabladepagos SET
estado='X',
ahorro='$ahorro'
WHERE nosol='$nosol' and no='$no'";
if(!mysql_query($sql))//checamos si hay curp
{
	echo '<img src="img\mal.jpg"> NO SE HA ACTUALIZADO';
}else{//si esta, preraramos la actualizacion
	
    
	$c=corte("", $_SESSION['usuario'], $total, $nosol, $no, $ahorro);
	//$c=corte('Cotrato'.$nosol.', '.$no.'('._nombre($nosol).') ahorro',$_SESSION['usuario'],$ahorro);
	$ca=cargos_pagar($nosol,$no);
	$c=_descuentos_X($nosol,$no);
	
	echo '<p>';
	echo'<a href="creditosactivos.php"><img border="0" src="img\logotipo.jpg"  width="200" height="80"/>
     </a> <BR /> <font face="Arial" pointsize="28">
     <br /><br>';
	
	echo '';
	
    echo '<br>';
	if (_tipodecredito($nosol)=="GRUPO"){
	echo 'GRUPO:'.	_aquegrupoperteneceestecontrato($nosol).'<br>';
	}
	else{	}
	echo 'Cliente:<br> '._nombre($nosol).'<br>';
	echo 'contrato: '.$nosol.'<br>';
	
	echo 'No. de pago: '.$no.'/'._cuantospagos($nosol).'<br>';

	echo '------------------------------------- <br><br>';

	
	
	echo 'Su Pago: <b> $'.$abono.'</b><br>';
	echo 'Recargo: <b> $'.$moratorio.'</b><br>';
	echo 'Retencion de <br> Recargos: <b>$'.$descuento.'</b><br>';
//	echo 'Interes: ('._tasainteres($nosol).'%)$ '.$interes.'<br>';
	echo 'Cargos: <b>$'.$extras.'</b><br>';
	echo _cuantosextras($nosol,$no,"SI").'<br>';
	echo '=====================<br>';
	echo 'Subtotal:<b> $ '.$total.'</b><br>'; 
	echo '+ ahorro: <b>$ '.$ahorro.'</b><br>'; 
	$grantotal = $total + $ahorro;
	echo '</font> <font face="Arial Black, Gadget, sans-serif" pointsize="30">
	TOTAL : $ '.$grantotal.'</font><font face="Georgia, Times New Roman" pointsize="26"><br> 
	
	'; 
	//echo numtoletras($grantotal).'<br>';
	echo '<br>';
	echo '---------------------------<br>';
	echo 'Efectivo: $'.$recibo.'<br>';
	$cambios = $recibo - $grantotal;
	echo 'Cambio: $'.$cambios.'</b><br>';
	
	echo '<br><p align="center">Contratar prestamos <br>por arriba de tu capacidad de pago,<br>puede afectar tu patrimonio<br>y tu historial crediticio.<br></p>';
//	echo 'Se recibo un ahorro de '.$ahorro.'<br>';	
	echo 'Le atendio '.$_SESSION['usuario'].'<br> Hoy '.fechacompleta(date("Y-m-d"));
	echo '<br>Aldama, Tam.<br>';
	echo '</font></p>';	
	
	
	}         
}else{
echo 'LO QUE RECIBIO ES MENOR QUE EL PAGO, VUELVA A INTENTARLO<br>';
echo'<a  href="index.php" >Regresar al menu</a>';
	
}

mysql_close();
?>      
    
    