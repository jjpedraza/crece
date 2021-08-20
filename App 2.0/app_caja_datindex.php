<?php
// include("head.php");

// include("header.php");
include("seguridad.php");  
require ("rintera-config.php");
require ("components.php");
// require ("app_funciones.php");
echo '<datalist id="contratos" style="

">';
$sql="
SELECT
	c.nosol, 
	c.curp, 
	clientes.nombre
	
FROM
	cuentas AS c
	INNER JOIN	clientes	ON 		c.curp = clientes.curp
	
WHERE
	valoracion = 'APROBADO'
";
$r= $db1 -> query($sql);
while($f = $r -> fetch_array()) {          
  echo '<option  value="'.$f['nosol'].'">'.$f['nosol'].' - '.$f['nombre'].'</option>';
}
unsert($r, $f);
  
echo '</datalist>';

?>

<?php
// include("footer.php");
?>