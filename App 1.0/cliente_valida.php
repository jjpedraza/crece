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




<!DOCTYPE html>
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

<tr><td bgcolor="#000000" class="menu1" align="center"><img src="img/home.png" /><a href="index.php"> Regresar al MENU </a></td></tr>

  
  <tr>
    <td align="left" valign="top">
   
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
	echo '<p class="titulo1" align="center"> ACTUALIZACION de CLIENTE<P>';
	echo '<form action=cliente_actualiza.php method="post" name="solicitud" ENCTYPE="multipart/form-data" >';
	echo '<p  class="txtform">';
	echo 'CURP: <BR/> <INPUT   class="textbox" name="curp" type="text" id="curp" required="required" readonly="readonly" value="', $curp, '"',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';
	 
	echo 'Nombre completo:<br /><input class="textbox" name="nombre" type="text" id="nombre" value="',$row["nombre"],'" required="required" size="70"','style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.	 
	'/><br /><br>';
	
	echo "Foto:<BR>";
	echo "<img src='foto_mostrar.php?curp=".$curp."' width='250' height='300'>";
	
	echo '<br>Seleccione una foto para actualizar: <br><INPUT NAME="userfile" TYPE="file"><br><br>';
	 
	 	echo 'DOMICILIO (calle, no, col y cp) :<br /><input class="textbox" size="70" name="domicilio" type="text" id="domicilio" value="', $row["domicilio"], '" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';
	 
	 	echo 'Referencia (alguna seña particular) :<br /><input class="textbox" size="70" name="domicilio_referencia" type="text" id="domicilio_referencia" value="',$row["domicilio_referencia"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	 
	 
	 	echo 'Municipio:<br /><input class="textbox" size="7" name="municipio" type="text" id="municipio" value="',$row["municipio"],'" required="required" readonly="readonly"',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><BR>';


	 	echo 'Estado :<br /><input class="textbox" size="10" name="estado" type="text" id="estado" value="', $row["estado"],'" required=" required"readonly="readonly" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><BR>';

	echo "Croquis:<BR>";
	echo "<img src='croquis_mostrar.php?curp=".$curp."' width='500' height='300'>";
	
	echo '<br>Seleccione una imagen para actualizar el croquis: <br><INPUT NAME="filecroquis" TYPE="file"><br><br>';
	
	echo 'Fecha de nacimiento (AAAA-MM-DD) :<br /><input class="textbox"  name="fechadenacimiento" type="date" id="fechadenacimiento" value="',$row["fechadenacimiento"],'" required="required"','"><br><BR>';
	
	echo 'Telefono(s):<br /><input size="70"  class="textbox"  name="telefono" type="text" id="telefono" value="',$row["telefono"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo 'Correo electronico:<br /><input size="70" class="textbox"  name="correo" type="text" id="correo" value="',$row["correo"],'" required="required" ',
	 
	 '"><br><br>';	
	 
	echo 'Red Social :<br /><input size="70" name="redsocial" class="textbox" type="text" id="redsocial" value="',$row["redsocial"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	
	echo 'Clave Electoral (IFE) :<br /><input size="30" class="textbox" name="ife" type="text" id="ife" value="',$row["IFE"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 
	 
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
	
	echo '<br><hr><p  class="normal" align="center"><br>REFERENCIAS PERSONALES: <BR></p>';
	echo '<p class="pies" >(1). Nombre :<br /><input size="70" class="textbox"  name="ref1_nombre" type="text" id="ref1_nombre" value="',$row["ref1_nombre"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 echo '(1). Domicilio :<br /><input class="textbox" size="70" name="ref1_domicilio" type="text" id="ref1_domicilio" value="',$row["ref1_domicilio"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(1) Telefono :<br /><input size="40" class="textbox" name="ref1_tel" type="text" id="ref1_tel" value="',$row["ref1_tel"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	

	echo '(1) Tiempo de conocerlo(a) :<br /><input size="40" class="textbox" name="ref1_antiguedad" type="text" id="ref1_antiguedad" value="',$row["ref1_antiguedad"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';		 

	echo '(2) Nombre :<br /><input size="70" class="textbox" name="ref2_nombre" type="text" id="ref2_nombre" value="',$row["ref2_nombre"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 
 	echo '(2). Domicilio :<br /><input size="70" class="textbox" name="ref2_domicilio" type="text" id="ref2_domicilio" value="',$row["ref2_domicilio"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(2) Telefono :<br /><input size="40" class="textbox" name="ref2_tel" type="text" id="ref2_tel" value="',$row["ref2_tel"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';		 	 

	echo '(2) Tiempo de conocerlo(a) :<br /><input size="40" class="textbox" name="ref2_antiguedad" type="text" id="ref2_antiguedad" value="',$row["ref2_antiguedad"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	 
	 
	 	echo '(3) Nombre :<br /><input size="70" class="textbox" name="ref3_nombre" type="text" id="ref3_nombre" value="',$row["ref3_nombre"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 
 	echo '(3). Domicilio :<br /><input size="70" class="textbox" name="ref3_domicilio" type="text" id="ref3_domicilio" value="',$row["ref3_domicilio"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(3) Telefono :<br /><input size="40" class="textbox" name="ref3_tel" type="text" id="ref3_tel" value="',$row["ref3_tel"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';		 	 

	echo '(3) Tiempo de conocerlo(a) :<br /><input size="40" class="textbox" name="ref3_antiguedad" type="text" id="ref3_antiguedad" value="',$row["ref3_antiguedad"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>
	
	 ';	 



echo '<br><hr><p  class="normal" align="center"><br>REFERENCIAS COMERCIALES: <BR></p>';
	echo '<p class="pies" >(1). Nombre :<br /><input size="70" class="textbox"  name="refc1_nombre" type="text" id="refc1_nombre" value="',$row["refc1_nombre"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 echo '(1). Domicilio :<br /><input class="textbox" size="70" name="refc1_domicilio" type="text" id="refc1_domicilio" value="',$row["refc1_domicilio"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(1) Telefono :<br /><input size="40" class="textbox" name="refc1_tel" type="text" id="refc1_tel" value="',$row["refc1_tel"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	

	echo '(1) Tiempo de conocerlo(a) :<br /><input size="40" class="textbox" name="refc1_antiguedad" type="text" id="refc1_antiguedad" value="',$row["refc1_antiguedad"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';		 

	echo '(2) Nombre :<br /><input size="70" class="textbox" name="refc2_nombre" type="text" id="refc2_nombre" value="',$row["refc2_nombre"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 
 	echo '(2). Domicilio :<br /><input size="70" class="textbox" name="refc2_domicilio" type="text" id="refc2_domicilio" value="',$row["refc2_domicilio"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(2) Telefono :<br /><input size="40" class="textbox" name="refc2_tel" type="text" id="refc2_tel" value="',$row["refc2_tel"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';		 	 

	echo '(2) Tiempo de conocerlo(a) :<br /><input size="40" class="textbox" name="refc2_antiguedad" type="text" id="refc2_antiguedad" value="',$row["refc2_antiguedad"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	 
	 
	 	echo '(3) Nombre :<br /><input size="70" class="textbox" name="refc3_nombre" type="text" id="refc3_nombre" value="',$row["refc3_nombre"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 
 	echo '(3). Domicilio :<br /><input size="70" class="textbox" name="refc3_domicilio" type="text" id="refc3_domicilio" value="',$row["refc3_domicilio"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(3) Telefono :<br /><input size="40" class="textbox" name="refc3_tel" type="text" id="refc3_tel" value="',$row["refc3_tel"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';		 	 

	echo '(3) Tiempo de conocerlo(a) :<br /><input size="40" class="textbox" name="refc3_antiguedad" type="text" id="refc3_antiguedad" value="',$row["refc3_antiguedad"],'" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>
	 <hr>
	 ';	 


	echo '<hr><p class="normal" align="center">  - ESTUDIO SOCIOECONOMICO - <br>
		Llene correctamente los siguientes datos:
	</p>';
	
	echo '<p class="pies">Profesion:<br /><input name="profesion" type="text" class="textbox"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()" value="', $row["profesion"], '" size="70"><br><BR /></p>';		
	
		echo '<p class="normal" align="center">EMPRESA DONDE LABORO:</p>';
		echo '<p class="pies">Nombre de la empresa:<br /><input name="trabajo_nombre" type="text" class="textbox"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()" value="', $row["trabajo_nombre"],'" size="70"><br><br>';
		
		echo 'Domicilio de la empresa::<br /><input size="70" name="trabajo_domicilio" class="textbox"  type="text" value="',$row["trabajo_domicilio"], '"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
		
		echo'Telefono del trabajo:<br /><input size="70" name="trabajo_telefono" class="textbox" type="text" value="',$row["trabajo_telefono"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
		
		echo' Giro comercial de la empresa:<br /><input size="50" name="trabajo_giro" class="textbox" type="text" value="', $row["trabajo_giro"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
		
		echo ' Puesto:<br /><input size="40" name="trabajo_puesto" type="text" class="textbox"  value="',$row["trabajo_puesto"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR />';
		
		echo 'Salario (mensual):<br /><input size="30" required="required" class="textbox" name="trabajo_salario" type="text" value="',$row["trabajo_salario"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR />  ';

		echo 'Antiguedad (años):<br /><input size="3" required="required" class="textbox" name="trabajo_antiguedad" type="text" value="',$row["trabajo_antiguedad"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR /> </p> ';		
		
		echo '</p><hr><p class="normal">DATOS FISCALES:</p> 
    <P class="pies">
	Estado de su RFC:<br /><input size="30" class="textbox" name="fiscal_edo" type="text" value="',$row["fiscal_edo"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />';
	
	
   echo ' RFC:<br /><input size="30" class="textbox" name="fiscal_rfc" type="text" value="',$row["fiscal_rfc"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />';
	
		echo ' Domicilio:<br /><input size="70" class="textbox" name="fiscal_domicilio" type="text" value="',$row["fiscal_domicilio"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br></p>';
	
		echo '<hr><p class="normal" >MI NEGOCIO: </p><p class="pies">
  Nombre del negocio:<br /><input class="textbox" class="textbox"  size="50" name="minegocio_nombre" type="text" value="',$row["minegocio_nombre"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />';
	
	echo '¿Local propio?<br />	
    <select class="textbox" name="minegocio_propio">';
	
if ($row["minegocio_propio"]== "SI") {echo '
	<option value="SI" selected="selected">SI</option>';}else {echo ' 
	<option value="SI">SI</option>';}
	
if ($row["minegocio_propio"]== "NO") {echo '
	<option value="NO" selected="selected">NO</option>';}else {echo ' 
	<option value="NO">NO</option>';}
	echo '</select><br>';	
	
	
	echo '<br>Ingresos del negocio (ganancia mensual):<br /><input size="20" name="minegocio_ingresos" type="text" class="textbox"  value="',$row["minegocio_ingresos"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()">  <br /><br />';
	
	echo 'Giro de mi negocio:<br /><input size="50"  class="textbox"  name="minegocio_giro" type="text" value="',$row["minegocio_giro"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />';
	
	echo 'Telefono del negocio:<br /><input size="50" class="textbox"  name="minegocio_telefono" type="text" value="',$row["minegocio_telefono"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />';
	
	echo '¿Cuantos empleados tiene?:<br /><input size="4" class="textbox"  name="minegocio_empleados" type="text" value="',$row["minegocio_empleados"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br> ';
	
		echo '¿Cuanto gasta en sueldos de empleados?:<br /><input size="4" class="textbox"  name="minegocio_sueldos" type="text" value="',$row["minegocio_sueldos"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br> ';
		
			echo '¿Antiguedad?:<br /><input size="4" class="textbox"  name="minegocio_antiguedad" type="text" value="',$row["minegocio_antiguedad"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br> ';
	//agregados
	
	echo 'Domicilio de mi negocio:<br /><input size="100" class="textbox"  name="minegocio_domicilio" type="text" value="',$row["minegocio_domicilio"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br> </p>';
	
	
	//-----
	
		
	echo '<hr><p class="normal">SOCIECONOMICO: </p><p class="pies">      
    ¿Cuantas personas depende de usted?:<br /><input size="60"  class="textbox"  name="socio_dependen" type="text" value="',$row["socio_dependen"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR />';
	
	echo ' ¿Cuantos hijos tiene?<br /><input size="3" name="socio_hijos" class="textbox"  type="text" value="',$row["socio_hijos"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
	
	echo '¿Vive en Casa Propia?<br />';	
	echo ' <select class="textbox" name="socio_casapropia">';	
if ($row["socio_casapropia"]== "SI") {echo '
	<option value="SI" selected="selected">SI</option>';}else {echo ' 
	<option value="SI">SI</option>';};
	
if ($row["socio_casapropia"]== "NO") {echo '
	<option value="NO" selected="selected">NO</option>';}else {echo ' 
	<option value="NO">NO</option>';};	
	
	echo '</select>';
	//---
	
	echo '<br />El hogar donde vive es? (RENTADO o PRESTADO)<br /><input size="50" name="socio_hogar" class="textbox"  type="text" value="',$row["socio_hogar"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
	
		echo '¿Cuanto paga de Renta?<br /><input size="30" name="socio_renta" class="textbox"  type="text" value="',$row["socio_renta"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
	
		echo '¿Cuenta con servicio de drenaje?<br /><input size="3" name="socio_drenaje" class="textbox"  type="text" value="',$row["socio_drenaje"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
			
		echo '¿Cuanto paga bimestralmente por Luz,Agua y Drenaje?<br /><input size="10" name="socio_agualuz" class="textbox"  type="text" value="',$row["socio_agualuz"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';

		echo '¿Cuantos pisos tiene su casa?<br /><input size="3" name="socio_pisos" class="textbox"  type="text" value="',$row["socio_pisos"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
		
		echo '¿Cuantos cuartos tiene su casa?<br /><input size="3" name="socio_cuartos" class="textbox"  type="text" value="',$row["socio_cuartos"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';


		echo '¿Cuantos baños tiene su casa?<br /><input size="3" name="socio_wc" class="textbox"  type="text" value="',$row["socio_wc"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';			

		echo '¿combustible usado para cocinar?<br /><input size="30" name="socio_cocina" class="textbox"  type="text" value="',$row["socio_cocina"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';		
		
		echo '¿De que material es su casa?<br /><input size="50" name="socio_material" class="textbox"  type="text" value="',$row["socio_material"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';		
		
		echo '¿Se encuentra en el buro de credito?<br /><input size="3" name="socio_buro" class="textbox"  type="text" value="',$row["socio_buro"],'"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';		
		
		
	//---

	echo '<hr> Grupo al que pertenece:('.$row["grupo"].')<br>';
	
	echo 'Actualmente tiene el cargo de '.$row["grupo_cargo"].'<br>';
	
	echo 'Si desea cambiarlo de grupo,seleccionelo:<br><select name="grupo">';
		$sqlg = "SELECT * FROM grupos";
		$resultadog=mysql_query($sqlg);
		echo '<option selected="selected"> </option>';
		while ($filag = mysql_fetch_array($resultadog))
			{
			extract($filag);
			echo '<option value="'
			 .$filag["nombre"].'">'.$filag["nombre"].'</option>';
			
			}
	echo '</select><br><br>';



	//boton
	echo '<p align="center"><input type="submit" name="ok" id="ok" value="ACTUALIZAR CLIENTE, SIGUIENTE" /></p>';
	echo '</form>';



}else{//---------------------------------si no esta, preraramos el form para nuevo
	
	echo '<p class="titulo1" align="center">CREAR CLIENTE NUEVO<P>';
	echo '<form action=cliente_crear.php method="post" name="solicitud" ENCTYPE="multipart/form-data" >';
	echo '<p  class="txtform">';
	echo 'CURP: <BR/> <INPUT   class="textbox" name="curp" type="text" id="curp" required="required" readonly="readonly" value="', $curp, '"',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';
	 
	echo 'Nombre completo:<br /><input class="textbox" name="nombre" type="text" id="nombre" value="" required="required" size="70"','style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.	 
	'/><br /><br>';
	
	echo "Foto:<BR>";
	echo "<img src='foto_mostrar.php?curp=".$curp."' width='250' height='300'>";
	
	echo '<br>Seleccione una foto para actualizar: <br><INPUT NAME="userfile" TYPE="file"><br><br>';
	 
	 	echo 'DOMICILIO (calle, no, col y cp) :<br /><input class="textbox" size="70" name="domicilio" type="text" id="domicilio" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';
	 
	 	echo 'Referencia (alguna seña particular) :<br /><input class="textbox" size="70" name="domicilio_referencia" type="text" id="domicilio_referencia" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	 
	 
	 	echo 'Municipio:<br /><input class="textbox" size="7" name="municipio" type="text" id="municipio" value="ALDAMA" required="required" readonly="readonly"',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><BR>';


	 	echo 'Estado :<br /><input class="textbox" size="10" name="estado" type="text" id="estado" value="TAMAULIPAS" required=" required"readonly="readonly" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><BR>';

	echo "Croquis:<BR>";
	echo "<img src='croquis_mostrar.php?curp=".$curp."' width='500' height='300'>";
	
	echo '<br>Seleccione una imagen para actualizar el croquis: <br><INPUT NAME="filecroquis" TYPE="file"><br><br>';
	
	echo 'Fecha de nacimiento (AAAA-MM-DD) :<br /><input class="textbox"  name="fechadenacimiento" type="date" id="fechadenacimiento" value="" required="required"','"><br><BR>';
	
	echo 'Telefono(s):<br /><input size="70"  class="textbox"  name="telefono" type="text" id="telefono" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo 'Correo electronico:<br /><input size="70" class="textbox"  name="correo" type="text" id="correo" value="" required="required" ',
	 
	 '"><br><br>';	
	 
	echo 'Red Social :<br /><input size="70" name="redsocial" class="textbox" type="text" id="redsocial" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	
	echo 'Clave Electoral (IFE) :<br /><input size="30" class="textbox" name="ife" type="text" id="ife" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 
	 
	 echo 'Sexo <br/>';
	 	 echo '<input type="radio" name="sexo" value="hombre" checked="checked" /> Hombre';
		 echo '<input type="radio" name="sexo" value="mujer" /> Mujer';
		
	 echo '<br><br>';

	echo 'Estado Civil:';
	echo '<select name="estadocivil" >';
	echo '<option value="SOLTERO" selected="selected">SOLTERO </option>';
	echo '<option value="CASADO" selected="selected">CASADO </option>';	
	echo '<option value="DIVORCIADO" selected="selected">DIVORCIADO </option>';
	echo '<option value="UNION LIBRE" selected="selected">UNION LIBRE </option>';
	echo '<option value="VIUDO" selected="selected">VIUDO </option>';
	echo '</select><br><br>';
	
	echo 'Escolaridad:';
	echo '<select name="escolaridad" >';
	echo '<option value="Sin Estudios" selected="selected">Sin Estudios </option>';
	echo '<option value="PRIMARIA" selected="selected">PRIMARIA </option>';	
	echo '<option value="SECUNDARIA" selected="selected">SECUNDARIA </option>';	
	echo '<option value="PREPARATORIA" selected="selected">PREPARATORIA </option>';				
	echo '<option value="UNIVERSIDAD" selected="selected">UNIVERSIDAD </option>';
	echo '<option value="POSTGRADO" selected="selected">UNIVERSIDAD </option>';
	echo '</select>';
	
	echo '<br><br><hr><p class="normal" align="center">REFERENCIAS PERSONALES: </p>';
	echo '<p class="pies">(1). Nombre :<br /><input size="70" class="textbox"  name="ref1_nombre" type="text" id="ref1_nombre" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 echo '(1). Domicilio :<br /><input class="textbox" size="70" name="ref1_domicilio" type="text" id="ref1_domicilio" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(1) Telefono :<br /><input size="40" class="textbox" name="ref1_tel" type="text" id="ref1_tel" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	

	echo '(1) Tiempo de conocerlo(a) :<br /><input size="40" class="textbox" name="ref1_antiguedad" type="text" id="ref1_antiguedad" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	 

	echo '(2) Nombre :<br /><input size="70" class="textbox" name="ref2_nombre" type="text" id="ref2_nombre" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 
 	echo '(2). Domicilio :<br /><input size="70" class="textbox" name="ref2_domicilio" type="text" id="ref2_domicilio" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(2) Telefono :<br /><input size="40" class="textbox" name="ref2_tel" type="text" id="ref2_tel" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';
	 		 	 
	echo '(2) Tiempo de conocerlo(a) :<br /><input size="40" class="textbox" name="ref2_antiguedad" type="text" id="ref2_antiguedad" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';		


	echo '(3) Nombre :<br /><input size="70" class="textbox" name="ref3_nombre" type="text" id="ref3_nombre" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 
 	echo '(3). Domicilio :<br /><input size="70" class="textbox" name="ref3_domicilio" type="text" id="ref3_domicilio" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(3) Telefono :<br /><input size="40" class="textbox" name="ref3_tel" type="text" id="ref3_tel" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';
	 		 	 
	echo '(3) Tiempo de conocerlo(a) :<br /><input size="40" class="textbox" name="ref3_antiguedad" type="text" id="ref3_antiguedad" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	

	echo '<br><br><hr><p class="normal" align="center">REFERENCIAS COMERCIALES: </p>';
	echo '<p class="pies">(1). Nombre :<br /><input size="70" class="textbox"  name="refc1_nombre" type="text" id="refc1_nombre" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 echo '(1). Domicilio :<br /><input class="textbox" size="70" name="refc1_domicilio" type="text" id="refc1_domicilio" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(1) Telefono :<br /><input size="40" class="textbox" name="refc1_tel" type="text" id="refc1_tel" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	

	echo '(1)Años de clientela :<br /><input size="40" class="textbox" name="refc1_antiguedad" type="text" id="refc1_antiguedad" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	 

	echo '(2) Nombre :<br /><input size="70" class="textbox" name="refc2_nombre" type="text" id="refc2_nombre" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 
 	echo '(2). Domicilio :<br /><input size="70" class="textbox" name="refc2_domicilio" type="text" id="refc2_domicilio" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(2) Telefono :<br /><input size="40" class="textbox" name="refc2_tel" type="text" id="refc2_tel" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';
	 		 	 
	echo '(2) Años de clientela :<br /><input size="40" class="textbox" name="refc2_antiguedad" type="text" id="refc2_antiguedad" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';		


	echo '(3) Nombre :<br /><input size="70" class="textbox" name="refc3_nombre" type="text" id="refc3_nombre" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	 
 	echo '(3). Domicilio :<br /><input size="70" class="textbox" name="refc3_domicilio" type="text" id="refc3_domicilio" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '(3) Telefono :<br /><input size="40" class="textbox" name="refc3_tel" type="text" id="refc3_tel" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';
	 		 	 
	echo '(3) Años de clientela :<br /><input size="40" class="textbox" name="refc3_antiguedad" type="text" id="refc3_antiguedad" value="" required="required" ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"><br><br>';	
	
	echo '<hr><p class="normal" align="center">  - ESTUDIO SOCIOECONOMICO - <br>
		Llene correctamente los siguientes datos:</p>';
	
	echo '<p class="pies">Profesion:<br /><input name="profesion" type="text" class="textbox"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()" value="" size="70"></p>';		
	
	echo '<p class="normal" align="center">EMPRESA DONDE LABORO:</p><p class="pies">';
	echo 'Nombre de la empresa:<br /><input name="trabajo_empresa" type="text" class="textbox"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()" value="" size="70"><br><br>';
		
	echo 'Domicilio de la empresa::<br /><input size="70" name="trabajo_domicilio" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
		
	echo'Telefono del trabajo:<br /><input size="70" name="trabajo_telefono" class="textbox" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
		
	echo' Giro comercial de la empresa:<br /><input size="50" name="trabajo_giro" class="textbox" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>';
		
	echo ' Puesto:<br /><input size="40" name="trabajo_puesto" type="text" class="textbox"  value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR />';
		
	echo 'Salario (mensual):<br /><input size="30" required="required" class="textbox" name="trabajo_salario" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR />  ';		
		
			echo 'Antiguedad (años):<br /><input size="3" required="required" class="textbox" name="trabajo_atiguedad" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR /> </p> ';		
		
	
	
	//---AGREGADOS
	
	//---------
	echo '</p><hr><p class="normal">DATOS FISCALES:</p> 
    <P class="pies"><br />';
	
	echo 'Estado de su RFC:<br /><input size="30" class="textbox"  name="fiscal_edo" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />';
	
    echo 'RFC:<br /><input size="30" class="textbox"  name="fiscal_rfc" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />';
	
	echo ' Domicilio:<br /><input size="70" class="textbox"  name="fiscal_domicilio" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br></p>';
	
	echo '<hr><p class="normal">MI NEGOCIO: </p><p class="pies">
  Nombre del negocio:<br /><input class="textbox"  size="50" name="minegocio_nombre" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />';
	
	echo '¿Local propio?<br />
    <select class="textbox"  name="minegocio_propio">
      <option value="si"> SI </option>
      <option value="no"> NO </option>
    </select>
    <br /><br />';
	
	echo 'Ingresos del negocio (ganancia mensual):<br /><input size="20" name="minegocio_ingresos" type="text" class="textbox"  value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()">  <br /><br />';
	
	echo 'Giro de mi negocio:<br /><input size="50"  class="textbox"  name="minegocio_giro" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />';
	
	echo 'Telefono del negocio:<br /><input size="50" class="textbox"  name="minegocio_telefono" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />';
	
	echo '¿Cuantos empleados tiene?:<br /><input size="4" class="textbox"  name="minegocio_empleados" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br> ';

	echo '¿Cuanto gasta en  sueldos de empleados?:<br /><input size="10" class="textbox"  name="minegocio_sueldos" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br> ';
	
	echo '¿Antiguedad?:<br /><input size="10" class="textbox"  name="minegocio_antiguedad" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br> ';		
//---AGREGADOS

	echo 'Domicilio de su negocio:<br /><input size="4" class="textbox"  name="minegocio_domicilio" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br> </p>';

	
//---------
	echo '<hr><p class="normal">SOCIECONOMICO: </p><p class="pies">      
    ¿Cuantas personas depende de usted?:<br /><input size="60"  class="textbox"  name="socio_dependen" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR />';
	
	echo ' ¿Cuantos hijos tiene?<br /><input size="3" name="socio_hijos" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';
	
	
	
	
	
	
	echo '¿Vive en Casa Propia?<br />
	<select class="textbox"  class="textbox"  name="socio_casapropia">
      <option value="si"> SI </option>
      <option value="no"> NO </option>
    </select>
    <br /><br /><br />';
	
	
	echo ' El hogar donde vive es(RENTADO   O PRESTADO)<br /><input size="50" name="socio_hogar" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';

echo '¿Cuanto paga de renta de casa?<br /><input size="20" name="socio_renta" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';	

echo '¿Cuenta con servicio de drenaje?<br /><input size="3" name="socio_drenaje" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';	

echo '¿Cuanto paga bimestralmente por Luz,Agua y Drenaje?<br /><input size="3" name="socio_agualuz" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';	

echo '¿Cuantos pisos tiene su casa?<br /><input size="3" name="socio_pisos" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';	

echo '¿Cuantos cuartos tiene su casa?<br /><input size="3" name="socio_cuartos" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';	

echo '¿Cuantos baños tiene su casa?<br /><input size="3" name="socio_wc" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';	

echo '¿combustible usado para cocinar?<br /><input size="80" name="socio_cocina" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';	

echo '¿De que material es su casa?<br /><input size="80" name="socio_material" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';	

echo '¿Se encuentra en el buro de credito?<br /><input size="3" name="socio_buro" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>';	
	
	
	echo '<hr> Grupo al que pertenece:<br>';
	echo '<select name="grupo">';
	echo '<option selected="selected">  </option>';
		$sqlg = "SELECT * FROM grupos";
		$resultadog=mysql_query($sqlg);
		while ($filag = mysql_fetch_array($resultadog))
			{
			extract($filag);
			echo '<option value="'
			 .$filag["nombre"].'">'.$filag["nombre"].'</option>';
			
			}
	echo '</select>';

	//boton
	echo '<p align="center"><input type="submit" name="ok" id="ok" value="CREAR CLIENTE, SIGUIENTE" /></p>';
	echo '</form>';
	
	
	
	

}

mysql_close();
?>      
      
      
      
    
    
    
    
    
    </td>
  </tr>
  <tr>
    <td bgcolor="#000000">>
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