<?php
// include("head.php");

// include("header.php");
include("seguridad.php");  
require ("rintera-config.php");
require ("components.php");
// require ("app_funciones.php");

$NoSol = VarClean($_POST['NoSol']);
$CreditoTipo = VarClean($_POST['CreditoTipo']);
$ClienteCurp = VarClean($_POST['ClienteCurp']);

$CreditoCantidad = VarClean($_POST['CreditoCantidad']);
$CreditoPlazo = VarClean($_POST['CreditoPlazo']);
$CreditoFormaDePago = VarClean($_POST['CreditoFormaDePago']);

$CreditoTasaInteres = VarClean($_POST['CreditoTasaInteres']);
$CreditoTasaMoratorio = VarClean($_POST['CreditoTasaMoratorio']);
$CreditoCargoPorSemana = VarClean($_POST['CreditoCargoPorSemana']);
$CreditoGarantia = VarClean($_POST['CreditoGarantia']);
$CreditoValoracion = VarClean($_POST['CreditoValoracion']);
$CreditoComentarios = VarClean($_POST['CreditoComentarios']);
$CreditoFechaContrato = VarClean($_POST['CreditoFechaContrato']);
$CreditoIvaTipo = VarClean($_POST['CreditoIvaTipo']);

// Historia($RinteraUser, "PROYECCION", "Vio la proyeccion ".$Anio);
if ($CreditoValoracion == "NOT"){
   //Solo puede guardar Cargo Semanal y Garantia
   $sql = "UPDATE cuentas SET
   garantia = '".$CreditoGarantia."',
   cargoporsemana = '".$CreditoCargoPorSemana."',
   comentario='".$CreditoComentarios."'
   WHERE nosol = '".$NoSol."'
   ";
   if ($db1->query($sql) == TRUE){
      Toast("Actualizado con exito, (cargo Semanal, Garantia y Comentarios)",4,"");      
      Historia($RinteraUser,"CLIENTES","Actualizo Cargo Semanal = ".$CreditoCargoPorSemana.", Garantia = ".$CreditoGarantia.", Comentarios=".$CreditoComentarios);      
   } else {
      Toast("Guardado con exito",2,"");
   }
   unset($sql);
   
} else { //addslashes($str);
   //Todos los campos y Ejecutar Tablas aledañas
   $GRABAR = TRUE;
   echo "FechaContrato=".$CreditoFechaContrato;
   if ($CreditoFechaContrato ==''){
      Toast("ERROR en la fecha del contrato",2,"");
      $GRABAR = FALSE;
   } 

   if ($CreditoCantidad =='' OR $CreditoCantidad=='0'){
      Toast("ERROR en la Cantidad",2,"");
      $GRABAR = FALSE;
   } 

   if ($CreditoPlazo =='' OR $CreditoPlazo=='0'){
      Toast("ERROR en el Plazo",2,"");
      $GRABAR = FALSE;
   } 

   if ($CreditoValoracion ==''){
      Toast("ERROR Eliga una Valoracion",2,"");
      $GRABAR = FALSE;
   } 


   if ($GRABAR == TRUE) {
   if ($CreditoValoracion=='APROBADO') {
      $sql = "UPDATE cuentas SET
      garantia = '".$CreditoGarantia."',
      cargoporsemana = '".$CreditoCargoPorSemana."',
      tipo='".$CreditoTipo."',
      cantidad='".$CreditoCantidad."',
      plazo ='".$CreditoPlazo."',
      formadepago='".$CreditoFormaDePago."',
      tasa_interes='".$CreditoTasaInteres."',
      tasa_moratorio='".$CreditoTasaMoratorio."',
      valoracion='".$CreditoValoracion."',
      fechacontrato='".$CreditoFechaContrato."',
      comentario='".$CreditoComentarios."',
      iva_tipo='".$CreditoIvaTipo."'


      WHERE nosol = '".$NoSol."'
      ";
      if ($db1->query($sql) == TRUE){
         Toast("Actualizado con exito, (".$CreditoValoracion.")",4,"");      
         Historia($RinteraUser,"CLIENTES","Actualizo Cuenta = ".addslashes($sql));      

         //CHECAR si hay una corrida y limpiarla
         $CorridaEncontrada=0;
         $sqlC = "select count(*) as n
         from tabladepagos
         where nosol='".$NoSol."'" ;    
         $rC= $db1 -> query($sqlC); if($C = $rC -> fetch_array()){
            $CorridaEncontrada = $C['n'];
         }
         unset($sqlC, $rC, $C);


         $HacerCorrida = TRUE;
         if ($CorridaEncontrada >0) {//Si encontramos una corrida financiera previa
            //Eliminamos la Corrida
            $sqlDel = "DELETE FROM  tabladepagos                     
                     WHERE nosol='".$NoSol."'  
                     ";
                     if ($db1->query($sqlDel) == TRUE){                        
                        Toast("Se actualizo la corrida",3,"");      
                        Historia($RinteraUser,"TABLADEPAGOS","ActualizoCorrida = ".addslashes($sqlDel));      
                        $HacerCorrida = TRUE;
                     }  else {
                        $HacerCorrida = FALSE;
                     }
         }  else {
            $HacerCorrida = TRUE;
         }

         //CREAR CORRIDA FINANCIERA:
         if ($HacerCorrida == TRUE){
               $n = 0;
               $NPlazo = 0;
               if ($CreditoFormaDePago==7){$NPlazo=$CreditoPlazo*4;}
               if ($CreditoFormaDePago==15){$NPlazo=$CreditoPlazo*2;}
               if ($CreditoFormaDePago==30){$NPlazo=$CreditoPlazo*1;}

               $Abono=$CreditoCantidad/$NPlazo;
               $Interes=(($CreditoCantidad/100)*$CreditoTasaInteres)*$CreditoPlazo;
               $Interes=$Interes/$NPlazo; //se reparte entre el numero de letras de pago

               $Impuestos = (($Abono  +  $Interes) /100) * $CreditoIvaTipo;
               
               $AbonoFinal=$Abono+$Interes + $Impuestos;

               $UltimoPago=$CreditoCantidad-($Abono*$NPlazo);

               $UltimoPago=$Abono+$UltimoPago;
            
               $nodepago =1;
               $Saldo=$CreditoCantidad;
               $n=1;
               $finicio="";
               $ffin="";
               // echo "NPagos=".$NPlazo."<br>";
               // echo "FormadePago=".$CreditoFormaDePago."<br>";
               // echo "
               // <h3>Corrida Financiera:</h3>
               // <table class='tabla'>";
               // echo "<th>No</th>";
               // echo "<th>Fecha de Pago</th>";
               // echo "<th>Abono</th>";
               // echo "<th>Interes</th>";
               // echo "<th>IVA</th>";
               // echo "<th>Total</th>";
               $nOK=0;
               while($n<=$NPlazo){
                  if ($n==1){ // si es el primer pago es la fecha del contrato
                     $FechaSig = $CreditoFechaContrato;
                  } else {
                     $FechaSig = date('Y-m-d', strtotime("$FechaSig + ".$CreditoFormaDePago."day"));
                  }
                  
                  if (dia($FechaSig) == "Sabado"){
                     $FechaSig = date('Y-m-d', strtotime("$FechaSig + 2day"));

                  }

                  if (dia($FechaSig) == "Domingo"){
                     $FechaSig = date('Y-m-d', strtotime("$FechaSig + 1day"));
                  }

                  // echo "<tr>";
                  $ffin=$FechaSig;
                  $finicio = date('Y-m-d', strtotime("$FechaSig - 3day"));
          

                  $sqlIn = "INSERT INTO tabladepagos
                  (
                     nosol,
                     cuenta_interna,
                     curp,
                     no,
                     fin,
                     abono,
                     interes,
                     iva,               
                     inicio,
                     usuario,
                     act_fecha,
                     act_hora

                  )
                  VALUES (
                     '".$NoSol."',
                     '',
                     '".$ClienteCurp."',
                     '".$n."',
                     '".$ffin."',
                     '".$Abono."',
                     '".$Interes."',
                     '".$Impuestos."',
                     '".$finicio."',
                     '".$RinteraUser."',
                     '".$fecha."',
                     '".$hora."'
                  )
                  ";
                  if ($db1->query($sqlIn) == TRUE){
                     $nOK= $nOK + 1;
                     // Toast("Actualizado con exito, (".$CreditoValoracion.")",4,"");      
                     Historia($RinteraUser,"TABLADEPAGOS","Inserto Corrida Financiera = ".addslashes($sqlIn));      
                  } 
                  unset($sqlIn);

                  // echo "<td>".$n."</td><td>".dia($finicio)." ".$finicio." ~ ".dia($ffin)." ".$ffin."". "</td>";
                  // echo "<td>".$n."</td><td>"." ".$finicio." ~ "." ".$ffin."". "</td>";
                  // echo "<td>".Pesos($Abono). "</td>";
                  // echo "<td>".Pesos($Interes). "</td>";
                  // echo "<td>".Pesos($Impuestos). "</td>";
                  // echo "<td>".Pesos($AbonoFinal). "</td>";
                  


                  // echo "</tr>";
                  


                  $n = $n+1;
               }
         } else{
            Toast ("Error al crear la Corrida Financiera",2,"");
         }

         if ($nOK > 0){
            Toast("Se insertaron ".$nOK." letras de pago a la corrida de la Cuenta ".$NoSol,4,"");
         } else {
            Toast("Ha habido un error al Insertar la Corrida Financiera",2,"");
         }
         // echo "</table>";

      } else {
         Toast("Guardado con exito",2,"");
      }
      unset($sql);




   } else { //RECHAZADO
   $sql = "UPDATE cuentas SET
      garantia = '".$CreditoGarantia."',
      cargoporsemana = '".$CreditoCargoPorSemana."',
      tipo='".$CreditoTipo."',
      cantidad='".$CreditoCantidad."',
      plazo ='".$CreditoPlazo."',
      formadepago='".$CreditoFormaDePago."',
      tasa_interes='".$CreditoTasaInteres."',
      tasa_moratorio='".$CreditoTasaMoratorio."',
      valoracion='".$CreditoValoracion."',
      fechacontrato='".$CreditoFechaContrato."',
      comentario='".$CreditoComentarios."'


      WHERE nosol = '".$NoSol."'
      ";
      if ($db1->query($sql) == TRUE){
         Toast("Actualizado con exito, (".$CreditoValoracion.")",4,"");      
         Historia($RinteraUser,"CLIENTES","Actualizo Cuenta = ".addslashes($sql));      
      } else {
         Toast("Guardado con exito",2,"");
      }
      unset($sql);
   }
} else {
   Toast("ERROR al guardar",2,"");
}
}

