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
    
    <p align="center" class="titulo1">Grupo:    

<?php
require ("config.php");
require ("funciones.php");
$grupo=$_POST["grupo"];

if(_grupo_esta($grupo)=="SI"){
echo $grupo.' Este nombre de grupo no esta disponible';	
}
else
{

	mysql_connect('localhost', 'root', 'admin');
	mysql_select_db('bd');
	$sql = "INSERT INTO grupos (nombre) VALUES ('$grupo')";

	if(!mysql_query($sql))//checamos si hay curp
	{
		echo '<img src="img\mal.jpg"> NO SE HA creado <br>'.$sql;
	}else{//si esta, preraramos la actualizacion
		echo '<img src="img\bien.jpg">'.$grupo.' creado satisfactoriamente<br>';	
		

}		
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