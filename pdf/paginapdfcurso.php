<?php  
require_once '..\dompdf\autoload.inc.php';
 use Dompdf\Dompdf;
 use Dompdf\Options;
session_start();
include("../bd.php");
include("../seguridad.php");

$postnombre = $_POST['ciclos'];
$postvaraño = $_POST['varaño'];
$sqly = "select * from ciclos where nombre_corto = '" . $postnombre . "'";
$resulty = mysqli_query($conexion, $sqly) or die("ERROR: " . mysqli_error($conexion)); 
$rowy = mysqli_fetch_array($resulty);
$idciclo = $rowy['id'];
$sqlinsert = "Select alumnos.id from alumnos 
INNER JOIN alumnos_ciclos ON alumnos_ciclos.alumnos_id = alumnos.id 
INNER JOIN ciclos ON ciclos.id = alumnos_ciclos.ciclos_id WHERE alumnos.curso_academico =" . $postvaraño . " AND ciclos.id =" . $idciclo;
$resultinsert = mysqli_query($conexion, $sqlinsert) or die("ERROR: " . mysqli_error($conexion));     

while ($rowinsert = mysqli_fetch_array($resultinsert)){

  ob_start();
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
  $post = $rowinsert['id'];
  // informacion de la tabla alumnos
  $sql = "select * from alumnos where id = " . $rowinsert['id'];
  $result = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));      
  $row = mysqli_fetch_array($result);
  
  //sacamos informacion de los parametros
  $sql1 = "select * from parametros";
  $result1 = mysqli_query($conexion, $sql1) or die("ERROR: " . mysqli_error($conexion));      
  $row1 = mysqli_fetch_array($result1);
  
  // 2 consultas para sacar datos tabla  ciclos
  $sqldato = "SELECT * FROM alumnos_ciclos WHERE alumnos_ciclos.alumnos_id = " . $rowinsert['id'];
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
  <img src="issl.jpg" width="131" height="106" style="margin-left: 80%; position:absolute;"/>
  <br><br><br><br><br><br>
  Región de Murcia<br>
  Consejería de Educación
  <br>
  <p class="p1">CERTIFICACIÓN DE NIVEL BÁSICO EN PREVENCIÓN DE RIESGOS LABORALES</p>
  
  <p class="p2">D./Dª. <?php echo $secretario; ?>, Secretario o Titular del centro <?php echo $centro; ?>, Código del centro <?php echo $codigocentro; ?>. Dirección <?php echo $direccion; ?> Código Postal <?php echo $cp; ?> Municipio <?php echo $municipio; ?>.</p>
  
  <p class="p1">CERTIFICA</p>
  
  <p class="p2">Que el alumno D./Dª. <?php echo $apellido1; ?>  <?php echo $apellido2; ?>, <?php echo $nombre; ?>, con números de NRE <?php echo $nre; ?> expediente <?php echo $exp; ?>, y <?php echo $tipodoc; ?> nº <?php echo $nif; ?>, 
  ha superado la formación del módulo profesional de formación y orientación laboral del ciclo formativo de grado <?php echo $mediosuperior; ?> de  <?php echo $descripcionestudio; ?>,
   que según lo establecido en el R.D. 127/2014, de 28 de febrero, le capacita para llevar a cabo responsabilidades profesionales equivalentes a las que precisan 
   las actividades de <a class="a1">NIVEL BÁSICO EN PREVENCIÓN DE RIESGOS LABORALES</a>, establecidas en el R.D.39/1997, de 17 de enero, por el que se aprueba el Reglamento de los 
   Servicios de Prevención, con la duración y contenidos que se especifican en el reverso de la presente certificación.</p>
  <br>
  <p class="p3center">Y, para que conste y surta los efectos oportunos, expido el presente certificado en</p>
  
  <p class="p3center"><?php echo $localidad; ?>, a <?php echo $hoy['mday'] ; ?> de <?php echo $hoy['mon'] ; ?> de <?php echo $hoy['year'] ; ?></p>
  
  <p>Vº Bº El/La Director/a del centro <a class="afirmas">El/La Secretario/a del centro</a></p><br><br><br><br>
  
  <p>Fdo.: <?php echo $director; ?>     <a class="afirmas1">                  Fdo.: <?php echo $secretario; ?></a></p>
  
  <br>
  <p class="p1">Módulo Profesional: Formación y orientación laboral</p>
  <p class="p3center">(Contenidos impartidos referentes a la Prevención de Riesgos Laborales)</p>
  
  <p>Duración: <a class="a1">50 horas.</a></p>
  
  <p><a class="a1" >I.- Conceptos básicos sobre seguridad y salud en el trabajo:</a></p>
  <p class="aconceptos"> a) &nbsp; El trabajo y la salud: Valoración de la relación entre trabajo y salud. Los riesgos profesionales.<br>
   b)  &nbsp; La evaluación de riesgos en la empresa como elemento básico de la actividad preventiva.<br>
      c) &nbsp; Determinación de los posibles daños a la salud del trabajador que pueden derivarse de las &nbsp; &nbsp; &nbsp;  &nbsp; 
      &nbsp; &nbsp; &nbsp; &nbsp;  situaciones de riesgo detectadas.<br>
      d)&nbsp; Accidentes de trabajo y enfermedades profesionales. Otras patologías derivadas del trabajo.<br>
      e) &nbsp; La siniestralidad laboral en España y en la Región de Murcia.<br>
      f) &nbsp; Marco normativo básico en materia de prevención de riesgos laborales. Ley de Prevención de  
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Riesgos Laborales y principales reglamentos de desarrollo.</p>
  
     <p> <a class="a1" >II.- Riesgos generales y su prevención:</a></p>
  <p class="aconceptos">    a) &nbsp;  Análisis de riesgos ligados a las condiciones de seguridad.<br>
      b) &nbsp;  Análisis de riesgos ligados a las condiciones ambientales.<br>
      c) &nbsp;  Análisis de riesgos ligados a las condiciones ergonómicas y psico-sociales.<br>
      d) &nbsp;  La carga de trabajo, la fatiga y la insatisfacción laboral.<br>
      e) &nbsp;  Sistemas elementales de control de riesgos. Protección colectiva e individual.</p>
  
     <p> <a class="a1" >III.- Riesgos específicos y su prevención en la familia profesional del ciclo formativo:</a></p>
  <p class="aconceptos">    a) &nbsp; Riesgos ligados a las condiciones de seguridad.<br>
      b) &nbsp;  Riesgos ligados a condiciones ambientales de trabajo.<br>
      c) &nbsp; Condiciones de trabajo y riesgos específicos en el sector profesional en el que se ubica el título.<br>
      d) &nbsp;  La carga de trabajo, la fatiga y la insatisfacción laboral.</p>
  
      <p><a class="a1" >IV.- Elementos básicos de gestión de la prevención de riesgos:</a></p>
  <p class="aconceptos">    a) &nbsp; Organismos públicos relacionados con la prevención de riesgos laborales.
  Organización del  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; trabajo preventivo: La cultura preventiva en la empresa. Gestión de la prevención en la empresa.
  &nbsp; &nbsp; &nbsp; Modalidades de organización preventiva. La gestión de la prevención en una pyme relacionada &nbsp; &nbsp; &nbsp; &nbsp; con el ciclo formativo.
  Planes de emergencia y de evacuación en entornos de trabajo. &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;
  &nbsp; &nbsp; &nbsp; &nbsp; Elaboración de un plan de emergencia en una empresa del sector.
  Representación de los &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
  &nbsp; &nbsp; &nbsp; &nbsp; trabajadores en materia preventiva. Responsabilidades en materia de prevención de riesgos &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; laborales.<br>
      c) &nbsp; Documentación de la prevención en la empresa: El Plan de Prevención de riesgos laborales. La &nbsp; &nbsp; &nbsp; &nbsp; evaluación de riesgos. Planificación de
       la prevención en la empresa. Notificación y registro de &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; accidentes de trabajo y enfermedades profesionales.
        Principales índices estadísticos de  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; siniestralidad. El control de la salud de los trabajadores.<br>
      d) &nbsp; Derechos y deberes en materia de prevención de riesgos laborales. Funciones del nivel básico de  
      &nbsp; &nbsp; &nbsp; prevención de riesgos laborales.<br>
      e) &nbsp; Determinación de las medidas de prevención y protección individual y colectiva. Señalización  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; de seguridad.<br>
      f) &nbsp; Protocolo de actuación ante una situación de emergencia. Simulacros </p>
  
      <p class="a1" >V.- Primeros auxilios.</p> 
  
  
  </div>
  
  
  
  </body>
  </html>
  
  <?php
  $html=ob_get_clean();
  //echo $html;
   
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
      mysqli_query($conexion, $sqlinsert) or die("ERROR: " . mysqli_error($conexion));
      
}
  header("Location: ..\index.php");
  mysqli_close($conexion);

  ?>


