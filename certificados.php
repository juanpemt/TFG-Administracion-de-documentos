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
</div>
<h1 style="text-align: center">Certificados</h1>
<br>
<!-- Tabla alumnos --> 
    <?php
      
      $sql1 = "select * from certificados;";
        $result1 = mysqli_query($conexion, $sql1) or die("ERROR: " . mysqli_error($conexion));    
    ?>
         
<table id="example" class="display" style="width:90vw">
<thead>
    <tr> 
        <th>ID</th>
        <th>ID Creador</th>
        <th>nombre creador</th>
        <th>Fecha Creacion</th>
        <th>Certificado</th>
        <th>Fecha de Escaneado</th>
        <th>Certificado Firmado</th>
        <th>ID Alumno</th>
        <th>nombre alumno</th>
        <th>ID Ciclo</th>
        <th>ciclo</th>
        <th>Borrar</th>
    </tr>
    </thead>
    <tbody>
    <?php 
          while ($row1 = mysqli_fetch_array($result1)) {
        ?>       
        <tr>  
            <th><?php echo $row1['id'] ; ?></th>
            <th><?php echo $row1['usuario_crea_id'] ; ?></th>
<?php 
$sql201 = "select concat_ws(' ', nombre, apellido1, apellido2) AS nombre3 from administrativos WHERE id = " . $row1['usuario_crea_id'] ;
$result201 = mysqli_query($conexion, $sql201) or die("ERROR: " . mysqli_error($conexion));  
$row201 = mysqli_fetch_array($result201);
?>
            <th><?php echo $row201['nombre3'] ; ?></th>
            <th><?php echo $row1['fecha_creacion'] ; ?></th>
            <th><?php echo $row1['certificado'] ; ?></th>
            <th><?php echo $row1['fecha_escaneado'] ; ?></th>
            <th><?php echo $row1['escaneado_firmado'] ; ?></th>
            <th><?php echo $row1['alumnos_id'] ; ?></th>
<?php 
$sql200 = "select concat_ws(' ', nombre, apellido1, apellido2) AS nombre1 from alumnos WHERE id = " . $row1['alumnos_id'] ;
$result200 = mysqli_query($conexion, $sql200) or die("ERROR: " . mysqli_error($conexion));  
$row200 = mysqli_fetch_array($result200);
?>
            <th><?php echo $row200['nombre1'] ; ?></th>
            <th><?php echo $row1['ciclos_id'] ; ?></th>
<?php 
$sql202 = "select nombre_corto AS ciclo from ciclos WHERE id = " . $row1['ciclos_id'] ;
$result202 = mysqli_query($conexion, $sql202) or die("ERROR: " . mysqli_error($conexion));  
$row202 = mysqli_fetch_array($result202);
?>          <th><?php echo $row202['ciclo'] ; ?></th>
            <th><form method='post' action='administracion/eliminar_certificados.php'>
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

