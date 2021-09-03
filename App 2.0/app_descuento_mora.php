<?php
include("seguridad.php");  
require ("rintera-config.php");
require ("components.php");
// require ("app_funciones.php");

$NoSol = VarClean($_POST['NoSol']);
$NPago =VarClean($_POST['NPago']);
$Descuento = VarClean($_POST['Descuento']);

if (NoSol_existe($NoSol)==TRUE){
    if (DebePago($NoSol,$NPago)>0){
        if ($Descuento > 0 ) {

            $Query="INSERT INTO descuetos (nosol, no, concepto, cantidad, act_user, act_fecha, act_hora, IdTipoDescuento) VALUES (
                '".$NoSol."',
                '".$NPago."',
                'Descuento Moratorio',
                '".$Descuento."',
                '".$RinteraUser."',
                '".$fecha."',
                '".$hora."',
                '1'
                
                

            )";            
            if ($db1->query($Query) == TRUE)
            {
                Toast("Se guardo correctamente el descuento",4,"");
                echo "<script>CargaContrato(0);</script>";
                echo "<script>MyModal.close();</script>";
            }
            else {
                Toast("Error al guardar, intenlo nuevamente <br>".$Query,2,"");

            }
            unset($Query);


        } else {
            Toast("Ingrese una cantidad para descontar",2,"");    
        }

    } else {
        Toast("El Pago ".$NPago." no tiene saldo, del contrato ".$NoSol,2,"");
    }

} else {
    Toast("No existe el contrato ".$NoSol,2,"");
}
?>

<?php
// include("footer.php");
?>