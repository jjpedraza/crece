<?php
include("seguridad.php");  
require ("rintera-config.php");
require ("components.php");
// require ("app_funciones.php");

$NoSol = VarClean($_POST['NoSol']);
$NPago = VarClean($_POST['NPago']);
$sql = "select *  from cartera WHERE nosol='".$NoSol."' and NPago='".$NPago."'";        
    // echo $sql;
$rc= $db1 -> query($sql);    
if($Sol = $rc -> fetch_array())
{ 
    
echo "<div id='Info_".$Sol['NPago']."'  style='font-size:10pt; font-family:auto;'>";
echo "<h5 style='
    
    color: black;
    text-align: center;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    margin-top: -9px;
    margin-right: -22px;
    margin-left: -24px;
    padding: 6px;
'>Detalles del Pago No.".$Sol['NPago'].":</h5>";


    // echo "<b>Numero de Pago </b>: ".$Sol['NPago']."<br>";
echo "<table class='tabla' style='font-size:12pt;'>";
echo "<tr style='
    font-size: 7pt;
    text-align: left;
    font-weight: initial;
    background-color: #c8c7c7;
    padding-left: 7px;
'><th></th><th>Debe</th><th>Descuento</th><th style='text-align:center;' >% </th><th></th></tr>";

echo "<tr style='height:50px;'>";
echo "<td valign=top style='font-size:10pt;'>Moratorios</td>";
    echo "<td  valign=top  align=left id='_".$Sol['NPago']."_Mora_txt"."'>".Pesos($Sol['mora_debe']);
    $DescuentosAutorizados = DescuentosMoratorios($NoSol,$NPago);
    if ($DescuentosAutorizados >0){
    echo "<a href='#Descuentosde".$NPago."' rel=MyModal:open title='Descuento Autorizado = ".$DescuentosAutorizados.", haz clic para ver mas...'><img src='icons/alerta.png' style='width:13px;'></a>";
    
    echo "<div id='Descuentosde".$NPago."' class='MyModal'>";
    $sql="
        select 
        cantidad as Descuento,
        CONCAT('',nosol,' no.=',no) as Aplicado_a,
        CONCAT('',act_fecha, ' ', act_user) as Autorizado
        from descuentos where nosol='".$NoSol."' and no='".$NPago."'";
    TableData($sql, "Descuentos Autorizados del Pago ".$Sol['NPago']);
    
    echo "<a href='app_solicitud.php?n=".$NoSol."' class='btn btn-secondary'>Gestionar Descuentos de este Contrato</a>";
    echo "</div>";
    }

    // echo "<cite style='font-size:8pt; color:gray;'><br>
    // <a href='app_solicitud.php?n=".$NoSol."' title='Descuentos autorizados = Haga clic aqui para mas detalles'>
    // ".DescuentosList_mora($NoSol,$Sol['NPago'])."</a></cite>";
    echo "</td>";
    echo "<td  valign=top  align=center  width=30%>
    
    <input style='
    font-size: 10pt;
    background-color: orange;
    color: white;
    ' id='_".$Sol['NPago']."_Mora_Descuento' placeholder='' class='form-control' type='number' min='1' max='".$Sol['mora_debe']."' style='' value='0'>
    ";

    
    echo "
    <label ></label>";
    
    echo "
    </td>";
    // echo "<td align=center valign=top style=''> 
    // <input 
    //     onchange='DescontarMora_calcular(".$Sol['NPago'].");' 
    //     id='_".$Sol['NPago']."_Mora_DescontarPorciento' 
    //     placeholder='% para Descontar' 
    //     class='form-control' type='number' 
    //     value=''  min='1' max='100' style='font-size: 10pt;
    //     background-color: green;
    //     color: white;'></td>
    echo "<td width=70px valign=top align=right>

    <img onclick='DescontarMora_save(".$Sol['NPago'].");'  src='icons/saveas.png' style='width:30px; cursor:pointer;'></td>";
    // echo "<input type='hidden' id='_".$Sol['NPago']."_Mora_debe' value='".$Sol['mora_debe']."'>";
echo "</tr>";







echo "</table>";

echo "</div>";
}
?>

<?php
// include("footer.php");
?>