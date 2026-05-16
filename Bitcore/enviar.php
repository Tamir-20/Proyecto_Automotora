<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluimos las clases necesarias de PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Configuración SMTP para Gmail (desde tu correo personal)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tamirscocozza@gmail.com'; // tu correo personal
        $mail->Password = 'wrmm oskz ehyt bdbx';         // clave de aplicación de Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Opciones para XAMPP local (evita errores SSL)
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        // Remitente y destinatario
        $mail->setFrom('tamirscocozza@gmail.com', $nombre); // se ve el nombre del usuario
        $mail->addAddress('bitcoreoficial@gmail.com', 'Bitcore'); // a donde llega el correo

        // Contenido
        $mail->isHTML(false);
        $mail->Subject = "Nuevo mensaje desde el sitio Bitcore";
        $mail->Body = "Nombre: $nombre\nEmail: $email\nMensaje:\n$mensaje";

        $mail->send();
        echo "<h2>✅ ¡Mensaje enviado correctamente! Gracias, $nombre.</h2>";

    } catch (Exception $e) {
        echo "<h2>❌ Error al enviar el mensaje: {$mail->ErrorInfo}</h2>";
    }
}
?>
