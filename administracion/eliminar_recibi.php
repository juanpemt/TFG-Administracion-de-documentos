<?php
session_start();
include("root.php");
include("..\bd.php");

$id = $_POST['id'];



$sql6 = "DELETE FROM recibi WHERE id LIKE $id";
mysqli_query($conexion, $sql6) or die("ERROR: " . mysqli_error($conexion));

header("Location: ../recibi.php");



 
?>