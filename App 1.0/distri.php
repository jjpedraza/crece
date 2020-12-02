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
    <td align="left" valign="top">
    
    
<form name="configurargrpo" method="POST" action="distri_validar.php">

<p align="center" class="t1"><b>DISTRIBUCION DE LA DEUDA DEL GRUPO</b></p>    
Nombre del grupo:<br />
<?php
require("funciones.php");
$grupo=$_GET["grupo"];
$nosol=$_GET["nosol"];    

mysql_connect($servidor, $usuario, $clave);
mysql_select_db($basededatos);

$curp=_grupopresidente($grupo);
//$nosol=_grupocontratoactual($grupo);
if ($nosol==""){echo 'ESTE GRUPO AUN NO TIENE CONTRATO<BR>';}else{
if(_grupo_esta($grupo)=="SI"){
		echo  '<input name="grupo" readonly="readonly" value="'.$grupo.'"><br>';
		echo  '<input name="nosol" readonly="readonly" value="'.$nosol.'"><br>';
				
			$sql = "SELECT * FROM clientes WHERE grupo='".$grupo."'";
			$resultado=mysql_query($sql);	
			$suma=0;
			echo '<p style="margin:10" class="tabla-text">';
			while ($fila = mysql_fetch_array($resultado))
					{
					extract($fila);
					echo '<a href="tabladepagos3.php?nosol='.$nosol.'&cantidad='._distribu($nosol,$fila["curp"]).'&nombre=
					'.$fila["nombre"].'">'.$fila["nombre"].' ('.$fila["grupo_cargo"].') $'._distribu($nosol,$fila["curp"]).'</a><br>';
					$suma=$suma+_distribu($nosol,$fila["curp"]);
					
					
					}
					echo '-----------------------<br>';
					echo '<b>Total: '.$suma.'<br><br></b>';
					$c =_cantidad($nosol);
					$i = (($c/100) * _tasainteres($nosol)) * plazo_de_pago($nosol);
					$c= $c + $i;
					echo 'Cantidad del prestamo '.$c.'<br>';
					$falta =$c-$suma;
					echo 'Falta por distribuir <span style="color:red"><b>'.$falta.'</b></span><br>';
					
			echo '</p>';
		
		
			echo 'SELECCIONA Y ESCRIBE LA CANTIDAD';
			$sql2 = "SELECT * FROM clientes WHERE grupo='".$grupo."'";
			$resultado=mysql_query($sql);	
			echo '<p style="margin:10" class="tabla-text">nombre:<select name="cliente">';
			while ($fila = mysql_fetch_array($resultado))
					{
					extract($fila);
					echo '<option value="'.$fila["curp"].'">'.$fila["nombre"].'</option>>';
					
					
					}
			echo '</select></p>';
			
//			$sql2 = "SELECT * FROM cuentas WHERE grupo='".$grupo."'";
//			$resultado2=mysql_query($sql2);	
//			echo '<p style="margin:10" class="tabla-text">Contrato:<select name="credito">';
//			while ($fila2 = mysql_fetch_array($resultado2))
//					{
//					extract($fila2);
//					echo '<option>'.$fila2["nosol"].'</option>>';
//					
//					
//					}
//			echo '</select></p>';
			
			echo '<br>';
			echo 'Cantidad:<br>';
			echo '<input name="cantidad">';

		echo'<input type="submit" name="button" id="button" value="Guardar" />';

	}

}

?>
      
</form>













    </td>
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