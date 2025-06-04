<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar reCAPTCHA
    $secretKey = "6LcP8mMqAAAAAAeFnaoKJTGad09ow8Qv1lvajJci";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);

    
    if (intval($responseKeys["success"]) !== 1) {
        echo "<script>alert('Verificación de reCAPTCHA fallida. Intenta nuevamente.'); window.history.back();</script>";
        exit; 
    }

    
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

   
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    
    if ($user) {
        
        if ($contrasena === $user['contrasena']) { 
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

           
            if ($user['tipo_usuario'] == 'admin') {
                header("Location: index1.php"); 
            } elseif ($user['tipo_usuario'] == 'administrador') {
                header("Location: administracion1.php"); 
            } elseif ($user['tipo_usuario'] == 'psicologo') {
                header("Location: index1.php"); 
            }
        } else {
            
            echo "Contraseña incorrecta.";
        }
    } else {
        // Si no se encuentra el usuario
        echo "Usuario no encontrado.";
    }
}
?>
