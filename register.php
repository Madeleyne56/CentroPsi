<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta SQL para encontrar al usuario por el nombre de usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    // Verificación si el usuario existe
    if ($user) {
        // Comparar directamente la contraseña en texto plano
        if ($contrasena == $user['contrasena']) { // Cambiado para no usar password_verify
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

            // Redirigir según el tipo de usuario
            if ($user['tipo_usuario'] == 'paciente') {
                header("Location: index.php"); // Página principal
            } elseif ($user['tipo_usuario'] == 'administrador') {
                header("Location: admin_panel.php"); // Panel de administrador
            } elseif ($user['tipo_usuario'] == 'psicologo') {
                header("Location: psicologo_panel.php"); // Panel de psicólogo
            }
        } else {
            // Si la contraseña no es correcta
            echo "Contraseña incorrecta.";
        }
    } else {
        // Si no se encuentra el usuario
        echo "Usuario no encontrado.";
    }
}
?>
