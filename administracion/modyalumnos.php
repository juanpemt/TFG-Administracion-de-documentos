<?php
session_start();
include("root.php");
include("../bd.php");
include("../seguridad.php");


$sql = "UPDATE alumnos
SET nre='" . $_POST['nre'] . "',
numero_expediente='" . $_POST['numero_expediente'] . "',
curso_academico='" . $_POST['curso_academico'] . "',
nombre='" . $_POST['nombre'] . "' ,
apellido1='" . $_POST['apellido1'] . "',
apellido2='" . $_POST['apellido2'] . "',
documento_identidad='" . $_POST['documento_identidad'] . "',
numero_identidad='" . $_POST['numero_identidad'] . "',
telefono='" . $_POST['telefono'] . "',
email='" . $_POST['email'] . "'
WHERE id=" . $_POST['id'];

mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));

header("Location: ../alumnos.php");

?>