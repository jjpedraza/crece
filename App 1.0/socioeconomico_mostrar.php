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
$curp=$_GET["curp"];
$result=mysql_query("SELECT * FROM clientes WHERE curp='".$curp."'",$link);
$row=mysql_fetch_array($result);

//# Mostramos la imagen

?>

<table  border="1" cellspacing="0" cellpadding="0" align="center"   width="800">
  <tr bgcolor="#000000">
    <th colspan="8" class="titulo" style="color:#FFF" scope="col">ESTUDIO SOCIOECONOMICO</th>
  </tr>
  <tr>
    <td colspan="8" align="center" bgcolor="#CCCCCC" class="subtitulo">INFORMACION PERSONAL</td>
  </tr>
  <tr>
    <td width="165" align="right" bgcolor="#FFFFFF"><span class="texto">Nombre</span>: </td>
    <td colspan="8" bgcolor="#FFFFFF"><span class="respuesta"><b><?php echo $row["nombre"];
	
	
//_integrantesdelgrupo
	
	 ?>       </b></span></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFFFFF" class="texto">Domicilio:</td>
    <td colspan="8" bgcolor="#FFFFFF"><span class="respuesta"><?php echo domicilio($row["curp"]) ?></span></td>
  </tr>
  <tr>
    <td cbgcolor="#FFFFFF" class="subtitulo" align="right"><span class="texto">Telefono</span>:</td>
    <td width="137" bgcolor="#FFFFFF"><span class="respuesta"><?php echo telefono($row["curp"]) ?></td>
    <td width="6" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="276" bgcolor="#FFFFFF" align="right"><span class="texto"><span class="respuesta">CURP::<?php echo $row["curp"] ?></span></span></td>
    <td colspan="4" align="left" bgcolor="#FFFFFF" ><span class="texto">Correo:</span><?php echo correo($row["curp"]) ?><span class="respuesta"></td>
  </tr>
  <tr>
    <td colspan="8" align="center" bgcolor="#CCCCCC" class="subtitulo">INFORMACION LABORAL</td>
  </tr>
  <tr>
    <td colspan="2" align="right" bgcolor="#FFFFFF" class="texto"><strong><span class="titus">Trabaja actualmente en:</span></strong><span class="respuesta"><br /> <?php echo trabajo_nombre($row["curp"]).'('.trabajo_giro($row["curp"]).')';
	echo ' con  '.$row["trabajo_antiguedad"].' año(s) de antiguedad';
	
	 ?></span></td>
    <td bgcolor="#FFFFFF"></td>
    <td colspan="6" align="center" bgcolor="#FFFFFF" class="texto"  >
    
    
    <strong><span class="titus">MI NEGOCIO <span class="respuesta"><br /><?php echo $row["minegocio_nombre"].'('.$row["minegocio_giro"].') con '.$row["minegocio_antiguedad"].' año(s) de antiguedad'; ?></span></span></strong></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Domicilio</td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo trabajo_domicilio($row["curp"]) ?></span></td>
    <td bgcolor="#FFFFFF"></td>
    <td bgcolor="#FFFFFF" class="texto" align="right">Local Propio:</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["minegocio_propio"] ?></span></td>
    <td width="194" rowspan="6" bgcolor="#FFFFFF"><span class="texto">Domicilio:<span class="respuesta"><?php echo $row["minegocio_domicilio"] ?></span></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Puesto:</td>
    <td bgcolor="#FFFFFF">
    <span class="respuesta">
    <?php echo trabajo_puesto($row["curp"]) ?>
    </span>
    
    </td>
    <td bgcolor="#FFFFFF"></td>
   
    <td bgcolor="#FFFFFF" class="texto" align="right">Empleados:</td>
    <td width="6" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="194" bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["minegocio_empleados"] ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">Salario mensual:</td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><b>
    <?php echo trabajo_salario($row["curp"]) ?>
    </b></span></td>
    <td bgcolor="#FFFFFF"></td>
    
    <td  bgcolor="#FFFFFF" class="texto" align="right">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right"><span class="respuesta">Telefono:</span></td>
    <td bgcolor="#FFFFFF"><span class="texto"><span class="respuesta"><?php echo trabajo_telefono($row["curp"]) ?></span></span></td>
    <td bgcolor="#FFFFFF"></td>
   
    <td  bgcolor="#FFFFFF" class="texto" align="right">Telefono:</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo minegocio_telefono($row["curp"]) ?></span></td>
  </tr>
  <tr>
    <td colspan="2" align="right" bgcolor="#FFFFFF" class="texto">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="texto" align="right">¿Cuanto gasta en salario a empleados?</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["minegocio_sueldos"] ?></span></td>
  </tr>
  <tr>
    <td colspan="2" align="right" bgcolor="#FFFFFF" class="texto">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    
    <td bgcolor="#FFFFFF" class="texto" align="right">Ingresos Mensuales :</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["minegocio_ingresos"] ?></span></td>
  </tr>
  <tr>
    <td colspan="7" align="center" bgcolor="#CCCCCC" class="subtitulo" >REFERENCIAS PERSONALES</td>
  </tr>
  <tr class="subtitulo" bgcolor="#CCCCCC">
    <td 
    align="CENTER">NOMBRE</td>
    <td >TIEMPO DE CONOCERLA</td>
    <td >&nbsp;</td>
    
    <td align="center"  
    >DOMICILIO</td>
    <td class="subtitulo" >&nbsp;</td>
    <td class="subtitulo" >&nbsp;</td>
    <td class="subtitulo" >TELEFONO</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right"><span class="respuesta"><?php echo $row["ref1_nombre"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["ref1_antiguedad"] ?></span></td>
    <td bgcolor="#FFFFFF"></td>
    <td colspan="3"  bgcolor="#FFFFFF" class="texto"><span class="respuesta"><?php echo $row["ref1_domicilio"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["ref1_tel"] ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right"><span class="respuesta"><?php echo $row["ref2_nombre"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["ref2_antiguedad"] ?></span></td>
    <td bgcolor="#FFFFFF"></td>
    <td colspan="3"  bgcolor="#FFFFFF" class="texto"><span class="respuesta"><?php echo $row["ref2_domicilio"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["ref2_tel"] ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right"><span class="respuesta"><?php echo $row["ref3_nombre"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["ref3_antiguedad"] ?></span></td>
    <td bgcolor="#FFFFFF"></td>
    <td colspan="3" bgcolor="#FFFFFF" class="texto"><span class="respuesta"><?php echo $row["ref3_domicilio"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["ref3_tel"] ?></span></td>
  </tr>
  <tr>
    <td colspan="7"  align="center" bgcolor="#CCCCCC" class="subtitulo">REFERENCIAS COMERCIALES</td>
  </tr>
  <tr  align="center" bgcolor="#CCCCCC" class="subtitulo">
    <td  align="CENTER">NOMBRE</td>
    <td >AÑOS DE<br />
CLIENTELA</td>
    <td ></td>
    <td align="right" >DOMICILIO</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>TELEFONO</td>
  </tr>
  <tr>
    <td  ><span class="respuesta"><?php echo $row["refc1_nombre"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["refc1_antiguedad"] ?></span></td>
    <td bgcolor="#FFFFFF"></td>
    <td colspan="3"  bgcolor="#FFFFFF" class="texto"><span class="respuesta"><?php echo $row["refc1_domicilio"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["refc1_tel"] ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" ><span class="respuesta"><?php echo $row["refc2_nombre"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["refc2_antiguedad"] ?></span></td>
    <td bgcolor="#FFFFFF"></td>
    <td colspan="3"  bgcolor="#FFFFFF" class="texto"><span class="respuesta"><?php echo $row["refc2_domicilio"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["refc2_tel"] ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" ><span class="respuesta"><?php echo $row["refc3_nombre"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["refc3_antiguedad"] ?></span></td>
    <td bgcolor="#FFFFFF"></td>
   
    <td colspan="3"  bgcolor="#FFFFFF" class="texto"><span class="respuesta"><?php echo $row["refc3_domicilio"] ?></span></td>
    <td bgcolor="#FFFFFF"><span class="respuesta"><?php echo $row["refc3_tel"] ?></span></td>
  </tr>
  <tr>
    <td colspan="7" align="center" bgcolor="#CCCCCC" class="subtitulo" >VIVIENDA / ECONOMMICO</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">El hogar donde vive es:</td>
    <td bgcolor="#FFFFFF" class="respuesta"><?php echo $row["socio_hogar"] ?></td>,
    <td bgcolor="#FFFFFF"></td>
   
    <td align="right" bgcolor="#FFFFFF" class="texto">¿Estado de su RFC?</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="respuesta"><?php echo $row["fiscal_edo"].' ' ?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">¿Cuanto paga de renta de casa?</td>
    <td bgcolor="#FFFFFF" class="respuesta"><?php echo $row["socio_renta"].' ' ?></td>
    <td bgcolor="#FFFFFF"></td>
    <td align="right" bgcolor="#FFFFFF" class="texto">¿Cuantas personas depende de ud?</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="respuesta"><span class="respuesta"><?php echo $row["socio_dependen"].' personas' ?></span></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">¿Cuenta con servicio de drenaje?</td>
    <td bgcolor="#FFFFFF" class="respuesta"><?php echo $row["socio_drenaje"].' ' ?></td>
    <td bgcolor="#FFFFFF"></td>
    <td align="right" bgcolor="#FFFFFF" class="texto">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="respuesta">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">¿Cuanto paga bimestralmente por Luz,Agua y Drenaje?</td>
    <td bgcolor="#FFFFFF" class="respuesta"><?php echo $row["socio_agualuz"].' ' ?></td>
    <td bgcolor="#FFFFFF"></td>
    <td align="right" bgcolor="#FFFFFF" class="texto">¿Cuantos hijos tiene?</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="respuesta"><span class="respuesta"><?php echo $row["socio_hijos"] ?></span></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="respuesta">&nbsp;</td>
    <td bgcolor="#FFFFFF"></td>
    <td align="right" bgcolor="#FFFFFF" class="texto">¿combustible usado para cocinar?</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="respuesta"><?php echo $row["socio_cocina"]; ?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">¿Cuantos pisos tiene su casa?</td>
    <td bgcolor="#FFFFFF" class="respuesta"><?php echo $row["socio_pisos"].' ' ?></td>
    <td bgcolor="#FFFFFF"></td>
    <td align="right" bgcolor="#FFFFFF" class="texto">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="respuesta">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">¿Cuantos cuartos tiene su casa?</td>
    <td bgcolor="#FFFFFF" class="respuesta"><?php echo $row["socio_cuartos"].' ' ?></td>
    <td bgcolor="#FFFFFF"></td>
    <td align="right" bgcolor="#FFFFFF" class="texto">¿De que material es su casa?</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="respuesta"><?php echo $row["socio_material"].' ' ?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="texto" align="right">¿Cuantos baños tiene su casa?</td>
    <td bgcolor="#FFFFFF" class="respuesta"><?php echo $row["socio_wc"].' ' ?></td>
    <td bgcolor="#FFFFFF"></td>
  
    <td align="right" bgcolor="#FFFFFF" class="texto">¿Se encuentra en el buro de credito?</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" class="respuesta">
	<?php 
	echo $row["socio_buro"]; 
	?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8" align="center" bgcolor="#FFFFFF" class="respuesta">
    
    
    
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Firma (solicitante) </p></td>
  </tr>
  <tr>
    <td colspan="8" align="center" bgcolor="#FFFFFF" class="respuesta">
    <span class="mini">
    Declaro que: Los datos en la presente solicitud, parte integrante del contrato, son correctos y autorizo a CRECE Y MAS S.A. de C.V. a realizar las investigaciones y acciones que se consideren necesarias, a efecto de comprobar a travéz de  cualquier tercero, dependencia u autoridad, la veracidad de los datos que le fueron proporcionados; de conformidad con el articulo 18 bis de la Ley para la Transparencia y Ordenamiento de los Servicio Financieros, fue hecho de mi conocimiento a mi entera satisfaccion, el contenido, alcance,terminos y condiciones de la presentesolicitud, queforma parte del Contrato, documentos con los que estoy de acuerdo y me adhiero a lo pactado en los mismos, procediendo en este ato a firmar la solicitud y aceptar el contrato registrado en terminos de las disposiciones legales aplicables la presene solicitud y se entendera por recibida y aceptada de mi parte al disponer del prestamo a traves de los medios de disposicion que CRECE Y MAS S.A. de C.V. tiene para tal efecto; Fuehecho de mi conocimiento que los  recursos del prestamo solicitado en caso de que sea autorizado los destinare a fines licitos.
    </span>
    </td>
  </tr>
</table>

</body>