<?php
session_start();
if ($_SESSION['tipo_usuario'] != 'psicologo') {
    header("Location: login.html");
    exit;
}

echo "<h2>Bienvenido al panel de Psicólogo</h2>";
?>
