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
<?php
require ("config.php");
require ("funciones.php");
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);
$nosol=$_GET["nosol"];
$result=mysql_query("SELECT * FROM cuentas WHERE nosol=".$nosol."",$link);
$row=mysql_fetch_array($result);

?>

<center>
<table style="display: inline-table;" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="495">
  
  <tr><td bgcolor="#000000" class="menu1" align="center"><img src="img/home.png" /><a href="index.php"> Regresar al MENU </a></td></tr>
  
  <tr>
    <td align="center" valign="top">
      <p><span class="titulo" > Aprobar Creditos</span></p>
      <form id="aprobar" name="aprobar" method="post" action="aprobar_validar.php">
        <table border="0">
          <tr>
            <td class="pies"><label for="nosol2">No. de Solicitud<br />
            </label>
              <?php echo '<input readonly="readonly" name="nosol" type="text" class="textbox" value="'.$nosol.'" />'; 
			  
			  ?></td>
            <td>&nbsp;</td>
            <td><label class="pies">Cantidad:<br />
<?php echo '<input class="textbox" readonly="readonly"  name="cantidad" type="text" class="titulo" value="'. $row["cantidad"].'"/>'; ?>
            </label></td>
          </tr>
          <tr>
            <td colspan="3" align="center">
              <?php 
			echo '<span class="normal"><b>'.nombre($row["curp"]);
			echo '</b><br> Plazo: '.$row["plazo"].' meses.';
			echo '<br> Forma de Pago: cada '.$row["formadepago"].' dias </span>';
			echo '<br><a href="solicitud_mostrar.php?nosol='.$nosol.'"> Ver mas detalles </a>';
			
			?>
              
              
              
            </td>
            </tr>
          <tr>
            <td colspan="3">
              
              <p class="pies">
              CURP:<br />
              <?php 
				echo '<input value="'.$row["curp"].'" required="required" class="textbox"  type="text" name="curp" id="curp"  readonly="readonly"/>';
				?><br /><br />
              
              <br />Informacion para crear la cuenta:<br /><br />Tipo de IVA:<br />
              <select name="iva_tipo" >
			<?php
			if (_ivatipo($nosol) == "0")
			{ echo '<option value="0" class="textbox" selected="selected"> 0 </option>
			<option value="16"> 16 </option>';}
			else
			{echo '<option value="0" class="textbox" > 0 </option>
			<option value="16" selected="selected"> 16 </option>';}
			?>
              </select>
              
              
                    
                <br /><br /> No. de Cuenta (interno): <br />
                <?php 
				$ci = _cuentainterna($nosol);
				echo '<input value="'.$ci.'" required="required" class="textbox"  type="text" name="cuenta_interna" id="cuenta_interna" />';
				?>
               
                
                <br /><br /> 
                Tasa de Interes Moratorio: (mensual) <br />
			  <select name="tasa_moratorio" id="tasa_moratorio" >
			  <?php 
				if (_tasamoratorio($nosol)=="0")
				{ echo'
				<option value="0" selected="selected" class="textbox"> 0 </option>
                <option value="15"  > 15 </option>';}
				else
				{echo '
				<option value="0"  class="textbox"> 0 </option>
                <option value="15" selected="selected" > 15 </option>';}
				
			  ?>
              </select>
              
              <br /><br />
              Tasa de Interes ordinario (mensual): <br />
			 <select name="tasa_interes" id="tasa_interes" >
             <?php
				if (_tasainteres($nosol)=="0")
				{ echo '
				<option value="0" selected="selected"> 0 </option>
                <option value="5"  > 5 </option>';
				}
				else
				{ echo '
				<option value="0" > 0 </option>
                <option value="5"  selected="selected" > 5 </option>';
					
					}
			?>
              </select>
                
                     
                
                     <br /><br />
                     Aprobacion:<?php echo '('._valoracion($nosol).'  )'; ?><br />
                <select name="valoracion" class="titulo" id="valoracion">
                <?php
                if (_valoracion($nosol)=="APROBADO")
				{echo '
				  <option VALUE="APROBADO" selected="selected">APROBADO</option>
                  <option VALUE="RECHAZADO">RECHAZADO</option>';
				} else 
					{ echo '
						  <option VALUE="APROBADO" >APROBADO</option>
					  <option VALUE="RECHAZADO" selected="selected">RECHAZADO</option>';
					}
						
				
				?>
                </select>
              </p>
            <!--<p class="pies">Fecha de inicio:<br />
                <label for="fvecimiento"></label>
                <input  type="date" name="fvecimiento" id="fvecimiento" required="required" />
              </p>
            -->  </td>
            </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
            </tr>
        </table>
        <?php
        if (_valoracion($nosol)=="RECHAZADO"){
			echo 'YA HA SIDO RECHAZADO, NO SE PUEDEN ACTUALIZAR SU VALORACION. Intentelo creando una nueva solicitud';}
		else
		{ echo'
        <input type="submit" name="guardar" id="guardar" value="ACTUALIZAR VALORACION" />';}
		
		?>
  
      </form>
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