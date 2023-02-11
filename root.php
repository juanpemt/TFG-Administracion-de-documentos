<?php
if ($_SESSION['usuario'] != "root") {
    header("Location: index.php");
}

?>