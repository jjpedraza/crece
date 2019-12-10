<?php include("body/edit_head.php"); ?>
<?php include("body/edit_menu.php"); ?>


<?php
$IdApp = 1;
$IdUsuario = $PrymeCodeAdmin_IdUser;

if (SanPedro("1",$PrymeCodeAdmin_IdUser) === TRUE){
    echo AppTitular($IdApp);
    historia($IdUsuario, "1", "[1] Acceso a la aplicacion para cambiar su password");

    echo "<form style='width: 100%;

    text-align: center;
    
    padding: 27px;'>";
    echo "<input type='hidden' name='IdUser' id='IdUser' value='".$IdUsuario."'>";
    echo "<div><label>Password actual: </label><input type='password' onKeyUp='ValidaPassword();' name='Password1' id='Password1' value=''></div>";
    echo "<div><label>Nuevo Password: </label><input type='password' name='Password2'  id='Password2'value='' onKeyUp='ValidaEscrituraDePassword();'></div>";
    echo "<div><label>Repita su Nuevo Password: </label><input type='password' name='Password3'  id='Password3'value='' onKeyUp='ValidaEscrituraDePassword();'></div>";

    echo "<span id='BtnGuardar' style='display:none'  class='btn btn-Primary' onclick='GuardarPassword();'><div >Guardar</div></span>";

    echo "</form>";
    echo "<label>Repita el Nuevo Password donde se le indica para que aparezca el boton Guardar</label>";


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