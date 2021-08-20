<?php
include("seguridad.php");  
require ("rintera-config.php");
require ("components.php");
// require ("app_funciones.php");

$NoSol = VarClean($_POST['NoSol']);
$PagosQueDebe = NDebe($NoSol);

if ($PagosQueDebe<= 0){
    Toast("El Contrato ".$NoSol." no debe ningun pago",2,"");
} else {
    $NSelect = VarClean($_POST['n']);
    if ($NSelect == 0) {
    
        $DebeTotal=DebeTotal($NoSol);

    } else {//Selecciono un pago
        $DebeTotal=DebePago($NoSol,$NSelect);
    }
    // $DebeTotal=DebeTotal($NoSol);
    //--------\/ Cantidad a Recibir
    echo '<div class="form-group disable" style="margin: 4px; padding: 4px; width:100%; border-radius: 5px;vertical-align: top;">';
        $IdElement = "CantidadRecibida";
        $Label="Recibida:";
        $SmallText="Cantidad que recibe en caja";
        $Value = Moneda($DebeTotal);
        echo '
            <label for="'.$IdElement.'" style="font-size:8pt;">'.$Label.'</label>
            <input title="'.$Value.'" style="cursor:pointer; font-size:12pt; height:50px; margin-top:-7px;" type="number" class="form-control" id="'.$IdElement.'" placeholder="" value="'.$Value.'" >
            <small id="'.$IdElement.'_smalltext'.'" class="form-text text-muted" style="font-size: 7pt;
            margin-top: -2px;">'.$SmallText.'</small>
        </div>';
    //------ /\ Cantidad a Recibir
}
?>

<?php
// include("footer.php");
?>