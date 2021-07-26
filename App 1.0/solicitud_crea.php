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
require ("funciones.php");

mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
$curp = $_POST["curp"];   
$curp_aval =$_POST["curp_aval"];
$nosol =$_POST["nosol"];
$cantidad=$_POST["cantidad"];
$formadepago=$_POST["formadepago"];
$plazo=$_POST["plazo"];
$garantia=$_POST["garantia"];
$destino=$_POST["destino"];
$tipo="SOLICITUD";
$fechasol=date('Y-m-j');
$tipo=$_POST["tipo"];
//$grupo=$_POST["grupo"];
//$integrantes=$_POST["integrantes"];
//$grupo=$_POST["grupo"];
$grupo = _aquegrupopertenece($curp);

$sql = "INSERT INTO cuentas (curp, curp_aval, nosol, cantidad, formadepago, plazo, garantia, destino,  fechasol,  tipo, grupo) 

VALUES(
'$curp',
'$curp_aval',
'$nosol',
'$cantidad',
'$formadepago',
'$plazo',
'$garantia',
'$destino',
 '$fechasol',
'$tipo',
'$grupo'
)";



if(!mysql_query($sql))//checamos si hay curp
{
	echo '<img src="img\mal.jpg"> No se ha creado la Solicitud. <br>'.$sql;
}else{//si esta, preraramos la actualizacion
	echo '<img src="img\bien.jpg">Solicitud Creada Correctamente con No. de Sol: ', $nosol,' <br>';	
		
		//Agregar foto de Garantia
			 
		# Conectamos con la base de datos
		$link=mysql_connect($servidor,$usuario,$clave);
		mysql_select_db($basededatos,$link);
		
			$nosol = $_POST["nosol"]; 
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
					
					$result = mysql_query("SELECT * FROM `garantia` WHERE nosol='".$nosol."'");		
					if($row = mysql_fetch_array($result))
					{
						$result=mysql_query("UPDATE garantia SET 
						nosol='$nosol',
						anchura='$info[0]',
						altura='$info[1]',
						tipo='image/jpeg',
						imagen='$imagenEscapes'
						WHERE curp='$curp'",$link);
						
						# Cogemos el identificador con que se ha guardado
						$id=mysql_insert_id();		
						echo '<img src="img\bien.jpg">Fotografia Garantia actualizada correctamente<br>';	
		//				
					}else{//si esta, preraramos la actualizacion
						//echo '<img src="img\mal.jpg"> NO SE HA ACTUALIZADO la foto';
						$result=mysql_query("INSERT INTO garantia (nosol, anchura, altura, tipo, imagen) 
						VALUES(
						'$nosol',
						'$info[0]',
						'$info[1]',
						'image/jpeg',
						'$imagenEscapes')");
						# Cogemos el identificador con que se ha guardado
						$id=mysql_insert_id();		
						echo '<img src="img\bien.jpg">Fotografia de Garantia agregada correctamente<br>';	
					}
			}else{
				$error="El formato de archivo tiene que ser JPG, GIF, BMP o PNG.";
			}
		}else{
			$error="No ha seleccionado ninguna foto...";
		}


//2
//Agregar foto de Garantia
			 
		# Conectamos con la base de datos
		$link=mysql_connect($servidor,$usuario,$clave);
		mysql_select_db($basededatos,$link);
		
			$nosol = $_POST["nosol"]; 
			# Comprovamos que se haya subido un fichero
		if (is_uploaded_file($_FILES["userfile2"]["tmp_name"]))
		{
			# Cogemos el formato de la imagen2
			if ($_FILES["userfile2"]["type"]=="image/jpeg" || $_FILES["userfile2"]["type"]=="image/pjpeg" || $_FILES["userfile2"]["type"]=="image/gif" || $_FILES["userfile2"]["type"]=="image/bmp" || $_FILES["userfile2"]["type"]=="image/png")
			{
				# Cogemos la anchura y altura de la imagen
				$info=getimagesize($_FILES["userfile2"]["tmp_name"]);
		
				# Escapa caracteres especiales
				$imagenEscapes=mysql_real_escape_string(file_get_contents($_FILES["userfile2"]["tmp_name"]));
		
					require ("config.php");
					mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
					mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
					 
					
					$result = mysql_query("SELECT * FROM `garantia2` WHERE nosol='".$nosol."'");		
					if($row = mysql_fetch_array($result))
					{
						$result=mysql_query("UPDATE garantia2 SET 
						nosol='$nosol',
						anchura='$info[0]',
						altura='$info[1]',
						tipo='image/jpeg',
						imagen='$imagenEscapes'
						WHERE curp='$curp'",$link);
						
						# Cogemos el identificador con que se ha guardado
						$id=mysql_insert_id();		
						echo '<img src="img\bien.jpg">Fotografia Garantia 2 actualizada correctamente<br>';	
		//				
					}else{//si esta, preraramos la actualizacion
						//echo '<img src="img\mal.jpg"> NO SE HA ACTUALIZADO la foto';
						$result=mysql_query("INSERT INTO garantia2 (nosol, anchura, altura, tipo, imagen) 
						VALUES(
						'$nosol',
						'$info[0]',
						'$info[1]',
						'image/jpeg',
						'$imagenEscapes')");
						# Cogemos el identificador con que se ha guardado
						$id=mysql_insert_id();		
						echo '<img src="img\bien.jpg">Fotografia de Garantia 2 agregada correctamente<br>';	
					}
			}else{
				$error="El formato de archivo tiene que ser JPG, GIF, BMP o PNG.";
			}
		}else{
			$error="No ha seleccionado ninguna foto...";
		}


//3
//Agregar foto de Garantia
			 
		# Conectamos con la base de datos
		$link=mysql_connect($servidor,$usuario,$clave);
		mysql_select_db($basededatos,$link);
		
			$nosol = $_POST["nosol"]; 
			# Comprovamos que se haya subido un fichero
		if (is_uploaded_file($_FILES["userfile3"]["tmp_name"]))
		{
			# Cogemos el formato de la imagen
			if ($_FILES["userfile3"]["type"]=="image/jpeg" || $_FILES["userfile3"]["type"]=="image/pjpeg" || $_FILES["userfile3"]["type"]=="image/gif" || $_FILES["userfile3"]["type"]=="image/bmp" || $_FILES["userfile3"]["type"]=="image/png")
			{
				# Cogemos la anchura y altura de la imagen
				$info=getimagesize($_FILES["userfile3"]["tmp_name"]);
		
				# Escapa caracteres especiales
				$imagenEscapes=mysql_real_escape_string(file_get_contents($_FILES["userfile3"]["tmp_name"]));
		
					require ("config.php");
					mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
					mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
					   
					
					$result = mysql_query("SELECT * FROM `garantia3` WHERE nosol='".$nosol."'");		
					if($row = mysql_fetch_array($result))
					{
						$result=mysql_query("UPDATE garantia3 SET 
						nosol='$nosol',
						anchura='$info[0]',
						altura='$info[1]',
						tipo='image/jpeg',
						imagen='$imagenEscapes'
						WHERE curp='$curp'",$link);
						
						# Cogemos el identificador con que se ha guardado
						$id=mysql_insert_id();		
						echo '<img src="img\bien.jpg">Fotografia Garantia 3 actualizada correctamente<br>';	
		//				
					}else{//si esta, preraramos la actualizacion
						//echo '<img src="img\mal.jpg"> NO SE HA ACTUALIZADO la foto';
						$result=mysql_query("INSERT INTO garantia3 (nosol, anchura, altura, tipo, imagen) 
						VALUES(
						'$nosol',
						'$info[0]',
						'$info[1]',
						'image/jpeg',
						'$imagenEscapes')");
						# Cogemos el identificador con que se ha guardado
						$id=mysql_insert_id();		
						echo '<img src="img\bien.jpg">Fotografia de Garantia 3 agregada correctamente<br>';	
					}
			}else{
				$error="El formato de archivo tiene que ser JPG, GIF, BMP o PNG.";
			}
		}else{
			$error="No ha seleccionado ninguna foto...";
		}
}





mysql_close();
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