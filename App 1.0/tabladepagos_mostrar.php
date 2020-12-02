<?php
$nosol="2009012474125";
require ("config.php");
require ("funciones.php");

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$sql = "SELECT abono, comentario, cuenta_interna, curp, estado, interes, iva, no, nosol, vencimiento FROM tabladepagos WHERE nosol='".$nosol."'";
$resultado=mysql_query($sql);
	echo '	TABLA DE PAGO<br>';	
	echo '<table border=1 cellpadding="3" cellspacing="0"n style="border-collapse:collapse">';
	echo '<tr  bgcolor="#CCCCCC">
	<td>No</td>
	<td>Vencimiento</td>
	<td>Saldo </td>
	<td>Abono</td>
	<td>Int('._tasainteres($nosol).'%)</td>
	<td>iva('._ivatipo($nosol).'%)</td>
	<td>Total</td>
    <td>Estado</td>
	<td>Comentario</td>
	
	</<tr>';
	$saldo=_cantidad($nosol);
while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		if (diasvencidos($vencimiento)>0){echo'<tr style="color:#F00">';}else{echo '<tr>';}
			echo '<td>'.$no.'</td>';	
			echo '<td>'.$vencimiento.'</td>';
			$saldo = $saldo - $abono;	
			echo '<td>'.$saldo.'</td>';	
			echo '<td>'.$abono.'</td>';	
			echo '<td>'.$interes.'</td>';	
			echo '<td>'.$iva.'</td>';	
			$total=$abono+$interes+$iva;
			echo '<td>'.$total.'</td>';	
			echo '<td>';
				if ($estado=="X"){echo'<img src="img\bien.jpg")';}else{
					if (diasvencidos($vencimiento)>0){
						echo'<img src="img\mal.jpg")<br>('.diasvencidos(date($vencimiento)).' dias)';
						}				
				}				
			echo '</td>';
			echo '<td>'.$comentario.'</td>';
		echo '</tr>';	
	}
echo'</table>';


?>