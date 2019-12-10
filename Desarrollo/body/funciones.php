<?php





function InfoEquipo()
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


function ValidaVAR($valor){
    $output = TRUE;
    $peligro = "SCRIPT"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    $peligro = "<"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    $peligro = "script"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    $peligro = ">"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    $peligro = "SELECT"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    $peligro = "COPY"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    $peligro = "DROP"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    $peligro = "DUMP"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    // $peligro = "OR"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    $peligro = "LIKE"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    $peligro = "'"; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 
    $peligro = "\""; if(preg_match('/'.$peligro.'/i', $valor)){ $output = FALSE; } 

    return $output;
}

function LimpiarVAR($valor){
    $output = LimpiarVAR_FrontEnd($valor);
	$output = LimpiarVAR_BackEnd($valor);
	$output =  LimpiarComillas($valor);
    return $output;
}

        

function LimpiarComillas($valor)
{
	
	$valor = addslashes($valor);     
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('"',"",$valor);
	
	
	return $valor;
}


    function LimpiarVAR_BackEnd($valor)
    {
        
        $valor = addslashes($valor);     
        $valor = str_ireplace("SELECT","",$valor);
        $valor = str_ireplace("COPY","",$valor);
        $valor = str_ireplace("DELETE","",$valor);
        $valor = str_ireplace("DROP","",$valor);
        $valor = str_ireplace("DUMP","",$valor);
        // $valor = str_ireplace(" OR ","",$valor);
        $valor = str_ireplace("%","",$valor);
        $valor = str_ireplace("LIKE","",$valor);
        $valor = str_ireplace("--","",$valor);
        $valor = str_ireplace("^","",$valor);
        $valor = str_ireplace("[","",$valor);
        $valor = str_ireplace("]","",$valor);	
        $valor = str_ireplace("!","",$valor);
        $valor = str_ireplace("¡","",$valor);
        $valor = str_ireplace("?","",$valor);
        $valor = str_ireplace("=","",$valor);
        $valor = str_ireplace("&","",$valor);
        $valor = str_ireplace("<SCRIPT>","",$valor);
        $valor = str_ireplace("<script>","",$valor);
        $valor = str_ireplace(">","",$valor);
        $valor = str_ireplace("<","",$valor);
        
        return $valor;
    }

   
    function LimpiarVAR_FrontEnd($input) {
     
      $search = array(
        '@<script[^>]*?>.*?</script>@si',   // Elimina javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Elimina las etiquetas HTML
        '@<style[^>]*?>.*?</style>@siU',    // Elimina las etiquetas de estilo
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Elimina los comentarios multi-línea
      );
     
        $output = preg_replace($search, '', $input);
        return $output;
      }
     
    function sanitize($input) {
        if (is_array($input)) {
            foreach($input as $var=>$val) {
                $output[$var] = sanitize($val);
            }
        }
        else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input  = cleanInput($input);
            $output = mysql_real_escape_string($input);
        }
        return $output;
	}
	


    function SESSION_init($id, $user, $session_name, $session_comentario, $ip){
        require("config.php");	
        $sql = "INSERT INTO sessiones (id, session_name,  usuario, fecha, hora, comentarios,ipcliente) 
        VALUES ('".$id."', '".$session_name."', '".$user."', '".$fecha."', '".$hora."', '".$session_comentario."', '".$ip."')";
        // mensaje($sql,'login.php');
            if ($conexion->query($sql) == TRUE)
                {return TRUE;}
            else {return FALSE;}
    }
    
    
    function SESSION_close($id){
        require("config.php");
        $sql="UPDATE sessiones  SET cierre_fecha='".$fecha."', cierre_hora='".$hora."'  WHERE id='".$id."'";
        // //echo $sql;
        if ($conexion->query($sql) == TRUE)
            {return TRUE;}
        else {return FALSE;}
    }
    
    
    function SESSION_tiempo($id){
        require("config.php");
        $sql = 'SELECT TIMEDIFF(CURTIME(), hora) as transcurrido, sessiones.* from sessiones where id="'.$id.'"' ;
        // //echo $sql;
        $r= $conexion -> query($sql); if($f = $r -> fetch_array()){
                return $f['transcurrido'];
        }else{
                return FALSE;
        }
            
    
    }
    
    
    
    function SESSION_tiempoRound($id){
        require("config.php");
        $sql = 'SELECT ROUND(TIMEDIFF(CURTIME(), hora)) as transcurrido, sessiones.* from sessiones where id="'.$id.'"' ;
        // //echo $sql;
        $r= $conexion -> query($sql); if($f = $r -> fetch_array()){
                return $f['transcurrido'];
        }else{
                return FALSE;
        }
            
    
    }


    function historia($IdUser, $IdHistoria, $descripcion){
        require("config.php");
        $descripcion = addslashes($descripcion);
        

        $sql = "INSERT INTO historia
        (iduser, idhistoria,  fecha, hora, descripcion)
        VALUES
        ('$IdUser', '$fecha', '$hora','$descripcion')";
        // //echo $sql;
        
        if ($conexion->query($sql) == TRUE)
        {	//echo "ok";
            return 'TRUE';
        }
            else
        {	////echo $sql;
            return 'FALSE';
        }
}




