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

    //Descargar recibi 
    $fileName = "Certificado_".$nre;
    $file = "certificados/".$nre;
    // Define headers
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/force-download");
        
    // Read the file
    readfile($file);

    }else{
        echo 'The file does not exist.';
    
}

mysqli_close($conexion);
?>