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



  
      

<?php
require ("config.php");
require ("funciones.php");
# Conectamos con la base de datos
//$link=mysql_connect($servidor,$usuario,$clave);
//mysql_select_db($basededatos,$link);
//$nosol=$_GET["nosol"];
//$result=mysql_query("SELECT * FROM `cuentas` WHERE nosol='".$nosol."'",$link);
//$row=mysql_fetch_array($result);

$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);
$result=mysql_query("SELECT * FROM `fotos` WHERE curp='NUEVO'",$link);
$row=mysql_fetch_array($result);

header("Content-type:".$row["tipo"]);
echo $row["imagen"];


//include ('ros/class.ezpdf.php');
//$pdf =& new Cezpdf('Letter','portrait');
//$pdf->selectFont('./fonts/Helvetica.afm');
//$pdf->ezSetY(500);
////$pdf->ezText('Hello World!',12);
//$pdf->ezImage(foto($row["curp"]),0,200,none);
//
//
//$pdf->ezStream();

?>

    