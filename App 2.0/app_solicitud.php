<?php
include("head.php");
include("header.php");

// if (isset($_GET['g'])){
//     $txtGrupo = VarClean($_GET['g']);
//     $sqlIn = "INSERT INTO grupos (nombre) VALUES ('".$txtGrupo."')";
//     if ($db1->query($sqlIn) == TRUE){
//         Toast("Grupo ".$txtGrupo." creado correctamente",4,"");
//         Historia($RinteraUser,"GRUPOS","Creo al grupo ".$txtGrupo);
//     } else {
//         Toast("Error al crear el grupo ".$txtGrupo."",2,"");

//     }
// }

if (isset($_GET['n'])){
    $NoSol = VarClean($_GET['n']);
    $sql = "select * from solicitudes where nosol='".$NoSol."'" ;    
    $r= $db1 -> query($sql); if($Sol = $r -> fetch_array()){
    
    // echo $NoSol;
    echo "<div id='mas' class='container' style='background-color:#f7f4f563; border-radius:5px;padding:5px; margin-top:20px; color: #62032c;'>
    <span><table width=100%><tr>";

    if (Contrato_Activo($NoSol)==TRUE){
        echo "<td ><h3 style='font-size:12pt; color:green;'> CONTRATO <b>".$NoSol."</b> | ACTIVO</h3></td>";
    } else {
        echo "<td ><h3 style='font-size:12pt;color:red;'> CONTRATO <b>".$NoSol."</b> | CANCELADO</h3></td>";
    }
    

        echo "
        <td align=right>
        <a href='?' class='btn btn-primary'>Regresar</a>
        <a href='app_carnet.php?id=".$Sol['curp']."' class='btn btn-secondary'>Cliente</a>
        
        
        ";
    

    echo "</tr></table></span>";
    echo "</div>";

    
    echo "<div id='mas' class='container' style='background-color:white; border-radius:5px;padding:5px; margin-top:20px;'>";
        
        echo "<div id='Titular' style='
            background-color: #d2d0d0;
            border-top-left-radius: 5px; padding:5px;
            border-top-right-radius: 5px;
        '>";
        $Curp = Contrato_Curp($NoSol);
        $Nombre = Contrato_Nombre($NoSol);
        if ($Sol['tipo']=='GRUPO'){
            echo "<h3>".$Nombre."<img src='icons/actualizar.png'  title='Haz clic para cambiar la titularidad'
            style='
                width: 23px;
                margin-left: 15px;
                cursor: pointer;    
                margin-top: -6px;
                border-radius: 50%;
            ' onclick='Selector();'>"."</h3>";

            echo "<div id='Selector' style='
                display: block;
                background-color: #b9b2c1;
                padding: 5px;
            '>";
            $sqlMiembros = "select curp, nombre, grupo, grupo_cargo from clientes where grupo=(select grupo from cuentas where nosol='".$NoSol."') and curp<>'".$Curp."'";
            $rM = $db1->query($sqlMiembros);    
            if ($db1->query($sqlMiembros) == TRUE){        
                echo "<table width=100%><tr><td width=80%>";
                echo "<select id='Miembro' name='Miembro' class='form-control'>";
                while($M= $rM -> fetch_array()) {  
                    echo "<option value='".$M['curp']."'>".$M['nombre']." - ".$M['grupo_cargo']."</option>";
                }
                echo "</select>";
                echo "</td><td>";
                echo "<button style='width:100%;' onclick='CambiarTitularidad();' class='btn btn-success'>Cambiar Titular</button>";

                echo "</td></tr></table>";
                
            } else {
                echo "No Se encontraron mas miembros en el Grupo";
            }
            echo "</div>";
            unset($rM, $M, $sqlMiembros);

            
            
    

        } else {
            echo "<h3>".$Nombre."</h3>";
        }

        
        

        echo "</div>";

        echo "<table width=100% border=0><tr><td valign=top align=left width=75%>";
        
        FormElement_input("CURP: ",$Sol['curp'],"", "","text","ClienteCurp",TRUE );

        FormElement_input("Cliente: ",$Sol['Cliente'],"", "","text","ClienteNombre",TRUE );
        FormElement_input("Fecha de Solicitud: ",$Sol['fechasol'],"", "","text","CreditoFechaSolicitud",TRUE );
        
        if ($Sol['valoracion']==''){
            
            FormElement_input("Fecha de Contrato: ",$Sol['fechacontrato'],"", "","date","CreditoFechaContrato");
        } else {
            FormElement_input("Fecha de Contrato: ",$Sol['fechacontrato'],"", "","date","CreditoFechaContrato",TRUE );
        }

        if ($Sol['valoracion']==''){
            
            FormElement_input("Fecha de Inicio: ",$Sol['fechainicio'],"", "","date","CreditoFechaInicio");
        } else {
            FormElement_input("Fecha de Inicio: ",$Sol['fechainicio'],"", "","date","CreditoFechaInicio",TRUE );
        }

        FormElement_input("Grupo al que pertenece: ",$Sol['grupo'],"", "","text","",TRUE );
        

        if ($Sol['valoracion']==''){
            echo '
            <div class="form-group" id="Divtipo" style="margin: 4px;
            padding: 4px;
            border-radius: 5px;
            vertical-align: top;">';

            echo '
                <label for="CreditoTipo" style="font-size:8pt;">Tipo de Credito:</label>
                ';

            echo "<select id='CreditoTipo' class='form-control' style='font-size:9pt; margin-top:-7px;'>";
            if ($Sol['tipo']=='GRUPO'){
                echo "<option value='GRUPO' selected>GRUPO</option>";
                echo "<option value='INDIVIDUAL'>INDIVIDUAL</option>";
            } else {
                echo "<option value='GRUPO'>GRUPO</option>";
                echo "<option value='INDIVIDUAL' selected>INDIVIDUAL</option>";
            }
            echo "</select>";
            echo '
            </div>';
        } else {
            echo '
            <div class="form-group disable" id="Divtipo" style="margin: 4px;
            padding: 4px;
            border-radius: 5px;
            vertical-align: top;">';

            echo '
                <label for="CreditoTipo" style="font-size:8pt;">Tipo de Credito:</label>
                ';

            echo "<select id='CreditoTipo' class='form-control disable' style='font-size:9pt; margin-top:-7px;' readonly>";
            if ($Sol['tipo']=='GRUPO'){
                echo "<option value='GRUPO' selected>GRUPO</option>";
                //echo "<option value='INDIVIDUAL'>INDIVIDUAL</option>";
            } else {
                //echo "<option value='GRUPO'>GRUPO</option>";
                echo "<option value='INDIVIDUAL' selected>INDIVIDUAL</option>";
            }
            echo "</select>";
            echo '
            </div>';
        }

        
        if ($Sol['valoracion']==''){
            FormElement_input("Cantidad de Credito: ",$Sol['cantidad'],"", "","text","CreditoCantidad");
        } else {
            FormElement_input("Cantidad de Credito: ",$Sol['cantidad'],"", "","text","CreditoCantidad",TRUE);

        }

        if ($Sol['valoracion']==''){
            FormElement_input("Plazo (meses): ",$Sol['plazo'],"", "","number","CreditoPlazo");
        } else {
            FormElement_input("Plazo (meses): ",$Sol['plazo'],"", "","number","CreditoPlazo", TRUE);
        }


    
       
        if ($Sol['valoracion']==''){
            echo '
            <div class="form-group" id="DivFormaDePago" style="margin: 4px;
            padding: 4px;
            border-radius: 5px;
            vertical-align: top;">';

            echo '
                <label for="CreditoFormaDePago" style="font-size:8pt;">Forma de Pago:</label>
                ';

            echo "<select id='CreditoFormaDePago' class='form-control' style='font-size:9pt; margin-top:-7px;'>";
            
            if ($Sol['formadepago']=='7'){
                echo "<option value='7' selected>SEMANAL</option>";
                echo "<option value='15'>QUINCENAL</option>";
                echo "<option value='30'>MENSUAL</option>";
            } else {
                if ($Sol['formadepago']=='15'){
                    echo "<option value='7' >SEMANAL</option>";
                    echo "<option value='15' selected>QUINCENAL</option>";
                    echo "<option value='30'>MENSUAL</option>";
                } else {
                    echo "<option value='7' >SEMANAL</option>";
                    echo "<option value='15'>QUINCENAL</option>";
                    echo "<option value='30' selected>MENSUAL</option>";
                }
            }

            echo "</select>";
            echo '
            </div>';
        } else {
            echo '
            <div class="form-group disable" id="DivFormaDePago" style="margin: 4px;
            padding: 4px;
            border-radius: 5px;
            vertical-align: top;">';

            echo '
                <label for="CreditoFormaDePago" style="font-size:8pt;">Tipo de Credito:</label>
                ';

            echo "<select id='CreditoFormaDePago' class='form-control disable' style='font-size:9pt; margin-top:-7px;' readonly>";
            
            if ($Sol['formadepago']=='7'){
                echo "<option value='7' selected>SEMANAL</option>";
                // echo "<option value='15'>QUINCENAL</option>";
                // echo "<option value='30'>MENSUAL</option>";
            } else {
                if ($Sol['formadepago']=='15'){
                    // echo "<option value='7' >SEMANAL</option>";
                    echo "<option value='15' selected>QUINCENAL</option>";
                    // echo "<option value='30'>MENSUAL</option>";
                } else {
                    // echo "<option value='7' >SEMANAL</option>";
                    // echo "<option value='15'>QUINCENAL</option>";
                    echo "<option value='30' selected>MENSUAL</option>";
                }
            }

            echo "</select>";
            echo '
            </div>';
        }

    if ($Sol['valoracion']==''){
        FormElement_input("Interes Mensual: ",$Sol['tasa_interes'],"", "","text","CreditoTasaInteres");
        FormElement_input("Interes Moratorio: (mensual) ",$Sol['tasa_moratorio'],"", "","text","CreditoTasaMoratorio");
    } else {
        FormElement_input("Interes Mensual: ",$Sol['tasa_interes'],"", "","text","CreditoTasaInteres", TRUE);
        FormElement_input("Interes Moratorio: (mensual) ",$Sol['tasa_moratorio'],"", "","text","CreditoTasaMoratorio", TRUE);
    }

    if ($Sol['valoracion']==''){
        FormElement_input("% IVA: ",$Sol['iva_tipo'],"", "","number","CreditoIvaTipo");
    } else {
        FormElement_input("% IVA: ",$Sol['iva_tipo'],"", "","number","CreditoIvaTipo", TRUE);
    }



        FormElement_input("Cargo Moratorio: (semanal) ",$Sol['cargoporsemana'],"", "","text","CreditoCargoPorSemana");
        
        
        
        



        FormElement_textarea("Comentarios: ",$Sol['comentario'],"", "","text","CreditoComentarios");



        

        if ($Sol['valoracion']==''){
            echo '
            <div class="form-group" id="DivValoracion" style="margin: 4px;
            padding: 4px; width: 100%;
            border-radius: 5px;
            vertical-align: top;">';

            echo '
                <label for="CreditoValoracion" style="font-size:8pt;">Valoracion del Cuenta</label>
                ';

            echo "<select id='CreditoValoracion' class='form-control' style='font-size:9pt; margin-top:-7px;'>";
            //SOLO PERMITIR CUANDO ESTE PENDIENTE DE APROBACION CAMPO EN BLANCO        
            
            
                echo "<option value='APROBADO'>APROBADO</option>";
                echo "<option value='RECHAZADO'>RECHAZADO</option>";
                echo "<option value='' selected>PENDIENTE DE APROBACION</option>";
        echo "</select>";


        echo '
        </div>';


        



        } else {
            
            FormElement_input("Estatus de la cuenta: ",$Sol['valoracion'],"", "","text","",TRUE );
            echo "<input type='hidden' id='CreditoValoracion' value='NOT'>";
        }

        FormElement_textarea("Descripcion de la Garantia y Antecedentes: ",$Sol['garantia'],"", "","text","CreditoGarantia");
        echo "</td><td>";
        
        

        echo '
        <div class="form-group disable" id="DivGarantiaFila" style="margin: 4px;
        padding: 4px;
        border-radius: 5px; background-color: #e8e8e8; width:100%;
        vertical-align: top;">';

        $fotoFile = 'fotos/'.$NoSol.'_garantia.jpg';
        if (is_file($fotoFile)){
            echo "<a href='".$fotoFile."' target=_blank><img name='foto' id='foto'  src='".$fotoFile."' style='width:100%; border-radius:5px;'></a>";

        } else {
            echo "<img name='foto' id='foto' src='icons/nofoto.jpg' style='width:100%;'>";
        }



        echo '<br>
        <table width=100%><tr><td>
            <label  style="font-size:8pt;">Archivo de la Garantia</label>
            <form id="FormGarantia" method="POST" enctype="multipart/form-data"><input type="file" name="GarantiaFile" id="GarantiaFile" accept=".jpg" class="form-control" style="font-size:8pt;">            </form>
            </td><td width=30%>
            
            <button class="btn btn-success" onclick="GuardarFoto();">Guardar Foto</button></td></tr></table>
        </div>';

        echo "</td><tr></table>";


if ($Sol['valoracion']==''){
            echo '
            <div class="form-group" id="DivAval" style="margin: 4px;
            padding: 4px; width:100%;
            border-radius: 5px;
            vertical-align: top;">';
            echo '<label for="CreditoAval" style="font-size:8pt;">Seleccione un Aval</label>';
            echo "<select id='CreditoAval' class='form-control' style='font-size:9pt; margin-top:-7px;'>";
            $rA = $db1->query("select * from avales where nombre<>'' order by nombre ");    
            if ($db1->query($sql) == TRUE){        
                while($Aval= $rA -> fetch_array()) {  
                    if ($Aval['CreditosPagados']>0 and $Aval['CreditosConAdeudo']==0){
                        echo "<option value='".$Aval['curp']."' class='form-control' style='background-color:#aeecbc;'><b>".$Aval['nombre']." </b>-  (Pagados=".$Aval['CreditosPagados']." | Debe=".$Aval['CreditosConAdeudo'].", ".$Aval['DiasDeRetraso']." dias de atraso)</option>";    
                    } else {

                        if ($Aval['DiasDeRetraso']>30){
                            echo "<option value='".$Aval['curp']."' class='form-control' style='background-color: #eebd7d;;'>".$Aval['nombre']." -  (Pagados=".$Aval['CreditosPagados']." | Debe=".$Aval['CreditosConAdeudo'].", ".$Aval['DiasDeRetraso']." dias de atraso)</option>";
                        } else {
                            echo "<option value='".$Aval['curp']."' class='form-control'>".$Aval['nombre']." -  (Pagados=".$Aval['CreditosPagados']." | Debe=".$Aval['CreditosConAdeudo'].", ".$Aval['DiasDeRetraso']." dias de atraso)</option>";
                        }

                    }
                    
                }
                echo "<option value='' selected>Sin Aval</option>";

            }   
            echo "</select>";


            echo '
            </div>';
        } else { //disable
            FormElement_input("Curp Aval: ",$Sol['curp_aval'],"", "","text","",TRUE );
            FormElement_input("Aval: ",$Sol['AvalNombre'],"", "","text","",TRUE );
        }

        echo "<div class='form-group' id='DivValoracion' style='margin: 4px;
        padding: 14px;
        border-radius: 5px;
        text-align: center; width:100%;
        vertical-align: top;'>
    ";
        // if ($Sol['valoracion']==''){
        echo "
        <button style='margin:5px;' class='btn btn-success' onclick='GuardarSolicitud();'>Guardar </button>";

        if (Contrato_Activo($NoSol)==TRUE){
            echo "<button style='margin:5px;' class='btn btn-danger' onclick='CancelarSolicitud();'>CANCELAR </button><br>";
        } else {
            echo "<button style='margin:5px;' class='btn btn-primary' onclick='ActivarSolicitud();'>ACTIVAR </button><br>";
        }
        

        echo "
<button style='margin:5px;' class='btn btn-warning' onclick='CorridaF();'>Simular Corrida Financiera</button>
<a target=_blank href='print_solicitud.php?id=".$NoSol."' style='margin:5px;' class='btn btn-primary' download='Solicitud-".$NoSol.".pdf'> 
    <img src='icons/pdf.png' style='width:23px; margin-top:-5px; margin-right:5px;'> Imprimir Solicitud</a>


<a target=_blank href='print_contrato.php?id=".$NoSol."' style='margin:5px;' class='btn btn-primary'  download='Pagare-".$NoSol.".pdf'> 
    <img src='icons/pdf.png' style='width:23px; margin-top:-5px; margin-right:5px;'> Imprimir Contrato</button>
</a>



            ";
            
        echo "</div>";
        echo '<hr style="border: dashed 1px rgba(0,0,0,.4);">';

        if ($Sol['valoracion']==''){
        echo "<div id='CorridaF'>

        </div>";}
        else {
            echo "<div id='CorridaFOK'>";
            // $sqlX = "
            // select 
            // nosol,
            // NPago as n,
            // fecha,
            // abono,
            // interes,
            // iva,
            // mora_dias,
            // mora_dia,
            // mora_debe,
            // Semanas,
            // CargoSemana,
            // CargoSemanal,
            // IF(CargoExtraOrdinario_concepto='',0,CONCAT(CargoExtraOrdinario_concepto,' ',CargoExtraOrdinario_cantidad)) as CargoExtra,
            // CONCAT(Descuento_concepto,' ',Descuento_cantidad) as Descuento,
            // TOTAL,
            // EstadoPago,
            // comentario



            // from cartera where nosol='".$Sol['nosol']."'
            // ";
            // // echo $sqlX;
            // $rx = $db1->query($sqlX);    
            // if ($db1->query($sqlX) == TRUE){        
            
            // echo "<h4>Estado de Cuenta:</h4>";

            echo "<div style='width:100%; text-align:right;margin:10px; margin-right:40px;'><a href='print_edocuenta.php?id=".$Sol['nosol']."' class='btn btn-secondary'>Imprimir Estado de Cuenta</a></div>";
           


            $QueryM = "select 
            NPago,
            fecha,
            TOTAL,
            EstadoPago,
            CajaCantidad

            from cartera where nosol='".$NoSol."'";
            //  order by no + 0";

            TableData($QueryM, $Tit="Estado de Cuenta:", $IdDiv="TableData_Div", $IdTabla="TableData_table", $Clase="", $Tipo=2);

            echo "</div>";

        }

        

if (isset($NoSol)){
    echo "<div id='mas' class='container' style='background-color:#fde1ab; border-radius:5px;padding:5px; margin-top:20px; margin-bottom:20px;'>";
    echo "<h4>CAPTURAR DESCUENTO</h4>";
    $IdDiv = "DivCaptura1";
    
    echo '
            <div class="form-group disable" id="'.$IdDiv.'" style="margin: 4px;
            padding: 4px;
            border-radius: 5px;
            vertical-align: top;">';
            $IdElement = "DescuentoCantidad";
            $Value = 0;
            $Label = "Cantidad a descontar";
            $SmallText = "Solo se puede agregar un descuento si tiene pagos pendientes";
    
            echo '
                <label for="'.$IdElement.'" style="font-size:8pt;">'.$Label.'</label>
                <input title="'.$Value.'" style="cursor:pointer; font-size:9pt; margin-top:-7px;" type="number" class="form-control" id="'.$IdElement.'" placeholder="" value="'.$Value.'" >
                <small id="'.$IdElement.'_smalltext'.'" class="form-text text-muted" style="font-size: 7pt;
                margin-top: -2px;">'.$SmallText.'</small>
            </div>';
    
            $sql = "select nosol, NPago, TOTAL, EstadoPago from cartera where nosol='".$NoSol."' and EstadoPago='SIN PAGAR'";
            $r= $db1 -> query($sql);
    
            echo '<div class="form-group disable" id="'.$IdDiv.'2" style="margin: 4px;
            padding: 4px;
            border-radius: 5px;
            vertical-align: top;">
            <label>NPago:<label><br>
            <select id="NPago" class="form-control">
            ';
            
            while($f = $r -> fetch_array()) {      
                echo '<option value="'.$f['NPago'].'">'.$f['NPago'].' = '.$f['TOTAL'].'</div>';
            }
            echo '</select>';
            unset($f,$sql);
            echo '</div>';
        
            echo '<div class="form-group disable" id="'.$IdDiv.'2" style="margin: 4px;
            padding: 4px;
            border-radius: 5px;
            vertical-align: top;">
            
            
            ';
            $IdElement = "DescuentoConcepto";
            $Value = 0;
            $Label = "Concepto";
            $SmallText = "";
    
            echo '
                <label for="'.$IdElement.'" style="font-size:8pt;">'.$Label.'</label>
                <input title="'.$Value.'" style="cursor:pointer; font-size:9pt; margin-top:-7px;" type="text" class="form-control" id="'.$IdElement.'" placeholder="" value="'.$Value.'" >
                <small id="'.$IdElement.'_smalltext'.'" class="form-text text-muted" style="font-size: 7pt;
                margin-top: -2px;">'.$SmallText.'</small>
            </div>';
            echo "<br>";
    
            echo "<button class='btn btn-success' onclick='Descontar();'>Crear Descuento</button>";
    
            echo "<hr>";
            echo "<div id='DivDescuentos'>";
            $sql="select * from descuentos_html where nosol='".$NoSol."' and EstadoPago='SIN PAGAR'";
            TableData($sql,"Descuentos autorizados:"); //0 = Basica, 1 = ScrollVertical, 2 = Scroll Horizontal
            echo "</div>";
        
           
        echo "</div>";
        }

    }else{
        echo "<div style='
            background-color:white;
            padding:10px;
            margin-top:10%;
            margin-left:25%;
            border-radius:10px;
            width:50%;

        '><b>No se encontro la solicitud<b> ".$NoSol."</div>";
    }
    unset($sql, $r, $Sol);
        
    echo "</div>";

    
    
    
    
} else {

    if (isset($_GET['new'])){
        echo "<div id='mas' class='container' style='background-color:#ffc107a6; border-radius:5px;padding:5px; margin-top:20px; color: #62032c;'>
    <span><table width=100%><tr>
    <td width=80%><h3 sytle='font-family:Bold'>NUEVA SOLICITUD</h3></td>";

        echo "
        <td>
        <button class='btn btn-success'>Guardar</button>
        <a href='?' class='btn btn-warning'>Regresar</a>

        </td>    
        ";
    

    echo "</tr></table></span>";
    echo "</div>";
    } else {

    //         echo "<div id='mas' class='container' style='background-color:#f7f4f563; border-radius:5px;padding:5px; margin-top:20px; color: #62032c;'>
    //         <span><table width=100%><tr>
    //         <td width=80%><h3 sytle='font-family:Bold'>SOLICITUDES</h3></td>";

    //         // if (isset($_GET['new'])){
    //         //     echo "
    //         //     <td><a href='?=' class='btn btn-primary'>Solicitudes </a></td>    
    //         //     ";
    //         // } else {
    //         //     echo "
    //         //     <td><a href='?new' class='btn btn-primary'>Crear Nueva Solicitud</a></td>    
    //         //     ";
    //         // }
    

    // echo "
    // </tr></table></span>

    // </div>";


    if (isset($_GET['all'])){
        $sql="select * from sol_ where valoracion <> ''";
        TableData($sql,"Solicitudes registradas:"); //0 = Basica, 1 = ScrollVertical, 2 = Scroll Horizontal
        echo "<br><a class='btn btn-secondary' href='?='>Solicitudes sin Aprobar</a>";
    
    } else {
        $sql="select * from sol_ where valoracion = ''";
        TableData($sql,"Solicitudes sin aprobar"); //0 = Basica, 1 = ScrollVertical, 2 = Scroll Horizontal
        echo "<br><a class='btn btn-secondary' href='?all='>Solicitudes Aprobadas</a>";
    
    }
    
    

   
    }

}



?>
<script>
function GuardarSolicitud(){
   //Variables
   NoSol = '<?php echo $_GET['n']; ?>';
   CreditoTipo = $('#CreditoTipo').val();
   CreditoCantidad = $('#CreditoCantidad').val();
   CreditoPlazo = $('#CreditoPlazo').val();
   CreditoFormaDePago = $('#CreditoFormaDePago').val();
   CreditoTasaInteres = $('#CreditoTasaInteres').val();
   CreditoTasaMoratorio = $('#CreditoTasaMoratorio').val();
   CreditoCargoPorSemana = $('#CreditoCargoPorSemana').val();
   CreditoGarantia = $('#CreditoGarantia').val();
   CreditoValoracion = $('#CreditoValoracion').val();
   CreditoComentarios = $('#CreditoComentarios').val();
   CreditoFechaContrato = $('#CreditoFechaContrato').val();
   CreditoFechaInicio = $('#CreditoFechaInicio').val();
   CreditoIvaTipo = $('#CreditoIvaTipo').val();
    ClienteCurp = $('#ClienteCurp').val();
   

   $('#PreLoader').show();
            $.ajax({
                url: 'app_solicitud_save.php',
                type: 'post',
                data: {
                    NoSol:NoSol, CreditoTipo:CreditoTipo, CreditoCantidad:CreditoCantidad,
                    CreditoPlazo:CreditoPlazo, CreditoFormaDePago: CreditoFormaDePago, CreditoTasaInteres:CreditoTasaInteres,
                    CreditoTasaMoratorio: CreditoTasaMoratorio, CreditoCargoPorSemana: CreditoCargoPorSemana,
                    CreditoGarantia: CreditoGarantia, CreditoValoracion:CreditoValoracion,
                    CreditoComentarios:CreditoComentarios, CreditoFechaContrato:CreditoFechaContrato,
                    CreditoIvaTipo:CreditoIvaTipo, ClienteCurp:ClienteCurp,
                    CreditoFechaInicio:CreditoFechaInicio
       
                },
                success: function(data) {
                    $('#R').html(data);
                    $('#PreLoader').hide();
                }
            });
}


function CorridaF(){
   //Variables
   NoSol = '<?php echo $_GET['n']; ?>';
   CreditoTipo = $('#CreditoTipo').val();
   CreditoCantidad = $('#CreditoCantidad').val();
   CreditoPlazo = $('#CreditoPlazo').val();
   CreditoFormaDePago = $('#CreditoFormaDePago').val();
   CreditoTasaInteres = $('#CreditoTasaInteres').val();
   CreditoTasaMoratorio = $('#CreditoTasaMoratorio').val();
   CreditoCargoPorSemana = $('#CreditoCargoPorSemana').val();
   CreditoGarantia = $('#CreditoGarantia').val();
   CreditoValoracion = $('#CreditoValoracion').val();
   CreditoComentarios = $('#CreditoComentarios').val();
   CreditoFechaContrato = $('#CreditoFechaContrato').val();
   CreditoIvaTipo = $('#CreditoIvaTipo').val();

   

   $('#PreLoader').show();
            $.ajax({
                url: 'app_solicitud_savef.php',
                type: 'post',
                data: {
                    NoSol:NoSol, CreditoTipo:CreditoTipo, CreditoCantidad:CreditoCantidad,
                    CreditoPlazo:CreditoPlazo, CreditoFormaDePago: CreditoFormaDePago, CreditoTasaInteres:CreditoTasaInteres,
                    CreditoTasaMoratorio: CreditoTasaMoratorio, CreditoCargoPorSemana: CreditoCargoPorSemana,
                    CreditoGarantia: CreditoGarantia, CreditoValoracion:CreditoValoracion,
                    CreditoComentarios:CreditoComentarios, CreditoFechaContrato:CreditoFechaContrato,
                    CreditoIvaTipo:CreditoIvaTipo
       
                },
                success: function(data) {
                    $('#CorridaF').html(data);
                    $('#PreLoader').hide();
                }
            });
}



function Descontar(){
   //Variables
   NoSol = '<?php echo $_GET['n']; ?>';
   DescuentoCantidad = $('#DescuentoCantidad').val();
   NPago = $('#NPago').val();
   DescuentoConcepto = $('#DescuentoConcepto').val();

   $('#PreLoader').show();
            $.ajax({
                url: 'app_solicitud_descontar.php',
                type: 'post',
                data: {
                    NoSol:NoSol, DescuentoCantidad:DescuentoCantidad,NPago:NPago, DescuentoConcepto:DescuentoConcepto
       
                },
                success: function(data) {
                    $('#R').html(data);
                    $('#PreLoader').hide();
                }
            });
}

function CancelarDescuento(IdDescuento){
    console.log('Cancelando '+IdDescuento);
    NoSol = '<?php echo $_GET['n']; ?>';
    $('#PreLoader').show();
            $.ajax({
                url: 'app_data_cancelardescuento.php',
                type: 'post',
                data: {
                    IdDescuento:IdDescuento, NoSol:NoSol
       
                },
                success: function(data) {
                    $('#R').html(data);
                    $('#PreLoader').hide();
                }
            });
}

function CargaDescuentos(){
    
    NoSol = '<?php echo $_GET['n']; ?>';
    $('#PreLoader').show();
            $.ajax({
                url: 'app_dat_descuentos.php',
                type: 'post',
                data: {
                    NoSol:NoSol
       
                },
                success: function(data) {
                    $('#DivDescuentos').html(data);
                    $('#PreLoader').hide();
                }
            });
}

function GuardarFoto(){    
    NoSol = '<?php echo $NoSol; ?>';
    // $('#GarantiaFile').html($('#VFile').val());        
    var formData = new FormData(document.getElementById('FormGarantia'));        
        formData.append('NoSol',  NoSol);
    $('#progressbar').show();
    $.ajax({
    url: 'app_dat_garantia.php',
    type: 'post',
    dataType: 'html',
    data: formData,             
    cache: false,
    contentType: false,
    processData: false,
    beforeSend:function(){
        // console.log('Cargando..');
    },
    success:function(data){
        // console.log(data);
        $('#R').html(data);
        $('#progressbar').hide();
    }
});
}

function ActualizaFoto(){
    d = new Date();    
    NoSol = '<?php echo $NoSol; ?>';
    
    src='fotos/'+NoSol+'_garantia.jpg?';
    $("#foto").attr("src",src+d.getTime());
}

function Selector(){
    if ($("#Selector").css("display") =='block'){
        $("#Selector").css("display","none");
    } else {
        $("#Selector").css("display","block");
    }
}
Selector();


function CambiarTitularidad(){    
    NoSol = '<?php echo $_GET['n']; ?>';
    NuevoTitular = $('#Miembro').val();
    $('#PreLoader').show();
            $.ajax({
                url: 'app_dat_cambiartitular.php',
                type: 'post',
                data: {
                    NoSol:NoSol, NuevoTitular:NuevoTitular
       
                },
                success: function(data) {
                    $('#R').html(data);
                    $('#PreLoader').hide();
                }
            });
}




function CancelarSolicitud(){    
    NoSol = '<?php echo $_GET['n']; ?>';
    
    $('#PreLoader').show();
            $.ajax({
                url: 'app_dat_cancelarcontrato.php',
                type: 'post',
                data: {
                    NoSol:NoSol
       
                },
                success: function(data) {
                    $('#R').html(data);
                    $('#PreLoader').hide();
                }
            });
}


function ActivarSolicitud(){    
    NoSol = '<?php echo $_GET['n']; ?>';
    
    $('#PreLoader').show();
            $.ajax({
                url: 'app_dat_activarcontrato.php',
                type: 'post',
                data: {
                    NoSol:NoSol
       
                },
                success: function(data) {
                    $('#R').html(data);
                    $('#PreLoader').hide();
                }
            });
}

</script>

<?php

include("footer.php");
?>