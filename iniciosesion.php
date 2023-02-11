<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagenes/logobohioreducido.png">
    <title>IES Bohío</title>
    <link rel='stylesheet' href='styleinicio.css'>
    
</head>

<body>
  <div class="registro">
<form method="post" action="index.php">
<h4 class="h4">LOGIN</h4><br>
            <label>
              <input class="controls" type="text" name="usuario" id="usuario" placeholder="Usuario" onkeypress="return soloLetras(event)" onpaste="return false" required>
            </label>
            <label>
              <input class="controls" type="password" name="pass" id="pass" placeholder="Contraseña"/>
            </label>
            <button class="registrar" type="submit" id="enviar" class="enviar"><b>Entrar</b></button>
          </form>
</div>
</body>
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
</html>