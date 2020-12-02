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
<title>Sistema CRECEyMAS 1.01</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">td img {display: block;}</style>
<link href="css/misol1.css" rel="stylesheet" type="text/css" />

</head>
<body bgcolor="#400012" topmargin="0" bottommargin="0">
<center>
<table  align="center"style="display: inline-table;" bgcolor="#400012" border="0" cellpadding="0" cellspacing="0" width="493">
  <tr>
   <td><img border="0" src="img/spacer.gif" width="79" height="1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="51" height="1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="14" height="1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="2" height="1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="88" height="1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="4" height="1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="97" height="1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="14" height="1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="143" height="1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="1" height="1" alt="" /></td>
  </tr>

  <tr>
   <td colspan="10"><img border="0" name="index_r1_c1" src="img/index_r1_c1.jpg" width="493" height="111" id="index_r1_c1" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="1" height="111" alt="" /></td>
  </tr>
  <tr>
   <td colspan="10" background="img/index_r2_c1.jpg" align="center">
   
   Bienvenido 
<?php echo $_SESSION['usuario'];?>    
|<a href="logout.php">Cerrar Sesión</a> |
<a href="mantenimiento_pass_form.php">Mod. Pass</a> |
   
   
   </td>
   <td><img border="0" src="img/spacer.gif" width="1" height="46" alt="" /></td>
  </tr>
  <tr>
   <td colspan="2"><a href="solicitud_form.php"><img border="0" name="index_r3_c1" src="img/index_r3_c1.jpg" width="130" height="137" id="index_r3_c1" alt="" /></a></td>
   <td colspan="4"><a href="aprobar_lista.php"><img border="0" name="index_r3_c3" src="img/index_r3_c3.jpg" width="105" height="137" id="index_r3_c3" alt="" /></a></td>
   <td colspan="3"><a href="contrato_form.php"><img border="0" name="index_r3_c7" src="img/index_r3_c7.jpg" width="115" height="137" id="index_r3_c7" alt="" /></a></td>
   <td><a href="creditosactivos.php"><img border="0" name="index_r3_c10" src="img/index_r3_c10.jpg" width="143" height="137" id="index_r3_c10" alt="" /></a></td>
   <td><img border="0" src="img/spacer.gif" width="1" height="137" alt="" /></td>
  </tr>
  <tr>
   <td colspan="5"><a href="caja_pagoordinario_form.php"><img border="0" name="index_r4_c1" src="img/index_r4_c1.jpg" width="147" height="170" id="index_r4_c1" alt="" /></a></td>
   <td colspan="3"><a href="cliente.php"><img border="0" name="index_r4_c6" src="img/index_r4_c6.jpg" width="189" height="170" id="index_r4_c6" alt="" /></a></td>
   <td colspan="2"><a href="listaclientes.php"><img border="0" name="index_r4_c9" src="img/index_r4_c9.jpg" width="157" height="170" id="index_r4_c9" alt="" /></a></td>
   <td><img border="0" src="img/spacer.gif" width="1" height="170" alt="" /></td>
  </tr>
  <tr>
   <td colspan="5"><a href="cortediario_form.php"><img border="0" name="index_r5_c1" src="img/index_r5_c1.jpg" width="147" height="147" id="index_r5_c1" alt="" /></a></td>
   <td colspan="3"><a href="estatus_form.php"><img border="0" name="index_r5_c6" src="img/index_r5_c6.jpg" width="189" height="147" id="index_r5_c6" alt="" /></a></td>
   <td colspan="2"><a href="carteravencida.php"><img border="0" name="index_r5_c9" src="img/index_r5_c9.jpg" width="157" height="147" id="index_r5_c9" alt="" /></a></td>
   <td><img border="0" src="img/spacer.gif" width="1" height="147" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><a href="totalcreditos.php"><img border="0" name="index_r6_c1" src="img/index_r6_c1.jpg" width="239" height="26" id="index_r6_c1" alt="" /></a></td>
   <td colspan="3"><img border="0" name="index_r6_c8" src="img/index_r6_c8.jpg" width="254" height="26" id="index_r6_c8" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="1" height="26" alt="" /></td>
  </tr>
  <tr>
   <td><a href="caja_extra_form.php"><img border="0" name="index_r7_c1" src="img/index_r7_c1.jpg" width="79" height="12" id="index_r7_c1" alt="" /></a></td>

   <td colspan="9" bgcolor="#FFFFFF"><img border="0" name="index_r7_c4" src="img/index_r7_c4.jpg" height="12" id="index_r7_c4" alt="" /></td>
   <td><img border="0" src="img/spacer.gif" width="1" height="12" alt="" /></td>
  </tr>
  <tr>
   <td colspan="10"><a href="descuentos_form.php"><img border="0" name="index_r8_c1" src="img/index_r8_c1.jpg" width="493" height="17" id="index_r8_c1" alt="" /></a></td>
   <td><img border="0" src="img/spacer.gif" width="1" height="17" alt="" /></td>
  </tr>
  <tr>
   <td colspan="10"><a href="presupuesto_form.php"><img border="0" name="index_r9_c1" src="img/index_r9_c1.jpg" width="493" height="28" id="index_r9_c1" alt="" /></a></td>
   <td><img border="0" src="img/spacer.gif" width="1" height="28" alt="" /></td>
  </tr>
  <tr>


  </tr>
</table><br />
<p class="entablado" align="center">
<a href="grupo_form.php">Crear un Grupo</a><br />
<a href="grupolista.php">Lista de Grupos</a><br />
</p>




<A HREF="vencehoy.php"><B>VENCIMIENTOS DE HOY</B></A> 


































<?php
require("config.php");

    echo '<p class="pie1"><br>'.$pie1;
	echo $pie2;
	echo '<br/>';
	echo $pie3_yo;
	echo '<br/>';
	echo '<a href="http://facebook.com/eltecnicodelpueblo">', $pie4_fb, '</a></>';?>

</center>
</body>
</html>
