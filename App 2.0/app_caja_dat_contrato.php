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
        $sql = "select * from cartera WHERE nosol='".$NoSol."' and EstadoPago='SIN PAGAR' order by NPago + 0";
        $r= $db1 -> query($sql);
        echo "<table class='tabla'>";
        echo "<th>No</th>";
        echo "<th>Debe</th>";
        echo "<th>Atraso | Fecha</th>";
        
        $Curp = "";
        $GranTotal = 0;
        while($Sol = $r -> fetch_array()) {          
            if ($Sol['CarteraEstatus']=='VENCIDO'){
                echo "<tr style='background-color:red;'>";
            } else {
                echo "<tr>";
            }
            
            echo "<td><a rel=MyModal:open style='font-size:9pt;cursor:pointer;' href='#Info_".$Sol['NPago']."'>".$Sol['NPago']."</a></td>";
            echo "<div id='Info_".$Sol['NPago']."' class='MyModal'>";
            echo "<h5>Detalles del Pago No.".$Sol['NPago']."</h5>";
            echo "<table>";
            echo "<tr><td>Capital: </td><td>".Pesos($Sol['abono'])."</td></tr>";
            echo "</table>";

            echo "</div>";

            echo "<td><a style='font-size:9pt;cursor:pointer;' class='btn-Link' onclick='CajaComponents(".$Sol['NPago'].");'>".Pesos($Sol['TOTAL'])."</a></td>";
            if ($Sol['CarteraEstatus']=='VENCIDO'){            
                echo "<td>".DiasAmigables($Sol['mora_dias'])."</td>";
            } else {
                echo "<td>".$Sol['fecha']."</td>";
            }
            

            echo "</tr>";
            $Curp = $Sol['CURP'];
            $GranTotal = $GranTotal + $Sol['TOTAL'];
        }
        echo "<td colspan='3' style='background-color:orange; cursor:pointer;' onclick='CajaComponents(0);'>
        <b style='font-size:14pt;'>".Pesos($GranTotal)."</b><br>
        <cite>".NumToLetras_Moneda($GranTotal)."</cite>
        </td>";
        echo "</table>";

        echo "<hr><a target=_blank class='btn btn-secondary' href='print_edocuenta.php?id=".$NoSol."'>Edo.Cuenta</a> ";
        echo "<a target=_blank class='btn btn-secondary' href='/app_carnet.php?id=".$Curp."'>Cliente</a>";
        unset($r,$sql, $Sol);

        echo "<script>CajaComponents(0);</script>";



    } else {//Selecciono un pago

    }
}
?>

<?php
// include("footer.php");
?>