<?php
session_start();
include("..\bd.php");
include("..\seguridad.php");

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


// Creamos un instancia de la clase ZipArchive
$zip = new ZipArchive();
// Creamos y abrimos un archivo zip temporal
 $zip->open("miarchivo.zip",ZipArchive::CREATE);
 // Añadimos un directorio

while ($rowinsert = mysqli_fetch_array($resultinsert)){
//Consulta para alumnos 
$sql3 = "select * from alumnos where id = " . $rowinsert['id'];
$result3 = mysqli_query($conexion, $sql3);
$row3 = mysqli_fetch_array($result3);


//Nombre con extension
$consulta = $row3['nre'];
$texto = ".pdf";
$nre = $consulta.$texto;


 // Añadimos un archivo en la raid del zip.
 $zip->addFile($nre,$nre);

}
// Una vez añadido los archivos deseados cerramos el zip.
$zip->close();
ob_clean();
// Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
header("Content-type: application/octet-stream");
header("Content-disposition: attachment; filename=miarchivo.zip");
// leemos el archivo creado
readfile('miarchivo.zip');
// Por último eliminamos el archivo temporal creado
unlink('miarchivo.zip');//Destruye el archivo temporal

mysqli_close($conexion);


?>