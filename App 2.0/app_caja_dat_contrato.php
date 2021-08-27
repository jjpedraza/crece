<?php
include("seguridad.php");  
require ("rintera-config.php");
require ("components.php");
// require ("app_funciones.php");

$NoSol = VarClean($_POST['NoSol']);
$PagosQueDebe = NDebe($NoSol);

if ($PagosQueDebe<= 0){
    Toast("El Contrato ".$NoSol." no debe ningun pago",2,"");
    echo "<script>AhorroDiv();</script>";
} 

    $NSelect = VarClean($_POST['n']);
    if ($NSelect == 0) {

        if (isset($_POST['mode'])){
            $sql = "select * from cartera WHERE nosol='".$NoSol."'  order by NPago + 0";
        } else {
            $sql = "select * from cartera WHERE nosol='".$NoSol."' and EstadoPago='SIN PAGAR' order by NPago + 0";
        }

        $r= $db1 -> query($sql);
        if (isset($_POST['mode'])){
            echo "<img title='PAGOS QUE DEBE' onclick='CargaContrato(0);' src='icons/arriba.png' style='width:12px; cursor:pointer;'>";
        } else {
            echo "<img title='TODOS LOS PAGOS' onclick='CargaContrato_full(0);' src='icons/abajo.png' style='width:12px; cursor:pointer;'>";
            

        }
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
                if ($Sol['CarteraEstatus']=='PAGADO'){
                    echo "<tr style='background-color:green;'>";
                } else {
                    echo "<tr>";
                }
                
            }
            
            echo "<td><a title='Haz clic aqui para Ver Detalles de Este Pago' rel=MyModal:open style='font-size:9pt;cursor:pointer;' href='#Info_".$Sol['NPago']."'>".$Sol['NPago']."</a></td>";
            
            echo "<div id='Info_".$Sol['NPago']."' class='MyModal' style='font-size:10pt; font-family:auto;'>";
            echo "<h5 style='
                background-color: #680632;
                color: white;
                text-align: center;
                border-top-left-radius: 6px;
                border-top-right-radius: 6px;
                margin-top: -9px;
                margin-right: -22px;
                margin-left: -24px;
                padding: 6px;
            '>Detalles del Pago No.".$Sol['NPago']."</h5>";
                // echo "<b>Numero de Pago </b>: ".$Sol['NPago']."<br>";
                echo "<b>  Abono </b>: ".Pesos($Sol['abono'])."<br>";
                echo "<b>+ Interes </b>: ".Pesos($Sol['interes'])."<br>";
                echo "<b>+ Impuesto (IVA) </b>: ".Pesos($Sol['iva'])."<br>";                
                echo "<b>+ Interes Moratorio </b>: ".Pesos($Sol['mora_debe'])."<br>";                
                echo "<b>+ Cargo Semanal </b>: ".Pesos($Sol['CargoSemanal'])."<br>";
                echo "<b>+ Cargo Extraordinario ".$Sol['CargoExtraOrdinario_concepto']." </b>: ".Pesos($Sol['CargoExtraOrdinario_cantidad'])."<br>";
                echo "<hr><b style='font-size:12pt;'>Subtotal: ".Pesos($Sol['subTOTAL'])."</b><br>";                
                echo "<b> - Descuento ".$Sol['Descuento_concepto']." </b>: ".$Sol['Descuento_cantidad']."<br><hr>";
                
                


                echo "<div style='
                    background-color: #680632;
                    color: white;
                    text-align: center;
                    margin-right: -22px;
                    margin-left: -22px;
                '><b style='font-size:14pt;'>TOTAL: ".Pesos($Sol['TOTAL'])."</b><br>";
                echo "<cite style='font-size:8pt;'>".NumToLetras_Moneda($Sol['TOTAL'])."</cite></div><br>";
                echo "";
                echo "<b>Ahorro en este pago </b>: ".$Sol['CajaAhorro']."<br>";
                echo "<b>Fecha en que Pago: </b>: ".$Sol['CajaFecha']." | ";
                echo "<b>Estatus: </b>: ".$Sol['CarteraEstatus']."<br>";

                echo "<p style='font-size:8pt; color:gray;'>Interes Moratorio por Dia </b>: ".Pesos($Sol['mora_dia']).", ";
                echo "Dias Moratorios </b>: ".$Sol['mora_dias'].",";
                echo "Forma de Pago </b>: (".$Sol['formadepago'].") ".$Sol['formadepago_tipo'].", ";
                echo "Tasa Int. Moratorio</b>: ".$Sol['mora_tasa']."%, ";
                echo "Semanas de Retraso </b>: ".$Sol['Semanas'].", ";
                echo "Cargo por cada Semana </b>: ".Pesos($Sol['CargoSemana']).".</p>";
                
                
                    
                Tickets($NoSol, $Sol['NPago']);
                    
                
            
                // echo "<a href='app_descuento.php?nosol=".$NoSol."&n=".$Sol['NPago']."' class='btn btn-primary'>Hacer Descuento</a>";


                // var_dump($Sol);

            echo "</div>";

            echo "<td><a title='Haz clic aqui para escribir esta cantidad en RECIBIR' style='font-size:9pt;cursor:pointer;' class='btn-Link' onclick='CajaComponents(".$Sol['NPago'].");'>".Pesos($Sol['TOTAL'])."</a></td>";
            if ($Sol['CarteraEstatus']=='VENCIDO'){            
                echo "<td>".DiasAmigables($Sol['mora_dias'])."</td>";
            } else {
                echo "<td>".$Sol['fecha']."</td>";
            }
            

            echo "</tr>";
            $Curp = $Sol['CURP'];
            $GranTotal = $GranTotal + $Sol['TOTAL'];
        }
        if ($GranTotal<=0){$GranTotal=0;}
        echo "<td colspan='3' style='background-color:orange; cursor:pointer;' onclick='CajaComponents(0);'>
        <b style='font-size:14pt;'>".Pesos($GranTotal)."</b><br>
        <cite>".NumToLetras_Moneda($GranTotal)."</cite>
        </td>";
        echo "</table>";

        echo "<hr><a target=_blank class='btn btn-warning' href='print_edocuenta.php?id=".$NoSol."'>Edo.Cuenta</a> ";
        echo "<a title='Estado de cuenta con descripcion muy detallada' target=_blank class='btn btn-warning' href='print_edocuenta.php?id=".$NoSol."&full='><img src='icons/correcto1.png' style='width:25px;'></a><br> ";
        echo "<a target=_blank class='btn btn-secondary' href='app_solicitud.php?n=".$NoSol."'>Cuenta</a> ";
        echo "<a target=_blank class='btn btn-secondary' href='app_carnet.php?id=".$Curp."'>Cliente</a>";
        unset($r,$sql, $Sol);

        echo "<script>CajaComponents(0);</script>";



    } else {//Selecciono un pago

    }

?>

<?php
// include("footer.php");
?>