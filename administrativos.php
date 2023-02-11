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
<h1 style="text-align: center">Administratívos</h1>
<br>
<!-- Tabla alumnos --> 
    <?php
      
      $sql1 = "select * from administrativos;";
        $result1 = mysqli_query($conexion, $sql1) or die("ERROR: " . mysqli_error($conexion));    
    ?>
         
<table id="example" class="display" style="width:90vw">
<thead>
    <tr> 
        <th>ID</th>
        <th>Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
        <th>Fecha de Alta</th>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Fecha Ultimo Acceso</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php 
          while ($row1 = mysqli_fetch_array($result1)) {
        ?>       
        <tr>  
            <th><?php echo $row1['id'] ; ?></th>
            <th><?php echo $row1['nombre'] ; ?></th>
            <th><?php echo $row1['apellido1'] ; ?></th>
            <th><?php echo $row1['apellido2'] ; ?></th>
            <th><?php echo $row1['fecha_alta'] ; ?></th>
            <th><?php echo $row1['usuario'] ; ?></th>
            <th><?php echo $row1['clave'] ; ?></th>
            <th><?php echo $row1['fecha_ultimo_acceso'] ; ?></th>
            <th><form method='post' action='administracion/eliminar_administrativos.php'>
            <input type='hidden' name='id' value='<?php echo $row1['id']?>'>
            <button type="submit">Eliminar</button>
            </form></th>
            <th><form method='post' action='administracion/modificar_administrativos.php'>
            <input type='hidden' name='id' value='<?php echo $row1['id']?>'>
            <button type="submit">Modificar</button>
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
