<?php

function app_nombre($idapp){
require("config.php");
$sql = "SELECT * FROM aplicaciones WHERE idapp='".$idapp."'";
$rc= $conexion -> query($sql);
$msg="";
if($f = $rc -> fetch_array())
{
return $f['nombre'];
}
else
{ return FALSE;}
}


function notificacion_add ($usuario, $asunto, $entregar_fecha, $itavu_manda, $contenido){
require("config.php");
$sql = "INSERT INTO notificaciones
		(nuc, asunto, entregar_fecha, nitavu_manda, contenido, no_oficio)
		VALUES
		('$usuario', '$asunto', '$entregar_fecha','$itavu_manda', '$contenido', '$oficio')";
if ($conexion->query($sql) == TRUE)
{
	return TRUE;
}
else
{
	return FALSE;
}
}



function aplicacion_nivel($idapp,$usuario){
require("config.php");
$sql = "SELECT * FROM aplicaciones_permisos WHERE (nuc='".$usuario."' AND idapp='".$idapp."')";
$rc= $conexion -> query($sql);
if($f = $rc -> fetch_array())
{
	return $f['nivel'];

}
else
{ return 0;}
}

function buscar($action, $placeholder){
echo '                <div id="beta_buscar">';
	echo '<form action="'.$action.'" method="get">';
	echo '<table broder="1" width="100%"><tr>';
			echo '<td>                    <input required="required" type="text" id="beta_buscar_input" name="q" placeholder="'.$placeholder.'" /></td>';
			echo '<td align="right" width="15px">                    
			<button id="beta_buscar_boton">
			<img  src="icon/buscar.png"></button>
			</td>';
		echo '</tr></table>';
	echo '</form>';
echo '                </div>';
//onclick="searchToggle(this, event)
}



function mensaje($mensaje, $link, $tipo){
if ($link=="") {$link = "../index.php";}

if ($tipo=='')
{
		echo '<div id="modal_oscuro"></div>';
		echo '<div id="mensaje">';
		echo '<p>'.$mensaje.'</p>';
		echo '<a class="btn btn-default" href="'.$link.'">Aceptar</a>  ';
		habla($mensaje);
		echo '</div>';
		
} else
{
	if ($tipo=='error')
	{
		echo '<div id="modal_error"></div>';
		echo '<div id="mensaje">ERROR:';
		echo '<p>'.$mensaje.'</p>';
		echo '<a class="btn btn-default" href="'.$link.'">Aceptar</a>  ';
		habla($mensaje);
		echo '</div>';

	}


}

}








function habla($quedigo){
	echo "<script>responsiveVoice.speak('".$quedigo."', 'Spanish Latin American Female', {volume: 100}); </script>";
	//echo "<script>responsiveVoice.speak('".$quedigo."', 'Spanish Female', {volume: 100}); </script>";
      //onclick='responsiveVoice.speak("Hola Mundo", "Spanish Latin American Female");' type='button' value='🔊 Play'  class='btn btn-default'/>
   //responsiveVoice.speak('Probando Sintetizador de audio', 'Spanish Female', {volume: 100});
   //responsiveVoice.speak('Probando Sintetizador de audio', 'Spanish Latin American Female', {volume: 100});
   //onstart: StartCallback, onend: EndCallback}
}




function historia($nuc, $descripcion){
require("config.php");
//funcion que otorga acceso a las aplicaciones
$sql = "INSERT INTO historia
(nitavu, fecha, hora, descripcion)
VALUES
('$nuc', '$fecha', '$hora','$descripcion')";
if ($conexion->query($sql) == TRUE)
{	//echo "ok";
	return 'TRUE';
}
	else
{	//echo $sql;
	return 'FALSE';
}
}








			function detectar()
			{
			$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
			$os=array("WIN","MAC","LINUX");
			# definimos unos valores por defecto para el navegador y el sistema operativo
			$info['browser'] = "OTHER";
			$info['os'] = "OTHER";
			# buscamos el navegador con su sistema operativo
			foreach($browser as $parent)
			{
			$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
			$f = $s + strlen($parent);
			$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
			$version = preg_replace('/[^0-9,.]/','',$version);
			if ($s)
			{
			$info['browser'] = $parent;
			$info['version'] = $version;
			
			}
			}
			# obtenemos el sistema operativo
			foreach($os as $val)
			{
			if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
			$info['os'] = $val;
			}
			# devolvemos el array de valores
			
			//echo getenv('HTTP_CLIENT_IP');
			//echo getenv('HTTP_X_FORWADED_FOR');
			//echo getenv('REMOTE_ADDR');
			$infofull="<br>";
			//$infofull = $infofull. "Usuario: ".gethostname()."<br>";
			$infofull = $infofull. "SO: ".$info['os']."<br>";
			$infofull = $infofull. "Nav: ".$info['browser']."<br>";
			$infofull = $infofull. "Ver: ".$info['version']."<br>";
			$infofull = $infofull. "Agente ".$_SERVER['HTTP_USER_AGENT']."<br>";
			
			$infofull = $infofull. "ip: ".getenv('HTTP_CLIENT_IP')."<br>";
			$infofull = $infofull. "ip: ".getenv('HTTP_X_FORWADED_FOR')."<br>";
			$infofull = $infofull. "ip: ".getenv('REMOTE_ADDR')."<br>";
			
			
			return $infofull;
			}




function nuc_nombre($id){
require("config.php");
$sql = "SELECT * FROM empleados WHERE nuc='".$id."'";
$rc= $conexion -> query($sql);
$msg="";
if($f = $rc -> fetch_array())
{
	if ($f['profesion_abr']==""){
		return $f['nombre'];}
	else
	{return $f['profesion_abr'].". ".$f['nombre'];}
}
else
{ return FALSE;}

}

function sanpedro ($idapp,$usuario){
require("config.php");
//funcion que otorga acceso a las aplicaciones
//pero a san pedro no le importa tu nivel, si estas en la lista te deja pasar
$sql = "SELECT * FROM aplicaciones_permisos WHERE (nuc='".$usuario."' AND idapp='".$idapp."' )";
$rc= $conexion -> query($sql);
if($f = $rc -> fetch_array())
	{
	//xd_update($idapp,$usuario);//guarda la experiencia del usuario
	return TRUE;

	}
else
	{ 
		//historia($usuario, "Se le nego el acceso a la aplicacion con ID ".$idapp); 
	return FALSE;
	}
}



?>