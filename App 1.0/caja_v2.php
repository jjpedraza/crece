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
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CAJA ver. 2.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
function sumar(uno,dos)
{
var total;
//total = parseInt(uno.value)+parseInt(dos.value);
//alert("El valor es " + total);

return Number(uno) + Number(dos);
return total;
}
</script>
<link href="caja.css" rel="stylesheet" type="text/css" />
<!--Fireworks CS6 Dreamweaver CS6 target.  Created Sat Jun 28 11:26:37 GMT-0500 2014-->

</head>
<body bgcolor="#d7d7d7">


 <?php
require ("config.php");
require ("funciones.php");
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);
$nosol=$_GET["nosol"];
$no=_siguientepago($nosol);
$result=mysql_query("SELECT * FROM tabladepagos WHERE nosol=".$nosol." AND no='".$no."'",$link);
$fila=mysql_fetch_array($result);
?>




<center>

<table style="display: inline-table;" bgcolor="#d7d7d7" border="0" cellpadding="0" cellspacing="0" width="800">
<!-- fwtable fwsrc="CAJA2.0.fw.png" fwpage="Página 1" fwbase="caja_v2.jpg" fwstyle="Dreamweaver" fwdocid = "1541706030" fwnested="0" -->
  <tr>
   <td><img src="img/spacer.gif" width="144" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="10" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="98" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="148" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="5" height="1" alt="" /></td>
   <td width="256"><img src="img/spacer.gif" width="256" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="139" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="1" alt="" /></td>
  </tr>

  <tr>
   <td rowspan="2"><img name="caja_v2_r1_c1" src="img/caja_v2_r1_c1.jpg" width="144" height="100" id="caja_v2_r1_c1" alt="" /></td>
   <td><img name="caja_v2_r1_c2" src="img/caja_v2_r1_c2.jpg" width="10" height="93" id="caja_v2_r1_c2" alt="" /></td>
   <td bgcolor="#FFFFFF" width="98" height="93" valign="middle" align="center">
   
   
   <?php
	echo "<a target='new' href='foto_mostrar.php?curp=".$fila["curp"]."'>
	<img border='0' src='foto_mostrar.php?curp=".$fila["curp"]."' height='88' width='94'/></a>";
	?>
   
   </td>
   <td rowspan="2" colspan="3" background="img/caja_v2_r1_c4.jpg"  align="left" valign="top">
   
   <?php
    echo '<p class="titulo">';
	echo ' <b>'._nombre($nosol).'</b><br>';
	echo '# Contrato:'.$nosol.'<br>';
	//echo 'GRUPO:'._aquegrupoperteneceestecontrato($nosol).'<br>';
	echo 'TIPO: '._tipodecredito($nosol);
	if (_tipodecredito($nosol)=="GRUPO"){
		echo ' <b>"'._aquegrupopertenece($fila["curp"]).'"</b>';}
	
	if (forma_de_pago($nosol)==7){echo '<br> FORMA: Semanal';}
	if (forma_de_pago($nosol)==15){echo '<br> FORMA: Quincenal';}
	if (forma_de_pago($nosol)==30){echo '<br> FORMA: Mensual';}
	
	
	echo '</p>';
   
   ?>
   
   
   </td>
   <td rowspan="2"><img name="caja_v2_r1_c7" src="img/caja_v2_r1_c7.jpg" width="139" height="100" id="caja_v2_r1_c7" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="93" alt="" /></td>
  </tr>
  <tr>
   <td colspan="2"><img name="caja_v2_r2_c2" src="img/caja_v2_r2_c2.jpg" width="108" height="7" id="caja_v2_r2_c2" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="7" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2"><img name="caja_v2_r3_c1" src="img/caja_v2_r3_c1.jpg" width="144" height="46" id="caja_v2_r3_c1" alt="" /></td>
   <td colspan="5" background="img/caja_v2_r3_c2.jpg" width="517" height="42"  valign="middle" align="center">
   <?php
   echo '<span class="tpago">Pago No. '.$fila["no"].' de '._cuantospagos($nosol).'</span>';

       if ($fila["fin"]>date("Y-m-d")){
			echo '<font color="#FF0000"><br><B>Esta adelantando Semana </B></font>';
			}
   
   ?>
   
   
   
   
   
   </td>
   <td rowspan="2"><img name="caja_v2_r3_c7" src="img/caja_v2_r3_c7.jpg" width="139" height="46" id="caja_v2_r3_c7" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="42" alt="" /></td>
  </tr>
  <tr>
   <td colspan="5"><img name="caja_v2_r4_c2" src="img/caja_v2_r4_c2.jpg" width="517" height="4" id="caja_v2_r4_c2" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="4" alt="" /></td>
  </tr>
  <tr>
   <td background="img/caja_v2_r5_c1.jpg">&nbsp;</td>
  
  
   <?php
   if ( _debevencidos($nosol)>0)
	   {
   		echo '<td id="caj" colspan="5" background="img/rojo.jpg" height="270" valign="top" align="center">';
		
	   }
	else{
		if ($fila["fin"]>date("Y-m-d")){
			echo '<td id="caj" colspan="5" background="img/azul.jpg" height="270" valign="top" align="center">';
			}else{
   			echo '<td id="caj" colspan="5" background="img/verde.jpg" height="270" valign="top" align="center">';}
	   }
	
	   
   ?>
   
    <form id="form1" name="form1" method="post" action="caja_pagoordinario_valida.php">
    
    <table border="0" width="510">
    <tr>
    	<td valign="top" align="left">
        <?php
		
		
		
		$cantidad=_cantidad($nosol);
		$ti=_tasainteres($nosol);
		$interes=(($cantidad/100)*$ti)*plazo_de_pago($nosol);//pormes
		$cantidad=$cantidad+$interes;
		
		$plazo=plazo_de_pago($nosol); //meses
		$forma=forma_de_pago($nosol);	
		//echo $forma;
		 //semanas
		 	$x=0;
			if ($forma==7){$x=4;}
			if ($forma==15){$x=2;}
			if ($forma==30){$x=1;}
		
		$abonof=$cantidad/(plazo_de_pago($nosol)*$x);
			
		$abono2=$abonof;
