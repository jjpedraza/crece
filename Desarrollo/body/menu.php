<div id='Menu'>
<table width=100%>
<tr>
<td ><img src='img/logo_white.png' style='width:141px; '></td>
<td width=40px>
<img id='BtnUser' src='icon/user.png' onclick='LoginInit();' style='height:40px; cursor:pointer;'>

</td>
</tr>
</table>
    
</div>

<div id='LoginUser' >
<form>
<div><input type='text' name='CorreoUser' placeholder='Tu Correo' style='color:#FF5E00;'></div>
<div><label>Passoword:</label><input type='password' name='PasswordUser' style='color:#FF5E00;'></div>
<div class='btn btn-Primary' style='font-size: 10pt;

font-family: Regular;

width: 63px;

margin-right: 0px;

text-align: center;'>Entrar</div>
<div class='btn btn-Default' style='font-size: 9pt;

font-family: Light;

width: 59px;

margin-left: 0px;'><a href='' style='color:white; text-decoration:none;display:block;'>Registrarse</a></div>
<br>
<a href=''>¿No recuerdo mi password?</a>

</form>
</div>

<script>
    function LoginInit(){        
        
        if (window.localStorage.getItem('LoginOpen') == 1){
            
            $("#LoginUser").hide()
            window.localStorage.setItem('LoginOpen', '0');
        } else {
            
            window.localStorage.setItem('LoginOpen', '1');
            $("#LoginUser").show()
        }
        
    }
    
</script>