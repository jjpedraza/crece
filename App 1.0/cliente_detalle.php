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
    
    <p align="center" class="titulo1"> 	CONSULTA DE CLIENTE
     
   
      
      

<?php
require ("config.php");
$link=mysql_connect($servidor,$usuario,$clave);
mysql_select_db($basededatos,$link);
//$id=$_GET["id"]; //utilizo get para obtener la variable id de pagina.php?id=1
$curp=$_GET["curp"];
# Buscamos la imagen a mostrar
$result=mysql_query("SELECT * FROM `clientes` WHERE curp='".$curp."'",$link);
$row=mysql_fetch_array($result);

echo "<img src='foto_mostrar.php?curp=".$curp."' height='400' width='300'/><br>";

echo "<p  class='pies'>Nombre:<p><p class='normal'>".$row["nombre"]."</p>";
echo $row["domicilio"]."<br>".$row["municipio"].", ".$row["estado"].".<br />";
echo "(".$row["domicilio_referencia"].")";
echo "Tel.:".$row["telefono"]."<br>";
echo "correo:".$row["correo"]."<br>";
echo "".$row["redsocial"]."<br><br>";
echo "ESTUDIOS:".$row["estudios"]."<br>";
echo "ESTADO CIVIL:".$row["estadocivil"]."<br><br>";
echo "Fecha de nacimiento:".$row["fechadenacimiento"]."<br><br>";
echo "R E F E R E N C I A S";
echo "".$row["ref1_nombre"]."<br>";
echo "".$row["ref1_tel"]."<br>";
echo "".$row["ref1_domicilio"]."<br>";
echo "".$row["ref2_nombre"]."<br>";
echo "".$row["ref2_tel"]."<br>";
echo "".$row["ref2_domicilio"]."<br>";
echo "</p>";

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