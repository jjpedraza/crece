<?php
// include("head.php");

// include("header.php");
include("seguridad.php");  
require ("rintera-config.php");
require ("components.php");
// require ("app_funciones.php");


$IdSucursal = $_POST['IdSucursal'];
$TipoCredito = $_POST['TipoCredito'];
$no_sol = NoSol_generar($IdSucursal);

// Toast($no_sol,0,"");

$Curp  = VarClean($_POST['IdCliente']);
$IdGrupo = Cliente_IdGrupo($Curp);
$CuentasActivas = Grupo_CuentasActivas($IdGrupo);
$Cargo = Cliente_Grupo_cargo($Curp);

//VALIDACIONES:

//1.- Que no tenga cuentas activas el Grupo



if ($CuentasActivas > 0){
    Toast("No se puede crear otra cuenta; ya que tienes una aun por pagar",2,"");
    
    
} else {
    //2.- Que el que solicite sea presidente (Se entiende como representante Legal del grupo)
    Toast("Cargo".$Cargo,"",1);
    var_dump($Cargo);
    if ($Cargo == 'PRESIDENTE'){                   
        $sql="
        INSERT INTO cuentas(nosol, curp, fechasol, IdSucursal, tipo, IdGrupo) VALUES ('".$no_sol."', '".$Curp."','".$fecha."', '".$IdSucursal."','GRUPAL','".$IdGrupo."')";
        // echo $sql;
        if ($db1->query($sql) == TRUE){
                Historia($RinteraUser,"CLIENTES","Creo la solicitud ".$no_sol." para el Cliente con CURP= ".$Curp.", siendo PRESIDENTE del IdGrupo ".$IdGrupo);
                Toast("Solicitud  ".$no_sol." creada correctamente",4,"");
                //Redirigir
                $url="app_solicitud.php?n=".$no_sol;
                echo "<script>"."window.location.replace('".$url."')"."</script>";            
        } else {
            Toast("Error al guardar ".$no_sol."",2,"");
        }
    } else {
        Toast("El cliente tiene que tener el cargo de PRESIDENTE del grupo para poder solicitarlo de forma grupal; actualmente tiene el cargo de ".$Cargo,2,"");
    }
}
unset($Curp, $sql);


?>

<?php
// include("footer.php");
?>