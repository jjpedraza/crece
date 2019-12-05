<div id='MenuVertical'>
<table >
<tr><td><a href='index.php?home='><img src='icon/home.png' style='width:43px;'></a></td></tr>
<?php 
$sql = "SELECT * FROM aplicaciones WHERE idapcat in(1,2)";
$r= $conexion -> query($sql);
while($f = $r -> fetch_array())
{
    echo "<tr><td><a href='".$f['vinculo']."'><img src='icon/".$f['icono']."' style='width:43px;'></a></td></tr>";
}

?>


<tr><td></td></tr>

<tr><td><a href='logout.php' title='Salir <?php echo $PrymeCodeAdmin_IdUser; ?>'><img src='icon/logout.png' style='width:43px;'></a></td></tr>



</table>
</div>

<div id='MenuTop'>
<?php
// echo "Buen dia <b>".$PrymeCodeAdmin_IdUser."</b>";
?>
</div>