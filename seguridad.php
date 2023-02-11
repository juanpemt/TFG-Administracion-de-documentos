<?php
if (isset($_POST['usuario'])){

$sqlhas = "SELECT * FROM administrativos WHERE usuario LIKE LOWER('".$_POST["usuario"]."')";
$resultadohash = mysqli_query($conexion, $sqlhas) or die("ERROR: " . mysqli_error($conexion));

while ($resultadohash1 = mysqli_fetch_array($resultadohash)) {
  if (mysqli_num_rows($resultadohash)==1 && password_verify($_POST['pass'], $resultadohash1['clave'])){
  $_SESSION['usuario'] = $_POST['usuario'];
  $varuser = $_SESSION['usuario'];
  $hoy = getdate();
  $fecha = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];
  $sqlsesion = "UPDATE administrativos SET fecha_ultimo_acceso ='". $fecha ."' WHERE usuario ='". $varuser."'";
  mysqli_query($conexion, $sqlsesion) or die("ERROR: " . mysqli_error($conexion));
}
}
}if (!isset($_SESSION['usuario'])) {
  session_destroy();
  header("Location: iniciosesion.php");
}

?>

