<?php
include("head.php");
include("header.php");

// if (isset($_GET['g'])){
//     $txtGrupo = VarClean($_GET['g']);
//     $sqlIn = "INSERT INTO grupos (nombre) VALUES ('".$txtGrupo."')";
//     if ($db1->query($sqlIn) == TRUE){
//         Toast("Grupo ".$txtGrupo." creado correctamente",4,"");
//         Historia($RinteraUser,"GRUPOS","Creo al grupo ".$txtGrupo);
//     } else {
//         Toast("Error al crear el grupo ".$txtGrupo."",2,"");

//     }
// }

$sql="select * from solicitudes limit 10";
TableData($sql); //0 = Basica, 1 = ScrollVertical, 2 = Scroll Horizontal



include("footer.php");
?>