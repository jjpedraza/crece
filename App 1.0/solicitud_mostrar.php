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






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> SOLICITUD DE CREDITO </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/solicitud.css" rel="stylesheet" type="text/css" />


</head><body>

<?php
require ("config.php");
require ("funciones.php");
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);
$nosol=$_GET["nosol"];
$result=mysql_query("SELECT * FROM cuentas WHERE nosol=".$nosol."",$link);
$row=mysql_fetch_array($result);

//# Mostramos la imagen

?>

<table  border="1" cellspacing="0" cellpadding="0" align="center"   width="800">
  <tr bgcolor="#000000">
    <th colspan="6" class="titulo" style="color:#FFF" scope="col">SOLICITUD DE PRESTAMO</th>
  </tr>
  <tr>
    <td height="25" colspan="2" bgcolor="#FFFFFF"><span class="texto">No</span>.<span class="respuesta"> <?php echo "<b>". $nosol."</b>" ?> <span class="texto"></span>|  
    Fecha: </span><span class="respuesta"><?php echo $row["fechasol"];	 ?></span>    </td>
    <td colspan="4" bgcolor="#FFFFFF" align="center">      <?php 
	if  ($row["valoracion"]==""){echo "<b>PENDIENTE</b>";}else{echo $row["valoracion"];} 
	
	
echo ' ('.$row["tipo"].')<br>';
	if ($row["tipo"]=="GRUPO"){
		echo '<SPAN class="subtitulo">GRUPO ('._aquegrupopertenece($row["curp"]).')<br> 
		Integrates del grupo: <br>';
		echo ''._integrantesdelgrupo(_aquegrupopertenece($row["curp"])).'</span><br>';	
	
//
		
		}
	
	//echo ' ('._aquegrupopertenece($row["curp"]).')<br>';	
	
//_integrantesdelgrupo
	
	
	?>
    
        </td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC" class="subtitulo">INFORMACION PERSONAL DEL SOLICITANTE</td>
  </tr>
  <tr>
    <td width="118" align="right" bgcolor="#FFFFFF"><span class="texto">Nombre</span>: </td>
    <td colspan="5" bgcolor="#FFFFFF"><span class="respuesta"><b><?php echo nombre($row["curp"]);
	
	