function correo($mail_dest, $mail_dest_name, $replymail, $replymail_name, $asunto, $contenido){
    //sleep(3);//retraso programado
    require("config.php");
  
    require_once('../lib/mailer/PHPMailerAutoload.php');
    $limite="";
    $footer="
    <br>
    <p>
    <b>https://v3nt4s.store</b><br>
        <cite>Te acompañamos a la nubes</cite>    
    </p>
    ";
    $replymail = 'itavu.informatica@tam.gob.mx';
    $replymail_name='Dpto. de Informatica de ITAVU';
    
    $contenido = "<p charset=UTF-8>".$contenido."</p>";
    ////////CONFIGURACION DEL CORREO DE LA PLATAFORMA////////
    //date_default_timezone_set('Etc/UTC');
    
        $mail = new PHPMailer;
        $mail->isSMTP(); $mail->SMTPDebug = 0; // 0 = off (for production use)// 1 = client messages// 2 = client and server messages
        $mail->Debugoutput = 'html'; $mail->Host = 'c1680987.ferozo.com';  // use // $mail->Host = gethostbyname('smtp.gmail.com'); 
        $mail->Helo = "c1680987.ferozo.com";
        $mail->Port = 465; $mail->SMTPSecure = 'ssl'; $mail->SMTPAuth = true; 
        $mail->Username = "noreply@v3nt4s.store"; $mail->Password = "Sistem4Punto0"; //CUENTA MASTER
        $mail->setFrom('admin@v3nt4s.store', $replymail_name); //Quie envia
        $mail->addReplyTo($replymail, $replymail_name); //Reponder a nombre de 
        $mail->addAddress($mail_dest, $mail_dest_name); //Set Destinatario
        $mail->Subject = $asunto;  //Set asunto
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__)); //--- PARA AÑADIR CONTENIDO DESDE UN ARCHIVO
        $mail->msgHTML($contenido);
        $mail->AltBody = 'El mensaje no puede ser entregado, debido a que su cliente de correo no puede leer el formato html';
        //adjuntar imagenes //$mail->addAttachment('https:/plataformaitavu.tamaulipas.gob.mx/img/logo_copia.png');
        $correo_historia="";
        if (!$mail->send()) {//Si se envia		
            
            return FALSE;
            
           
        } else {
            return TRUE;
           
        }
        
    
}
    
    
    



    
function SESSION_Validate($id){ // solo existe en seguridad
    require("config.php");
    $sql = "select  count(*) as n  from sessiones 
    where id='".$id."'    and cierre_fecha = '0000-00-00'" ;    
    $r= $conexion -> query($sql);     
    if($f = $r -> fetch_array()){
    
			if ($f['n']==0)	{
				return FALSE;
			} else {
				return TRUE; //<-- Sesion abierta
			}
		
    }else{
            return FALSE;
    }
        

}



function SESSION_initRegenerate($id, $user, $session_name, $session_comentario, $ip){
	require("config.php");	
	$sql = "INSERT INTO sessiones (id, session_name,  usuario, fecha, hora, comentarios,ipcliente) 
	VALUES ('".$id."', '".$session_name."', '".$user."', '".$fecha."', '".$hora."', '".$session_comentario."', '".$ip."')";
	// echo $sql;
	// mensaje($sql,'login.php');
		if ($conexion->query($sql) == TRUE)
			{return TRUE;}
		else {return FALSE;}
		
}


