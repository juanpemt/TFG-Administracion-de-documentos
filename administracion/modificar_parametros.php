<?php
session_start();
include("root.php");
include("../bd.php");
include("../seguridad.php");
include ("navegacion_administracion.php");



$id = $_POST['id'];

$sql = "SELECT * FROM parametros WHERE idparametros LIKE $id";
$result = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
$row = mysqli_fetch_array($result);

$id = $row['idparametros'];
$director = $row['director'];
$centro = $row['centro'];
$codigo_centro = $row['codigo_centro'];
$direccion = $row['direccion'];
$codigo_postal = $row['codigo_postal'];
$municipio = $row['municipio'];
$secretario = $row['secretario'];
$localidad = $row['localidad'];
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
<h1 style="text-align: center">Modificar Parametros</h1>
<br>
<div id="div_form">
    <fieldset style="width:500px">
    <form method="POST" action="modyparametros.php">
	<input type="hidden" name="id" id="id" value="<?php echo $id?>">
	<label for="director">Director</label>
	<input type="text" name="director" id="director" value="<?php echo $director;?>" size="90" required>
	<br>
    <br>
    <label for="centro">Centro</label>
	<input type="text" name="centro" id="centro" value="<?php echo $centro;?>" size="90" required>
	<br>
    <br>
    <label for="codigo_centro">Codigo del Centro</label>
	<input type="text" name="codigo_centro" id="codigo_centro" value="<?php echo $codigo_centro;?>" size="90" required>
	<br>
    <br>
    <label for="direccion">Direccion</label>
	<input type="text" name="direccion" id="direccion" value="<?php echo $direccion;?>" size="90" required>
	<br>
    <br>
    <label for="codigo_postal">Codigo Postal</label>
	<input type="text" name="codigo_postal" id="codigo_postal" value="<?php echo $codigo_postal?>" size="90" required>
    <br>
    <br>
    <label for="municipio">Município</label>
	<input type="text" name="municipio" id="municipio" value="<?php echo $municipio?>" size="90" required>
    <br>
    <br>
    <label for="secretario">Secretario</label>
	<input type="text" name="secretario" id="secretario" value="<?php echo $secretario?>" size="90" required>
    <br>
    <br>
    <label for="localidad">Localidad</label>
	<input type="text" name="localidad" id="localidad" value="<?php echo $localidad?>" size="90" required>
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