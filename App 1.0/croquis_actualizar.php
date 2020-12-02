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
    
    <p align="center" class="titulo1"> SOLICITUD DE CREDITO
     

      </P>
 <?php
require ("config.php");
# Conectamos con la base de datos
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);

	$curp = $_POST["curp"]; 
	
//echo "<BR>".$_FILES["userfile"]["name"];		//nombre del archivo
//echo "<BR>".$_FILES["userfile"]["type"];		//tipo
//echo "<BR>".$_FILES["userfile"]["tmp_name"];	//nombre del archivo de la imagen temporal
//echo "<BR>".$_FILES["userfile"]["size"];		//tamaño

# Comprovamos que se haya subido un fichero
if (is_uploaded_file($_FILES["userfile"]["tmp_name"]))
{
	# Cogemos el formato de la imagen
	if ($_FILES["userfile"]["type"]=="image/jpeg" || $_FILES["userfile"]["type"]=="image/pjpeg" || $_FILES["userfile"]["type"]=="image/gif" || $_FILES["userfile"]["type"]=="image/bmp" || $_FILES["userfile"]["type"]=="image/png")
	{
		# Cogemos la anchura y altura de la imagen
		$info=getimagesize($_FILES["userfile"]["tmp_name"]);
		//echo "<BR>".$info[0]; //anchura
		//echo "<BR>".$info[1]; //altura
		//echo "<BR>".$info[2]; //1-GIF, 2-JPG, 3-PNG
		//echo "<BR>".$info[3]; //cadena de texto para el tag <img

		# Escapa caracteres especiales
		$imagenEscapes=mysql_real_escape_string(file_get_contents($_FILES["userfile"]["tmp_name"]));

		# Agregamos la imagen a la base de datos
	  

		$result=mysql_query("UPDATE croquis SET 
		curp='$curp',
		anchura='$info[0]',
		altura='$info[1]',
		tipo='image/jpeg',
		imagen='$imagenEscapes'
	    WHERE curp='$curp'",$link);
		
		
		
				# Cogemos el identificador con que se ha guardado
		$id=mysql_insert_id();

		# Mostramos la imagen agregada
//		echo "<CENTER>Imagen actualizada correctamente<BR>";
		echo "<center><img src='croquis_mostrar.php?curp=".$curp."' width='100' height='80'></CENTER>";
		
		echo "<script type='text/javascript'>\n";
		echo "alert('Croquis actualizado');\n";
	 	echo "</script>";
		//echo '<center>Croquis:<br>';
//		echo '<img border="0" src="croquis_mostrar.php?curp='.$curp,'" height="100" width="80"><br><br>';
//		echo '<a HREF="foto_mostrar.php?curp='.$curp.'"> Descargar Foto</a> <br> <br>';
	
	echo '<P>INFORMACION LABORAL <BR /></P>';
	echo '<P>Llene a continuacion correctamente la siguiente informacion:</P>';
	echo '<form action="lab_actualizar.php" id="empresa" name="empresa" method="post" action="">
  <p class="pies">
    <label> ¿Cuenta con un trabajo actualmente?<br />
      <input type="radio" name="trabaja" value="si"   checked="checked"/>
      si</label>
    <br />
    <label>
      <input type="radio" name="trabaja" value="no" />
      no</label>
    <br /><br />

  DATOS DE LA EMPRESA DONDE LABORO:<br />
  Nombre de la empresa:<br /><input size="50" name="trabajo_empresa" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
  
   Domicilio:<br /><input size="70" name="trabajo_domicilio" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
   
   Telefono del trabajo:<br /><input size="70" name="trabajo_telefono" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
  
    Giro comercial de la empresa:<br /><input size="50" name="trabajo_giro" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
    
    
    Puesto:<br /><input size="40" name="trabajo_puesto" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
    
    Salario (mensual):<br /><input size="30" required="required" name="trabajo_salario" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
  
  ¿Tiene usted un negocio propio?<br />
  <select name="negocio">
  	<option value="si"> SI </option>
    <option value="no"> NO </option>
  </select><br /><br />
  
   Razon Social:<br /><input size="50" name="negocio" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
  
   RFC:<br /><input size="30" name="negocio_rfc" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
   
   Domicilio:<br /><input size="70" name="negocio_domicilio" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>     
   
   Telefono:<br /><input size="50" name="negocio_telefono" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br> 
   
  Giro comercial de mi negocio:<br /><input size="50" name="negocio_giro" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>   
  
  <br>
  
  ¿Local propio?<br />
  <select name="local">
  	<option value="si"> SI </option>
    <option value="no"> NO </option>
  </select><br /><br />
  
    Ingresos del negocio (ganancia mensual):<br /><input size="30" name="negocio_ingresos" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()">  
  <p class="pies"> 
     
    ¿Cuantas personas depende de usted?:<br /><input size="3" name="dependen" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
    
    
    ¿Cuantos hijos tiene?<br /><input size="3" name="hijos" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
    

    
    
  <p class="pies">Salario (mensual):<br /><input size="13" name="salario" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>
  
   Ingreso de mi negocio (mensual):<br /><input size="13" name="negocio_ingreso" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>
   
   
  Gasto (mensual):<br /><input size="13" name="gasto" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br> </p>
     
     
<p align="center"><input type="submit" name="ok" id="ok" value="GUARDAR,  SIGUIENTE" /></p> 
</form>';
		
		
		
		
		
		
		
		
		
		
	}else{
		$error="El formato de archivo tiene que ser JPG, GIF, BMP o PNG.";
	}
}else{
	$error="No ha seleccionado ninguna imagen...";
}

//if ($error!="")
//{
//	echo "</center><P><font face='Arial' size=2 color='#ff0000'> Error: ".$error."</font><br>";
//}
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