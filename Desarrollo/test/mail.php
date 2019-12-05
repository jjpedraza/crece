<?php
require("../body/config.php");
require("../body/funciones.php");

$CorreoDeDestino = "printepolis@gmail.com";
$NombreDelDestino = "Juan Pedraza";

$CorreoDeRespuesta = "admin@v3nt4s.store";
$NombreDeRespuesta = "Administracion v3nt4s.store";

$Asunto = "Test de Prueba";
$Contenido = "<p>Hola mundo </p>";

if (correo($CorreoDeDestino, $NombreDelDestino, $CorreoDeRespuesta, $NombreDeRespuesta, $Asunto, $Contenido) == TRUE ){
    echo "Se envio con éxito";
} else {
    echo "Ha ocurido un error al enviar el correo a ".$CorreoDeDestino;
}



?>