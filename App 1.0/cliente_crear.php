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
$nombre =$_POST["nombre"];
$domicilio =$_POST["domicilio"];
$domicilio_referecia=$_POST["domicilio_referencia"];
$municipio=$_POST["municipio"];
$estado=$_POST["estado"];
$fechadenacimiento=$_POST["fechadenacimiento"];
$telefono=$_POST["telefono"];
$correo=$_POST["correo"];
$redsocial=$_POST["redsocial"];
$ife=$_POST["ife"];
$sexo=$_POST["sexo"];
$estadocivil=$_POST["estadocivil"];
$ref1_nombre=$_POST["ref1_nombre"];
$ref1_domicilio=$_POST["ref1_domicilio"];
$ref1_tel=$_POST["ref1_tel"];
$ref2_nombre=$_POST["ref2_nombre"];
$ref2_domicilio=$_POST["ref2_domicilio"];
$ref2_tel=$_POST["ref2_tel"];
$escolaridad=$_POST["escolaridad"];
$profesion=$_POST["profesion"];
$trabajo_nombre=$_POST["trabajo_empresa"];
$trabajo_domicilio=$_POST["trabajo_domicilio"];
$trabajo_telefono=$_POST["trabajo_telefono"];
$trabajo_giro=$_POST["trabajo_giro"];
$trabajo_puesto=$_POST["trabajo_puesto"];
$trabajo_salario=$_POST["trabajo_salario"];
$fiscal_rfc=$_POST["fiscal_rfc"];
$fiscal_domicilio=$_POST["fiscal_domicilio"];
$minegocio_nombre=$_POST["minegocio_nombre"];
$minegocio_propio=$_POST["minegocio_propio"];
$minegocio_ingresos=$_POST["minegocio_ingresos"];
$minegocio_giro=$_POST["minegocio_giro"];
$minegocio_telefono=$_POST["minegocio_telefono"];
$minegocio_empleados=$_POST["minegocio_empleados"];
$socio_dependen=$_POST["socio_dependen"];
$socio_hijos=$_POST["socio_hijos"];
$socio_casapropia=$_POST["socio_casapropia"];
$grupo=$_POST["grupo"];

$minegocio_domicilio=$_POST["minegocio_domicilio"];
$trabajo_antiguedad=$_POST["trabajo_antiguedad"];
$minegocio_sueldos=$_POST["minegocio_sueldos"];
$minegocio_antiguedad=$_POST["minegocio_antiguedad"];

$ref1_antiguedad=$_POST["ref1_antiguedad"];
$ref2_antiguedad=$_POST["ref2_antiguedad"];
$ref3_nombre=$_POST["ref3_nombre"];
$ref3_tel=$_POST["ref3_tel"];
$ref3_domicilio=$_POST["ref3_domicilio"];
$ref3_antiguedad=$_POST["ref3_antiguedad"];

$refc1_nombre=$_POST["refc1_nombre"];
$refc1_tel=$_POST["refc1_tel"];
$refc1_domicilio=$_POST["refc1_domicilio"];
$refc1_antiguedad=$_POST["refc1_antiguedad"];

$refc2_nombre=$_POST["refc2_nombre"];
$refc2_tel=$_POST["refc2_tel"];
$refc2_domicilio=$_POST["refc2_domicilio"];
$refc2_antiguedad=$_POST["refc2_antiguedad"];

$refc3_nombre=$_POST["refc3_nombre"];
$refc3_tel=$_POST["refc3_tel"];
$refc3_domicilio=$_POST["refc3_domicilio"];
$refc3_antiguedad=$_POST["refc3_antiguedad"];

$fiscal_edo=$_POST["fiscal_edo"];

$socio_hogar=$_POST["socio_hogar"];
$socio_renta=$_POST["socio_renta"];
$socio_drenaje=$_POST["socio_drenaje"];
$socio_agualuz=$_POST["socio_agualuz"];
$socio_pisos=$_POST["socio_pisos"];
$socio_cuartos=$_POST["socio_cuartos"];
$socio_wc=$_POST["socio_wc"];
$socio_cocina=$_POST["socio_cocina"];
$socio_material=$_POST["socio_material"];
$socio_buro=$_POST["socio_buro"];




