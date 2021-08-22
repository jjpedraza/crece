<?php
require ("rintera-config.php");
require ("components.php");
include("seguridad.php");

if (isset($_GET['id'])){ //Ticket
    $IdCorte = VarClean($_GET['id']);
    $sql = "select * from corte WHERE id ='".$IdCorte."'";        
    $rc= $db1 -> query($sql);
    if($f = $rc -> fetch_array())
    {   
        $Curp = NoSol_to_Curp($f['nosol']);
        $Cliente = Cliente_Nombre($Curp);    
        $Grupo = Cliente_Grupo($Curp);

        echo '<p>';
        echo'<img border="0" src="img/logo_color.png"  width="120" height="80" style="margin-left:50px;"/>
        <br></p>';

        
        echo '<b style="font-size:12pt; font-family:courier new;">'.$Cliente.'</b><br>';
        echo '<b style="font-size:10pt; font-family:courier new;">'.$Curp.'</b><br>';
        echo '<b style="font-size:10pt; font-family:courier new;">'.$Grupo.'</b><br>';
        echo '<b style="font-size:10pt; font-family:courier new;">Contrato: '.$f['nosol'].'</b><br>';

        

        echo '<b style="font-size:10pt; font-family:courier new;">No: '.$f['no'].'/'.Cuenta_NPagos($f['nosol']).'</b>';
        

    } else {
        echo "ERROR; Ticket ",$IdCorte." no encontrado";
    }
    unset($sql, $rc, $f);

} else{
    if (isset($_GET['nosol'])){// Buscar uno o varios etiquetados del mismo pago
        $NoSol = VarClean($_GET['nosol']);
        $NPago = VarClean($_GET['n']);
        $Curp = NoSol_to_Curp($NoSol);
        $Cliente = Cliente_Nombre($Curp);
    }
    
}


    
?>