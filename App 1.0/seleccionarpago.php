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
<link href="css/contrato.css" rel="stylesheet" type="text/css" />


</head>
<body  topmargin="0" bottommargin="0">



     
     
     <?php
require ("config.php");
require ("funciones.php");
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);
$nosol=$_GET["nosol"];
$no=_siguientepago($nosol);
$result=mysql_query("SELECT * FROM tabladepagos WHERE nosol=".$nosol." AND no='".$no."'",$link);
$fila=mysql_fetch_array($result);

   echo '<p align="center" class="contrato_texto">';
	echo 'Nombre:'._nombre($nosol).'<br>';
	echo 'No. de contrato:'.$nosol.'<br>';
	//echo 'GRUPO:'._aquegrupoperteneceestecontrato($nosol).'<br>';
	echo 'TIPO: '._tipodecredito($nosol);
	echo '</p>';
	
	echo '<p class="normal"><center>';
        echo '';
		echo '<form id="form1" name="form1" method="post" action="caja_pagoordinario_valida.php">';
		echo 'contrato:<br><input type="text" name="nosol" readonly="readonly" VALUE="'.$nosol.'"><br>';
        if ($fila["fin"]>date("Y-m-d")){
			echo '<font color="#FF0000"><B>ESTA ADELANTANDO SEMANA </B></font>';
			}
        echo 'No:'.$fila["no"].'/'._cuantospagos($nosol).'<br><input type="text" name="no" readonly="readonly" VALUE="'.$fila["no"].'"><br>';
        
		
	
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
					echo 'Abono:<br><input type="text" name="abono" readonly="readonly" VALUE="'.number_format($ultimopago,2,".","").'"><br>';

			}else{
						echo 'Abono:<br><input type="text" name="abono" readonly="readonly" VALUE="'.number_format($abonof,2,".","").'"><br>';

				}
		
        
			
	//calculo de semanas de recargo
		$hoy=date("Y-m-d");	
		$debe=0;	
		if ($fila["fin"]<=$hoy){
			$dias_diferencia=diasvencidos($fila["fin"]);
			$semanas=round($dias_diferencia/7);
                if ($semanas<=0){$semanas=0;}
				if (_dia_grupo($hoy)=="SI"){}else{
				$semanas=$semanas+1;	
				}
					if (_tipodecredito($nosol)=="INDIVIDUAL"){
					$debe=$semanas*_cargo($nosol);}
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
	
	
	    
        echo 'Recargos:<br><input type="text" name="moratorio" readonly="readonly" VALUE="'.number_format($debe,2,".","").'"><br>';
        
		$descuento=_descuento($nosol,$no,"no");
		$recargos_descuento=($debe/100)*$descuento;
		echo '<font color="#FF0000">Retencion de Recargos: '.$descuento.'%<br><input type="text" name="descuento" readonly="readonly" VALUE="'.$recargos_descuento.'"></font><br>';
		
		
		$extras=_cuantosextras($nosol,$fila["no"],"no");
        echo 'Extraordinarios: '._cuantosextras($nosol,$fila["no"],"SI").'<br><input type="text" name="extras" readonly="readonly" VALUE="'.$extras.'"><br>';
        
		
       	
      
	    $total= $abonof + ($debe-$recargos_descuento) +$extras;
		echo 'Total:<br><input type="text" name="total" readonly="readonly" VALUE="'.number_format($total,2,".","").'"><br>';
  
	   
	   echo '<br><br>Ahorro:<br><input type="text" 	name="ahorro"  VALUE=""><br>';
	   echo '<hr><br><br>Recibo:<br><input required="required" type="text" name="recibo"  VALUE=""><br>';
       
	   
	   
	   
	    echo '<br>'.$fila["comentario"].'<br>';
		
echo '<input type="submit" name="seleccionar" id="seleccionar" value="PAGAR" /></center></form>';

	
	?>
      <p><br />
      </p></td>
  </tr>
  <tr>
  
</table>

</body>
</html>