$sql = "INSERT INTO clientes (curp, nombre, ife, domicilio, municipio, telefono, sexo, estudios, correo, redsocial, fechadenacimiento, domicilio_referencia, estadocivil, ref1_nombre, ref1_tel, ref1_domicilio, ref2_nombre, ref2_domicilio, ref2_tel, estado,
profesion, trabajo_nombre, trabajo_domicilio, trabajo_telefono,trabajo_giro, trabajo_puesto, trabajo_salario, fiscal_rfc, fiscal_domicilio, minegocio_nombre, minegocio_propio, minegocio_ingresos, minegocio_giro, minegocio_telefono, minegocio_empleados, socio_dependen, socio_hijos, socio_casapropia,grupo, minegocio_domicilio,trabajo_antiguedad, minegocio_sueldos, minegocio_antiguedad, ref1_antiguedad,ref2_antiguedad, ref3_nombre,ref3_tel, ref3_domicilio, ref3_antiguedad, refc1_nombre, refc1_tel, refc1_domicilio, refc1_antiguedad, 
refc2_nombre, refc2_tel, refc2_domicilio, refc2_antiguedad, refc3_nombre, refc3_tel, refc3_domicilio, refc3_antiguedad, fiscal_edo, socio_hogar, socio_renta, socio_drenaje, socio_agualuz, socio_pisos, socio_cuartos, 
socio_wc, socio_cocina, socio_material, socio_buro
) 

VALUES(
'$curp',
'$nombre',
'$ife',
'$domicilio',
'$municipio',
'$telefono',
'$sexo',
'$escolaridad',
'$correo',
'$redsocial',
'$fechadenacimiento',
'$domicilio_referecia',
'$estadocivil',
'$ref1_nombre',
'$ref1_tel',
'$ref1_domicilio',
'$ref2_nombre',
'$ref2_domicilio',
'$ref2_tel',
'$estado',
'$profesion',
'$trabajo_nombre',
'$trabajo_domicilio',
'$trabajo_telefono',
'$trabajo_giro',
'$trabajo_puesto',
'$trabajo_salario',
'$fiscal_rfc',
'$fiscal_domicilio',
'$minegocio_nombre',
'$minegocio_propio',
'$minegocio_ingresos',
'$minegocio_giro',
'$minegocio_telefono',
'$minegocio_empleados',
'$socio_dependen',
'$socio_hijos',
'$socio_casapropia',
'$grupo',
'$minegocio_domicilio',
'$trabajo_antiguedad',
'$minegocio_sueldos',
'$minegocio_antiguedad',
'$ref1_antiguedad',
'$ref2_antiguedad',
'$ref3_nombre',
'$ref3_tel',
'$ref3_domicilio',
'$ref3_antiguedad',
'$refc1_nombre',
'$refc1_tel',
'$refc1_domicilio',
'$refc1_antiguedad',
'$refc2_nombre',
'$refc2_tel',
'$refc2_domicilio',
'$refc2_antiguedad',
'$refc3_nombre',
'$refc3_tel',
'$refc3_domicilio',
'$refc3_antiguedad',
'$fiscal_edo',
'$socio_hogar',
'$socio_renta',
'$socio_drenaje',
'$socio_agualuz',
'$socio_pisos',
'$socio_cuartos',
'$socio_wc',
'$socio_cocina',
'$socio_material',
'$socio_buro'
)";



if(!mysql_query($sql))//checamos si hay curp
{
	echo '<img src="img\mal.jpg"> NO SE HA creado';
}else{//si esta, preraramos la actualizacion
	echo '<img src="img\bien.jpg">Cliente creado satisfactoriamente<br>';	
             
}

mysql_close();
?>      
      
      
<!--PARA ACTUALIZAR LA FOTO      -->
 <?php
require ("config.php");
# Conectamos con la base de datos
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);

	$curp = $_POST["curp"]; 
	# Comprovamos que se haya subido un fichero
