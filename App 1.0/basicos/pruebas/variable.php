<html>

<body>
<?php
require ("config.php");
?>

<?php
//  verificamos nivel del admin
$numelentos = count($nivel_admin);
$estoy = 'no';
for ($i=0; $i < $numelentos; $i++)
{
	//print $nivel_admin[$i];
	$yo = 'clemen';
	if ($yo == $nivel_admin[$i])
	{
		$estoy='OK';
		}
		
		
	//if 	($_SESSION['usuario'] != $nivel_admin[$i])
		//{
			
		  //header('Location: error_nivel.html'); 
		  //exit();
		//}
}
if ($estoy=='OK'){
	echo 'soy admin';
	}else { echo 'no tengo acceso'; }
?>

</body>
</html>