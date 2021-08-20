<?php
include("head.php");
include("header.php");

if (isset($_GET['g'])){
    $txtGrupo = VarClean($_GET['g']);
    $sqlIn = "INSERT INTO grupos (nombre) VALUES ('".$txtGrupo."')";
    if ($db1->query($sqlIn) == TRUE){
        Toast("Grupo ".$txtGrupo." creado correctamente",4,"");
        Historia($RinteraUser,"GRUPOS","Creo al grupo ".$txtGrupo);
    } else {
        Toast("Error al crear el grupo ".$txtGrupo."",2,"");

    }
}

$sql=" 
select 
Grupo,
Integrantes,
Cuentas,
FORMAT(Vencido,2) as Vencido,
FORMAT(Saldo,2) as Saldo
from gruposinfo
where NIntegrantes >0
";
echo "<div class='container' style='

background-color: white;
padding: 10px;
border-radius: 6px;
margin-top: 30px;
'>
<h1>Grupos registrados:</h1>
";





DynamicTable_MySQL($sql, "DivProyeccion", "TblProyeccion", "tabla", 0, 1);

echo "<br><br>
<form action='app_grupos.php' method='GET'>
<button title='Haga Clic aqui para ver el reporte' class='btn btn-success'
style='
   // background-color: #e6e6e6;
   // color: #625f5f;
   width: 100%;
   font-size: 10pt;
   text-align:left;
'
>

<input type='text' id='g' name='g' placeholder='Nombre del Grupo' class='form-control' required>
Crear Grupo</button>

<br></form>
";
echo "</div>";


include("footer.php");
?>