function url_origin($s, $use_forwarded_host=false) {

	$ssl = ( ! empty($s['HTTPS']) && $s['HTTPS'] == 'on' ) ? true:false;
	$sp = strtolower( $s['SERVER_PROTOCOL'] );
	$protocol = substr( $sp, 0, strpos( $sp, '/'  )) . ( ( $ssl ) ? 's' : '' );
  
	$port = $s['SERVER_PORT'];
	$port = ( ( ! $ssl && $port == '80' ) || ( $ssl && $port=='443' ) ) ? '' : ':' . $port;
	
	$host = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
	$host = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
  
	return $protocol . '://' . $host;
  
  }
  
  function full_url( $s, $use_forwarded_host=false ) {
	return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
  }
  
  function URLActual(){
	  $absolute_url = full_url( $_SERVER );
	  return $absolute_url;
  }
  

  function SESSION_closeRegenerate($id){
	require("config.php");
	$sql="UPDATE sessiones  SET cierre_fecha='".$fecha."', cierre_hora='".$hora."'  WHERE id='".$id."'";
	// //echo $sql;
	if ($conexion->query($sql) == TRUE)
		{return TRUE;}
	else {return FALSE;}
}


function App_idapcat($idapp){
    require("config.php");   
    $sql = "SELECT * FROM aplicaciones WHERE (idapp='".$idapp."')";
    $rc= $conexion -> query($sql);
    if($f = $rc -> fetch_array())
        {        
            return $f['idapcat'];
        }
    else
        { 
            return '';
        }
}



function SanPedro($idapp,$usuario){
    require("config.php");   
    if (App_idapcat($idapp) == 1 || App_idapcat($idapp) == 2){
        return TRUE;
    } else {
        $sql = "SELECT * FROM aplicaciones_permisos WHERE (iduser='".$usuario."' AND idapp='".$idapp."')";
        $rc= $conexion -> query($sql);
        if($f = $rc -> fetch_array())
            {        
                return TRUE;
            }
        else
            { 
                return FALSE;
            }
    }
    
}

function AppInit($idapp,$usuario){
    require("config.php");   
    if (SanPedro($idapp,$usuario) == TRUE){

    } else {
        
    }
}


function MsgBox($mensaje, $link){
    if ($link=="") {$link = "index.php";}
    $tipo = substr($mensaje, 0,5);    // devuelve "ef"
    
    if ($tipo=='ERROR'){
        echo '<div id="modal_error"></div>';}
        else{
        echo '<div id="modal_oscuro"></div>';}
        
    
    //echo '<div class="padre">';
    //echo '<span class="hijo">';
            if ($tipo=='ERROR'){echo '<div id="msg_error">';}
            else{echo '<div id="mensaje">';}
            echo '<p>'.$mensaje.'</p>';
            echo '<a class="btn btn-default" href="'.$link.'">Aceptar</a>  ';
            //echo '<a class="btn btn-cancel" href="'.$link.'">Cerrar</a>';
            //habla($mensaje);
            echo '</div>';
            
    //echo '</span>';
    //echo '</div>';
    
    }

    

function AppTitular($idapp){
	require("config.php");
	$sql = "SELECT * FROM aplicaciones WHERE idapp='".$idapp."'";
	$rc= $conexion -> query($sql);
	$msg="";
	if($f = $rc -> fetch_array())
	{
		$msg="<div id='AppTitular'><a href='".$f['vinculo']."' style='cursor:pointer; margin-top:-100px;  z-index:5000;' 
		title='Haga clic para regresar a la principal de esta aplicacion'>
	<table border=0 width=100%><tr>";
		$msg= $msg."<td align=center valign=middle width=20px>";
			$archivo = "icon/".$f['icono'];
			
			$foto = "<img src='icon/".$f['icono']."' style='width:40px;'>";
			$msg = $msg.$foto;			
		$msg=  $msg. "</td>";
		$msg = $msg."<td align=center valign=top><span class='app_titulo'>".$f['nombre']."</span><span class='app_version'></span><br>";
		$msg = $msg."<span class='app_des'>".$f['descripcion']."</span></td>";
        $msg = $msg."<td class='pc' width=30px>";
        if ($f['ayuda']==''){

        }else {
            $msg = $msg."<a title='Ir a la ayuda de esta aplicacion ' href='".$f['ayuda']."'>
            <img src='icon/ayuda.png' 
            style=' width:30px; height:30px; margin-left:20px; opacity:0.4;
            ';
            ></a></span>";
        }
        $msg = $msg."</td>";
        
		

	$msg= $msg."</tr></table></a></div>";
	return $msg;
	}
	else
	{ return FALSE;}
}


