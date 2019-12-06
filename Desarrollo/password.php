<?php include("body/edit_head.php"); ?>
<?php include("body/edit_menu.php"); ?>


<?php
$IdApp = 1;
if (SanPedro("1",$PrymeCodeAdmin_IdUser) === TRUE){
    echo AppTitular($IdApp);



} else {echo MsgBox("ERROR, no tienes acceso a está aplicación","");}


?>



<?php include("body/edit_footer.php"); ?>