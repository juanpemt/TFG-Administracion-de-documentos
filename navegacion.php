<?php
function barra_navegacion() {
?>
<link rel='stylesheet' href='style_nav.css'>
<nav id='menu'>
  <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
  <ul>
    <li><a href='index.php' title="Inicio">Bienvenido/a <?php echo $_SESSION['usuario']?></a></li>
    <?php
    if ($_SESSION['usuario'] == "root") {
    ?>
    <li><a href='crear_administrador.php'>Crear Administrador</a></li>
    <?php 
    }
    ?>
    <?php
    if ($_SESSION['usuario'] == "root") {
    ?>
    <li><a class='dropdown-arrow'>Administracion</a>
      <ul class='sub-menus'>
        <li><a href='administrativos.php'>Administrativos</a></li>
        <li><a href='alumnos.php'>Alumnos</a></li>
        <li><a href='certificados.php'>Certificados</a></li>
        <li><a href='recibi.php'>Recibí</a></li>
        <li><a href='parametros.php'>Parametros</a></li>
        <li><a href='alumnos_ciclos.php'>Alumnos y Ciclos</a></li>
        <li><a href='ciclos.php'>Ciclos</a></li>
      </ul>
    </li>
    <li><a href='userhistorial.php'>Historial </a></li>
    <?php 
    }
    ?>
    <li><a href='sesion destroy.php'>Cerrar sesión </a></li>
  </ul>
</nav>

<?php
}
?>