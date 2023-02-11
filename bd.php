<?php
//Parámetros de conexión a la BD
$dbhost = "localhost"; //Los nombres de las variables son case-sensitive, no así las palabras reservadas
$dbusuario = "root";
$dbpassword = "";
$port = "3306";
$db = "prl";  //Nombre de la BD
$conexion = mysqli_connect($dbhost . ":" . $port, $dbusuario, $dbpassword);

if (!$conexion) die('Could not connect: ' . mysqi_error($conexion));

if (!mysqli_select_db($conexion, $db)) {
    die ("No se puede usar la BD " . $db . " : " . mysqli_error($conexion));
}

?>