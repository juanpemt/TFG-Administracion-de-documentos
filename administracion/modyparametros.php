<?php
session_start();
include("root.php");
include("../bd.php");
include("../seguridad.php");


$sql = "UPDATE parametros
SET director='" . $_POST['director'] . "',
centro='" . $_POST['centro'] . "',
codigo_centro='" . $_POST['codigo_centro'] . "',
direccion='" . $_POST['direccion'] . "' ,
codigo_postal='" . $_POST['codigo_postal'] . "',
municipio='" . $_POST['municipio'] . "',
secretario='" . $_POST['secretario'] . "',
localidad='" . $_POST['localidad'] . "'
WHERE idparametros=" . $_POST['id'];

mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));

header("Location: ../parametros.php");

?>