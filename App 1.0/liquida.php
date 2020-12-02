

<?php
/* si no es la sesion de el USUARIO regresar a login.*/
session_start();

if(!isset($_SESSION['usuario'])) 
{  
  header('Location: login.php'); 
  exit();
}

?>

<?php
$nosol=$_GET["nosol"];
require ("config.php");
require ("funciones.php");
	echo '<p class="contrato_texto">';
	echo'<img src="img\logotipo.jpg"  width="136" height="58"/>
      <BR />
     Aldama, Tamaulipas.<br /><br>';
	echo 'RECIBO DE GARANTIA LIQUIDA </b></p>';
	
	$cantidad=_cantidad($nosol);
	$liq=($cantidad/100)*10;
	echo '<p class="contrato_texto">';
	echo '';
	
    echo '<br>';
	echo 'Cliente: '._nombre($nosol).'<br>';
	echo 'contrato: '.$nosol.'<br>';
	echo 'Se recibe el 10%.<br>';
	echo 'de la cantidad del prestamo<br>';
	echo '$ '.$cantidad.'<br>';
	echo 'como  garantia liquida<br>';
	echo '------------------------------<br>';
	echo 'Total: $ '.$liq.'<br>'; 
	echo '<br><br><br>';
	echo 'Le atendio '.$_SESSION['usuario'].'<br> Hoy '.fechacompleta(date("Y-m-d"));
	echo '</p>';	
	
	?>