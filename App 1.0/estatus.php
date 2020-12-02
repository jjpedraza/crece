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


      <img src="img\logotipo.jpg"  width="136" height="58"/>
    
     <BR />
     Aldama, Tamaulipas.<br /><br />
     
     
     <?php
require ("config.php");
require ("funciones.php");
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);
$nosol=$_GET["nosol"];
$result=mysql_query("SELECT * FROM tabladepagos WHERE nosol=".$nosol."",$link);
$fila=mysql_fetch_array($result);

     //TABLA DE PAGOS
	 
	echo '	TABLA DE PAGO:<br>';	
	echo '<table border=1 cellpadding="3" cellspacing="0"n style="border-collapse:collapse">';
	echo '<tr  bgcolor="#CCCCCC" class="pies">
	<td></td>
    <td>No</td>
	<td>Vencimiento</td>
	<td>Semana</td>
	<td>Abono</td>
	<td>Int ('._tasainteres($nosol).'%)</td>
	  <td>Moratorio</td>
	<td>Total</td>
  
	<td>Comentario</td>
	
	</<tr>';
	
	echo '<tr class="entablado">';
        echo '<td>';
        if ($fila["estado"]=="X"){echo'<img src="img\bien.jpg">';}
        if ($fila["vencimiento"] < date("Y-m-d")){
            if ($fila["estado"]=="X"){}else{
                echo'<img src="img\mal.jpg">';                
            }
        }
       $fila["estado"].'</td>';	
		echo '<td>'.$fila["no"].'<br></td>';
        echo '<td>'.$fila["vencimiento"].'</td>';
		echo '<td>'.$fila["semana"].'</td>';
         $interes=($fila["abono"]/100)*_tasainteres($nosol);
	
		echo '<td> $'.number_format($fila["abono"],2,".",",").'</td>'.'<td> $'.number_format($interes,2,".",",").'</td>';
	
		echo '<td>';
        $mora=_moratoriov2($fila["nosol"],$fila["no"],"no");
        if (_moratoriov2($fila["nosol"],$fila["no"],"no")>0){
            echo '$ '.number_format(_moratoriov2($fila["nosol"],$fila["no"],"no"),2,".",",");
			$total_recargos=_moratoriov2($fila["nosol"],$fila["no"],"no");
        }
        else
        {
            $total_recargos=0;
            
        }
        
        
		
		echo '</td>';
       	$total= $fila["abono"] +$interes+ _moratoriov2($fila["nosol"],$fila["no"],"no");
		$grantotal = $total;
		
		echo '<td bgcolor="#F2F2F2"><b>$'.number_format($total,2,".",",").'</b></td>';
		
        echo '<td>'.$fila["comentario"].'</td>';
		echo '</tr>';
		
		$total_abono=$fila["abono"];
		$total_interes=$fila["interes"];
	
	while ($fila = mysql_fetch_array($result))
		{
		extract($fila);	
		echo '<tr class="entablado">';
        echo '<td>';
        if ($fila["estado"]=="X"){echo'<img src="img\bien.jpg">';}
        if ($fila["vencimiento"] < date("Y-m-d")){
            if ($fila["estado"]=="X"){}else{
                echo'<img src="img\mal.jpg">';                
            }
        }
       $fila["estado"].'</td>';	
		echo '<td>'.$fila["no"].'<br></td>';
        echo '<td>'.$fila["vencimiento"].'</td>';
		echo '<td>'.$fila["semana"].'</td>';
        $interes=($fila["abono"]/100)*_tasainteres($nosol);
		
		echo '<td> $'.number_format($fila["abono"],2,".",",").'</td>'.'<td> $'.number_format($interes,2,".",",").'</td>';

		echo '<td>';
			
		$mora=_moratoriov2($fila["nosol"],$fila["no"],"no");
        if (_moratoriov2($fila["nosol"],$fila["no"],"no")>0){
            echo '$ '.number_format(_moratoriov2($fila["nosol"],$fila["no"],"no"),2,".",",");
			$total_recargos=_moratoriov2($fila["nosol"],$fila["no"],"no");
        }
        else
        {
            $total_recargos=0;
            
        }
			
		$total_recargos=$total_recargos+_moratoriov2($fila["nosol"],$fila["no"],"no");
		echo '</td>';
        
        $total= $fila["abono"] +$interes+ _moratoriov2($fila["nosol"],$fila["no"],"no");
		
		$grantotal=$grantotal+$total;
		$total_abono=$total_abono+$fila["abono"];
		$total_interes=$total_interes+$interes;
		echo '<td bgcolor="#F2F2F2"><b>$'.number_format($total,2,".",",").'</b></td>';
		
        echo '<td>'.$fila["comentario"].'</td>';
		echo '</tr>';
		
	}
	if ($total_recargos<0){$total_recargos=0;}
	echo ' 
	<tr class="entablado">
	<td></td>
    <td></td>
	<td></td>
	<td></td>
	<td> <b>$'.number_format($total_abono,2,".",",").'</b></td>
	<td><b>$'.number_format($total_interes,2,".",",").'</b></td>
	  <td><b>$'.number_format($total_recargos,2,".",",").'</b></td>
	<td><b>$'.number_format($grantotal,2,".",",").'</b></td>
  
	<td></td>
	
	</<tr>';
		
				
		

	
	echo '</table>';
	echo '<p align="center" class="normal2">';
	echo 'Nombre:'.nombre($curp).'<br>';
	echo 'No. de contrato:'.$nosol.'<br>';
	echo 'CURP:'.$curp.'<br>';
	echo 'Integrantes del grupo: '._integrantes($nosol);
	echo '</p>';
	?>
      <p><br />
      </p></td>
  </tr>
  <tr>
  
</table>

</body>
</html>