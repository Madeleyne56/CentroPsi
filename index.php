<?php
session_start();

// Verificar si el usuario es "paciente"
if ($_SESSION['tipo_usuario'] != 'paciente') {
    header("Location: login.html"); // Redirigir si no es paciente
    exit;
}

// Si es paciente, mostrar el mensaje de alerta y redirigir al HTML
echo "<script>
        alert('Bienvenido Paciente');
        window.location.href = 'index.html'; // Redirigir a la página principal HTML
      </script>";
?>

