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




$sql = "INSERT INTO clientes (curp, nombre, ife, domicilio, municipio, telefono, sexo, estudios, correo, redsocial, fechadenacimiento, domicilio_referencia, estadocivil, ref1_nombre, ref1_tel, ref1_domicilio, ref2_nombre, ref2_domicilio, ref2_tel, estado) 

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
'$estado'
)";

//checamos si hay curp
if(!mysql_query($sql))
{
	echo 'NO SE HA GUARDADO';
}else{//si esta, preraramos la actualizacion
//form en con los datos
	
	
	echo "<script type='text/javascript'>\n";
		 echo "alert('CLIENTE GUARDADO CORRECTAMENTE');\n";
	 echo "</script>";
	echo '<center>Fotografia:<br>';
	echo '<img border="0" src="foto_mostrar.php?curp='.$curp,'" height="100" width="80"><br><br>';
	echo '<a HREF="foto_mostrar.php?curp='.$curp.'"> Descargar Foto</a> <br> <br>';
	
	echo 'Seleccione una foto si desea actualizar <br>';
	echo '<form ENCTYPE="multipart/form-data" action="foto_agregar.php" method="POST">';
	echo 'CURP: <input size="40" name="curp" type="text" id="curp" value="',$curp,'" readonly="readonly"  ',
	 'style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"'.
	 '"> <br> <br>';//
	echo '<INPUT NAME="userfile" TYPE="file">';
	echo '<p><input type="submit" value="GUARDAR Y CONTINUAR"></form></center>';

             
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