<?php
// include("head.php");

// include("header.php");
include("seguridad.php");  
require ("rintera-config.php");
require ("components.php");
// require ("app_funciones.php");



$no_sol = NoSol_generar();

Toast($no_sol,0,"");
$Curp  = VarClean($_POST['IdCliente']);
$sql="
INSERT INTO cuentas(nosol, curp, fechasol) VALUES ('".$no_sol."', '".$Curp."','".$fecha."')";
echo $sql;
if ($db1->query($sql) == TRUE){
        Historia($RinteraUser,"CLIENTES","Creo la solicitud ".$no_sol." para el Cliente con CURP= ".$Curp);
        Toast("Solicitud  ".$no_sol." creada correctamente",4,"");
        //Redirigir
        $url="app_solicitud.php?n=".$no_sol;
        echo "<script>"."window.location.replace('".$url."')"."</script>";
        
} else {
    Toast("Error al guardar ".$no_sol."",2,"");

}

unset($Curp, $sql);


?>

<?php
// include("footer.php");
?>