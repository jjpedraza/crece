<?php include("body/edit_head.php"); ?>
<?php include("body/edit_menu.php"); ?>


<?php
$IdApp = 5;
$IdUsuario = $PrymeCodeAdmin_IdUser;

if (SanPedro($IdApp,$PrymeCodeAdmin_IdUser) === TRUE){
    echo AppTitular($IdApp);
    historia($IdUsuario, $IdApp, "Acceso a la aplicacion para cambiar Administrar permisos");

    echo "<div id='Programas' style='
    width:96%;
    padding:10px;
    display:inline-block;
    '>";

    echo "</div>";
    $sql="select 
*   from html_usuarios
    ";
    
    echo "<div id='Usuarios' style='
    width:96%;
    padding:10px;
    display:inline-block;
    background-color:antiquewhite;
    margin: 10px;
    border-radius: 5px;
    text-align:center;
    '>";
    TablaDinamica_MySQL("",$sql, "MiIdDivTabla2", "IdTabla2", "", 0); //0 = Basica, 1 = ScrollVertical, 2 = Scroll Horizontal
    echo "</div>";



} else {echo MsgBox("ERROR, no tienes acceso a está aplicación","");}


?>
<div id ='R' style='display:none'></div>
<script>
function ValidaPassword(){   
    IdUser = $("#IdUser").val();
    Password = $("#Password1").val();
    $("#LoginLoader").hide;
    
   $.ajax({
      url: "password_valida.php",
      type: "post",   
      data: {IdUser:IdUser, Password:Password },
      success: function(data){
       $('#R').html(data+"\n");
       $("#LoginLoader").show;
      }
   });

}

function ValidaEscrituraDePassword(){
    Password2 = $("#Password2").val();
    Password3 = $("#Password3").val();
    if (Password2 == '' || Password3 ==''){
    } else {
    if (Password2 == Password3){
        $('#BtnGuardar').show();
    } else {
        $('#BtnGuardar').hide();

    }
    }

}

function GuardarPassword(){   
    IdUser = $("#IdUser").val();
    PasswordActual = $("#Password1").val();
    PasswordNuevo = $("#Password2").val();
    $("#LoginLoader").hide;
    
   $.ajax({
      url: "password_save.php",
      type: "post",   
      data: {IdUser:IdUser, Password:Password, PasswordNuevo:PasswordNuevo },
      success: function(data){
       $('#R').html(data+"\n");
       $("#LoginLoader").show;
      }
   });

}

</script>


<?php include("body/edit_footer.php"); ?>