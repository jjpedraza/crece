<?php
    require("body/config.php");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="body/edit_estilo.css"/>
    <style>
        body{
            margin:0px; padding:0px;
        }
        #ContenidoLogin{
            background-image: url('https://source.unsplash.com/random/1920x1080/?nature,trees,green');
            width:100%;
            height:100%;
            padding:50px;
           
            padding: 50px;
            position: fixed;
            z-index: 0;
            filter: blur(2px)  ;
            margin:0px;
            

        }
        #Login{
            
            z-index: 100;
            position: absolute;
            display: inline-block;
            width: 40%;
            background-color: white;
            bottom: 10%;
            right: 10%;
            border-radius: 5px;
            padding: 20px;
            text-align:center;
        }

    </style>
    	<script src="lib/jquery-3.3.1.min.js"></script> 
		<link rel="stylesheet" href="lib/jquery.toast.min.css">
		<script type="text/javascript" src="lib/jquery.toast.min.js"></script>
        <script type="text/javascript" src="lib/pdz_functions.js"></script>
    <title>Login</title>
</head>
<body>
    

<div id='ContenidoLogin'> </div>

<form id='Login' method='POST'>
<table widt=100%><tr>
<td width=50%><img src='img/logo.png' style='width:80%'></td>
<td align=left>
    <!-- <h3><b>Administracion! </b>Identificate:</h3> -->
    <div><label for='IdUser'>IdUser:</label><input id='IdUser' name='IdUser' value='' placeholder='' type='text'></div>
    <div><label for='Password'>Password:</label><input id='Password' name='Password' value='' placeholder='' type='password'></div>
    <input type='hidden' name='ip' id='ip' value=''>
    
<div class='btn btn-Primary'id='btnLogin' name='btnLogin' value='Entrar' placeholder='' type='submit' onclick='LoginBtn()'>Entrar</div>
<div><a href='' class=''>Recordar Contraseña </a></div>

    <span id='LoginLoader' style='color:gray; font-size:8pt; width:100%; display:none; '> <img src='../img/loader_bar.gif'> Espere por favor  ...</span>
    </td>
</tr></table>
</form>   

<div id='R' style='display:none;'></div>

<script>
function LoginBtn(){   
    IdUser = $("#IdUser").val();
    Password = $("#Password").val();
    $("#LoginLoader").hide;
    
   $.ajax({
      url: "login_action.php",
      type: "post",   
      data: {IdUser:IdUser, Password:Password },
      success: function(data){
       $('#R').html(data+"\n");
       $("#LoginLoader").show;
      }
   });

}
</script>

</body>
</html>