function Mensaje($mensaje, $link, $tipo){
if ($link=="") {$link = "../index.php";}
echo "<script>$('#R').show();</script>";
if ($tipo==0)
{
        echo '<div id="modal_oscuro"></div>';
        echo '<div id="mensaje">';
        echo '<p>'.$mensaje.'</p>';
        echo '<a class="btn btn-default" href="'.$link.'">Aceptar</a>  ';        
        echo '</div>';
        
}

if ($tipo==1) // error
{
    echo '<div id="modal_error"></div>';
    echo '<div id="mensaje">ERROR:';
    echo '<p>'.$mensaje.'</p>';
    echo '<a class="btn btn-default" href="'.$link.'">Aceptar</a>  ';    
    echo '</div>';

}




}





function TablaDinamica_MySQL($tbCont, $sql, $IdDiv, $IdTabla, $Clase, $Tipo){
	require("config.php");
	
	if ($tbCont == '') {
        $r= $conexion -> query($sql);
        $tbCont = '<div id="'.$IdDiv.'" class="'.$Clase.'">
        <table id="'.$IdTabla.'" class="display" style="width:100%" class="tabla" style="font-size:8pt;">';
    $tabla_titulos = ""; $cuantas_columnas = 0;
        $r2 = $conexion -> query($sql); while($finfo = $r2->fetch_field())
        {//OBTENER LAS COLUMNAS

                /* obtener posición del puntero de campo */
                $currentfield = $r2->current_field;       
                $tabla_titulos=$tabla_titulos."<th style='text-transform:uppercase; font-size:9pt;'>".$finfo->name."</th>";
                $cuantas_columnas = $cuantas_columnas + 1;        
        }

        $tbCont = $tbCont."  
        <thead>
        <tr>
            ".$tabla_titulos."  
        </tr>
        </thead>"; //Encabezados
        $tbCont = $tbCont."<tbody class='tabla'>";
        $cuantas_filas=0;
        $r = $conexion -> query($sql); while($f = $r-> fetch_row())
        {//LISTAR COLUMNAS

            $tbCont = $tbCont."<tr>";        
            for ($i = 1; $i <= $cuantas_columnas; $i++) {      
                $tbCont = $tbCont."<td style='font-size:10pt;'>".$f[$i-1]."</td>";       
                }

            $tbCont = $tbCont."</tr>";
            $cuantas_filas = $cuantas_filas + 1;        
        }

        $tbCont = $tbCont."</tbody>";
        $tbCont = $tbCont."</table></div>";
	} else {
		
	}
	echo  $tbCont;
		switch ($Tipo) {
			case 1: //Scroll Vertical
					echo '<script>
					$(document).ready(function() {
						$("#'.$IdTabla.'").DataTable( {
							"scrollY":        "200px",
							"scrollCollapse": true,
							"paging":         false,
							"language": {
								"decimal": ",",
								"thousands": "."
							}
						} );
					} );
					</script>';
				break;

			case 2: //Scroll Horizontal
					echo '<script>
					$(document).ready(function() {
						$("#'.$IdTabla.'").DataTable( {
							"scrollX": true,
							"scrollCollapse": true,
							"paging":         true,
							"language": {
								"decimal": ",",
								"thousands": "."
							}
						} );
					} );
					</script>';
				break;
			
			default:
				echo '<script>
				$(document).ready(function() {
					$("#'.$IdTabla.'").DataTable( {
						"language": {
							"decimal": ",",
							"thousands": "."
						}
					} );
				} );
				</script>';
		}
       

}

?>