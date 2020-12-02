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
  
  <tr>
    <td width="800" align="center" valign="top">
      <p><span class="titulo" > CAJA: pagos </span></p>
      <form id="form1" name="form1" method="get" action="caja_v2.php">
        <p>
          <label for="nosol">Escriba  No. de Contrato:<br />
          </label>
          <input name="nosol"  id="nosol" size="40">
          
        </p>
        <p>
          <input type="submit" name="seleccionar" id="seleccionar" value="Seleccionar" />
        </p>
      </form>
      <p>&nbsp;</p>
      <p><br />
    </p></td>
  </tr>
  <tr>
    <td bgcolor="#000000">
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