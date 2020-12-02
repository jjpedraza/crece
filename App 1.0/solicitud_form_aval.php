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






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php   echo '<title>'; 
		echo $nombresistema;
		echo ', ';
		echo $nombreversion;
		echo '</title>';

 ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/misol1.css" rel="stylesheet" type="text/css" />


</head>
<body  topmargin="0" bottommargin="0">
<center>
<table style="display: inline-table;" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="495">
 
    <td align="left" valign="top">    
    <p align="center" class="titulo1"> SOLICITUD DE CREDITO </p>
   
   
       
    <?PHP
require ("config.php");
require ("funciones.php");

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$curp = $_POST["curp"];   
$result = mysql_query("SELECT * 
					FROM clientes 
					WHERE curp = '".$curp."'");
 
//checamos si hay curp
if($row = mysql_fetch_array($result)){//si se ha encontrado, capturar SOLICITUD	
	echo '<p class="titulo" align="center"> CAPTURA DE LA SOLICITUD DE CREDITO </p>';
    echo '<P align="center" class="texto_debil">* Es necesario que el AVAL este registrado como cliente. </P>';
    echo '<form action="solicitud_captura.php" method="post" name="solicitud"><p  class="pies" align="center">Indique el CURP del AVAL::<br /><input name="curp" type="text" required="required" class="textbox"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="" size="30" /><br /><br />
    Si desconoce dicho dato:</p>';
    echo '<table border="0" align="center"><tr><td><img src="img\lupa.gif" border="0" /></td><td><a href="busquedacliente_form.php" class="enfasis2" >   	Buscar Cliente </a></td>
    </tr>
   </table>
    <p  class="pies" align="center">Busque al cliente para saberlo.<br />
  </p>
      <p align="center">';
  echo '<input type="submit" name="ok" id="ok" value="Siguiente >" />
</p></form>';}

else
{ echo '<P class="titulo" align="center"> EL CURP INTRODUCIDO NO ESTA REGISTRADO!</P>';
	}   
	
	?>
   
   
   
   
   
   
   

	
	</td>
  </tr>
  <tr>
    <td <?php echo 'bgcolor="', $tabla, '"' ?>>
    <p class="pie1" align="center">
    <?php
    echo $pie1;
	echo $pie2;
	echo '<br/>';
	echo $pie3_yo;
	echo '<br/>';
	echo '<a href="http://facebook.com/eltecnicodelpueblo">', $pie4_fb, '</a>';

	
    ?>

    
    </td>
  </tr>
</table>
</center>
</body>
</html>