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
    <title>Certificado</title>
    <link rel="icon" href="logobohioreducido.png">
  <style>
    .p1 {
    height: 40px;
    text-align: center;
    font-size: 18px;
    line-height: 40px;
    font-weight: bolder;
  }

  .p2 {
    word-spacing: 14px;
    font-size: 17px;
    line-height: 25px;
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
margin-left:230px;
}

.aconceptos {
    line-height: 18px;
    font-size: 18px;
    margin-top: 0px;
}

  </style>
</head>
<body>
    <?php 
$post = $_POST['id'];
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

// Para indicar el a??o
// echo $hoy['year'] ;
?> 
<div>
<img src="escudoCARM.png" width="60" height="95" style="margin-left: 5%; position:absolute;"/>
<img src="issl.jpg" width="131" height="106" style="margin-left: 80%; position:absolute;"/>
<br><br><br><br><br><br>
Regi??n de Murcia<br>
Consejer??a de Educaci??n
<br>
<p class="p1">CERTIFICACI??N DE NIVEL B??SICO EN PREVENCI??N DE RIESGOS LABORALES</p>

<p class="p2">D./D??. <?php echo $secretario; ?>, Secretario o Titular del centro <?php echo $centro; ?>, C??digo del centro <?php echo $codigocentro; ?>. Direcci??n <?php echo $direccion; ?> C??digo Postal <?php echo $cp; ?> Municipio <?php echo $municipio; ?>.</p>

<p class="p1">CERTIFICA</p>

<p class="p2">Que el alumno D./D??. <?php echo $apellido1; ?>  <?php echo $apellido2; ?>, <?php echo $nombre; ?>, con n??meros de NRE <?php echo $nre; ?> expediente <?php echo $exp; ?>, y <?php echo $tipodoc; ?> n?? <?php echo $nif; ?>, 
ha superado la formaci??n del m??dulo profesional de formaci??n y orientaci??n laboral del ciclo formativo de grado <?php echo $mediosuperior; ?> de  <?php echo $descripcionestudio; ?>,
 que seg??n lo establecido en el R.D. 127/2014, de 28 de febrero, le capacita para llevar a cabo responsabilidades profesionales equivalentes a las que precisan 
 las actividades de <a class="a1">NIVEL B??SICO EN PREVENCI??N DE RIESGOS LABORALES</a>, establecidas en el R.D.39/1997, de 17 de enero, por el que se aprueba el Reglamento de los 
 Servicios de Prevenci??n, con la duraci??n y contenidos que se especifican en el reverso de la presente certificaci??n.</p>
<br>
<p class="p3center">Y, para que conste y surta los efectos oportunos, expido el presente certificado en</p>

<p class="p3center"><?php echo $localidad; ?>, a <?php echo $hoy['mday'] ; ?> de <?php echo $hoy['mon'] ; ?> de <?php echo $hoy['year'] ; ?></p>

<p>V?? B?? El/La Director/a del centro <a class="afirmas">El/La Secretario/a del centro</a></p><br><br><br><br>

<p>Fdo.: <?php echo $director; ?>     <a class="afirmas1">                  Fdo.: <?php echo $secretario; ?></a></p>

<br>
<p class="p1">M??dulo Profesional: Formaci??n y orientaci??n laboral</p>
<p class="p3center">(Contenidos impartidos referentes a la Prevenci??n de Riesgos Laborales)</p>

<p>Duraci??n: <a class="a1">50 horas.</a></p>

<p><a class="a1" >I.- Conceptos b??sicos sobre seguridad y salud en el trabajo:</a></p>
<p class="aconceptos"> a) &nbsp; El trabajo y la salud: Valoraci??n de la relaci??n entre trabajo y salud. Los riesgos profesionales.<br>
 b)  &nbsp; La evaluaci??n de riesgos en la empresa como elemento b??sico de la actividad preventiva.<br>
    c) &nbsp; Determinaci??n de los posibles da??os a la salud del trabajador que pueden derivarse de las &nbsp; &nbsp; &nbsp;  &nbsp; 
    &nbsp; &nbsp; &nbsp; &nbsp;  situaciones de riesgo detectadas.<br>
    d)&nbsp; Accidentes de trabajo y enfermedades profesionales. Otras patolog??as derivadas del trabajo.<br>
    e) &nbsp; La siniestralidad laboral en Espa??a y en la Regi??n de Murcia.<br>
    f) &nbsp; Marco normativo b??sico en materia de prevenci??n de riesgos laborales. Ley de Prevenci??n de  
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Riesgos Laborales y principales reglamentos de desarrollo.</p>

   <p> <a class="a1" >II.- Riesgos generales y su prevenci??n:</a></p>
