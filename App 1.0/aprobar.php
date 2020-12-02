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
      <p><span class="titulo" > Aprobar Prestamo</span></p>
      <form id="aprobar" name="aprobar" method="post" action="aprobar_validar.php">
        <table border="0">
          <tr>
            <td class="pies"><label for="nosol2">No. de Solicitud<br />
            </label>
              <?php echo '<input readonly="readonly" name="nosol" type="text" class="textbox" value="'.$nosol.'" />'; 
			  echo ' ('._aquegrupoperteneceestecontrato($nosol).')';
			  
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
			echo '<br> Forma de Pago: cada '.$row["formadepago"].' dias ';
			echo '<br><a href="solicitud_mostrar.php?nosol='.$nosol.'"> Ver solicitud </a>';
			$actual=$nosol;
			
			//record de cliente:
			echo '<br><br>Contratos que ha tenido o tiene:<br>';
			mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
			mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
			$curp=$row["curp"];
			$sql = 'SELECT * FROM cuentas WHERE curp="'.$curp.'"';
			$re=mysql_query($sql);
			$puede=0;
					while ($f = mysql_fetch_array($re)){
					extract($f);			
					$puede=$puede+_estapagado($f["nosol"]);
					if ($f["nosol"]==$actual){}else{	
						if (_debevencidos($f["nosol"])>0){echo '<img src="img\mal.jpg">';}
						else{echo '<img src="img\bien.jpg">';}
						echo ' <a href="estatus2.php?nosol='.$f["nosol"].'">'.$f["nosol"].'</a></span>';
						}
					}
			
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
              
              <br /><b>Informacion para crear la cuenta:</b><br />
             <!-- <br />Tipo de IVA:<br />
              <select name="iva_tipo" >-->
			<?php
//			if (_ivatipo($nosol) == "0")
//			{ echo '<option value="0" class="textbox" selected="selected"> 0 </option>
//			<option value="16"> 16 </option>';}
//			else
//			{echo '<option value="0" class="textbox" > 0 </option>
//			<option value="16" selected="selected"> 16 </option>';}
//			?>
            <!--</select>-->
              
                    
               <br /> No. de Cuenta (interno): <br />
                <?php 
				$ci = _cuentainterna($nosol);
				echo '<input value="'.$ci.'" class="textbox"  type="text" name="cuenta_interna" id="cuenta_interna" />';
				?>
               
                
                <br /><br /> 
                Tasa de Interes Moratorio (mensual)<br />
			  <select name="tasa_moratorio" id="tasa_moratorio" >
			  <?php 
				echo '
				<option value="0"> 0 </option>
                <option value="1.19" selected="selected" > 1.19 %</option>';
				
				
			  ?>
              </select>
              
              <br /><br />
              Tasa de Interes ordinario (mensual): <br />
			 <select name="tasa_interes" id="tasa_interes" >
			   <?php echo'
				<option value="0" > 0 </option>
                <option value="5" selected="selected" > 5 % </option>';
				?>
			   </select>
              </p>
              <p class="pies">
                <label for="fechadeinicio">Fecha de inicio:</label>
                <br />
                <?php
				echo '<input type="date" name="fechadeinicio" id="fechadeinicio"  value="'.date("Y-m-d").'"/>';
				?>
                
				<br /><label for="fechacontrato">Fecha del contrato:</label>
                <br />
                <?php
				echo '<input type="date" name="fechacontrato" id="fechacontrato"  value="'.date("Y-m-d").'"/>';
				?>
              </p>
              <p class="pies">Cargo:<br />
                <label for="cargo"></label>
                <?php
                echo '<input type="text" name="cargo" id="cargo" value="20" />';
				?>
                <br />
                <br />
                Aprobacion:<?php echo '('._valoracion($nosol).'  )'; 
				?><br />
                
                <select name="valoracion" class="titulo" id="valoracion">
                <?php  
										
						//if (_valoracion($nosol)==""){
						  echo '<option VALUE="APROBADO" >APROBADO</option>
						  <option VALUE="RECHAZADO">RECHAZADO</option><BR><input type="submit" name="guardar" 
						  id="guardar" value="ACTUALIZAR VALORACION" />';
					    //else{
						//  echo'Ya ha sido '._valoracion($nosol).'NO PUEDE HACER UNA VALORACION';}
					  
  					                
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