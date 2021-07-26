<?php
set_time_limit(1200);	

//FUNCIONES DE LAS APLICACIONES
function Proyeccion_CrearTabla($ALL = TRUE){
    require("rintera-config.php");
    if ($ALL == TRUE ){
        // echo "Calculando proyeccion basada en todos los pagos que se han recibido y los que aun no se pagan. Recomendable para analizar lineas
        // de proyeccion versus ingresos";
        $sql = "
        SET lc_time_names = 'es_ES';
        delete from proyeccion;
        insert proyeccion (
        select 
            DISTINCT 
                YEAR(Pagos.fecha) as Anio,
                MONTH(Pagos.fecha) as M,
                MONTHNAME(Pagos.fecha) as Mes,
                LAST_DAY(Pagos.fecha) as FechaCalculo,			
                0 as PagoCorriente,
                0 as PagoMoratorio,
                NOW() as Actualizacion
        from tblpagos Pagos
      
        );          
        ";  
        if (!$db1->multi_query($sql)) {
            
            echo "Falló la multiconsulta: (" . $mysqli->errno . ") " . $mysqli->error;
            return FALSE;
        } else {
            return TRUE;
        }
    } else {
        // echo "Calculando proyeccion sobre los pagos que aun se han pagado.";
        

      
        $sql = "
        SET lc_time_names = 'es_ES';
        delete from proyeccion;
        insert proyeccion (
        select 
            DISTINCT 
                YEAR(Pagos.fecha) as Anio,
                MONTH(Pagos.fecha) as M,
                MONTHNAME(Pagos.fecha) as Mes,
                LAST_DAY(Pagos.fecha) as FechaCalculo,			
                0 as PagoCorriente,
                0 as PagoMoratorio,
                NOW() as Actualizacion
        from tblpagos Pagos
        WHERE  EstadoPago='SIN PAGAR'
        );          
        ";  
        if (!$db1->multi_query($sql)) {
            
            echo "Falló la multiconsulta: (" . $mysqli->errno . ") " . $mysqli->error;
            return FALSE;
        } else {
            return TRUE;
        }
        
        
}
}


function Proyeccion_Generate($ALL){
require("rintera-config.php");
    
//1.- Crear la tabla de proyeccion, basada en los pagos activos (Sin Pagar)
// Proyeccion_CrearTabla(TRUE) <- Todos los pagos (historia de pagos y no pagados)
// Proyeccion_CrearTabla(FALSE) <-- cartera vencida, tabla con pagos que aun no se debe.

if (Proyeccion_CrearTabla($ALL)==TRUE){
    sleep(3);
    // echo "- Tabla creada de proyeccion: <br>";
    $r= $db1 -> query("select * from proyeccion");
    while($f = $r -> fetch_array()) {      
        if ($ALL == TRUE)  { //<-- se necesita el calculo completo de lo esperado incluso incluir lo pagado
            $QueryCalculo = "        
                SELECT	
                    
                sum(abono) + sum(interes) + sum(iva)  as PagoCorriente

                FROM
                tabladepagos
                WHERE 	
                    YEAR(fin) = ".$f['Anio']." and MONTH(fin) = ".$f['M']."
            ";
        } else{

        
            $QueryCalculo = "        
                SELECT	
                    
                sum(abono) + sum(interes) + sum(iva)  as PagoCorriente

                FROM
                tabladepagos
                WHERE 	
                estado<>'X' 
                and YEAR(fin) = ".$f['Anio']." and MONTH(fin) = ".$f['M']."
            ";
        }
        $PagoCorriente = 0; $OK = ""; $c = 0; $Ingresos = 0;
        $RCalc= $db1 -> query($QueryCalculo);
        if($Calculo = $RCalc -> fetch_array())
        {
            $PagoCorriente = $Calculo['PagoCorriente'];

            $QueryUpdate="UPDATE proyeccion  SET PagoCorriente='".$PagoCorriente."'  WHERE Anio='".$f['Anio']."' and M = '".$f['M']."'";            
            if ($db1->query($QueryUpdate) == TRUE)
            {$OK = "OK"; $c = $c+1; }
            else {$OK = "X";}
            unset($QueryCalculo);
        } 
      
        unset($RCalc, $Calculo, $QueryCalculo);


        //Calclo de ingresos
        $QueryCalculo = "        
            SELECT	
                
            sum(abono) + sum(interes) + sum(iva)  as Ingresos

            FROM
            tabladepagos
            WHERE 	
            estado='X' 
            and YEAR(fin) = ".$f['Anio']." and MONTH(fin) = ".$f['M']."
        ";
        $PagoCorriente = 0; $OK = ""; $c2 = 0; $Ingresos;
        $RCalc= $db1 -> query($QueryCalculo);
        if($Calculo = $RCalc -> fetch_array())
        {
            $Ingresos = $Calculo['Ingresos'];

            $QueryUpdate="UPDATE proyeccion  SET Ingresos='".$Ingresos."'  WHERE Anio='".$f['Anio']."' and M = '".$f['M']."'";            
            if ($db1->query($QueryUpdate) == TRUE)
            {$OK = "OK"; $c2 = $c2+1; }
            else {$OK = "X";}
            unset($QueryCalculo);
        } 

        ///TEST
        // echo "<br>".$f['FechaCalculo']."->".$PagoCorriente."->".$OK;
        unset($RCalc, $Calculo, $QueryCalculo);



    }
    if ($c>0){
        // DynamicTable_MySQL("select Anio, Mes, PagoCorriente from proyeccion", "DivProyeccion", "TblProyeccion", "tabla", 0, 1);
        return TRUE;
    } else {
        return FALSE;
    }

    
} else {
    Error("Error al crear al preparar la tabla para proyecciones");
}

}

