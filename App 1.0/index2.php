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

<title>MISOL</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">td img {display: block;}</style>
<link href="css/misol1.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#ffffff" topmargin="0" bottommargin="0">
<center>

<table style="display: inline-table;" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="493">
  <tr>
   <td><img src="img/spacer.gif" width="137" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="102" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="42" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="81" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="55" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="6" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="69" height="1" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="1" alt="" /></td>
  </tr>

  <tr>
   <td colspan="8"><img name="index_r1_c1" src="img/index_r1_c1.jpg" width="493" height="31" id="index_r1_c1" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="31" alt="" /></td>
  </tr>
  <tr>
   <td colspan="8" background="img/index_r2_c1.jpg" class="texto_debil" align="center" valign="middle">
   

Bienvenido 
<?php echo $_SESSION['usuario'];?>    
|<a href="logout.php">Cerrar Sesión</a> |
<a href="mantenimiento_pass_form.php">Mod. Pass</a> |




   
   
   
   </td>
   <td><img src="img/spacer.gif" width="1" height="48" alt="" /></td>
  </tr>
  <tr>
   <td><a href="solicitud_form.php"><img border='0' name="index_r3_c1" src="img/index_r3_c1.jpg" width="137" height="137" id="index_r3_c1" alt="" /></a></td>
   <td><a href="aprobar_lista.php"><img border='0' name="index_r3_c2" src="img/index_r3_c2.jpg" width="102" height="137" id="index_r3_c2" alt="" /></a></td>
   <td colspan="2"><a href="contrato_form.php"><img name="index_r3_c3" border='0' src="img/index_r3_c3.jpg" width="123" height="137" id="index_r3_c3" alt="" /></a></td>
   <td colspan="4"><img name="index_r3_c5" src="img/index_r3_c5.jpg" width="131" height="137" id="index_r3_c5" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="137" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2"><img name="index_r4_c1" src="img/index_r4_c1.jpg" width="137" height="133" id="index_r4_c1" alt="" /></td>
   <td colspan="7"><img name="index_r4_c2" src="img/index_r4_c2.jpg" width="356" height="41" id="index_r4_c2" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="41" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" colspan="2"><img name="index_r5_c2" src="img/index_r5_c2.jpg" width="144" height="116" id="index_r5_c2" alt="" /></td>
   <td rowspan="2" colspan="4"><img name="index_r5_c4" src="img/index_r5_c4.jpg" width="143" height="116" id="index_r5_c4" alt="" /></td>
   <td rowspan="2"><img name="index_r5_c8" src="img/index_r5_c8.jpg" width="69" height="116" id="index_r5_c8" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="92" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2"><img name="index_r6_c1" src="img/index_r6_c1.jpg" width="137" height="156" id="index_r6_c1" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="24" alt="" /></td>
  </tr>
  <tr>
   <td colspan="2"><img name="index_r7_c2" src="img/index_r7_c2.jpg" width="144" height="132" id="index_r7_c2" alt="" /></td>
   <td colspan="4"><img name="index_r7_c4" src="img/index_r7_c4.jpg" width="143" height="132" id="index_r7_c4" alt="" /></td>
   <td rowspan="2"><img name="index_r7_c8" src="img/index_r7_c8.jpg" width="69" height="283" id="index_r7_c8" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="132" alt="" /></td>
  </tr>
  <tr>
   <td><img name="index_r8_c1" src="img/index_r8_c1.jpg" width="137" height="151" id="index_r8_c1" alt="" /></td>
   <td colspan="2"><img name="index_r8_c2" src="img/index_r8_c2.jpg" width="144" height="151" id="index_r8_c2" alt="" /></td>
   <td colspan="3"><img name="index_r8_c4" src="img/index_r8_c4.jpg" width="137" height="151" id="index_r8_c4" alt="" /></td>
   <td><img name="index_r8_c7" src="img/index_r8_c7.jpg" width="6" height="151" id="index_r8_c7" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="151" alt="" /></td>
  </tr>
  <tr>
   <td><img name="index_r9_c1" src="img/index_r9_c1.jpg" width="137" height="73" id="index_r9_c1" alt="" /></td>
   <td colspan="7"><img name="index_r9_c2" src="img/index_r9_c2.jpg" width="356" height="73" id="index_r9_c2" alt="" /></td>
   <td><img src="img/spacer.gif" width="1" height="73" alt="" /></td>
  </tr>
</table>


   
   
   
   
   
</center>
</body>
</html>