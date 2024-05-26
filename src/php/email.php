<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendVerificationEmail($userEmail, $token) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'mail.grupomapsen.com.mx';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('EMAIL');
        $mail->Password = getenv('EMAIL_PASSWORD');
        $mail->SMTPSecure = 'tls';
        $mail->Port = 465;

        // Remitente y destinatario
        $mail->setFrom(getenv('EMAIL'), 'e-Smart Programming');
        $mail->addAddress($userEmail);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Verificación de correo';
        $mail->Body    = 'Click <a href="https://pruebas.grupomapsen.com.mx/esp-costeo/src/php/verify.php?token=' . $token . '">here</a> to verify your email.';

        $mail->send();
        echo 'Correo de verificación enviado';
    } catch (Exception $e) {
        echo 'El mensaje no pudo ser enviado. Error del correo: ', $mail->ErrorInfo;
    }
}