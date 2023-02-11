<?php
session_start();
include("bd.php");

    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $hoy = getdate();
    $fecha = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

$passhash = password_hash($clave, PASSWORD_DEFAULT);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resgistro</title>
    <link rel="icon" href="imagenes/logobohioreducido.png">
</head>
<body>
    <?php

    $success = NULL;
if (!empty($_REQUEST['captcha'])) {
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
        echo "ERROR AL RELLENAR EL CAPTCHA";
    } else {
        $sql2 = 'INSERT INTO administrativos(nombre, apellido1, apellido2, fecha_alta, usuario, clave) values("'.$nombre.'","'.$apellido1.'","'.$apellido2.'","'.$fecha.'","'.$usuario.'","'.$passhash.'")';
        $success = mysqli_query($conexion, $sql2) or die("ERROR: " . mysqli_error($conexion)); 
}
}
  if ($success==1) { 
echo ("<script LANGUAGE='JavaScript'>
													window.alert('Creado correctamente');
													window.location.href='crear_administrador.php';
													</script>");
                                                    ?>
 

  <a href='index.php'>PAGINA PRINCIPAL</a>

  <?php } else { 
echo $success;
      ?>

  <p>HAY ALGUN ERROR NO TE HAS REGISTRADO CORRECTAMENTE</p>
  <br>
  <?php  
  echo $success;
  ?>
  <a href='crear_administrador.php'>VOLVER A INTENTARLO</a>
  <?php 
  } 
   ?>
   <div>
        <script src="pagina.js"></script>
    </div>
</body>
</html>