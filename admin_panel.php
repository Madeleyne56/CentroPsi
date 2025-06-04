<?php
session_start();
if ($_SESSION['tipo_usuario'] != 'administrador') {
    header("Location: login.html");
    exit;
}

echo "<h2>Bienvenido al panel de Administrador</h2>";
?>
