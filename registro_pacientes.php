<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena']; // Captura la contraseña sin hashear

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, usuario, correo, contrasena, tipo_usuario) VALUES (?, ?, ?, ?, 'paciente')";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute([$nombre, $usuario, $correo, $contrasena])) {
        echo "Registro exitoso. Tu contraseña es: $contrasena. <a href='login.html'>Inicia sesión aquí</a>";
    } else {
        echo "Error al registrarse. Inténtalo de nuevo.";
    }
}
?>
