<?php include("head.php"); ?>


<?php
    if (isset($RinteraUser)){
    $MiToken = MiToken($RinteraUser, "Search");
    if ($MiToken == '') {
        $MiToken = MiToken_Init($RinteraUser, "Search");
    }
    } else {
     
    }

// echo "Token: ".$MiToken."";
?>





<?php
include("header.php");
?>

<section id='Busqueda' style='
background-color: <?php echo Preference("ColorPrincipal", "", ""); ?>;
'>

<table width=100%><tr><td>
    <?php
    if (isset($_GET['q'])) {
        echo '<input id="InputBusqueda" list="busquedas"     data-min-length="1" style="background-color: '.Preference("ColorPrincipal", "", "").';"
        class="InputBusqueda flexdatalist" type="text" placeholder="¿Que reporte necesitas?"  value="' . VarClean($_GET['q']) . '">';

    } else {
        echo '<input id="InputBusqueda" list="busquedas"  data-min-length="1" style="background-color: '.Preference("ColorPrincipal", "", "").';"
        class="InputBusqueda flexdatalist" type="text" placeholder="¿Que reporte necesitas?" >';
    }

    if (isset($_GET['i1'])) {
        Toast("Guardado correctamente " . VarClean($_GET['q']), 1, "");
    }

    if (isset($_GET['e1'])) {
        Toast("ERROR:Al localizar el Reporte " . VarClean($_GET['e1']), 2, "");
    }
    ?>

</td>
<td width=50px align=right valign=middle 
    style='background-color: <?php echo Preference("ColorPrincipal", "", ""); ?>;'>
    <button  class="Mbtn btn-Success"  onclick="Search();" style="
    background-color:  <?php echo Preference("ColorResaltado", "", ""); ?>;
    box-shadow: 0 3px  #4d4c49; margin:10px;

    "> 
    <img src='icons/busqueda.png' style='width:24px;'></button>
</td>
</tr>
</table>

<div style='
background-color: <?php echo Preference("ColorPrincipal", "", ""); ?>;
text-align: center;
color: white;
font-size: 10pt;  height:22px;

-webkit-box-shadow: 1px 5px 5px -3px rgba(0,0,0,0.75);
-moz-box-shadow: 1px 5px 5px -3px rgba(0,0,0,0.75);
box-shadow: 1px 5px 5px -3px rgba(0,0,0,0.75);
margin-top:  -21px;
'>
    <div id='PreloaderBuscando' style='display:none;'>
        Buscando <img src='img/loader_bar.gif'>
    </div>
</div>

</section>
<?php
if (Preference("MostrarApps", "", "")=='TRUE'){
    echo '
    <div class="row" style="margin:0px;">
    <section id="Resultados" >
    

    </section>

    <section id="MisApp" >
    ';
   
   
    echo '

    </section>
    </div>
    ';
} else {
    echo '
    
    <section id="Resultados" style="width:100%">    

    </section>

    
    ';
}
?>

