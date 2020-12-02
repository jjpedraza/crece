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
$queda=$_POST["queda"];
$recargos=$_POST["recargos"];
$extras=$_POST["extras"];


mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."'";
$resultado=mysql_query($sql);
while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);		
		$sqlx = "UPDATE tabladepagos SET estado='X'	WHERE nosol='".$nosol."' and no='".$fila["no"]."'";
		$r=mysql_query($sqlx);
		}

$fila = mysql_fetch_array($resultado);
extract($fila);		
echo '<p class="contrato_texto">';
	echo'<img src="img\logotipo.jpg"  width="136" height="58"/>
      <BR />
     Aldama, Tamaulipas.<br /><br>';
echo 'Liquidacion del contrato '.$nosol.'<br>';
echo 'Resto de la deuda: '.$queda.'<br>';
echo 'Recargos: '.$recargos.'<br>';
echo 'Extraordinarios: '.$extras.'<br>';
echo '----------------------------<br>';
echo 'Total: '.$queda+$recargos+$extras.'<br>';
//$c=corte(''.$nosol.', '.$no.'('._nombre($nosol).')',$_SESSION['usuario'],$queda+$recargos+$extras);
	

?>      
    
    