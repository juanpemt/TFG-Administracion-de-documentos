<?php
ob_start();
session_start();
include("../bd.php");
include("../seguridad.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibí</title>
    <link rel="icon" href="logobohioreducido.png">
  <style>
    .p1 {
    height: 40px;
    text-align: center;
    font-size: 26px;
    line-height: 40px;
    font-weight: bolder;
  }

  .p2 {
    word-spacing: 14px;
    font-size: 25px;
    line-height: 45px;
  }
  .a1 {
    font-weight: bold;
  }
  .p3center{
  text-align: center;
  }
.afirmas {
margin-left:250px;
}
.afirmas1 {
margin-left:300px;
}

.aconceptos {
    line-height: 18px;
    font-size: 26px;
    margin-top: 0px;
}


  </style>
</head>
<body>
    <?php 
$post = $_POST['id'];
$Nautorizado = $_POST['nombreautorizado'];
$dniautorizado = $_POST['dniautorizado'];
$id_certificado = $_POST['certificado_id'];
// informacion de la tabla alumnos
$sql = "select * from alumnos where id = " . $_POST['id'];
$result = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));      
$row = mysqli_fetch_array($result);

//sacamos informacion de los parametros
$sql1 = "select * from parametros";
$result1 = mysqli_query($conexion, $sql1) or die("ERROR: " . mysqli_error($conexion));      
$row1 = mysqli_fetch_array($result1);

// 2 consultas para sacar datos tabla  ciclos
$sqldato = "SELECT * FROM alumnos_ciclos WHERE alumnos_ciclos.alumnos_id = " . $_POST['id'];
$resultdato = mysqli_query($conexion, $sqldato) or die("ERROR: " . mysqli_error($conexion));      
$rowdato = mysqli_fetch_array($resultdato);
$iddato = $rowdato['ciclos_id'];
$sql2 = "SELECT * FROM ciclos WHERE id = " . $iddato;
$result2 = mysqli_query($conexion, $sql2) or die("ERROR: " . mysqli_error($conexion));      
$row2 = mysqli_fetch_array($result2);

    $secretario= $row1['secretario'];
    $centro= $row1['centro'];
    $codigocentro= $row1['codigo_centro'];
    $direccion= $row1['direccion'];
    $cp= $row1['codigo_postal'];
    $municipio= $row1['municipio'];
    $apellido1= $row['apellido1'];
    $apellido2= $row['apellido2'];
    $nombre= $row['nombre'];
    $nre= $row['nre'];
    $exp= $row['numero_expediente'];
    $tipodoc= $row['documento_identidad'];
    $nif= $row['numero_identidad'];
    $mediosuperior= $row2['grado'];
    $descripcionestudio= $row2['nombre'];
    $localidad= $row1['localidad'];
    $director= $row1['director'];
   
$hoy = getdate();
// Para indicar el dia
// echo $hoy['mday'] ;

// Para indicar el mes
// echo $hoy['mon'] ;

// Para indicar el año
// echo $hoy['year'] ;
?> 
<div>
<img src="escudoCARM.png" width="60" height="95" style="margin-left: 5%; position:absolute;"/>
<br><br><br><br><br><br>
Región de Murcia<br>
Consejería de Educación
<br><br><br>
<p class="p1">RECIBÍ PERSONA AUTORIZADA</p>
<br>
<p class="p2">D./Dª. <?php echo $Nautorizado; ?>, con Documento de identificación
 nº <?php echo $dniautorizado; ?>, retira el certificado de 
Prevención de Riesgos Laborales de nivel Básico del alumno <?php echo $apellido1; ?> <?php echo $apellido2; ?>
 <?php echo $nombre; ?>, correspondiente al ciclo formativo de grado <?php echo $mediosuperior; ?> de  <?php echo $descripcionestudio; ?>.</p>
<br><br>
<p class="p3center"><?php echo $localidad; ?>, a <?php echo $hoy['mday'] ; ?> de <?php echo $hoy['mon'] ; ?> de <?php echo $hoy['year'] ; ?></p>
<br><br>
<p>Fdo.: _____________________________
</div>



</body>
</html>

<?php
$html=ob_get_clean();
//echo $html;

require_once '..\dompdf\autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set(array('isRemoteEnabled' => true));


$dompdf = new Dompdf($options);



$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
//$dompdf->setPaper('A4', 'landscape');
//  $dompdf->render();

//  $dompdf->stream("archivo_prueba.pdf", array("Attachment" => false));


//Donde guardar el documento

$rutaGuardado = "C:\\xampp\htdocs\\tfg-final\\recibis\\";
//Nombre del Documento.
$nombreArchivo = $row['nre'] . ".pdf";

//Renderiza el archivo primero
$dompdf->render();

//Guardalo en una variable
$output = $dompdf->output();

file_put_contents( $rutaGuardado.$nombreArchivo, $dompdf->output());


// esto hay que ponerlo para recibi
$varidalumno = $row['id'];
$sesion = $_SESSION['usuario'];
$sqlid = "select * from administrativos WHERE usuario LIKE '$sesion'";
$resultid = mysqli_query($conexion, $sqlid) or die("ERROR: " . mysqli_error($conexion));
$rowid = mysqli_fetch_array($resultid);
$idsesion = $rowid['id'];
$fecha = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];

 $idvarciclo = $row2['id'];
 $si = "si";

$sqlinsert = "INSERT INTO recibi (certificados_id, alumno_recibi,	escaneado_recibi, persona_autorizada, dni_autorizado,	administrativos_id) 
    VALUES ('" . $id_certificado . "','" . $si . "','" . $nombreArchivo .  "','" . $Nautorizado .  "','" . $dniautorizado .  "','" . $idsesion .  "')";
    echo $sqlinsert;
    mysqli_query($conexion, $sqlinsert) or die("ERROR: " . mysqli_error($conexion));
    

header("Location: ..\historial.php?id=" . $post);

mysqli_close($conexion);
?>