<div id='Dashboard'>
    <div id="DashboardCol1"  style="vertical-align: top;" >
        <?php
        $QueryG = "
             
            select CONCAT('Aprobadas') as Label,count(*) as Data from cuentas WHERE valoracion='APROBADO' UNION
            select CONCAT('No Aprobadas') as Label,count(*) as Data from cuentas WHERE valoracion<>'APROBADO'
 
   
        ";
        $rF= $db1 -> query($QueryG);    
        $Datas = ""; $Labels="";
        while($Fr = $rF -> fetch_array()) {   
            $Datas.= $Fr['Data'].", ";
            $Labels.="'".$Fr['Label']."',";
        }
        unset($rf);unset($Fr);
        $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        $Labels = substr($Labels, 0, -1); //quita la ultima coma.

            echo '<div style="" class="Graficas">';
            GraficaBar($Labels,$Datas,"Solicitudes");
            echo '</div>';
        unset($rF, $Datas, $Labels);
        ?>


    <?php
        $QueryG = "
             
        select CONCAT('Grupales') as Label,count(*) as Data from cuentas WHERE  grupo<>'' UNION
        select CONCAT('Individuales') as Label,count(*) as Data from cuentas WHERE grupo=''
   
        ";
        $rF= $db1 -> query($QueryG);    
        $Datas = ""; $Labels="";
        while($Fr = $rF -> fetch_array()) {   
            $Datas.= $Fr['Data'].", ";
            $Labels.="'".$Fr['Label']."',";
        }
        unset($rf);unset($Fr);
        $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        $Labels = substr($Labels, 0, -1); //quita la ultima coma.
            echo '<div style="" class="Graficas">';
            GraficaPie($Labels,$Datas,"Tipo de Cuentas");
            echo '</div>';
        ?>




        
    <?php
        $QueryG = "
             
      
	
        -- SET lc_time_names = 'es_MX'
        select DISTINCT CONCAT(MONTHNAME(a.fechacontrato), YEAR(a.fechacontrato)) as MES,	 
        (select count(*) from cuentas where MONTHNAME(fechacontrato) = MONTHNAME(a.fechacontrato) and YEAR(fechacontrato) = YEAR(a.fechacontrato) )as contratos
        
        
        from cuentas a WHERE fechacontrato<>'0000-00-00' order by fechacontrato
   
        ";
        $rF= $db1 -> query($QueryG);    
        $Datas = ""; $Labels="";
        while($Fr = $rF -> fetch_array()) {   
            $Datas.= $Fr['contratos'].", ";
            $Labels.="'".$Fr['MES']."',";
        }
        unset($rf);unset($Fr);
        $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        $Labels = substr($Labels, 0, -1); //quita la ultima coma.
            echo '<div style="" class="Graficas">';
            GraficaBarLine($Labels,$Datas,"Contrataciones",1);
            echo '</div>';
        ?>

    
    </div>

    <div id="DashboardCol2" >
    

    <?php
     $rF= $db0 -> query("select * from reportes where Portada=1");    
     $repos = 0; $repolist="";
     while($Fr = $rF -> fetch_array()) {   
         $repolist.= "<a          
         href='r.php?id=".$Fr['id_rep']."' title='Haga Clic aqui para ver el reporte' class='btn btn-info'
         style='
            // background-color: #e6e6e6;
            // color: #625f5f;
            width: 100%;
            font-size: 10pt;
            text-align:left;
            margin-bottom:5px;
         '
         >".$Fr['rep_name']."</a>";
         $repos = $repos + 1;
     }


     $repolist.= "
     
     <button onclick='ClienteNuevo();' title='Haga Clic aqui para ver el reporte' class='btn btn-success'
     style='
        // background-color: #e6e6e6;
        // color: #625f5f;
        width: 100%;
        font-size: 10pt;
        text-align:left;
     '
     >
    
     <input type='text' id='txtCurp' placeholder='CURP' size='16' class='form-control'>
     Registrar Cliente</button>
     
     <br><br>";

     $repolist.= "<a href='app_caja.php' title='Haga Clic aqui para ver el reporte' class='btn btn-success'
     style='
        
        width: 100%;
        font-size: 10pt;
        text-align:left;
     '
     >Caja</a>
     ";
     $repolist.= "
     <a href='app_solicitud.php' title='Haga Clic aqui para ver' class='btn '
     style='
        background-color: #ff8007;
        color: white;
        width: 100%;
        font-size: 10pt;
        text-align:left;
        margin-top:10px;
     '
     >Solicitudes</a>


     <a href='app_grupos.php' title='Haga Clic aqui para ver' class='btn btn-secondary'
     style='
        // background-color: #e6e6e6;
        // color: #625f5f;
        width: 100%;
        font-size: 10pt;
        text-align:left;
        margin-top:10px;
     '
     >Grupos</a>
     ";

    
     unset($rf);unset($Fr);
     if ($repos > 0 ){
         echo "<h6 style='font-size: 8pt;
         opacity: 0.6;'>Recomendados</h6>";
         echo $repolist;
     }

     
    ?>


    </div>

     <script>
     function ClienteNuevo(){
        Curp = $('#txtCurp').val();
        console.log(Curp);
        if (Curp == ''){
            $.toast('Escriba el Curp del cliente nuevo');
        } else {
            window.location.assign("app_carnet.php?id="+Curp);
        }
        
     }
     </script>


    
</div>

<?php
UltimasBusquedas_buble($RinteraUser);

if (UserAdmin($RinteraUser) == TRUE) {
    if (Preference("NuevosReportes", "", "")=='TRUE'){
    echo "<div class='btnMas' title='Haz clic aquí para crear un nuevo reporte'>
    <a href='nuevo.php' > <img src='src/mas.png' style='width:100%;'>
    </a>
    </div>";
    }

}
?>




<?php
echo "
<script> 
$('.InputBusqueda').css('background-color','".Preference("ColorPrincipal", "", "")."');
$('.InputBusqueda').css('color','white');
</script>
";
echo "
    <script>
    function Search(){
        var busqueda = $('#InputBusqueda').val();
         $('#PreloaderBuscando').show();                
            $.ajax({
                url: 'search.php',
                type: 'post',        
                data: {IdUser:'" . $RinteraUser . "', Token: '" . $MiToken . "',
                    busqueda:busqueda

                },
            success: function(data){
                $('#Resultados').html(data);
                
                $('#PreloaderBuscando').hide();
                $('#Dashboard').hide();
            }
            });
        
       


            
    }
    
    // Search();
    </script>

";
if (isset($_GET['q'])){
    if ($_GET['q']<>''){
        echo '
        <script>
            Search();
            $("#Dashboard").hide();
        </script>
        ';
    }
}
?>

<!-- <a href='#DivModal' rel=MyModal:open onclick='URLModal(1)' class='icon'><img src='icons/check3.png'></a> -->

<!-- <a href="app_detalles.php?id=1&amp;tipo=AROMA&amp;var1=1" rel="MyModal:open" class="icon"><img src="icons/info.png"></a> -->

<?php
Historia($RinteraUser, "HOME", "Acceso a la pagina principal");





include ("footer.php");
?>