// $sql="select count(*) as nPagos from tabladepagos where nosol='".$NoSol."'";
// $NPagos = 0;
// if ($db1->query($sql) == TRUE){
//     $rc = $db1->query($sql);    
//     if($f = $rc -> fetch_array())
//     {
//         $NPagos = $f['nPagos'];
//     } 
// }
// unset($rc, $f);




// if ($Existe == 0){ //INSERT
//     $sqlIn =  "INSERT INTO clientes          
//         (
//         curp,
//         nombre,
//         domicilio,
//         municipio,
//         estado,
//         IFE,
//         correo,
//         estadocivil,
//         fechadenacimiento,
//         profesion,
//         sexo,
//         telefono,
//         trabajo_nombre,
//         trabajo_domicilio,
//         trabajo_telefono,
//         trabajo_giro,
//         trabajo_puesto,
//         trabajo_salario,
//         socio_dependen,
//         socio_casapropia,
//         minegocio_propio,
//         minegocio_giro,
//         minegocio_ingresos,
//         minegocio_telefono,
//         minegocio_empleados,
//         minegocio_domicilio,
//         minegocio_antiguedad,
//         socio_hijos,
//         socio_hogar,
//         socio_renta,
//         socio_agualuz,
//         socio_drenaje,
//         refc1_nombre,
//         refc1_tel,
//         refc1_domicilio,
//         refc1_antiguedad,
//         refc2_nombre,
//         refc2_tel,
//         refc2_domicilio,
//         refc2_antiguedad,
//         refc3_nombre,
//         refc3_tel,
//         refc3_domicilio,
//         refc3_antiguedad,
//         grupo,
//         grupo_cargo)

