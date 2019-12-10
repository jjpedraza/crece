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
           
            
            echo "
            <script>
                $('#Password1').css('backgroundColor', '#D0F2C0');             
                // console.log('Password = OK | ".$Password." | ".$f['AdminPassword']."');
            </script>
            ";
            

        } else {
                // $infoequipo=detectar().'IP Cliente: '.$_POST['ip'].'\n Descripcion Local: '.$_POST['pcdescripcion'];
                // historia('','ERROR al loguearse del usuario '.$nitavu.' con el nip '.$nip.'<hr> desde: <br>'.$infoequipo,'LOGIN');
                // mensaje("ERROR: No coincide tu NIP con tu usuario",'./login.php');
                echo "
                // <script>
                // $.toast({
                //     heading: 'Error',
                //     text: 'Contraseña Incorrecta',
                //     showHideTransition: 'fade',
                //     icon: 'error'
                // })    
                
                // </script>
                <script>
                $('#Password1').css('backgroundColor', '#FF0000');    
                
                // console.log('Password = X | ".$Password." | ".$f['AdminPassword']."');
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