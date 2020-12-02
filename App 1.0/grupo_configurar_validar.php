<?php
require("funciones.php");
require("config.php");
$presidente=$_POST["presidente"];
$secretario=$_POST["secretario"];
$tesorero=$_POST["tesorero"];
$grupo=$_POST["grupo"];




$ok="SI";
if (($presidente==$secretario) or ($presidente==$tesorero)){
	echo 'el presidente se encuentra repetido <br>';
	$ok='no';}

if (($secretario==$presidente) or ($secretario==$tesorero)){
	echo 'el secretario se encuentra repetido <br>';
	$ok='no';}

if (($tesorero==$secretario) or ($tesorero==$secretario)){
	echo 'el tesorero se encuentra repetido <br>';
	$ok='no';}

if ($ok=="SI"){
//	echo $ok.'<br>';
//	echo 'Grupo: '.$grupo.'<br>';
//	echo 'presidente: '.$presidente.'<br>';
//	echo 'secretario: '.$secretario.'<br>';
//	echo 'tesorero: '.$tesorero.'<br>';
mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($basededatos)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
		$sql = "UPDATE clientes SET	grupo_cargo='PRESIDENTE' WHERE curp='$presidente'";
		if(!mysql_query($sql)){echo '<img src="img\mal.jpg"> NO SE HA ACTUALIZADO';
		}else{echo '<img src="img\bien.jpg">Presidente<br>'._nombre($presidente).'<br>';}

		$sql = "UPDATE clientes SET	grupo_cargo='SECRETARIO' WHERE curp='$secretario'";
		if(!mysql_query($sql)){echo '<img src="img\mal.jpg"> NO SE HA ACTUALIZADO';
		}else{echo '<img src="img\bien.jpg">Secretario<br>'._nombre($secretario).'<br>';}

		$sql = "UPDATE clientes SET	grupo_cargo='TESORERO' WHERE curp='$tesorero'";
		if(!mysql_query($sql)){echo '<img src="img\mal.jpg"> NO SE HA ACTUALIZADO';
		}else{echo '<img src="img\bien.jpg">Tesorero<br>'._nombre($tesorero).'<br>';}

	
	}else{
		echo'<b>NO PUEDE CONTINUAR, SELECCIONE UN MIEMBRO DIFERENTE PARA CADA CARGO</b>';
		
		}
?>