//     VALUES (
//      '".$Curp."',
//      '".$Nombre."',
//      '".$Domicilio."',
//      '".$Municipio."',
//      '".$Estado."',
//      '".$IFE."',
//      '".$Correo."',
//      '".$EstadoCivil."',
//      '".$FechaDeNacimiento."',
//      '".$Profesion."',
//      '".$Sexo."',
//      '".$Telefono."',
//      '".$trabajo_nombre."',
//      '".$trabajo_domicilio."',
//      '".$trabajo_telefono."',
//      '".$trabajo_giro."',
//      '".$trabajo_puesto."',
//      '".$trabajo_salario."',
//      '".$socio_dependen."',
//      '".$socio_casapropia."',
//      '".$minegocio_propio."',
//      '".$minegocio_giro."',
//      '".$minegocio_ingresos."',
//      '".$minegocio_telefono."',
//      '".$minegocio_empleados."',
//      '".$minegocio_domicilio."',
//      '".$minegocio_antiguedad."',
//      '".$socio_hijos."',
//      '".$socio_hogar."',
//      '".$socio_renta."',
//      '".$socio_agualuz."',
//      '".$socio_drenaje."',
//      '".$refc1_nombre."',
//      '".$refc1_tel."',
//      '".$refc1_domicilio."',
//      '".$refc1_antiguedad."',
//      '".$refc2_nombre."',
//      '".$refc2_tel."',
//      '".$refc2_domicilio."',
//      '".$refc2_antiguedad."',
//      '".$refc3_nombre."',
//      '".$refc3_tel."',
//      '".$refc3_domicilio."',
//      '".$refc3_antiguedad."',
//      '".$grupo."',
//      '".$grupo_cargo."')";
    