<p class="aconceptos">    a) &nbsp;  An??lisis de riesgos ligados a las condiciones de seguridad.<br>
    b) &nbsp;  An??lisis de riesgos ligados a las condiciones ambientales.<br>
    c) &nbsp;  An??lisis de riesgos ligados a las condiciones ergon??micas y psico-sociales.<br>
    d) &nbsp;  La carga de trabajo, la fatiga y la insatisfacci??n laboral.<br>
    e) &nbsp;  Sistemas elementales de control de riesgos. Protecci??n colectiva e individual.</p>

   <p> <a class="a1" >III.- Riesgos espec??ficos y su prevenci??n en la familia profesional del ciclo formativo:</a></p>
<p class="aconceptos">    a) &nbsp; Riesgos ligados a las condiciones de seguridad.<br>
    b) &nbsp;  Riesgos ligados a condiciones ambientales de trabajo.<br>
    c) &nbsp; Condiciones de trabajo y riesgos espec??ficos en el sector profesional en el que se ubica el t??tulo.<br>
    d) &nbsp;  La carga de trabajo, la fatiga y la insatisfacci??n laboral.</p>

    <p><a class="a1" >IV.- Elementos b??sicos de gesti??n de la prevenci??n de riesgos:</a></p>
<p class="aconceptos">    a) &nbsp; Organismos p??blicos relacionados con la prevenci??n de riesgos laborales.
Organizaci??n del  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
&nbsp; &nbsp; trabajo preventivo: La cultura preventiva en la empresa. Gesti??n de la prevenci??n en la empresa.
&nbsp; &nbsp; &nbsp; Modalidades de organizaci??n preventiva. La gesti??n de la prevenci??n en una pyme relacionada &nbsp; &nbsp; &nbsp; &nbsp; con el ciclo formativo.
Planes de emergencia y de evacuaci??n en entornos de trabajo. &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp; Elaboraci??n de un plan de emergencia en una empresa del sector.
Representaci??n de los &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp; trabajadores en materia preventiva. Responsabilidades en materia de prevenci??n de riesgos &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; laborales.<br>
    c) &nbsp; Documentaci??n de la prevenci??n en la empresa: El Plan de Prevenci??n de riesgos laborales. La &nbsp; &nbsp; &nbsp; &nbsp; evaluaci??n de riesgos. Planificaci??n de
     la prevenci??n en la empresa. Notificaci??n y registro de &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; accidentes de trabajo y enfermedades profesionales.
      Principales ??ndices estad??sticos de  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; siniestralidad. El control de la salud de los trabajadores.<br>
    d) &nbsp; Derechos y deberes en materia de prevenci??n de riesgos laborales. Funciones del nivel b??sico de  
    &nbsp; &nbsp; &nbsp; prevenci??n de riesgos laborales.<br>
    e) &nbsp; Determinaci??n de las medidas de prevenci??n y protecci??n individual y colectiva. Se??alizaci??n  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; de seguridad.<br>
    f) &nbsp; Protocolo de actuaci??n ante una situaci??n de emergencia. Simulacros </p>

    <p class="a1" >V.- Primeros auxilios.</p> 


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

$rutaGuardado = "C:\\xampp\htdocs\\tfg-final\\certificados\\";
//Nombre del Documento.
$nombreArchivo = $row['nre'] . ".pdf";

//Renderiza el archivo primero
$dompdf->render();

//Guardalo en una variable
$output = $dompdf->output();

file_put_contents( $rutaGuardado.$nombreArchivo, $dompdf->output());

$varidalumno = $row['id'];
$sesion = $_SESSION['usuario'];
$sqlid = "select * from administrativos WHERE usuario LIKE '$sesion'";
$resultid = mysqli_query($conexion, $sqlid) or die("ERROR: " . mysqli_error($conexion));
$rowid = mysqli_fetch_array($resultid);
$idsesion = $rowid['id'];
$fecha = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];

 $idvarciclo = $row2['id'];

$sqlinsert = "INSERT INTO certificados (usuario_crea_id, fecha_creacion, certificado,	alumnos_id,	ciclos_id) 
    VALUES ('" . $idsesion . "','" . $fecha ."','" . $nombreArchivo . "','" . $varidalumno .  "','" . $idvarciclo .  "')";
    echo $sqlinsert;
    mysqli_query($conexion, $sqlinsert) or die("ERROR: " . mysqli_error($conexion));
    

header("Location: ..\historial.php?id=" . $post);

mysqli_close($conexion);
?>