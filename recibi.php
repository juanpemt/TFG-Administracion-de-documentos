<?php
session_start();
include("root.php");
include("bd.php");
include("seguridad.php");
include ("navegacion.php");
include ("librerias.php");


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IES bohio</title>

<link rel="icon" href="imagenes/logobohioreducido.png">
<link rel='stylesheet' href='style.css'>
<script src='script.js'></script>
<!-- Librerias css y js -->
<?php librerias(); ?>
</head>
<body>
<!-- Navegador principal -->
<?php barra_navegacion(); ?>

<h1 style="text-align: center">Recibis</h1>
</div>
<br>
<!-- Tabla alumnos --> 
    <?php
      
      $sql1 = "select * from recibi;";
        $result1 = mysqli_query($conexion, $sql1) or die("ERROR: " . mysqli_error($conexion));    
    ?>
         
<table id="example" class="display" style="width:90vw">
<thead>
    <tr> 
        <th>ID</th>
        <th>ID Certificados</th>
        <th>Nombre alumno</th> 
        <th>Recibido Alumno</th>
        <th>Fecha </th>
        <th>Escaneado</th>
        <th>Persona Autorizada</th>
        <th>DNI</th>
        <th>Documento Autorizado</th>
        <th>ID Administrativo</th>
        <th>Administrativo</th>
        <th>Borrar</th>
    </tr>
    </thead>
    <tbody>
    <?php 
          while ($row1 = mysqli_fetch_array($result1)) {
        ?>       
        <tr>  
            <th><?php echo $row1['id'] ; ?></th>
            <th><?php echo $row1['certificados_id'] ; ?></th>
            <?php 
$sql20 = "select id, alumnos_id from certificados WHERE id = " . $row1['certificados_id'] ;
$result20 = mysqli_query($conexion, $sql20) or die("ERROR: " . mysqli_error($conexion));  
$row20 = mysqli_fetch_array($result20);
$sql22 = "select concat_ws(' ', nombre, apellido1, apellido2) AS nombre from alumnos WHERE id = " . $row20['alumnos_id'] ;
$result22 = mysqli_query($conexion, $sql22) or die("ERROR: " . mysqli_error($conexion));  
$row22 = mysqli_fetch_array($result22);
?>          <th><?php echo $row22['nombre'] ; ?></th>
            <th><?php echo $row1['alumno_recibi'] ; ?></th>
            <th><?php echo $row1['fecha_recibi'] ; ?></th>
            <th><?php echo $row1['escaneado_recibi'] ; ?></th>
            <th><?php echo $row1['persona_autorizada'] ; ?></th>
            <th><?php echo $row1['dni_autorizado'] ; ?></th>
            <th><?php echo $row1['escaneado_autorizacion'] ; ?></th>
            <th><?php echo $row1['administrativos_id'] ; ?></th>
            <?php 
$sql201 = "select concat_ws(' ', nombre, apellido1, apellido2) AS nombre3 from administrativos WHERE id = " . $row1['administrativos_id'] ;
$result201 = mysqli_query($conexion, $sql201) or die("ERROR: " . mysqli_error($conexion));  
$row201 = mysqli_fetch_array($result201);
?>
            <th><?php echo $row201['nombre3'] ; ?></th>
            <th><form method='post' action='administracion/eliminar_recibi.php'>
            <input type='hidden' name='id' value='<?php echo $row1['id']?>'>
            <button type="submit">Eliminar</button>
            </form></th>
        </tr>    
      <?php
          };
        ?>
        <tbody>

</table>
</body>
<?php 
  include ("footer.php");
  ?>
</html>

<!-- script datatable -->
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
