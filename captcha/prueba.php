<?php 
session_start(); 


/** Validar captcha */
if (!empty($_POST['captcha'])) {
    if (empty($_SESSION['captcha']) || trim(strtolower($_POST['captcha'])) != $_SESSION['captcha']) {
        $mensaje = "Captcha no válido";
        $style = "background-color: red";
    } else {
        $mensaje = "Captcha válido";
        $style = "background-color: green";
    }

    $post_captcha = htmlspecialchars($_POST['captcha']);

?>
        <div id="result" style="<?php echo $style; ?>">
        <h2><?php echo $mensaje; ?></h2>
        <table>
        <tr>
            <td>CAPTCHA de la imagen:</td>
            <td><?php echo $_SESSION['captcha']; ?></td>
        </tr>
        <tr>
            <td>CAPTCHA tecleado por usted:</td>
            <td><?php echo $post_captcha; ?></td>
        </tr>
        </table>
        </div>
<?php
    unset($_SESSION['captcha']);
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
<title>Tienda CLON PCCOMPONENTES</title>
<meta charset="utf-8" />
</head>
<body>
<img src="captcha.php" id="captcha" /><br/>
<form method="POST" action="prueba.php">
Teclee texto de la imagen
<input type="text" name="captcha" autocomplete="off" /><br/>
<input type="submit" />

</form>
</body>
</html>