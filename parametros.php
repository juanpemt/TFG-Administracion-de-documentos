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
<h1 style="text-align: center">Parametros</h1>
<br>
<!-- Tabla alumnos --> 
    <?php
      
      $sql1 = "select * from parametros;";
        $result1 = mysqli_query($conexion, $sql1) or die("ERROR: " . mysqli_error($conexion));    
    ?>
         
<table id="example" class="display" style="width:90vw">
<thead>
    <tr> 
        <th>Director</th>
        <th>Centro</th>
        <th>Código Centro</th>
        <th>Direccion</th>
        <th>Código Postal</th>
        <th>Municipio</th>
        <th>Secretario</th>
        <th>Localidad</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php 
          while ($row1 = mysqli_fetch_array($result1)) {
        ?>       
        <tr>  
            <th><?php echo $row1['director'] ; ?></th>
            <th><?php echo $row1['centro'] ; ?></th>
            <th><?php echo $row1['codigo_centro'] ; ?></th>
            <th><?php echo $row1['direccion'] ; ?></th>
            <th><?php echo $row1['codigo_postal'] ; ?></th>
            <th><?php echo $row1['municipio'] ; ?></th>
            <th><?php echo $row1['secretario'] ; ?></th>
            <th><?php echo $row1['localidad'] ; ?></th>
            <th><form method='post' action='administracion/modificar_parametros.php'>
            <input type='hidden' name='id' value='<?php echo $row1['idparametros']?>'>
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