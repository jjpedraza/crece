<?php 
require("config.php");
require("funciones.php");

// //SENTINELA DE SESSION
session_start();  
$IdSession = session_id();

	if (SESSION_Validate($IdSession) == TRUE) { //<-- Si la session esta abierta

		//actualizar el id de session
		$id_sesion_antigua = session_id(); //<-- guardamos el id session actual
		$PrymeCodeAdmin_IdUser = $_SESSION['PrymeCodeAdmin_IdUser']; //<-- Guardamos al usuario actual
		
		session_regenerate_id();$id_sesion_nueva = session_id(); //<-- regneramos el id de session		
		$_SESSION['PrymeCodeAdmin_IdUser'] = $PrymeCodeAdmin_IdUser; //<- Pasamos los valores a la nueva session
		

		SESSION_closeRegenerate($id_sesion_antigua); //<-- Cerramos la sessión actual
		SESSION_initRegenerate($id_sesion_nueva, $PrymeCodeAdmin_IdUser, session_name(), URLActual(), ""); //<-- guardamos la nueva session


		//De esta manera la proxima vez que entren a un link detectara si esta activa la session, y si esta activa
		// la regenera
		

	} else {
		$_SESSION = array(); 
		session_destroy();		
		unset($PrymeCodeAdmin_IdUser);
		// echo "Logearse";
		header("location:login.php?info=Sesion Expirada");	
    }



// ob_end_clean();
    
    
?>    