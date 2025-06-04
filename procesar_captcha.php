<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $captcha = $_POST['g-recaptcha-response'];
    
   
    if (!$captcha) {
        echo 'Por favor, completa el captcha.';
        exit;
    }

    $secretKey = '6LcxumAqAAAAAMOhYXCPccwiTKlnACI_Oa_a6CBF';  // Reemplaza con tu clave secreta
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    if ($responseKeys['success']) {
        echo 'Captcha verificado exitosamente.';
        header('Location: incio2.html');
        exit();
    } else {
        echo 'Error en la verificación del Captcha. Inténtalo de nuevo.';
    }
} else {
    echo 'Método no permitido.';
}
?>

?>