function ProyeccionCheck($modo){
    require("rintera-config.php");   
    $AnioActual = date("Y");
    if ($modo==0){
        $sql = "select count(*) as n from proyeccion where Anio>=".$AnioActual;
    } else {
        $sql = "select count(*) as n from proyeccion";
    }
    $rc= $db1 -> query($sql);    
    if($f = $rc -> fetch_array())
    {
        if ($f['n']== 0 ){
            Toast("No hay informacion suficiente en la base de datos para calcular una proyeccion actual.",3,"");
            return FALSE;
        } else {
            return TRUE;
        }
        
    } else {
        return FALSE;
    }

}


function TableData($QueryM, $IdDiv="TableData_Div", $IdTabla="TableData_table", $Clase="", $Tipo=2){
require("rintera-config.php");
	
        $r= $db1 -> query($QueryM);
        // echo $sql;
        // var_dump($r);
        
        $tbCont = '<div id="'.$IdDiv.'" class="'.$Clase.'" style="background-color:white; padding:10px">
        <table id="'.$IdTabla.'" class="display" style="width:100%" class="tabla" style="font-size:8pt;">';
    $tabla_titulos = ""; $cuantas_columnas = 0;
        $r2 = $db1 -> query($QueryM); 
        // echo $sql;
        // var_dump($r2);
        
        while($finfo = $r2->fetch_field())
        {//OBTENER LAS COLUMNAS

                /* obtener posición del puntero de campo */
                $currentfield = $r2->current_field;       
                $tabla_titulos=$tabla_titulos."<th style='text-transform:uppercase; font-size:9pt;'>".$finfo->name."</th>";
                $cuantas_columnas = $cuantas_columnas + 1;        
        }

        $tbCont = $tbCont."  
        <thead>
        <tr>
            ".$tabla_titulos."  
        </tr>
        </thead>"; //Encabezados
        $tbCont = $tbCont."<tbody class='tabla'>";
        $cuantas_filas=0;
        $r = $db1 -> query($QueryM); while($f = $r-> fetch_row())
        {//LISTAR COLUMNAS

            $tbCont = $tbCont."<tr>";        
            for ($i = 1; $i <= $cuantas_columnas; $i++) {      
                $tbCont = $tbCont."<td style='font-size:10pt;'>".$f[$i-1]."</td>";       
                }

            $tbCont = $tbCont."</tr>";
            $cuantas_filas = $cuantas_filas + 1;        
        }

        $tbCont = $tbCont."</tbody>";
        $tbCont = $tbCont."</table></div>";
	
	echo  $tbCont;

	$Botones = "
	dom: 'Bfrtip',
	buttons: [
		{
			extend:    'copyHtml5',
			text:      '<i class=\"fa fa-files-o\"></i>',
			titleAttr: 'Copy'
		},
		{
			extend:    'excelHtml5',
			text:      '<i class=\"fa fa-file-excel-o\"></i>',
			titleAttr: 'Excel'
		},
		{
		    extend:    'csvHtml5',
		    text:      '<i class=\"fa fa-file-text-o\"></i>',
		    titleAttr: 'CSV'
		},
		{
		    extend:    'pdfHtml5',
		    text:      '<i class=\"fa fa-file-pdf-o\"></i>',
		    titleAttr: 'PDF'
		}
	]
	";
		switch ($Tipo) {
			case 1: //Scroll Vertical
					echo '<script>
					$(document).ready(function() {
						$("#'.$IdTabla.'").DataTable( {
							"scrollY":        "200px",
							"scrollCollapse": true,
							"paging":         false,
							"language": {
								"decimal": ",",
								"thousands": "."
							}
						} );
					} );
					</script>';
				break;

			case 2: //Scroll Horizontal
					echo '<script>
					$(document).ready(function() {
						$("#'.$IdTabla.'").DataTable( {
							"scrollX": true,
							"scrollCollapse": true,
							"paging":         true,
							"language": {
								"decimal": ",",
								"thousands": "."
								
							}
							,responsive: true
							,'.$Botones.'
						} );
					} );
					</script>';
				break;
			
			default:
				echo '<script>
				$(document).ready(function() {
					$("#'.$IdTabla.'").DataTable( {
						"language": {
							"decimal": ",",
							"thousands": "."
						}
					} );
				} );
				</script>';
		}
       

}

?>