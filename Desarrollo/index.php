<?php include("body/edit_head.php"); ?>
<?php include("body/edit_menu.php"); ?>


<?php
echo "<h4 sytle='width:100%;'>Aplicaciones a las que tienes acceso:</h4>";
echo "<div id='AppContenedor'>

";

    $sql = " 
        SELECT 
        a.idapcat,
        a.nombre,
        (select count(*) from aplicacionespermisos where iduser='".$PrymeCodeAdmin_IdUser."' and aplicacionespermisos.IdApCat = a.idapcat) as Apps
        FROM aplicaciones_categoria a    
        WHERE idapcat not in(1,2)
    ";
    
    $r2= $conexion -> query($sql);
    while($fr = $r2 -> fetch_array()){
        if ($fr['Apps'] <> 0){
        echo "<div id='IdCat".$fr['idapcat']."' class='AppCategoria'>";
        echo "<h4>".$fr['nombre']."</h4>";
        echo "<table width=100%>";

        $sqlMyApps = "select * from aplicacionespermisos where iduser='".$PrymeCodeAdmin_IdUser."' and IdApCat='".$fr['idapcat']."'";
        // echo $sqlMyApps;
        $r= $conexion -> query($sqlMyApps);
        while($f = $r -> fetch_array()){
            
            echo "<tr class='BtnApps' ><td width=40px >";
            echo "<a href='".$f['URL']."'>";
            echo "<img src='icon/".$f['Icono']."' style='width:40px;'>";
            echo "</a>";
            echo "</td><td>";
            echo "<a href='".$f['URL']."' style='text-decoration:none; color:inherit;'>";
            echo $f['AplicacionNombre']."<br>"."<span class='app_des'>".$f['Descripcion']."</span>";
            echo "</a>";
            echo "</td>";

            echo "</tr>";
            echo "</a>";
        }
        

        echo "</table>";
        echo "</div>";
        }

    }
echo "</div>";
    
    ?>



<?php include("body/edit_footer.php"); ?>