//		$abonof=$abonof+0.6;
	//	$abonof=round($abonof);		
		
			if ($fila["no"]==_cuantospagos($nosol)){
					$cantidad2=$abonof*_cuantospagos($nosol);
					$diferencia = ($cantidad2-$cantidad);
					$ultimopago = $abonof -$diferencia;
					echo 'Abono:<br><input type="text" name="abono" readonly="readonly" VALUE="'.number_format($ultimopago,2,".",",").'"><br>';

			}else{
						echo 'Abono:<br><input type="text" name="abono" readonly="readonly" VALUE="'.number_format($abonof,2,".",",").'"><br>';

				}
		
        
			
		//calculo de semanas de recargo
		$hoy=date("Y-m-d");	
		$debe=0;	
		if ($fila["fin"]<$hoy){
			$dias_diferencia=diasvencidos($fila["fin"]);
			$semanas=round($dias_diferencia/7);
			if ($semanas<=0){$semanas=0;}
			
			
//			if (_dia_grupo($hoy)=="SI"){
//				//				
//				if ($semanas>=2){$semanas=$semanas+1;
//				}			
//			}else{$semanas=$semanas+1;}
				
				
			//si esta vencido el pago, cobrale la semana actual +1
			if (_vencidono($fila["nosol"],$fila["no"]) == 1) {
				$semanas=$semanas+1;
				//echo _vencidono($fila["nosol"],$fila["no"]);
				}
			//--------------
					if (_tipodecredito($nosol)=="INDIVIDUAL"){
						
						if (forma_de_pago($nosol)=="15"){
							
							$semanas = $semanas -1;
							$debe= $semanas*_cargo($nosol);
							$debe = $debe + 60;
								
							}
							else {
						
					$debe=$semanas*_cargo($nosol);}
					//echo $semanas;
					}
					else{
					$debe=$semanas*(_cargo($nosol)*(_cuantosgrupo(_aquegrupoperteneceestecontrato($nosol))));}						
					
					
					if ($debe>0){
						if (_estado($nosol,$fila["no"])=="X"){echo'<td>  </td>'; }else{
			//			echo'<td> ('.$semanas.' sem.)'.number_format($debe,2,".",",").'</td>';
						}
					}else{
						//echo'<td>  </td>';
					}
			}else{
					//echo'<td>  </td>';
				}
	
	
	    
        echo 'Recargos:<br><input type="text" name="moratorio" readonly="readonly" VALUE="'.number_format($debe,2,".",",").'"><br>';
        
		$descuento=_descuento($nosol,$no,"no");
		$recargos_descuento=($debe/100)*$descuento;
		echo '<font color="#FF0000">Retencion de Recargos: '.$descuento.'%<br><input type="text" name="descuento" readonly="readonly" VALUE="'.$recargos_descuento.'"></font><br>';
		
		
		$extras=_cuantosextras($nosol,$fila["no"],"no");
        echo 'Extraordinarios: '._cuantosextras($nosol,$fila["no"],"SI").'<br><input type="text" name="extras" readonly="readonly" VALUE="'.$extras.'"><br>';
        
		
       	
      
	    $total= $abonof + ($debe-$recargos_descuento) +$extras;
		echo 'Total:<br><input type="text" id="total" name="total" id="total" readonly="readonly" VALUE="'.number_format($total,2,".","").'"><br>';
  
		
		
		?></td>
    	<td valign="top" align="left">
        
        
   
   <?php
   		
		
		
		
		
	   echo 'Actualmente tiene <b> $'. _ahorro($nosol).'</b> ahorrados. <br>';
	   echo '¿Cuanto desea ahorrar?:<br><input type="text" 	id="ahorro" name="ahorro"  VALUE="" onkeypress="gran.value= sumar(ahorro.value,total.value)" ><br>';
	   echo '';
       
	   
	   
	   
	    echo ''.$fila["comentario"].'';
	
   
   
   
   
   
   
   
   
   
   
   //paso de variables
	echo  '<input type="hidden" value="'.$nosol.'" id="nosol" name="nosol"' .' />';
	   echo  '<input type="hidden" value="'.$fila["no"].'" id="no" name="no">';
   
   
   ?>
   
	<br>GranTotal (ahorro + Total):<br><input  type="text" name="gran" id="gran"  VALUE="" readonly="readonly" >
        
    <br>Recibo:<br><input required="required" type="text" name="recibo" id="recibo"  VALUE="" onkeypress="feria.value=recibo.value-gran.value" ><br>
    
    <br>Feria:<br><input  type="text" name="feria" id="feria"  VALUE="" readonly="readonly" ><br>
    
    	</td>
    <tr>
    </table>
    
    
    
    
    
    
    
    
    
    
    
    
    
   <input type="submit" name="seleccionar" id="seleccionar" value="PAGAR" />
   </form>
   
   
   
   </td>
   <td background="img/caja_v2_r5_c7.jpg">&nbsp;</td>
   <td><img src="img/spacer.gif" width="1" height="270" alt="" /></td>
  </tr>
  <tr>
   <td><img name="caja_v2_r6_c1" src="img/caja_v2_r6_c1.jpg" width="144" height="97" id="caja_v2_r6_c1" alt="" /></td>
   <td colspan="5" background="img/caja_v2_r6_c2.jpg" valign="top" align="center">
   <?php
   
   echo '<a href="estatus2.php?nosol='.$nosol.'"> VER TABLA DE PAGO</a>';
   
   
   ?>
   
   
   
   </td>
   <td><img name="caja_v2_r6_c7" src="img/caja_v2_r6_c7.jpg" width="139" height="97" id="caja_v2_r6_c7" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="97" alt="" /></td>
  </tr>
  <tr>
   <td><img name="caja_v2_r7_c1" src="img/caja_v2_r7_c1.jpg" width="144" height="87" id="caja_v2_r7_c1" alt="" /></td>
   <td colspan="5"><img name="caja_v2_r7_c2" src="img/caja_v2_r7_c2.jpg" width="517" height="87" id="caja_v2_r7_c2" alt="" /></td>
   <td><img name="caja_v2_r7_c7" src="img/caja_v2_r7_c7.jpg" width="139" height="87" id="caja_v2_r7_c7" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="87" alt="" /></td>
  </tr>
</table>
</center>
</body>
</html>
