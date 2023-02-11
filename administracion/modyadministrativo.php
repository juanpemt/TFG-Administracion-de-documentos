<?php
session_start();
include("root.php");
include("../bd.php");
include("../seguridad.php");
$clave = $_POST['clave'];
$passhash = password_hash($clave, PASSWORD_DEFAULT);

$sql = "UPDATE administrativos
SET nombre='" . $_POST['nombre'] . "',
apellido1='" . $_POST['apellido1'] . "',
apellido2='" . $_POST['apellido2'] . "',
apellido2='" . $_POST['apellido2'] . "' ,
fecha_alta='" . $_POST['fecha_alta'] . "',
usuario='" . $_POST['usuario'] . "',
clave='" . $passhash . "',
fecha_ultimo_acceso='" . $_POST['fecha_ultimo_acceso'] . "'
WHERE id=" . $_POST['id'];
    
mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));

header("Location: ../administrativos.php");

?>