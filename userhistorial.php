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
<link rel='stylesheet' href='style_nav.css'>
<link rel='stylesheet' href='style.css'>
<script src='script.js'></script><body>
<!-- Librerias css y js -->
<?php librerias(); ?>
</head>
<body>
<!-- Navegador principal -->
<?php barra_navegacion(); ?>
<h1 style="text-align: center">HISTORIAL ADMINISTRACION</h1>
<br>
<!-- Tabla alumnos --> 
<?php
      
      $sql1 = "SELECT * FROM certificados" ;
        $result1 = mysqli_query($conexion, $sql1) or die("ERROR: " . mysqli_error($conexion));    
    ?>
         
<table id="example" class="display" style="width:90vw">
<thead>
    <tr> 
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Certificado</th>
        <th>Entregado Certificado</th>
        <th>Entregado Recibi</th>
        <th>Alumno</th>
        <th>NRE</th>
        <th>Número expediente</th>
        <th>Curso</th>
    </tr>
    </thead>
    <tbody>
    <?php 
          while ($row1 = mysqli_fetch_array($result1)) {
        ?>       
        <tr> 
        <?php
        $sql3 = "select concat_ws(' ', nombre, apellido1, apellido2) AS nombre1, usuario from administrativos WHERE id = " . $row1['usuario_crea_id'] ;
 $result3 = mysqli_query($conexion, $sql3) or die("ERROR: " . mysqli_error($conexion));  
 $row3 = mysqli_fetch_array($result3);
 ?>
            <th><?php echo $row3['nombre1'] ; ?></th>
            <th><?php echo $row3['usuario'] ; ?></th>
            <th><?php echo $row1['fecha_creacion'] ; ?></th>
            <th><?php echo $row1['fecha_escaneado'] ; ?></th>
            <?php
            $sql30 = "select id, certificados_id, fecha_recibi from recibi WHERE certificados_id = " . $row1['id'] ;
 $result30 = mysqli_query($conexion, $sql30) or die("ERROR: " . mysqli_error($conexion));  
 $row30 = mysqli_fetch_array($result30);
 ?>
 <?php  
 if ($row30) {
  ?>         
  <th><?php echo $row30['fecha_recibi'] ; ?></th>
<?php
}else{
  ?>
  <th></th>
  <?php
}
?>     
<?php
 
 $sql200 = "select concat_ws(' ', nombre, apellido1, apellido2) AS nombre1, nre, numero_expediente from alumnos WHERE id = " . $row1['alumnos_id'] ;
 $result200 = mysqli_query($conexion, $sql200) or die("ERROR: " . mysqli_error($conexion));  
 $row200 = mysqli_fetch_array($result200);
?>
            <th><?php echo $row200['nombre1'] ; ?></th>
            <th><?php echo $row200['nre'] ; ?></th>
            <th><?php echo $row200['numero_expediente'] ; ?></th>
            <?php
$sql10 = "select * from alumnos_ciclos WHERE alumnos_id = " . $row1['alumnos_id'] ;
$result10 = mysqli_query($conexion, $sql10) or die("ERROR: " . mysqli_error($conexion));   
$row10 = mysqli_fetch_array($result10);
$idciclo = $row10['ciclos_id'];
$sql100 = "select id, nombre_corto from ciclos WHERE id = " . $idciclo;
$result100 = mysqli_query($conexion, $sql100) or die("ERROR: " . mysqli_error($conexion));   
$row100 = mysqli_fetch_array($result100);

?>
            <th><?php echo $row100['nombre_corto'] ; ?></th>
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