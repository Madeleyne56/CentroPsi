<?php
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email']; // Este es el correo que ingresa el usuario
    $telefono = $_POST['telefono'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io'; // Servidor SMTP de Mailtrap
        $mail->SMTPAuth = true;
        $mail->Username = 'b06e64f3604fdf'; // Usuario SMTP de Mailtrap
        $mail->Password = '0ee12cfea76b20'; // Contraseña SMTP de Mailtrap
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Protocolo seguro
        $mail->Port = 2525; // Puerto SMTP de Mailtrap

        // Destinatarios
        $mail->setFrom('madeleyne1023@gmail.com', 'Nombre Remitente');
        $mail->addAddress($email); // Envía el correo al email ingresado en el formulario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $asunto ?: 'Nuevo mensaje de contacto';
        $mail->Body    = "
            <strong>Nombre:</strong> $nombre<br>
            <strong>Email:</strong> $email<br>
            <strong>Teléfono:</strong> $telefono<br>
            <strong>Mensaje:</strong><br>$mensaje
        ";

        // Enviar el correo
        $mail->send();
        echo 'Mensaje enviado exitosamente.';
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
} else {
    echo "Método no permitido.";
}
?>
