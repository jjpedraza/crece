<?php
include("head.php");
include("header.php");
?>
<script>$('body').css('background-color','#d0cdcdab');</script>

<div id='DivQuien' style='
padding: 5px;
background-color: #79284a;
'>
    <table width=100%>
    <tr><td align=center valign=top>
        <input id='NoSol' placeholder='No. de Contrato' type="text" list="contratos"
         style="
            width: 100%;
            height: 50px;
            border-width: 0px;
            border-radius: 5px;
            text-align: center;
            font-size: 18pt;
            background-color: #28a745;
            color: white;
            font-weight: bold;
        "
        
        >
    </td><td width=50px align=center valign=top>
        <button onclick='CargaContrato(0);' class='btn btn-success' style='
        height:50px;
        '>Entrar</button>
    </td></tr>
    </table>
    <div id='rdata' style='display:none;'></div>
</div>

<div id='CajaInfo'>

</div>

<div id='CajaPago'>

</div>


<script>
function Clientes(){        
    $('#PreLoader').show();           
    $.ajax({
        url: 'app_caja_datindex.php',
        type: 'post',        
        data: {
            
        },
    success: function(data){
        $('#rdata').html(data);                
        $('#PreLoader').hide();
        
    }
    });




            
}
Clientes();
var btn = document.getElementById("NoSol");
btn.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
        CargaContrato(0);
    }
});  
function CargaContrato(n){
    NoSol = $('#NoSol').val();
    $('#PreLoader').show();           
    $.ajax({
        url: 'app_caja_dat_contrato.php',
        type: 'post',        
        data: {
            NoSol:NoSol, n:n
            
        },
    success: function(data){
        $('#CajaInfo').html(data);                
        $('#PreLoader').hide();
        
    }
    });


}  


function CajaComponents(n){
    NoSol = $('#NoSol').val();
    $('#PreLoader').show();           
    $.ajax({
        url: 'app_caja_dat_component.php',
        type: 'post',        
        data: {
            NoSol:NoSol, n:n
            
        },
    success: function(data){
        $('#CajaPago').html(data);                
        $('#PreLoader').hide();
        
    }
    });


}  
</script>
<?php
?>
<?php
include("footer.php");
?>