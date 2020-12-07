<?php
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
        $QueryCalculo = "        
            SELECT	
                
            sum(abono) + sum(interes) + sum(iva)  as PagoCorriente

            FROM
            tabladepagos
            WHERE 	
            estado<>'X' 
            and YEAR(fin) = ".$f['Anio']." and MONTH(fin) = ".$f['M']."
        ";
        $PagoCorriente = 0; $OK = ""; $c = 0;
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

?>