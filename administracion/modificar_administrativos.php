<?php
session_start();
include("root.php");
include("../bd.php");
include("../seguridad.php");
include ("navegacion_administracion.php");


$id = $_POST['id'];

$sql = "SELECT * FROM administrativos WHERE id LIKE $id";
$result = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
$row = mysqli_fetch_array($result);

$id_administrativo = $row['id'];
$nombre = $row['nombre'];
$apellido1 = $row['apellido1'];
$apellido2 = $row['apellido2'];
$fecha_alta = $row['fecha_alta'];
$usuario = $row['usuario'];
$clave = $row['clave'];
$fecha_ultimo_acceso = $row['fecha_ultimo_acceso'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IES bohio</title>

<link rel="icon" href="../imagenes/logobohioreducido.png">
<link rel='stylesheet' href='../style_nav.css'>
<link rel='stylesheet' href='../style.css'>
</head>
<body>
<!-- Navegador principal -->
<?php barra_navegacion(); ?>

<h1 style="text-align: center">Modificar Administrativos</h1>
<br>
<div id="div_form">
    <fieldset style="width:500px">
    <form method="POST" action="modyadministrativo.php">
	<input type="hidden" name="id" id="id" value="<?php echo $id_administrativo?>">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" id="nombre" value="<?php echo $nombre;?>" size="90" required>
	<br>
    <br>
    <label for="apellido1">Primer Apellido</label>
	<input type="text" name="apellido1" id="apellido1" value="<?php echo $apellido1?>" size="90" required>
    <br>
    <br>
    <label for="apellido2">Segundo Apellido</label>
	<input type="text" name="apellido2" id="apellido2" value="<?php echo $apellido2?>" size="90" required>
    <br>
    <br>
    <label for="fecha_alta">Fecha de Alta</label>
	<input type="date" name="fecha_alta" id="fecha_alta" value="<?php echo $fecha_alta?>" size="90" required>
    <br>
    <br>
    <label for="usuario">Usuario</label>
	<input type="text" name="usuario" id="usuario" value="<?php echo $usuario?>" size="90" required>
    <br>
    <br>
    <label for="clave">Contraseña</label>
	<input type="text" name="clave" id="clave" value="<?php echo $clave?>" size="90" required>
    <br>
    <br>
    <label for="fecha_ultimo_acceso">Fecha Ultimo Acceso</label>
	<input type="date" name="fecha_ultimo_acceso" id="fecha_ultimo_acceso" value="<?php echo $fecha_ultimo_acceso?>" size="90" required>
    <br>
    <br>
	<input type="submit" value="Guardar cambios">
	<input type="reset" value="Restaurar valores iniciales">
    </form>
</fieldset>
</div>

</body>
<?php 
  include ("../footer.php");
  ?>
</html>
