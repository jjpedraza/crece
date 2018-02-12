
<script>
function tiempo(){

var fecha= new Date();
var horas= fecha.getHours();
var minutos = fecha.getMinutes();
var segundos = fecha.getSeconds();


if (horas>12){
dn="PM";
horas=horas-12;
} else {
	dn = "AM";
}
document.getElementById('vigi_hora').innerHTML=horas;
document.getElementById('vigi_min').innerHTML=minutos;
document.getElementById('vigi_seg').innerHTML=segundos;
document.getElementById('vigi_dn').innerHTML=dn;

setTimeout('tiempo()',1);
}
setTimeout('tiempo()',10);

</script>

<div id="superior"> 
	<table border="0" width=100%>
	<tr>
		<td align="left"  width="180px" >
		<a href="index2.php" title="Haga clic para ir a la pagina principal">
			<img src="img/logo.png" class='blanco' style='width:80px;' title="Haga clic aqui para ir al menu principal">
    	</a>
	</td>
	<td></td>
	<td align="right" valign="middle"  width="100px">	

<?php


			echo '<div>';
			echo "<table border='0' id='vigi_horas'>";
			echo "<tr>";
    		echo "<td rowspan='2' width='50%' align=center><div id='vigi_hora'></div></td>";
    		echo "<td valign='bottom' align='justify' width='50%'><div id='vigi_min'></div></td>";
  			echo "</tr>";
  			echo "<tr>";
    		echo "<td valign='top' ><div id='vigi_seg'></div><div id='vigi_dn'></div></td>";
  			echo "</tr>";
			echo "</table>";

?>	
	</td>


</tr>

</table>

</div>


<div id='grancontenido' class='visible'>

<div id="preloader" style='background-color:white; color:#4E4E4E; opacity: 0.9;'>

    <div id="loader">			
    		<img src="img/loader.gif" style='width: 120px; filter: hue-rotate(<?php echo rand(1, 360);?>deg) contrast(80%) brightness(100%) grayscale(0%); opacity: 1;'><br>
   			<span sytle='color:#4E4E4E;'>Cargando...</span>
    </div>
</div>
	





	