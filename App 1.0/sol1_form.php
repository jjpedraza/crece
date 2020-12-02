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
//  verificamos nivel del admin
$numelentos = count($nivel_admin);
$estoy = 'no';
for ($i=0; $i < $numelentos; $i++)
{
	//print $nivel_admin[$i];
	$yo = $_SESSION['usuario'];
	if ($yo == $nivel_admin[$i])
	{
		$estoy='OK';
		}
}
if ($estoy=='OK'){
	//echo 'soy admin';
	}else { 
	//echo 'no tengo acceso'; 
	header('Location: error_nivel.html'); 
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
  <tr>
    <td <?php echo 'bgcolor="', $tabla, '"' ?>>
    <p class="menu1" align="center"> Empleado: 
	<?php echo $_SESSION['usuario'];//--------------MENU--------//?>    
	 <a href="logout.php">Cerrar Sesión</a> 
     | <a href="index.php"> MENU </a>

	</p>
    
    
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <p align="center" class="titulo1"> SOLICITUD DE CREDITO
   
    <P align="center" class="texto_debil">* RECUERDE ACTUALIZAR LOS DATOS DEL CLIENTE ANTES</P>
      
  <form action='sol1_procesa.php' method='post' name='solicitud'>      <p  class="pies" align="center">
        CURP:<br /><input name='curp' type='text' id='curp' value='' size="19" required="required" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" /><br /><br /><br />
    </p>
      <p align="center">
        <input type='submit' name='ok' id='ok' value='Siguiente >' />
      </p>
    </form>
    
    <br />
    
    <a href="busquedacliente_form.php" target="new"> Buscar Cliente </a>
    
    
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
    </p>
    
    </td>
  </tr>
</table>
</center>
</body>
</html>