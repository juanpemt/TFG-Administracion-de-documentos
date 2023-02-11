<?php
include ("bd.php");
session_start();

//Consulta para alumnos 
$sql3 = "select * from alumnos where id = " . $_POST['id'];
$result3 = mysqli_query($conexion, $sql3);
$row3 = mysqli_fetch_array($result3);


//Nombre con extension
$consulta = $row3['nre'];
$texto = ".pdf";
$nre = $consulta.$texto;

echo $nre;


if(isset($_POST['id'])){

    //Descargar documentacion autorizado
    $fileName2 = "Autorizado_".$nre;
    $file2 = "documentos_autorizado/".$nre;
    // Define headers
    header("Content-Disposition: attachment; filename=\"$fileName2\"");
    header("Content-Type: application/force-download");
            
    // Read the file
    readfile($file2);

    }else{
        echo 'The file does not exist.';
    
}

mysqli_close($conexion);
?>