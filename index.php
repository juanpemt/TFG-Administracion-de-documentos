<?php
session_start();
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
<script src='script.js'></script>
<!-- Librerias css y js -->
<?php librerias(); ?>
</head>
<body>
<!-- Navegador principal -->
<?php barra_navegacion(); ?>
<br><br>
<div class="flush1" id="div1">
<form METHOD="POST" ACTION="index.php">
			&nbsp &nbsp <label>Año del curso: </label> &nbsp &nbsp &nbsp
      <?php
        $sql3 = "select DISTINCT curso_academico from alumnos ";
	      $result3 = mysqli_query($conexion, $sql3) or die("ERROR: " . mysqli_error($conexion));      
      ?>      
			<select onchange="this.form.submit()" name="año" class="selectpicker show-menu-arrow" title="-----" data-style="form-control" data-live-search="true" >    
      <option value="">TODOS</option>    
        <?php
         //Crea un bucle while para compilar todos los resultados de la tabla
				while ($row3 = mysqli_fetch_array($result3)){
          //Y en echo se muestran los registros de la tabla indicada
         ?>
        <option value="<?php echo $row3['curso_academico']; ?>"><?php echo $row3['curso_academico']; ?></option>
        <?php
				}
				?>        
			</select>		    	
	</form>
</div>
<?php
if (isset($_POST["año"]) && $_POST["año"] > 2 ) {
  $año = $_POST["año"];
?>


<div class="flush1" id="div2">
      <form METHOD="POST" ACTION="pdf/paginapdfcurso.php">
			&nbsp &nbsp <label>Curso: </label> &nbsp &nbsp &nbsp
      <input type="hidden" value="<?php echo $_POST["año"]; ?>" name="varaño" >
      <?php 
      $sql = "Select DISTINCT nombre_corto from ciclos
      INNER JOIN alumnos_ciclos ON alumnos_ciclos.ciclos_id = ciclos.id
      INNER JOIN alumnos ON alumnos.id = alumnos_ciclos.alumnos_id WHERE alumnos.curso_academico =" . $_POST['año'];
	    $result = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));  
      ?>
			<select name="ciclos" class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true">        
        <?php
         //Crea un bucle while para compilar todos los resultados de la tabla
				while ($row = mysqli_fetch_array($result)){
          //Y en echo se muestran los registros de la tabla indicada
         ?>
        <option value="<?php echo $row['nombre_corto']; ?>"><?php echo $row['nombre_corto']; ?></option>
        <?php
				}
				?>
			</select>		
      &nbsp &nbsp
      <input id="foto" type="image" name="enviar" value="enviar" src="imagenes/pdf.png"  />	
	</form>
</div>
<!-- Div de descargas -->
<div class="flush1" id="div3">
      <form METHOD="POST" ACTION="certificados\descargarcursocert.php">
      <input type="hidden" value="<?php echo $_POST["año"]; ?>" name="varaño" >
      <?php 
      $sql = "Select DISTINCT nombre_corto from ciclos
      INNER JOIN alumnos_ciclos ON alumnos_ciclos.ciclos_id = ciclos.id
      INNER JOIN alumnos ON alumnos.id = alumnos_ciclos.alumnos_id WHERE alumnos.curso_academico =" . $_POST['año'];
	    $result = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));  
      ?>
			<select name="ciclos" class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true">        
        <?php
         //Crea un bucle while para compilar todos los resultados de la tabla
				while ($row = mysqli_fetch_array($result)){
          //Y en echo se muestran los registros de la tabla indicada
         ?>
        <option value="<?php echo $row['nombre_corto']; ?>"><?php echo $row['nombre_corto']; ?></option>
        <?php
				}
				?>
			</select>		
      <input id="descargas" type="image" name="descargar" value="descargar" src="imagenes/descarga.png"  />	
	</form>
</div>
<?php 

}
?>
<br><br><br><br><br>
<!-- Tabla alumnos --> 
<?php
if (isset($_POST["año"])) {
?>
<?php
 $sql1 = "select id, nre, numero_expediente, curso_academico, concat_ws(' ', nombre, apellido1, apellido2) AS nombre, documento_identidad, numero_identidad, telefono, email from alumnos WHERE curso_academico LIKE'%" . $_POST['año'] . "%'";
 $result1 = mysqli_query($conexion, $sql1) or die("ERROR: " . mysqli_error($conexion)); 
     
         
}else{
  $sql1 = "select id, nre, numero_expediente, curso_academico, concat_ws(' ', nombre, apellido1, apellido2) AS nombre, documento_identidad, numero_identidad, telefono, email from alumnos";
      $result1 = mysqli_query($conexion, $sql1) or die("ERROR: " . mysqli_error($conexion));
}
    ?>
         
         <table id="example" class="display" style="width:90vw">
<thead>
    <tr> 
        <th>NRE</th>
        <th>Numero Expediente</th>
        <th>Curso</th>
        <th>Año del curso</th>
        <th>Nombre</th>
        <th>Documento Identidad</th>
        <th>Numero Identidad</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Historial</th>
    </tr>
    </thead>
    <tbody>
    <?php 
          while ($row1 = mysqli_fetch_array($result1)) {
        ?>       
        <tr> 
            <th><?php echo $row1['nre'] ; ?></th>
            <th><?php echo $row1['numero_expediente'] ; ?></th>
            <?php
            $sql10 = "select * from alumnos_ciclos WHERE alumnos_id = " . $row1['id'] ;
$result10 = mysqli_query($conexion, $sql10) or die("ERROR: " . mysqli_error($conexion));   
$row10 = mysqli_fetch_array($result10);
$idciclo = $row10['ciclos_id'];
$sql100 = "select id, nombre_corto from ciclos WHERE id = " . $idciclo;
$result100 = mysqli_query($conexion, $sql100) or die("ERROR: " . mysqli_error($conexion));   
$row100 = mysqli_fetch_array($result100);
?>
            <th><?php echo $row100['nombre_corto'] ; ?></th>
            <th><?php echo $row1['curso_academico'] ; ?></th>
            <th><?php echo $row1['nombre'] ; ?></th>
            <th><?php echo $row1['documento_identidad'] ; ?></th>
            <th><?php echo $row1['numero_identidad'] ; ?></th>
            <th><?php echo $row1['telefono'] ; ?></th>
            <th><?php echo $row1['email'] ; ?></th>
           <th><form method='get' action='historial.php?id="<?php $row1["id"] ?>"'>
           <input type='hidden' name='id' value='<?php echo $row1['id']?>'>
           <button type="submit">Acceder</button>
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

<?php
    mysqli_close($conexion);
?>