if (is_uploaded_file($_FILES["userfile"]["tmp_name"]))
{
	# Cogemos el formato de la imagen
	if ($_FILES["userfile"]["type"]=="image/jpeg" || $_FILES["userfile"]["type"]=="image/pjpeg" || $_FILES["userfile"]["type"]=="image/gif" || $_FILES["userfile"]["type"]=="image/bmp" || $_FILES["userfile"]["type"]=="image/png")
	{
		# Cogemos la anchura y altura de la imagen
		$info=getimagesize($_FILES["userfile"]["tmp_name"]);

		# Escapa caracteres especiales
		$imagenEscapes=mysql_real_escape_string(file_get_contents($_FILES["userfile"]["tmp_name"]));

			require ("config.php");
			mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
			mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
			$curp = $_POST["curp"];   
			
			$result = mysql_query("SELECT * FROM `fotos` WHERE curp='".$curp."'");		
			if($row = mysql_fetch_array($result))
			{
				$result=mysql_query("UPDATE fotos SET 
				curp='$curp',
				anchura='$info[0]',
				altura='$info[1]',
				tipo='image/jpeg',
				imagen='$imagenEscapes'
				WHERE curp='$curp'",$link);
				
				# Cogemos el identificador con que se ha guardado
				$id=mysql_insert_id();		
				echo '<img src="img\bien.jpg">Fotografia actualizada correctamente<br>';	
//				
			}else{//si esta, preraramos la actualizacion
				//echo '<img src="img\mal.jpg"> NO SE HA ACTUALIZADO la foto';
				$result=mysql_query("INSERT INTO fotos (curp, anchura, altura, tipo, imagen) 
				VALUES(
				'$curp',
				'$info[0]',
				'$info[1]',
				'image/jpeg',
				'$imagenEscapes')");
				# Cogemos el identificador con que se ha guardado
				$id=mysql_insert_id();		
				echo '<img src="img\bien.jpg">Fotografia agregada correctamente<br>';	
				
				
				
				
				
						 
			}
		
		
		
		
		
		
		
			
	}else{
		$error="El formato de archivo tiene que ser JPG, GIF, BMP o PNG.";
	}
}else{
	$error="No ha seleccionado ninguna foto...";
}
?>    
    
<!-- ACTUALIZAR CROQUIS  -->  
 <?php
require ("config.php");
# Conectamos con la base de datos
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);

	$curp = $_POST["curp"]; 
	# Comprovamos que se haya subido un fichero
	if (is_uploaded_file($_FILES["filecroquis"]["tmp_name"]))
{
	# Cogemos el formato de la imagen
	if ($_FILES["filecroquis"]["type"]=="image/jpeg" || $_FILES["filecroquis"]["type"]=="image/pjpeg" || $_FILES["filecroquis"]["type"]=="image/gif" || $_FILES["filecroquis"]["type"]=="image/bmp" || $_FILES["filecroquis"]["type"]=="image/png")
	{
		# Cogemos la anchura y altura de la imagen
		$info=getimagesize($_FILES["filecroquis"]["tmp_name"]);
		# Escapa caracteres especiales
		$imagenEscapes=mysql_real_escape_string(file_get_contents($_FILES["filecroquis"]["tmp_name"]));

require ("config.php");
			mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
			mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
			$curp = $_POST["curp"];   
			
			$result = mysql_query("SELECT * FROM `croquis` WHERE curp='".$curp."'");		
			if($row = mysql_fetch_array($result))
			{
				$result=mysql_query("UPDATE croquis SET 
				curp='$curp',
				anchura='$info[0]',
				altura='$info[1]',
				tipo='image/jpeg',
				imagen='$imagenEscapes'
				WHERE curp='$curp'",$link);
				
				# Cogemos el identificador con que se ha guardado
				$id=mysql_insert_id();		
				echo '<img src="img\bien.jpg">Croquis actualizado correctamente<br>';	
//				
			}else{//si esta, preraramos la actualizacion
//				echo '<img src="img\mal.jpg"> NO SE HA ACTUALIZADO el croquis';
				$result=mysql_query("INSERT INTO croquis (curp, anchura, altura, tipo, imagen) 
				VALUES(
				'$curp',
				'$info[0]',
				'$info[1]',
				'image/jpeg',
				'$imagenEscapes')");
				# Cogemos el identificador con que se ha guardado
				$id=mysql_insert_id();		
				echo '<img src="img\bien.jpg">Croquis agregado correctamente<br>';	
				
				
				
				
				
						 
			}
	}else{
		$error="El formato de archivo tiene que ser JPG, GIF, BMP o PNG.";
	}
}else{
	$error="No ha seleccionado ningun croquis...";
}
?>     



      

    </td>
  </tr>
  <tr>
    <td bgcolor="#000000">
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