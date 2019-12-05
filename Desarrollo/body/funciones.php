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


    function historia($IdUser, $IdHistoria, $Descripcion){
        require("config.php");
        $descripcion = addslashes($descripcion);
        

        $sql = "INSERT INTO historia
        (iduser, idhistoria,  fecha, hora, descripcion)
        VALUES
        ('$nitavu_', '$fecha', '$hora','$Descripcion')";
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




?>