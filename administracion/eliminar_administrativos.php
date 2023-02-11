<?php
session_start();
include("root.php");
include("..\bd.php");


$id = $_POST['id'];

$sql2 = "SELECT * FROM administrativos WHERE id LIKE $id";
$result2 = mysqli_query($conexion, $sql2);
$row2 = mysqli_fetch_array($result2);

$usuario = $row2['usuario'];
echo "$usuario";

//Sacamos los datos de la tabla certificados 
$sql3 = "SELECT * FROM certificados";
$result3 = mysqli_query($conexion, $sql3);
$row3 = mysqli_fetch_array($result3);

//Editamos la tabla certificados si el administrador a creado alguno
if (!is_null($row3['usuario_crea_id'] == $id)) {
    $sql = "UPDATE certificados
    SET usuario_crea_id=1
    WHERE usuario_crea_id=$id";
    mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
}

//Sacamos los datos de la tabla recibis 
$sql4 = "SELECT * FROM recibi";
$result4 = mysqli_query($conexion, $sql4);
$row4 = mysqli_fetch_array($result4);

//Editamos la tabla recibis si el administrador a creado alguno
if (!is_null($row4['administrativos_id'] == $id)) {
    $sql = "UPDATE recibi
    SET administrativos_id=1
    WHERE administrativos_id=$id";
    mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
}

$sql = "DELETE FROM administrativos WHERE id =" .$id;
echo $sql;
mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion)); 

header("Location: ..\administrativos.php");




?>

