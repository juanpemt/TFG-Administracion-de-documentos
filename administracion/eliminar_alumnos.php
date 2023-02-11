<?php
session_start();
include("root.php");
include("..\bd.php");

$id = $_POST['id'];

$sql2 = "SELECT * FROM alumnos WHERE id LIKE $id";
$result2 = mysqli_query($conexion, $sql2);
$row2 = mysqli_fetch_array($result2);

//Sacamos los datos de la tabla certificados 
$sql3 = "SELECT * FROM certificados";
$result3 = mysqli_query($conexion, $sql3);
$row3 = mysqli_fetch_array($result3);

//Editamos la tabla certificados si el administrador a creado alguno
if (is_null($row3['alumnos_id'] == $id)) {
    
    $sql6 = "DELETE FROM alumnos_ciclos WHERE alumnos_id LIKE $id";
    mysqli_query($conexion, $sql6) or die("ERROR: " . mysqli_error($conexion));

    $sql = "DELETE FROM alumnos WHERE id =" .$id;
    echo $sql;
    mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
    
    
} else {


    $id_recibi = $row3['id'];
    echo $id_recibi;

    $sql5 = "DELETE FROM recibi WHERE certificados_id LIKE $id_recibi";
    mysqli_query($conexion, $sql5) or die("ERROR: " . mysqli_error($conexion));

    $sql6 = "DELETE FROM certificados WHERE alumnos_id LIKE $id";
    mysqli_query($conexion, $sql6) or die("ERROR: " . mysqli_error($conexion));

    $sql6 = "DELETE FROM alumnos_ciclos WHERE alumnos_id LIKE $id";
    mysqli_query($conexion, $sql6) or die("ERROR: " . mysqli_error($conexion));

    $sql = "DELETE FROM alumnos WHERE id =" .$id;
    echo $sql;
    mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion)); 
}

header("Location: ..\alumnos.php");



 
?>