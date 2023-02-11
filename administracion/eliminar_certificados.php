<?php
session_start();
include("root.php");
include("..\bd.php");

$id = $_POST['id'];


//Sacamos los datos de la tabla recibi
$sql3 = "SELECT * FROM recibi";
$result3 = mysqli_query($conexion, $sql3);
$row3 = mysqli_fetch_array($result3);

//Editamos la tabla certificados si el administrador a creado alguno
if (!is_null($row3['certificados_id'] == $id)) {


    $sql5 = "DELETE FROM recibi WHERE certificados_id LIKE $id";
    mysqli_query($conexion, $sql5) or die("ERROR: " . mysqli_error($conexion));
 
}

$sql6 = "DELETE FROM certificados WHERE id LIKE $id";
mysqli_query($conexion, $sql6) or die("ERROR: " . mysqli_error($conexion));

header("Location: ..\certificados.php");



 
?>