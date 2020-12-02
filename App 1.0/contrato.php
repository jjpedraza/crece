<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CONTRATO</title>

<link href="css/contrato.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
require ("funciones.php");
require ("config.php");
$nosol=$_GET["nosol"];
if (no_esta($nosol)=="SI"){
if (_valoracion($nosol)=="APROBADO")	{
echo '
<table border="0" width="800">
  <tr>
    <td width="78" valign="top"><img src="img/logotipo.jpg" width="205" height="135" /></td>
    <td width="260" valign="top"><span class="contrato_titulo"></span><br />
    <br /></td>
    <td width="448" align="right"><strong><b>PAGARE SOLIDARIO </b><br />';
//echo '('.	_tipodecredito($nosol).')';
	
      echo '
       <br />
       <strong><span class="contrato_subtitulo">No: </span><span class="contrato_resaltado"><b>'.$nosol.'</b></span></strong>
<span class="contrato_subtitulo"> bueno por $<span class="contrato_resaltado"> ';

$interes=((_cantidad($nosol)/100)*_tasainteres($nosol))*plazo_de_pago($nosol);
$total=$interes+_cantidad($nosol);



echo number_format($total,2,".",",")

.'</span> <br />
       ('.numtoletras($total).')</span>    </strong>
    </td>
  </tr>
</table>
<p align="right" class="contrato_texto">Aldama, Tamaulipas a '.fechacompleta(_fechacontrato($nosol)).'</p>
<p class="contrato_texto">Por el presente pagare me obligo incondicionalmente a pagar a la orden de CRECE Y MAS S.A. DE C.V. Representada por el C. Edgar Treviño Sosa,  en sus oficinas en Aldama, Tamaulipas, o en cualquiera otra plaza que se nos indicará, en fechas y montos establecidos en el presente pagare. </p>
<p class="contrato_texto">El valor total que ampara este Pagaré ha sido recibido en efectivo y a nuestra entera satisfacción este pagaré ampara una serie de <span class="contrato_texto_subrayado"><b> ';

// calculo del numero de pagos
	$formadepago=forma_de_pago($nosol);
	$plazo=plazo_de_pago($nosol);


	$como="";
	if ($formadepago==7){
		$como="semanal";	
		$npago = 4 * $plazo;	
		}
	if ($formadepago==15){
		$como="quincenal";	
		$npago = 2 * $plazo;
		}
	if ($formadepago==30){
		$como="mensual";	
		$npago = 1 * $plazo;
		}


echo round($npago)
.' pagos </b></span>de forma <span class="contrato_texto_subrayado"><b>'.$como.'  en '.$plazo.' meses</b></span> y todos están sujetos a la condición de que, al no pagarse cualquiera de ellos y se tenga saldo vigente, serán exigibles de manera anticipada todos los que le sigan en fecha de vencimiento, además de los pagos ya vencidos. <br />
  <br />
  La cantidad importe de este pagare causara interes ordinario, que resulte de multiplicar la Tasa del CINCO POR CIENTO MENSUAL, durante el tiempo que tenga vigencia en este crédito. <br />
  <br />';
  
  $tasa=_tasamoratorio($nosol)+_tasainteres($nosol);
  
  echo '
  
  Si el importe correspondiente a cada uno de los pagos no fuere pagado a su vencimiento '.fechacompleta(_fechaultimadepago($nosol));
  
  
  
  echo ', causara intereses moratorios de '._tasamoratorio($nosol).'% mensual mas el interes ordinario mensual,  por el tiempo en que el adeudo continué insoluto.<br><br>  
  El suscriptor y los avales, aceptan que en caso de controversia judicial, independientemente del domicilio que tengan, se someterán a la Jurisdicción del XV Distrito Judicial en el Estado Con Residencia en los municipios de Gonzalez y Aldama Tamaulipas. </p><br><br>
';


if (_tipodecredito($nosol)=="INDIVIDUAL"){
	
	if (_aval($nosol)==""){
		echo '<table border="0" class="contrato_texto" align="center"><tr>
		<td align="center" width="60">';
			echo '_______________________________<br> C. '._nombre($nosol).'<br> (Firma y huella)';
		echo '</td></tr>';
		echo '</table>';	
		
		//echo "* no cuenta con Aval";
		}else
		{
		echo '<table border="0" class="contrato_texto" align="center"><tr>
		<td align="center" width="60">';
			echo '_______________________________<br>C. '._nombre($nosol).'<br> (Firma y Huella)';
		echo '</td><td width="20"></td><td align="center" width="60">';	
		echo '_______________________________<br>C. '._aval($nosol).'<br>(Firma y Huella)';
		echo '</td></tr>';
		echo '</table>';	
			}
	
	
	
	}

else{
//LISTA DE LOS INTEGRANTES DEL GRUPO:

    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$hoy=date("Y-m-d");
	echo '<p class="contrato_texto">';
	echo 'El Grupo : '._aquegrupoperteneceestecontrato($nosol).' acepta los terminos de este pagare para su cumplimiento<br>';
echo '<table border=1 cellpadding="3" cellspacing="0"n style="border-collapse:collapse" class="contrato_texto">';
			echo '<tr  bgcolor="#57020F"; style="color:white;">
			<td>No. </td>
			<td>Integrante</td>
			<td>Domicilio</td>
			<td>Firma</td>				
			</<tr>';	
			
	$sql = "SELECT * FROM clientes WHERE grupo='"._aquegrupoperteneceestecontrato($nosol)."' ORDER BY grupo_cargo";
	$resultado=mysql_query($sql);
	$n=0;		
	while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		$n=$n+1;
		if ($fila["grupo_cargo"]=="PRESIDENTE"){		
				echo '<tr>'.
				'<td>1</td>'.
				'<td>C. '.$fila["nombre"].'<br><b>'.$fila["grupo_cargo"].'</b></td>';
				echo '<td>'.domicilio($fila["curp"]).'</td>';
				echo '<td width="200"></td>
				</tr>';}
		}


	$sql = "SELECT * FROM clientes WHERE grupo='"._aquegrupoperteneceestecontrato($nosol)."' ORDER BY grupo_cargo";
	$resultado=mysql_query($sql);
	$n=0;		
	while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		$n=$n+1;
		if ($fila["grupo_cargo"]=="SECRETARIO"){		
				echo '<tr>'.
				'<td>2</td>'.
				'<td>C. '.$fila["nombre"].'<br><b>'.$fila["grupo_cargo"].'</b></td>';
				echo '<td>'.domicilio($fila["curp"]).'</td>';
				echo '<td width="200"></td>
				</tr>';}
		}


	$sql = "SELECT * FROM clientes WHERE grupo='"._aquegrupoperteneceestecontrato($nosol)."' ORDER BY grupo_cargo";
	$resultado=mysql_query($sql);
	$n=0;		
	while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		$n=$n+1;
		if ($fila["grupo_cargo"]=="TESORERO"){		
				echo '<tr>'.
				'<td>3</td>'.
				'<td>C. '.$fila["nombre"].'<br><b>'.$fila["grupo_cargo"].'</b></td>';
				echo '<td>'.domicilio($fila["curp"]).'</td>';
				echo '<td width="200"></td>
				</tr>';}
		}

	$sql = "SELECT * FROM clientes WHERE grupo='"._aquegrupoperteneceestecontrato($nosol)."' ORDER BY grupo_cargo";
	$resultado=mysql_query($sql);
	$n=3;		
	while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		$n=$n+1;
		if (($fila["grupo_cargo"]=="PRESIDENTE") or ($fila["grupo_cargo"]=="SECRETARIO") or ($fila["grupo_cargo"]=="TESORERO")){}else{		
				echo '<tr>'.
				'<td>'.$n.'</td>'.
				'<td>C. '.$fila["nombre"].'<br><b>'.$fila["grupo_cargo"].'</b></td>';
				echo '<td>'.domicilio($fila["curp"]).'</td>';
				echo '<td width="200"></td>
				</tr>';}
		}


}
		echo '</table><br><p class="contrato_texto">Créditos sujetos a aprobación por CRECE Y MAS S.A. de C.V., misma que NO requiere autorización de la Secretaria de Hacienda y Crédito Publico, para la realización de operaciones de crédito, y no está sujeta a la supervisión y vigilancia de la Comisión Nacional Bancaria y de Valores.</p>';


}
else
{
	echo '<CENTER>NO ESTA APROBADO EL CONTRATO '.$nosol;
	echo '<br> Valoracion: '._valoracion($nosol);
	echo '<br><a href="index.php">Regresar al menu</a></CENTER>';
	
	}
}
else
{
	echo '<CENTER>NO SE ENCONTRO EL CONTRATO '.$nosol;
	echo '<br><a href="index.php">Regresar al menu</a></CENTER>';

	}
?>

</body>
</html>