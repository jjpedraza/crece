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
    <td align="center" valign="top">
      <p><span class="titulo" > CAJA: pagos </span></p>
      <p>
      
       <?php
require ("config.php");
require ("funciones.php");

$nosol=$_POST["nosol"];
echo '<form id="form1" name="form1" method="post" action="caja_pagoordinario_valida.php">';
echo 'No. de contrato:<br><input name="nosol" type="text" readonly="readonly" value="'.$nosol.'" /><br>';



 	mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol . "' and  
	estado<>'X' ORDER BY nosol");
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
      	echo 'CURP:<br><input name="curp"  
		 type="text"readonly="readonly" value="'.$row["curp"].'"><br><br>';
		 
      	echo 'No pago:<br><input name="nopago"  
		 type="text"readonly="readonly" value="'.$row["no"].'"><br><br>';
		 
		echo '<p><label for="Abono" class="pies">Abono:</label><br />
		<input name="abono"  readonly="readonly"  type="text" id="abono" value="$ '.number_format($row["abono"],2,".",",").'" /></p>';
			   
		echo '<p><label for="Abono" class="pies">Interes:</label><br />
		<input  readonly="readonly"  name="interes" type="text" id="interes" value="$'.number_format($row["interes"],2,".",",").'" /></p>';

			$sem1=$row["semana"];
			$semHoy=_enquesemana(date("Y-m-d"));
			$retraso=$semHoy-$sem1;
	
			$recargos=($retraso*_cargo($row["nosol"]))*_integrantes($row["nosol"]);

if ($recargos>0){
		echo '<p><label for="Abono" class="pies">Recargo:</label><br />
		<input  readonly="readonly"  name="recargo" type="text" id="recargo" value=$'.number_format($recargos,2,".",",").' /></p>';
	}
    else
    {
    echo '<p><label for="Abono" class="pies">Recargo:</label><br />
		<input  readonly="readonly"  name="recargo" type="text" id="recargo" value="" /></p>';    
    }	
    if (_moratoriodebe($nosol,$row["no"])>0){			   
		echo '<p><label for="Abono" class="pies">Interes Moratorio:</label><br />
		<input  readonly="readonly"  name="moratorio" type="text" id="moratorio" value=$'.number_format(_moratoriodebe($nosol,$row["no"]),2,".",",").' /></p>';
		}
        else
        {
		echo '<p><label for="Abono" class="pies">Interes Moratorio:</label><br />
		<input  readonly="readonly"  name="moratorio" type="text" id="moratorio" value="" /></p>';
            
            
        }
if ($retraso>0){        
		echo '<p><label for="Abono" class="pies">Comentario sobre moratorio:</label><br />
		<input  readonly="readonly"  size="50" name="mocac" type="text" id="mocac" value="'.$retraso.' semanas de retraso"/></p>';
		}
        else
        {
        echo '<p><label for="Abono" class="pies">Comentario sobre moratorio:</label><br />
		<input  readonly="readonly"  size="50" name="mocac" type="text" id="mocac" value="" /></p>';    
        }
		echo '<p><label for="Abono" class="pies">Fecha de vecimiento:</label><br />
		<input readonly="readonly" name="vencimiento" type="text" id="vencimiento" value='.$row["vencimiento"].' /></p>';

		echo '<p><label for="Abono" class="pies">Cargos:</label><br />
		<input readonly="readonly" name="cargos" type="text" id="cargos" value='._cargos($row["curp"],"no").' /></p>';

		echo '('._cargos($row["curp"],"SI").')';

		if ($recargos<0){$recargos=0;} 

				$total = $row["abono"] + $row["interes"] + $row["iva"] + _moratoriodebe($nosol,$row["no"])+_cargos($row["curp"],"no")+$recargos	;
				echo '<br><br>
				  <label for="total">TOTAL</label>
				  <br />

				  <input readonly="readonly"  name="total" type="text" class="textbox" id="total" value="$'.number_format($total,2,".",",").'" />
				</p>';
} else {

}











echo '<input type="submit" name="seleccionar" id="seleccionar" value="PAGAR" />';

echo '</form>';



	?>
      
      
      
      

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