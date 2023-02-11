<?php
session_start();
include("bd.php");
include("seguridad.php");
include ("navegacion.php");
include ("librerias.php");

$sql = "select * from alumnos where id = " . $_GET['id'];
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($result);

$id = $row['id'];
$nombre = $row['nombre'];
$apellido1 = $row['apellido1'];
$apellido2 = $row['apellido2'];
$nre = $row['nre'];
$expediente = $row['numero_expediente'];

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
<body>
    <div class="historialnavegacion">
<?php barra_navegacion(); ?> 
</div>
<h1><?php echo $nombre ?> <?php echo $apellido1 ?> <?php echo $apellido2?></h1>
<h2>NRE: <?php echo $nre ?></h2>
<h2>Expediente: <?php echo $expediente ?></h2>
<div id="div_certificados">
    <h2>Certificados</h2>
    <?php
    $sql1 = "select * from certificados where alumnos_id = " . $_GET['id'];
    $result1 = mysqli_query($conexion, $sql1);
    $row1 = mysqli_fetch_array($result1);
    
    
    //Comprobamos que no existe el certificado del alumno
    if (is_null($row1)) {
        
        ?>
        <div id="texto_certificados">
        <form method='post' action='pdf/paginapdf.php'>
        <input type='hidden' name='id' value='<?php echo $id ?>'>
        <label for="persona">No hay certificado: </label>
        <input type="submit" name="submit" value="Generar certificado"/>
        </form>
        </div>
        <br>
    <?php
    } else {
    $certificados_id = $row1['id'];
        ?>      
        <div id="texto_certificados">
        <form method='post' action='descargarcertificado.php'>
        <input type='hidden' name='id' value='<?php echo $id ?>'>
        <label for="id">Descargar Certificado: </label>
        <input type="submit" name="submit" value="Descargar"/>
        </form>
        </div>
        <br>
        <?php
        if (is_null($row1['escaneado_firmado'])) {
            $sql2 = "select * from recibi where certificados_id = " . $certificados_id;
            $result2 = mysqli_query($conexion, $sql2);
            $row2 = mysqli_fetch_array($result2);
          
        
        ?>
        <div id="texto_recibi">
        <fieldset style="width:500px">
        <form method='post' action='subir_certificado_firmado.php' enctype="multipart/form-data">
        <input type='hidden' name='id' value='<?php echo $id ?>'>
        <label for="file">Certificado Firmado: </label>
        <input name="file" name="file" id="file" onchange="return fileValidation()" type="file">
        <br>
        <br>
        <input type="submit" name="submit" value="Subir Certificado Firmado"/>
        <br>
        <br>
        </form>
        </fieldser>
        </div>
        <br>
        <?php
        } else {
        ?>
        <div id="texto_certificados">
        <form method='post' action='descargar_certificado_firmado.php'>
        <input type='hidden' name='id' value='<?php echo $id ?>'>
        <label for="id">Descargar Certificado Firmado: </label>
        <input type="submit" name="submit" value="Descargar"/>
        </form>
        </div>
        <br>
        <?php
        } 
        ?>
</div>
<br>

    <div id="div_recibi">
    <h2>Recibi</h2>
    <?php
         $sql2 = "select * from recibi where certificados_id = " . $certificados_id;
         $result2 = mysqli_query($conexion, $sql2);
         $row2 = mysqli_fetch_array($result2);
        if (is_null($row2)) {

        ?>
        <form action="#" method="post">
<input type="radio" name="radio" value="alumno">Recibí alumno</input>
<input type="radio" name="radio" value="autorizada">Persona autorizada</input>
<input type="submit" name="submit" value="Seleccionar"/>
</form><br>
        <?php
        if (isset($_POST["radio"])) {
          $varradio = $_POST["radio"];
          if ($varradio == 'alumno'){
              
                if (is_null($row2)) {
                ?>
                <br>
            <form method='post' action='pdf/recibialumnopdf.php'>
            <input type='hidden' name='id' value='<?php echo $id ?>'>
            <input type='hidden' name='certificado_id' value='<?php echo $certificados_id ?>'>
            <label for="persona">No hay recibí alumno: </label>
            <input type="submit" name="submit" value="Generar recibi"/>
            </form><br><br>
                <?php
                }
                ?>
            <?php
          }else{
            if (is_null($row2)) {
              
              ?>
              <br>
            <form method='post' action='pdf/recibiautorizadopdf.php'>
            <input type='hidden' name='id' value='<?php echo $id ?>'><br>
            <input type='hidden' name='certificado_id' value='<?php echo $certificados_id ?>'>
            <label for="persona">Nombre autorizado </label>
            <input type='text' name='nombreautorizado' value="" required><br><br>
            <label for="persona">DNI autorizado </label>
            <input type='text' name='dniautorizado' value="" required><br><br>
            <label for="persona">No hay recibí persona autorizada: </label>
            <input type="submit" name="submit" value="Generar recibi"/>
            </form>
            <br><br>
            <?php
            }
          }
        }
      } else {
        ?>
          <div id="texto_certificados">
        <form method='post' action='descargarrecibi.php'>
        <input type='hidden' name='id' value='<?php echo $id ?>'>
        <label for="id">Descargar Recibí: </label>
        <input type="submit" name="submit" value="Descargar"/>
        </form>
        </div>
        <br>
        <?php
        if (is_null($row2["escaneado_autorizacion"])) {
        ?>
        <div id="texto_recibi">
        <form method='post' action='subirrecibi.php' enctype="multipart/form-data">
        <input type='hidden' name='id' value='<?php echo $id ?>'>
        <label for="file">Recibí Firmado: </label>
        <input name="file" id="file2" onchange="return fileValidation2()" type="file">
        <br>
        <br>
        <input type="submit" name="submit" value="Subir Recibí Firmado"/>
        <br>
        <br>
        </form>
        </div>
        <br>
        <?php
        } else {
          ?>
          <div id="texto_certificados">
          <form method='post' action='descargarrecibi_firmados.php'>
          <input type='hidden' name='id' value='<?php echo $id ?>'>
          <label for="id">Descargar Recibí Firmado: </label>
          <input type="submit" name="submit" value="Descargar"/>
          </form>
          </div>
          <br> 
        <?php
        }
        ?>
        <?php
      }
      }
   ?>
    
</div>

</body>
<?php 
  include ("footer.php");
  ?>
</html>
<script> 
function fileValidation(){
  var fileInput = document.getElementById('file');
  var filePath = fileInput.value;
  var allowedExtensions = /(.pdf)$/i;
  if(!allowedExtensions.exec(filePath)){
      alert('Error el archivo no es PDF.');
      fileInput.value = '';
      return false;
  }
}

function fileValidation2(){
  var fileInput = document.getElementById('file2');
  var filePath = fileInput.value;
  var allowedExtensions = /(.pdf)$/i;
  if(!allowedExtensions.exec(filePath)){
      alert('Error el archivo no es PDF.');
      fileInput.value = '';
      return false;
  }
}
</script>