<?php
require ("config.php");
?>



<?php
/* si no es la sesion de el USUARIO regresar a login.*/
session_start();

if(!isset($_SESSION['usuario'])) 
{  
  header('Location: login.php'); 
  exit();
}

?>



<?php
//  verificamos nivel del admin
$numelentos = count($nivel_admin);
$estoy = 'no';
for ($i=0; $i < $numelentos; $i++)
{
	//print $nivel_admin[$i];
	$yo = $_SESSION['usuario'];
	if ($yo == $nivel_admin[$i])
	{
		$estoy='OK';
		}
}
if ($estoy=='OK'){
	//echo 'soy admin';
	}else { 
	//echo 'no tengo acceso'; 
	header('Location: error_nivel.html'); 
	exit();
	}
?>



<?php
require ("config.php");
require ("funciones.php");

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());

$nosol = $_POST["nosol"];
//$iva_tipo = $_POST["iva_tipo"];   
$cuenta_interna = $_POST["cuenta_interna"];
$tasa_moratorio = $_POST["tasa_moratorio"];
$tasa_interes = $_POST["tasa_interes"];
$valoracion = $_POST["valoracion"];
$curp = $_POST["curp"];
$cantidad = $_POST["cantidad"];
$cargo=$_POST["cargo"];
$fechadeinicio=$_POST["fechadeinicio"];
$fechacontrato=$_POST["fechacontrato"];

//$f = $_POST["fvencimiento"];

/*echo $iva_tipo."<br>";
echo $cuenta_interna."<br>";
echo $tasa_moratorio."<br>";
echo $tasa_interes."<br>";*/

$sql = "UPDATE cuentas SET

cuenta_interna ='$cuenta_interna',	
tasa_interes = '$tasa_interes',
tasa_moratorio='$tasa_moratorio',
valoracion='$valoracion',
cargo='$cargo',
fechacontrato='$fechacontrato'

WHERE nosol='$nosol'";


if(!mysql_query($sql))//checamos 
{
	echo '<img src="img\mal.jpg"> NO SE HA ACTUALIZADO';
}else{//si esta, preraramos la actualizacion
	echo '<center><img src="img\bien.jpg">Actualizada correctamente la valoracion como: '.$valoracion.'<br><center>';	
		
		if (_valoracion($nosol)=="APROBADO"){
		//TABLA DE PAGOS
		//variables para calculo
		$fecha=$fechadeinicio;
		$n=0;
		$forma=forma_de_pago($nosol);	
		//echo $forma;
		$cantidad=$cantidad;
		$plazo=plazo_de_pago($nosol); //meses
		 //semanas
			if ($forma==7){$plazo2=$plazo*4;}
			if ($forma==15){$plazo2=$plazo*2;}
			if ($forma==30){$plazo2=$plazo*1;}
	
		$tasainteres=$tasa_interes;
		$tasamoratorio=$tasa_moratorio;
		
		
		$abono=$cantidad/$plazo2;
		$interes=(($cantidad/100)*$tasainteres)*$plazo;
		$interes=$interes/$plazo2; //por semana
		$abonofinal=$abono+$interes;
		$ultimopago=$cantidad-($abono*$plazo2);
		$ultimopago=$abono+$ultimopago;
		$nodepago =1;
		$saldo=$cantidad;
		$n=1;
				while($n<=$plazo2){
					$fecha = date('Y-m-d', strtotime("$fecha + 1day"));
					
                   
                     $hoydia = date('d', strtotime($fecha));
                            if (($hoydia == 1) ){
                                        $finicio = $fecha;
                                       
                        
                    }
                    
					
					
                    if ($forma==15){
                            $hoydia = date('d', strtotime($fecha));
							//if (($hoydia == 15) or ($hoydia==30)){
                            if (($hoydia == 15) or ($hoydia==findemes($fecha))){
                                        $finicio = $fecha;
                                       
                                        if ((dia($fecha)=="Sabado") or (dia($fecha)=="Domingo") ){
                                           $ft = $fecha; 
                                            while (dia($ft)<>"Lunes"){
                                                $ft = date('Y-m-d', strtotime("$ft + 1day"));                                            
                                                }
                                            $ffin = $ft;
                                        } else
										{
											$ffin = $fecha;
											}
                                        
                                        //if (dia($fecha)=="Lunes"){
//                                            $ffin = date('Y-m-d', strtotime("$fecha + 2day"));}
//                                            
//                                        if (dia($fecha)=="Martes"){
//                                            $ffin = date('Y-m-d', strtotime("$fecha + 1day"));}
//                                        
//                                        if (dia($fecha)=="Miercoles"){
//                                            $ffin = $fecha;
//                                            }
                                            
                                        $nodepago= $nodepago+1;
                   						$saldo=$saldo-$abono;
            						$sql2 = "INSERT INTO tabladepagos (no, abono, interes, inicio, fin, comentario, curp, cuenta_interna, estado, nosol) 
            							
            							VALUES(
            							'$n',
            							'$abono',
            							'$interes',							
            							'$finicio',
            							'$ffin',
            							'',
            							'$curp',
            							'$cuenta_interna',
            							'',
            							'$nosol'							
            							)";
            							
            							if(!mysql_query($sql2))//checamos si hay curp
            							{
            								echo '<img src="img\mal.jpg"> NO SE HA creado <br>';
            							}else{//si esta, preraramos la actualizacion
            								echo '<img src="img\bien.jpg">'.$n;	
            								$act=actualizar_vencimiento($nosol,$ffin); //act  el vencimieinto gralconel  ultimio ago
            									 
            							}
                                       
                                        $n=$n+1;
            						}
                        
                                   // }
                                    
                        
                        
                    }
                    
                    if ($forma==7){
            					if (dia($fecha)=="Lunes"){
            						// fechas de vencimiento deLun a Mie
            							$finicio=$fecha;
            //							echo '<td >'.dia($fecha).', '.$fecha.'</td>';
            							
            							$fecha = date('Y-m-d', strtotime("$fecha + 2day"));
            							$ffin=$fecha;
            //							 echo '<td >'.dia($fecha).', '.$fecha.'</td>';
            							 $nodepago= $nodepago+1;
            						
            //						echo '<td>'.number_format($saldo,2,".",",").'</td>';
            						
            						$saldo=$saldo-$abono;
            
            						
            						$sql2 = "INSERT INTO tabladepagos (no, abono, interes, inicio, fin, comentario, curp, cuenta_interna, estado, nosol) 
            							
            							VALUES(
            							'$n',
            							'$abono',
            							'$interes',							
            							'$finicio',
            							'$ffin',
            							'',
            							'$curp',
            							'$cuenta_interna',
            							'',
            							'$nosol'							
            							)";
            							
            							if(!mysql_query($sql2))//checamos si hay curp
            							{
            								echo '<img src="img\mal.jpg"> NO SE HA creado <br>';
            							}else{//si esta, preraramos la actualizacion
            								echo '<img src="img\bien.jpg">'.$n;	
            								$act=actualizar_vencimiento($nosol,$ffin); //act  el vencimieinto gralconel  ultimio ago
            									 
            							}
                                        $n=$n+1;
            						}
            						
            			       	}
				}
			
		
			if (_valoracion($nosol)=="APROBADO"){
			echo '<br><span class="pie1"></span>';}
			echo '	<br><a href="index.php"> Regresar al menu </a>';
		
		}
}

mysql_close();




?>