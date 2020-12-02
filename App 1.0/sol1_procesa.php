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




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php   echo '<title>'; 
		echo $nombresistema;
		echo ', ';
		echo $nombreversion;
		echo '</title>';

 ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/misol1.css" rel="stylesheet" type="text/css" />


</head>
<body  topmargin="0" bottommargin="0">
<center>
<table style="display: inline-table;" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="495">
  <tr>
    <td <?php echo 'bgcolor="', $tabla, '"' ?>>
    <p class="menu1" align="center"> Empleado: 
	<?php echo $_SESSION['usuario'];?>    
	 <a href="logout.php">Cerrar Sesión</a> 
     | <a href="index.php"> MENU </a>

	</p>
    
    
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <p align="center" class="titulo1"> SOLICITUD DE CREDITO
     
    <P align="center" class="texto_debil">PASO 2: ALTA o ACTUALIZACION de cliente .<br />
      </P>
<?PHP
require ("config.php");

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$curp = $_POST["curp"];   
$result = mysql_query("SELECT * 
					FROM clientes 
					WHERE curp = '".$curp."'");
 
//checamos si hay curp
if($row = mysql_fetch_array($result)){//si  hay, preparar la captura
	echo '<form action=sol2_actcliente_procesa.php method="post" name="solicitud" ENCTYPE="multipart/form-data" >';
	echo '<p  class="pies" align="center">';
	echo 'CURP: <BR/> <INPUT name="curp" type="text" id="curp" required="required" readonly="readonly" value="', $curp, '"',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';
	 
	echo 'Nombre completo:<br /><input name="nombre" type="text" id="nombre" value="',$row["nombre"],'" required="required" size="70"','style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.	 
	'/><br />';
	
	echo "Foto:<BR>";
	echo "<img src='foto_mostrar.php?curp=".$curp."' width='100' height='80'>";
	
	echo '<br>Seleccione una foto para actualizar: <br><INPUT NAME="userfile" TYPE="file"><br><br>';
	 
	 	echo 'DOMICILIO (calle, no, col y cp) :<br /><input size="70" name="domicilio" type="text" id="domicilio" value="', $row["domicilio"], '" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';
	 
	 	echo 'Referencia (alguna seña particular) :<br /><input size="70" name="domicilio_referencia" type="text" id="domicilio_referencia" value="',$row["domicilio_referencia"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	 
	 
	 	echo 'Municipio:<br /><input size="7" name="municipio" type="text" id="municipio" value="',$row["municipio"],'" required="required" readonly="readonly"',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><BR>';


	 	echo 'Estado :<br /><input size="10" name="estado" type="text" id="estado" value="', $row["estado"],'" required=" required"readonly="readonly" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><BR>';

	echo "Croquis:<BR>";
	echo "<img src='croquis_mostrar.php?curp=".$curp."' width='600' height='100'>";
	
	echo '<br>Seleccione una imagen para actualizar el croquis: <br><INPUT NAME="filecroquis" TYPE="file"><br><br>';
	
	echo 'Fecha de nacimiento (AAAA-MM-DD) :<br /><input  name="fechadenacimiento" type="date" id="fechadenacimiento" value="',$row["fechadenacimiento"],'" required="required"','"><br><BR>';
	
	echo 'Telefono(s):<br /><input size="70" name="telefono" type="text" id="telefono" value="',$row["telefono"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	
	echo 'Correo electronico:<br /><input size="70" name="correo" type="text" id="correo" value="',$row["correo"],'" required="required" ',
	 
	 '"><br>';	
	 
	echo 'Red Social :<br /><input size="70" name="redsocial" type="text" id="redsocial" value="',$row["redsocial"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	
	
	echo 'Clave Electoral (IFE) :<br /><input size="30" name="ife" type="text" id="ife" value="',$row["IFE"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	 
	 
	 echo 'Sexo <br/>';
	 if ($row["sexo"]== "hombre") {
		 echo '<input type="radio" name="sexo" value="hombre" checked="checked" /> Hombre';
		 echo '<input type="radio" name="sexo" value="mujer" /> Mujer';
		 } else {
		 echo '<input type="radio" name="sexo" value="hombre" /> Hombre';
		 echo '<input type="radio" name="sexo" value="mujer" checked="checked"  /> Mujer';
			 
		 }
	 
	 echo '<br><br>';

	echo 'Estado Civil:';
	echo '<select name="estadocivil" >';
	if ($row["estadocivil"]== "SOLTERO") {echo '<option value="SOLTERO" selected="selected">SOLTERO </option>';}else {	echo '<option value="SOLTERO">SOLTERO </option>';};
	
	if ($row["estadocivil"]== "CASADO") {echo '<option value="CASADO" selected="selected">CASADO </option>';}else {	echo '<option value="CASADO">CASADO </option>';};
	
if ($row["estadocivil"]== "DIVORCIADO") {echo '<option value="DIVORCIADO" selected="selected">DIVORCIADO </option>';}else {	echo '<option value="DIVORCIADO">DIVORCIADO </option>';};


if ($row["estadocivil"]== "UNION LIBRE") {echo '<option value="UNION LIBRE" selected="selected">UNION LIBRE </option>';}else {	echo '<option value="UNION LIBRE">UNION LIBRE </option>';};

if ($row["estadocivil"]== "VIUDO") {echo '<option value="VIUDO" selected="selected">VIUDO </option>';}else {	echo '<option value="VIUDO">VIUDO </option>';};

	echo '</select><br><br>';
	
	echo 'Escolaridad:';
	echo '<select name="escolaridad" >';
	if ($row["estudios"]== "Sin Estudios") {echo '<option value="Sin Estudios" selected="selected">Sin Estudios </option>';}else {	echo '<option value="Sin Estudios">Sin Estudios </option>';};
	
	if ($row["estudios"]== "PRIMARIA") {echo '<option value="PRIMARIA" selected="selected">PRIMARIA </option>';}else {	echo '<option value="PRIMARIA">PRIMARIA </option>';};
	
	if ($row["estudios"]== "SECUNDARIA") {echo '<option value="SECUNDARIA" selected="selected">SECUNDARIA </option>';}else {	echo '<option value="SECUNDARIA">SECUNDARIA </option>';};
	
	if ($row["estudios"]== "PREPARATORIA") {echo '<option value="PREPARATORIA" selected="selected">PREPARATORIA </option>';}else {	echo '<option value="PREPARATORIA">PREPARATORIA </option>';};
				
	if ($row["estudios"]== "UNIVERSIDAD") {echo '<option value="UNIVERSIDAD" selected="selected">UNIVERSIDAD </option>';}else {	echo '<option value="UNIVERSIDAD">UNIVERSIDAD </option>';};
	
		if ($row["estudios"]== "POSTGRADO") {echo '<option value="POSTGRADO" selected="selected">UNIVERSIDAD </option>';}else {	echo '<option value="POSTGRADO">POSTGRADO </option>';};
		
	echo '</select>';
	
	echo '<br> <br>R E F E R E N  C I A S: <BR><BR>';
	echo '(1). Nombre :<br /><input size="70" name="ref1_nombre" type="text" id="ref1_nombre" value="',$row["ref1_nombre"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	 echo '(1). Domicilio :<br /><input size="70" name="ref1_domicilio" type="text" id="ref1_domicilio" value="',$row["ref1_domicilio"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	
	echo '(1) Telefono :<br /><input size="40" name="ref1_tel" type="text" id="ref1_tel" value="',$row["ref1_tel"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	

	echo '(2) Nombre :<br /><input size="70" name="ref2_nombre" type="text" id="ref2_nombre" value="',$row["ref2_nombre"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	 
 	echo '(2). Domicilio :<br /><input size="70" name="ref2_domicilio" type="text" id="ref2_domicilio" value="',$row["ref2_domicilio"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	
	echo '(2) Telefono :<br /><input size="40" name="ref2_tel" type="text" id="ref2_tel" value="',$row["ref2_tel"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';		 	 
		
	
	
	
	
	echo '</p>';
	
	//boton
	echo '<p align="center"><input type="submit" name="ok" id="ok" value="ACTUALIZAR CLIENTE, SIGUIENTE" /></p>';
	echo '</form>';



}else{//si no esta, preraramos el form para nuevo
	echo '<form action=sol2_nuevocliente_procesa.php method="post" name="solicitud">';

	echo '<p  class="pies" align="center">';
	echo 'CURP: <BR/> <INPUT name="curp" type="text" id="curp" required="required" readonly="readonly" value="', $CURP,'"><br><br>';
	 
	echo 'Nombre completo:<br /><input size="70" name="nombre" type="text" id="nombre" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><BR>';
	 
	 	echo 'DOMICILIO (calle, no, col y cp) :<br /><input size="70" name="domicilio" type="text" id="domicilio" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';
	 
	 	echo 'Referencia (alguna seña particular) :<br /><input size="70" name="domicilio_referencia" type="text" id="domicilio_referencia" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	 
	 
	 	echo 'Municipio:<br /><input size="7" name="municipio" type="text" id="municipio" value="ALDAMA" required="required" readonly="readonly"',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><BR>';


	 	echo 'Estado :<br /><input size="10" name="estado" type="text" id="estado" value="TAMAULIPAS" required=" required"readonly="readonly" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><BR>';

	 
	echo 'Fecha de nacimiento (AAAA-MM-DD) :<br /><input  name="fechadenacimiento" type="date" id="fechadenacimiento" value="" required="required"','"><br><BR>';
	
	echo 'Telefono(s):<br /><input size="70" name="telefono" type="text" id="telefono" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	
	echo 'Correo electronico:<br /><input size="70" name="correo" type="text" id="correo" value="" required="required" ',
	 
	 '"><br>';	
	 
	echo 'Red Social :<br /><input size="70" name="redsocial" type="text" id="redsocial" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	
	
	echo 'Clave Electoral (IFE) :<br /><input size="30" name="ife" type="text" id="ife" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	 
	 
	 echo 'Sexo <br/>';
	 echo '<input type="radio" name="sexo" value="hombre" checked="checked" /> Hombre';
	 echo '<input type="radio" name="sexo" value="mujer" /> Mujer';
	 echo '<br><br>';

	echo 'Estado Civil:';
	echo '<select name="estadocivil" >';
	echo '<option value="SOLTERO">SOLTERO </option>';
	echo '<option value="CASADO">CASADO </option>';
	echo '<option value="DIVORCIADO">DIVORCIADO </option>';
	echo '<option value="UNIONLIBRE">UNION LIBRE </option>';
	echo '<option value="VIUDO">VIUDO </option>';
	echo '</select><br><br>';
	
	echo 'Escolaridad:';
	echo '<select name="escolaridad" >';
	echo '<option value="Sin Estudios">SIN ESTUDIOS </option>';
	echo '<option value="PRIMARIA">PRIMARIA </option>';
	echo '<option value="SECUNDARIA">SECUNDARIA </option>';
	echo '<option value="PREPARATORIA">PREPARATORIA </option>';
	echo '<option value="UNIVERSIDAD">UNIVERSIDAD </option>';
	echo '<option value="POSTGRADO">POSTGRADO </option>';

	echo '</select>';
	
	echo '<br> <br>R E F E R E N  C I A S: <BR><BR>';
	echo '(1). Nombre :<br /><input size="70" name="ref1_nombre" type="text" id="ref1_nombre" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	 echo '(1). Domicilio :<br /><input size="70" name="ref1_domicilio" type="text" id="ref1_domicilio" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	
	echo '(1) Telefono :<br /><input size="40" name="ref1_tel" type="text" id="ref1_tel" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	

	echo '(2) Nombre :<br /><input size="70" name="ref2_nombre" type="text" id="ref2_nombre" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	 
 	echo '(2). Domicilio :<br /><input size="70" name="ref2_domicilio" type="text" id="ref2_domicilio" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';	
	
	echo '(2) Telefono :<br /><input size="40" name="ref2_tel" type="text" id="ref2_tel" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br>';		 	 
	echo '</p>';
	
	//boton
	echo '<p align="center"><input type="submit" name="ok" id="ok" value="CREAR CLIENTE, SIGUIENTE" /></p>';
	echo '</form>';



}

mysql_close();
?>      
      
      
      
    
    
    
    
    
    </td>
  </tr>
  <tr>
    <td <?php echo 'bgcolor="', $tabla, '"' ?>>
    <p class="pie1" align="center">
    <?php
    echo $pie1;
	echo $pie2;
	echo '<br/>';
	echo $pie3_yo;
	echo '<br/>';
	echo '<a href="http://facebook.com/eltecnicodelpueblo">', $pie4_fb, '</a>';

	
    ?>
    </p>
    
    </td>
  </tr>
</table>
</center>
</body>
</html>