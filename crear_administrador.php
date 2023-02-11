<?php 
session_start();
include("bd.php");
include("seguridad.php");
include ("navegacion.php");
include ("librerias.php");

if ($_SESSION['usuario'] == "root") {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagenes/logobohioreducido.png">
    <title>Crear Administrador</title>
    

<link rel='stylesheet' href='style.css'>
<link rel='stylesheet' href='stylereg.css'>
<!-- Librerias css y js -->
<?php librerias(); ?>
<body>
<!-- Navegador principal -->
<?php barra_navegacion(); ?>
<div class="centroFotos">
     <!--  buscador de productos  -->
<?php 

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
<div class="registro" id="flush">
  <form method="post" action="registrado.php">
    <h4 class="h4f">Formulario Registro</h4><br>
    <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese su Nombre" onkeypress="return soloLetras(event)" onpaste="return false" required>
    <input class="controls" type="text" name="apellido1" id="apellido1" placeholder="Primer apellido" onkeypress="return soloLetras(event)" onpaste="return false" >
    <input class="controls" type="text" name="apellido2" id="apellido2" placeholder="Segundo apellido apellido" onkeypress="return soloLetras(event)" onpaste="return false" >
    <input class="controls" type="text" name="usuario" id="usuario" placeholder="Ingrese nombre Usuario" onkeypress="return soloLetras(event)" onpaste="return false" required>
    <input class="controls" type="password" name="clave" id="clave" placeholder="Ingrese su Contraseña" required>
    <img class="capcha1" src="captcha/captcha.php" id="captcha" /><br/><br/>
    <input class="controls" placeholder="Rellene la imagen de arriba" type="text" name="captcha" autocomplete="off" /><br/>
    <input class="registrar" type="submit" onclick="nombrereg()" value="Registrar" style="cursor: pointer">
  </form>
</div>
</body>
<?php 
  include ("footer.php");
  ?>
</html>
<script>
 function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "abcdefghijklmnopqrstuvwxyz1234567890";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
			//document.frmcontactenos.nick.value="";			
            return false;
        }
    }
</script>
<?php 
    } else {
        header("Location: index.php");
    }
?>