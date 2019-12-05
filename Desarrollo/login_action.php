<?php
require("body/config.php");
require("body/funciones.php");

$IdUser = $_POST['IdUser']; if (ValidaVAR($IdUser)==TRUE){$IdUser = LimpiarVAR($IdUser);} else {$IdUser = "";}
$Password = $_POST['Password']; if (ValidaVAR($Password)==TRUE){$Password = LimpiarVAR($Password);} else {$Password = "";}

if ($IdUser == '' and $Password == ''){
    
    echo "
    <script>
    $.toast('Debe proporcionar un IdUser y un Password')    ;
    
    </script>
    ";
    

} else {
    $error = "";
    $sql="SELECT * FROM administradores WHERE (IdAdmin='".$IdUser."')";
    $r = $conexion -> query($sql); if($f = $r -> fetch_array())	
    {     
        
        if ($f['AdminPassword']== $Password){
           

            $PrymeCodeAdmin_IdUser = $f['IdAdmin'];	// variable de entorno      
            global $PrymeCodeAdmin_IdUser; 

            session_start();    
            session_regenerate_id();                
            $sessionAnterior = session_name("PrymeCodeAdmin");

            $_SESSION['PrymeCodeAdmin_IdUser']=$f['IdAdmin'];             
            
            $InformacionDelEquipo = InfoEquipo();
            
            historia($PrymeCodeAdmin_IdUser,'Acceso <br>'.$infoequipo.'','LOGIN');			    

            SESSION_init(session_id(), $PrymeCodeAdmin_IdUser, session_name(), $InformacionDelEquipo,"");    

          

            echo "
            <script>
                $.toast('Excelente... ".$PrymeCodeAdmin_IdUser."');                
            </script>
            ";
            echo '<script>window.location.replace("index.php?home=")</script>'; 

        } else {
                // $infoequipo=detectar().'IP Cliente: '.$_POST['ip'].'\n Descripcion Local: '.$_POST['pcdescripcion'];
                // historia('','ERROR al loguearse del usuario '.$nitavu.' con el nip '.$nip.'<hr> desde: <br>'.$infoequipo,'LOGIN');
                // mensaje("ERROR: No coincide tu NIP con tu usuario",'./login.php');
                echo "
                <script>
                $.toast({
                    heading: 'Error',
                    text: 'Contraseña Incorrecta',
                    showHideTransition: 'fade',
                    icon: 'error'
                })    
                
                </script>
                ";
        }
    }else {
        echo "
        <script>
        $.toast({
            heading: 'Error',
            text: 'No existe el usuario ".$IdUser."',
            showHideTransition: 'fade',
            icon: 'error'
        })    
        
        </script>
        ";
    }


}
?>