<?php
include ("bd.php");
session_start();
include("seguridad.php");

//Variables del formulario Recibí
$id = $_POST['id'];
$persona = $_POST['persona'];
$dni = $_POST['dni'];
$usuario = $_SESSION['usuario'];
$alumno_recibi = 'si';

//Fecha actual 
$hoy = getdate();
$fecha = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];


//Consulta para sacar datos de la tabla Administrativos, de la cual necesitamos el id
$sql2 = "SELECT * FROM administrativos WHERE usuario LIKE '$usuario'";
$result2 = mysqli_query($conexion, $sql2);  
$row2 = mysqli_fetch_array($result2);

$id_usuario = $row2['id'];

//Consulta tabla certificados, de la cual estraemos el id del certificado relacionado con el recibi 
$sql1 = "select * from certificados where alumnos_id = " . $id;
$result = mysqli_query($conexion, $sql1);
$row = mysqli_fetch_array($result);

$id_certificado = $row['id'];

if ($_FILES["file"]["error"] > 0) {
    echo "ERROR subiendo fichero. El código del error es: " . $_FILES["file"]["error"] . "<br>";
		/* Codigos de error
		UPLOAD_ERR_OK: 0
		UPLOAD_ERR_INI_SIZE: 1
		UPLOAD_ERR_FORM_SIZE: 2
		UPLOAD_ERR_NO_TMP_DIR: 6
		UPLOAD_ERR_CANT_WRITE: 7
		UPLOAD_ERR_EXTENSION: 8
		UPLOAD_ERR_PARTIAL: 3
		*/
} else {
	// 1MB = 1048576 bytes
    echo "Nombre original del fichero: " . $_FILES["file"]["name"] . "<br>";
    echo "Tipo MIME: " . $_FILES["file"]["type"] . "<br>";
    echo "Tamaño: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";   //size da el tamaño en bytes
    echo "Nombre temporal del fichero: " . $_FILES["file"]["tmp_name"] . "<br>";
	
    //Consulta para alumnos 
    $sql3 = "select * from alumnos where id = " . $id;
    $result3 = mysqli_query($conexion, $sql3);
    $row3 = mysqli_fetch_array($result3);


    //Nombre con extension
    $consulta = $row3['nre'];
    $texto = ".pdf";
    $nre = $consulta.$texto;
    echo $nre;

	$sql = "UPDATE recibi SET fecha_recibi = '$fecha', escaneado_autorizacion = '$nre' WHERE certificados_id= $id_certificado";
    echo $sql . "<br/>";
    mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
	

	//Guardamos el documento recibi
	$recibi = "recibis_firmados/$nre";
	move_uploaded_file($_FILES["file"]["tmp_name"], $recibi);
	echo "Documento agregada correctamente.<br>";
	
    
	
}

mysqli_close($conexion);

header("Location: historial.php?id=" . $id);
?>