<?php


$TestValor = 1;
global $TestValor;

date_default_timezone_set('Mexico/General');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

//Administrador
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '3l-1t4vu'; 
$dbname = 'bd';


if (function_exists('mysqli_connect')) {
        $conexion = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
        $acentos = $conexion->query("SET NAMES 'utf8'"); 
        global $conexion;

       
        
}else
{
        //error en la coneccion
        echo "Error de conección a la Base de dAtos";
}

$fecha = date('Y-m-d'); $hora =  date ("H:i:s");
global $fecha, $hora;
ini_set('max_execution_time', 0);



?>