//     echo $sqlIn;
//     if ($db1->query($sqlIn) == TRUE){
//         Toast("Guardado ".$Nombre." correctamente",4,"");
//         Historia($RinteraUser,"CLIENTES","Dio de Alta al cliente con IdCliente = ".$Curp);
//     } else {
//         Toast("Error al guardar ".$Nombre." correctamente",2,"");

//     }
    

// } else { //UPDATE
//     $sqlUp =  "UPDATE clientes  SET        
        
//         nombre = '".$Nombre."',
//         domicilio = '".$Domicilio."',
//         municipio = '".$Municipio."',
//         estado = '".$Estado."',
//         IFE = '".$IFE."',
//         correo = '".$Correo."',
//         estadocivil = '".$EstadoCivil."',
//         fechadenacimiento = '".$FechaDeNacimiento."',
//         profesion = '".$Profesion."',
//         sexo = '".$Sexo."',
//         telefono = '".$Telefono."',
//         trabajo_nombre = '".$trabajo_nombre."',
//         trabajo_domicilio = '".$trabajo_domicilio."',
//         trabajo_telefono = '".$trabajo_telefono."',
//         trabajo_giro = '".$trabajo_giro."',
//         trabajo_puesto = '".$trabajo_puesto."',
//         trabajo_salario = '".$trabajo_salario."',
//         socio_dependen = '".$socio_dependen."',
//         socio_casapropia = '".$socio_casapropia."',
//         minegocio_propio = '".$minegocio_propio."',
//         minegocio_giro = '".$minegocio_giro."',
//         minegocio_ingresos = '".$minegocio_ingresos."',
//         minegocio_telefono = '".$minegocio_telefono."',
//         minegocio_empleados = '".$minegocio_empleados."',
//         minegocio_domicilio = '".$minegocio_domicilio."',
//         minegocio_antiguedad = '".$minegocio_antiguedad."',
//         socio_hijos = '".$socio_hijos."',
//         socio_hogar = '".$socio_hogar."',
//         socio_renta = '".$socio_renta."',
//         socio_agualuz = '".$socio_agualuz."',
//         socio_drenaje = '".$socio_drenaje."',
//         refc1_nombre = '".$refc1_nombre."',
//         refc1_tel = '".$refc1_tel."',
//         refc1_domicilio = '".$refc1_domicilio."',
//         refc1_antiguedad = '".$refc1_antiguedad."',
//         refc2_nombre = '".$refc2_nombre."',
//         refc2_tel = '".$refc2_tel."',
//         refc2_domicilio = '".$refc2_domicilio."',
//         refc2_antiguedad = '".$refc2_antiguedad."',
//         refc3_nombre = '".$refc3_nombre."',
//         refc3_tel = '".$refc3_tel."',
//         refc3_domicilio = '".$refc3_domicilio."',
//         refc3_antiguedad = '".$refc3_antiguedad."',
//         grupo = '".$grupo."',
//         grupo_cargo = '".$grupo_cargo."'
        
//     WHERE curp='".$Curp."'";
//     echo $sqlUp;
//     if ($db1->query($sqlUp) == TRUE){
//         Toast("Actulizado ".$Nombre." correctamente",4,"");
//         Historia($RinteraUser,"CLIENTES","Actualizo al cliente con IdCliente = ".$Curp);
//     } else {
//         Toast("Error al guardar ".$Nombre." correctamente",2,"");

//     }
// }

?>

<?php
// include("footer.php");
?>