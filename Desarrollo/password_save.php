<?php
require("body/config.php");
require("body/funciones.php");

$IdUser = $_POST['IdUser']; if (ValidaVAR($IdUser)==TRUE){$IdUser = LimpiarVAR($IdUser);} else {$IdUser = "";}
$Password = $_POST['Password']; if (ValidaVAR($Password)==TRUE){$Password = LimpiarVAR($Password);} else {$Password = "";}
$PasswordNuevo = $_POST['PasswordNuevo']; if (ValidaVAR($PasswordNuevo)==TRUE){$PasswordNuevo = LimpiarVAR($PasswordNuevo);} else {$PasswordNuevo = "";}

if ($IdUser == '' and $Password == '' and $PasswordNuevo == ''){
    
    echo "
    <script>
        $.toast('Debe proporcionar un Password Actual y uno Nuevo');    
    </script>
    ";
    

} else {
    $error = "";
    $sql = "UPDATE administradores SET AdminPassword='".$PasswordNuevo."' WHERE  IdAdmin='".$IdUser."'";
        if ($conexion->query($sql) == TRUE)
        {	//echo "ok";
            historia($IdUser,"1","Actualizo su password de  [".$Password."] a [".$PasswordNuevo."]");
            Mensaje("Password actualizado correctamente, vuelva a iniciar session para confirmarlo","login.php","0");
            
        }
            else
        {	
            echo "
            <script>
            $.toast({
                heading: 'Error',
                text: 'No se pudo guardar, intentelo mas tarde o contacte al Dpto. de Informatica',
                showHideTransition: 'fade',
                icon: 'error'
            })    
            
            </script>
            ";
            
        }

}
?>