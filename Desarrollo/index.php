<?php include("body/edit_head.php"); ?>
<?php include("body/edit_menu.php"); ?>


<?php

if (SanPedro("3",$PrymeCodeAdmin_IdUser) === TRUE){
    echo "Acceso concedido";
} else {
    echo MsgBox("ERROR, no tienes acceso a está aplicación","");
}


?>



<?php include("body/edit_footer.php"); ?>