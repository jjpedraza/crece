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
  
  <tr><td bgcolor="#000000" class="menu1" align="center"><img src="img/home.png" /><a href="index.php"> Regresar al MENU </a></td></tr>
  
    <td align="left" valign="top">
    
    <p align="center" class="titulo1"> SOLICITUD
   
    <P align="center" class="texto_debil">* Se requiere identicar al cliente mediante el CURP, si el cliente no esta<br />
      registrado hagalo o actualizelo mediante las opciones del menu.
    </P>
      
  <form action='solicitud_captura.php' method='post' name='solicitud'>      
  <p  class="pies" align="center">Indique el CURP del solicitante) :<br />  
  <input name='curp' type='text' required="required" class="textbox" id='curp' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value='' size="30" /><br /><br />
    <p  class="pies" align="center">Indique el CURP del AVAL:<br /> 
    (opcional)<br />  
  <input name='curp_aval' type='text'  class="textbox" id='curp' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value='' size="30" /><br />
    </p>
    <p  class="pies" align="center">&nbsp;</p>
    <p  class="pies" align="center"><br />
      
      Si desconoce dicho dato:</p>
    <table border="0" align="center">
   	<tr><td><img src="img\lupa.gif" border='0' /></td>
   		<td><a href="busquedacliente_form.php" class="enfasis2" >   	Buscar Cliente </a></td>
    </tr>
   </table>
    <p  class="pies" align="center"><a href="solicitud_lista.php">Buscar solicitud de Credito.</a><br />
  </p>
      <p align="center">
        <input type='submit' name='ok' id='ok' value='Siguiente >' />
</p>
    </form>
    
    <br /></td>
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
    </p>
    
    </td>
  </tr>
</table>
</center>
</body>
</html>