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
  
    <td align="left" valign="top">
    
<?PHP
require ("config.php");
require ("funciones.php");
$curp = $_POST["curp"]; 
$curp_aval = $_POST["curp_aval"]; 

if (cliente_esta($curp)=="SI"){
	
			echo '<p class="titulo" align="center"> CAPTURA DE LA SOLICITUD DE CREDITO </p>';
			echo '<form action=solicitud_crea.php method="post" name="solicitud_captura" ENCTYPE="multipart/form-data" >';
			echo '<p  class="pies" align="left">';
			echo 'CURP: <BR/> <INPUT  class="textbox" name="curp" type="text" id="curp" required="required" readonly="readonly" value="', $curp, '"',
			 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
			 '"><br><br>';
			 
			echo 'Nombre:<br /><input class="textbox" readonly="readonly" name="nombre" type="text" id="nombre" value="',profesion($curp), '. ', nombre($curp), '" required="required" size="70"','style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.	 
			'/><br /><br>';
			
			echo "Foto:<BR>";
			echo "<img src='foto_mostrar.php?curp=".$curp."' width='100' height='80'><br><br>";
			
			$nosol=no();
			
			echo 'No. de Solicitud:<br /><input class="textbox" name="nosol" type="text" id="nosol" readonly="readonly" value="'.$nosol.'" required="required" size="50"','style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.	 
			'/><br /><br>';
			
			
			echo 'Cantidad Solicitada:<br /> (Escribala sin comas, ni signos)<br><input class="textbox" name="cantidad" type="text"  value="" required="required" size="30"','style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.	 
			'/><br /><br>';
			
			echo 'Forma de Pago:<br>';
			echo '<select name="formadepago" class="textbox" >';
			echo '<option value="7" selected="selected" >Semanal</option>';
			echo '<option  value="15">Quincenal (15 dias)</option>';
			echo '<option value="30">Mensual (30 dias)</option>';
			echo '</select><br><br>';
			
			echo 'Tipo de Credito:<br>';
			echo '<select name="tipo" class="textbox" >';
			echo '<option value="INDIVIDUAL" selected="selected" >Individual</option>';
			echo '<option value="GRUPO" >Grupo</option>';

			echo '</select><br><br>';
			
			echo 'Plazo:<br>';
			echo '<select name="plazo" class="textbox" >';
			echo '<option value="1"> 1 mes </option>';
			echo '<option value="4" >4 meses</option>';
			echo '<option selected="selected" value="6"> 6 meses </option>';
			echo '<option value="9" >9 meses</option>';
			echo '<option value="12">1 año (12 meses)</option>';
			echo '</select><br><br>';
			
			//echo 'Nombre del grupo:<br>';
			//echo '<input class="textbox" name="grupo" type="text"   value="'._aquegrupopertenece($curp).'"  readonly="readonly" size="70"','style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.	 
			'/><br />';
			
			echo '</select><br>';
			
			echo 'Describa del grupo '._aquegrupopertenece($curp).' que representa:  <br>'._integrantesdelgrupo(_aquegrupopertenece($curp)).'<br><br>';
		
			
			echo 'Describa la Garantia que presenta: <br>
			<textarea name="garantia"  class="textbox" id="garantia" cols="70" rows="5" required="required"', 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"','></textarea>
			<br /><br>';
	echo "Foto de Garantia:<BR>";
	echo '<br>Seleccione una foto para actualizar: <br><INPUT NAME="userfile" TYPE="file"><br><br>
			
			<br /><br>';
	echo "Foto de Garantia 2:<BR>";
	echo '<br>Seleccione una foto para actualizar: <br><INPUT NAME="userfile2" TYPE="file"><br><br>
			

			<br /><br>';
	echo "Foto de Garantia 3:<BR>";
	echo '<br>Seleccione una foto para actualizar: <br><INPUT NAME="userfile3" TYPE="file"><br><br>';
			

			
			echo 'Destino del Credito:<br /> <input class="textbox" name="destino" type="text"   value="" size="70"','style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.	 
			'/><br /><br>';
			
			echo '<hr> <p class="normal"> AVAL </P> <BR><P CLASS="pies">';
			
			echo 'CURP:<br /> <input class="textbox"  name="curp_aval" type="text" readonly="readonly"  value="', $curp_aval,'" required="required" size="70"','style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.	 
			'/><br /><br>';
			
			
			echo 'Nombre del Aval:<br /> <input class="textbox" name="nombre_aval" type="text"  readonly="readonly"  value="',profesion($curp_aval),'. ', nombre($curp_aval), '" required="required" size="70"','style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.	 
			'/><br /><br>';
			//boton
			echo '<p align="center"><input type="submit" name="ok" id="ok" value="GUARDAR" /></p>';
			echo '</form>'; 
		
		
		
	}else{
	echo 'No se encontro';
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