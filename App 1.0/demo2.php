<?php
//require("funciones.php");
//echo dias_vencidos("2014-03-01");


//$fecha="2014-03-01 00:00:00";
//$fecha="2014-03-01";
//$segundos= strtotime('now') - strtotime($fecha);
//$diferencia_dias=intval($segundos/60/60/24);
//echo "La cantidad de dias entre el ".$fecha." y hoy es <b>".$diferencia_dias."</b>";

require ("config.php");
require ("funciones.php");

$nosol="2009012474125";

$formadepago=forma_de_pago($nosol);
echo '<br>'.$formadepago;
$plazo=plazo_de_pago($nosol);
echo '<br>'.$plazo;
?>