//_integrantesdelgrupo
	
	 ?>       </b></span></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF" class="texto">Domicilio:</td>
    <td colspan="5" bgcolor="#FFFFFF"><span class="respuesta"><?php echo domicilio($row["curp"]) ?></span></td>
  </tr>
  <tr>
    <td cbgcolor="#FFFFFF" class="subtitulo" align="right"><span class="texto">Telefono</span>:</td>
    <td width="25" bgcolor="#FFFFFF"><span class="respuesta"><?php echo telefono($row["curp"]) ?></td>
    <td width="3" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="119" bgcolor="#FFFFFF" align="right"><span class="texto">Correo:</span></td>
    <td colspan="2" align="left" bgcolor="#FFFFFF" ><?php echo correo($row["curp"]) ?><span class="respuesta"></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF" class="texto">CURP:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["curp"] ?></span></td>
    <td bgcolor="#FFFFFF" class="texto">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="texto" align="right">IFE:</td>
    <td colspan="2" align="left" bgcolor="#FFFFFF">
    <span class="respuesta"><?php echo ife($row["curp"]) ?></span></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF" class="texto">Fecha de nacimiento:</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="texto">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="texto">Fotografia</td>
    <td colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF" class="texto">Estado Civil:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo estadocivil($row["curp"]) ?></span></td>
    <td colspan="4" rowspan="4" bgcolor="#FFFFFF">
   <?php
	echo "<a target='new' href='foto_mostrar.php?curp=".$row["curp"]."'>
	<img border='0' src='foto_mostrar.php?curp=".$row["curp"]."' height='80' width='100'/></a>";
	?>
    
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF" class="texto">Estudios:</td>
    <td bgcolor="#FFFFFF">
    
    <span class="respuesta">
    <?php echo estudios($row["curp"]) ?>
    </span>
    
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF" class="texto">Profesion:</td>
    <td bgcolor="#FFFFFF">
    <span class="respuesta">
    <?php echo profesion($row["curp"]) ?>
    </span>
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF" class="texto">Sexo:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta">
    <?php echo sexo($row["curp"]) ?>
    </span></td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF" class="texto">Croquis de ubicacion del Domicilio:</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF" align="center">
    <?php
	echo "<a target='new' href='croquis_mostrar.php?curp=".$row["curp"]."'>
	<img border='0' src='croquis_mostrar.php?curp=".$row["curp"]."' height='100' width='400'/></a>";
	?>
    
    
     </td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC" class="subtitulo">INFORMACION LABORAL</td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF" class="texto">Trabaja actualmente en:<span class="respuesta">
      <?php echo trabajo_nombre($row["curp"]).'('.trabajo_giro($row["curp"]).')'; ?>
    </span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Domicilio:</td>
    <td colspan="5" bgcolor="#FFFFFF"><span class="respuesta">
    <?php echo trabajo_domicilio($row["curp"]) ?>
    </span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Puesto:</td>
    <td bgcolor="#FFFFFF">
    <span class="respuesta">
    <?php echo trabajo_puesto($row["curp"]) ?>
    </span>
    
    </td>
    <td bgcolor="#FFFFFF"></td>
   
    <td bgcolor="#FFFFFF" class="texto" align="right">Telefono</td>
    <td width="65" bgcolor="#FFFFFF"><span class="respuesta">
    <?php echo trabajo_telefono($row["curp"]) ?>
    </span></td>
    
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Salario mensual:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><b>
    <?php echo trabajo_salario($row["curp"]) ?>
    </b></span></td>
    <td bgcolor="#FFFFFF"></td>
    
    <td  bgcolor="#FFFFFF" class="texto" align="right">:</td>
    <td bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">mi Negocio:</td>
    <td bgcolor="#FFFFFF">
    <span class="respuesta"><b>
    <?php echo minegocio_nombre($row["curp"]).'('.minegocio_giro($row["curp"]).')'; ?>
    </b></span>
    
    </td>
    <td bgcolor="#FFFFFF"></td>
   
    <td  bgcolor="#FFFFFF" class="texto" align="right">Telefono:</td>
    <td bgcolor="#FFFFFF">
    <span class="respuesta">
    <?php echo minegocio_telefono($row["curp"]) ?>
    </span>
    
    
    </td>
  </tr>
  <tr>
    <td colspan="2" align="right" bgcolor="#FFFFFF" class="texto">
      <span class="respuesta">
      <?php echo 'No. Empleados: '.	
	minegocio_telefono($row["curp"]).
	', Local propio:'.minegocio_propio($row["curp"]);
	 ?>
      </span>
      
      
    </td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    
    <td bgcolor="#FFFFFF" class="texto" align="right">Ingresos Mensuales :</td>
    <td bgcolor="#FFFFFF">
    <span class="respuesta">
    <?php echo casa_propia($row["curp"]) ?>
    </span>
    
    
    </td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC" class="subtitulo" >REFERENCIAS</td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF" class="texto">(1)<span class="respuesta">
    <?php echo ref1($row["curp"]) ?>
    </span></td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF" class="texto">(2)
    
    <span class="respuesta">
    <?php echo ref2($row["curp"]) ?>
    </span>
    </td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC" class="subtitulo" >OPERACION SOLICITADA:</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Cantidad:</td>
    <td bgcolor="#FFFFFF">
        <span class="respuesta">
    <?php 
	
	echo $row["cantidad"]; ?>
    </span>
    
    
    </td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    
    <td align="right" bgcolor="#FFFFFF" class="texto">Forma de pago:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta">
    <?php 
	
	echo 'cada '.$row["formadepago"].' dias'; ?>
    </span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Destino:</td>
    <td colspan="5" bgcolor="#FFFFFF" align="left"><span class="respuesta">
    <?php 
	
	echo $row["destino"]; ?>
    </span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Plazo:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta">
    <?php 
	
	echo $row["plazo"].' meses'; ?>
    </span></td>
    <td bgcolor="#FFFFFF"></td>
   
    <td align="right" bgcolor="#FFFFFF" class="texto">Tipo:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta">
    <?php 
	
	echo $row["tipo"]; ?>
    </span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Garantia:</td>
    <td colspan="5" bgcolor="#FFFFFF"><span class="respuesta">
    <?php 
	
	echo $row["garantia"].'<br>';
	echo '<a href="garantia_mostrar.php?nosol='.$nosol.'">';
	echo "<img src='garantia_mostrar.php?nosol=".$nosol."' width='100' height='100' border='0'></a>";	

	echo '<a href="garantia_mostrar2.php?nosol='.$nosol.'">';
	echo "<img src='garantia_mostrar2.php?nosol=".$nosol."' width='100' height='100' border='0'></a>";	
	
		echo '<a href="garantia_mostrar3.php?nosol='.$nosol.'">';
	echo "<img src='garantia_mostrar3.php?nosol=".$nosol."' width='100' height='100' border='0'></a>";	
	 ?>
    </span></td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC" class="subtitulo" >AVAL</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Nombre:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta">
    <?php 
	
	echo nombre($row["curp_aval"]);
	echo '<br>';
	echo 'Contratos que ha tenido: '._contratos($row["curp_aval"]);
	
	 ?>
    </span></td>
    <td bgcolor="#FFFFFF"></td>
   
    <td align="right" bgcolor="#FFFFFF" class="texto">Telefono:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta">
    <?php 
	
	echo telefono($row["curp_aval"]); ?>
    </span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">CURP:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta">
    <?php 
	
	echo $row["curp_aval"]; ?>
    </span></td>
    <td bgcolor="#FFFFFF"></td>
  
    <td align="right" bgcolor="#FFFFFF" class="texto">Profesion:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta">
    <?php 
	
	echo profesion($row["curp_aval"]); ?>
    </span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Domicilio:</td>
    <td colspan="5" bgcolor="#FFFFFF"><span class="respuesta">
    <?php 
	
	echo domicilio($row["curp_aval"]); ?>
    </span></td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF" class="respuesta">
    
    
    
      <p>&nbsp;</p>
      <p>Firma (Aval) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma (solicitante) </p></td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF" class="respuesta">
    <span class="mini">
    Declaro que: Los datos en la presente solicitud, parte integrante del contrato, son correctos y autorizo a CRECE Y MAS S.A. de C.V. a realizar las investigaciones y acciones que se consideren necesarias, a efecto de comprobar a travéz de  cualquier tercero, dependencia u autoridad, la veracidad de los datos que le fueron proporcionados; de conformidad con el articulo 18 bis de la Ley para la Transparencia y Ordenamiento de los Servicio Financieros, fue hecho de mi conocimiento a mi entera satisfaccion, el contenido, alcance,terminos y condiciones de la presentesolicitud, queforma parte del Contrato, documentos con los que estoy de acuerdo y me adhiero a lo pactado en los mismos, procediendo en este ato a firmar la solicitud y aceptar el contrato registrado en terminos de las disposiciones legales aplicables la presene solicitud y se entendera por recibida y aceptada de mi parte al disponer del prestamo a traves de los medios de disposicion que CRECE Y MAS S.A. de C.V. tiene para tal efecto; Fuehecho de mi conocimiento que los  recursos del prestamo solicitado en caso de que sea autorizado los destinare a fines licitos.
    </span>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>