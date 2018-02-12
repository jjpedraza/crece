


<?php 



?>
		
</div>	

<div id='footer'>
<table border=0 width="100%">
	<tr>
		<td valign="center" align="center" width="24px">
			<?php
			echo "<img src='icon/user.png' style='width: 23px; height:23px;'>";
			?>

		</td>
		<td>
			<?php echo nuc_nombre($nuc); ?>
		</td>
		<td align="right" valign="right"><a href='login/logout.php' title='haga clic aqui para cerrar sesion'> Salir </a></td>
	</tr>
</table>

</div>




<script type="text/javascript"> // Desaparece el preloader
$(window).load(function() {
	$('#preloader').fadeOut('slow');
	$('body').css({'overflow':'visible'});
})
</script> 




</body>
</html>