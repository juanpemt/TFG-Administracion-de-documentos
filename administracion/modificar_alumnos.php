<?php
session_start();
include("root.php");
include("../bd.php");
include("../seguridad.php");
include ("navegacion_administracion.php");



$id = $_POST['id'];

$sql = "SELECT * FROM alumnos WHERE id LIKE $id";
$result = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
$row = mysqli_fetch_array($result);

$id = $row['id'];
$nre = $row['nre'];
$numero_expediente = $row['numero_expediente'];
$curso_academico = $row['curso_academico'];
$nombre = $row['nombre'];
$apellido1 = $row['apellido1'];
$apellido2 = $row['apellido2'];
$documento_identidad = $row['documento_identidad'];
$numero_identidad = $row['numero_identidad'];
$telefono = $row['telefono'];
$email = $row['email'];
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
<h1 style="text-align: center">Modificar Alumnos</h1>
<br>
<div id="div_form">
    <fieldset style="width:500px">
    <form method="POST" action="modyalumnos.php">
	<input type="hidden" name="id" id="id" value="<?php echo $id?>">
	<label for="nre">NRE</label>
	<input type="text" name="nre" id="nre" value="<?php echo $nre;?>" size="90" required>
	<br>
    <br>
    <label for="numero_expediente">Numero de Expediente</label>
	<input type="text" name="numero_expediente" id="numero_expediente" value="<?php echo $numero_expediente;?>" size="90" required>
	<br>
    <br>
    <label for="curso_academico">Curso Academico</label>
	<input type="text" name="curso_academico" id="curso_academico" value="<?php echo $curso_academico;?>" size="90" required>
	<br>
    <br>
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
    <label for="documento_identidad">Documento de Identidad</label>
	<input type="text" name="documento_identidad" id="documento_identidad" value="<?php echo $documento_identidad?>" size="90" required>
    <br>
    <br>
    <label for="numero_identidad">Numero de identidad</label>
	<input type="text" name="numero_identidad" id="numero_identidad" value="<?php echo $numero_identidad?>" size="90" required>
    <br>
    <br>
    <label for="telefono">Teléfono</label>
	<input type="text" name="telefono" id="telefono" value="<?php echo $telefono?>" size="90" required>
    <br>
    <br>
    <label for="email">Correo</label>
	<input type="text" name="email" id="email" value="<?php echo $email?>" size="90" required>
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
