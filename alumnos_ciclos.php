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
<h1 style="text-align: center">Alumnos y Ciclos</h1>
<br>
<!-- Tabla alumnos --> 
    <?php
      
      $sql1 = "select * from alumnos_ciclos;";
        $result1 = mysqli_query($conexion, $sql1) or die("ERROR: " . mysqli_error($conexion));    
    ?>
         
<table id="example" class="display" style="width:90vw">
<thead>
    <tr> 
        <th>ID Alumnos</th>
        <th>Fecha Curso</th>
        <th>ID Ciclos</th>
    </tr>
    </thead>
    <tbody>
    <?php 
          while ($row1 = mysqli_fetch_array($result1)) {
        ?>       
        <tr>  
            <th><?php echo $row1['alumnos_id'] ; ?></th>
            <th><?php echo $row1['curso_fol'] ; ?></th>
            <th><?php echo $row1['ciclos_id'] ; ?></th>
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
