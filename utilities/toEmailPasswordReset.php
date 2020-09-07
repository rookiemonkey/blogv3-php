<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    function toEmailPasswordReset($receiver, $token) {
        try {

            global $mail;
            
            // Server settings
            $mail->isSMTP();                                          // Send using SMTP
            $mail->Host       = EmailConfig::SMTP_HOST;               // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                 // Enable SMTP authentication
            $mail->Username   = EmailConfig::SMTP_USERNAME;           // SMTP username
            $mail->Password   = EmailConfig::SMTP_PASSWORD;           // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption;
            $mail->Port       = EmailConfig::SMTP_PORT;               // TCP port to connect to

            // Recipients
            $mail->setFrom(EmailConfig::SMTP_EMAIL, EmailConfig::SMTP_MAILER);
            $mail->addAddress($receiver);              

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->CharSet = 'UTF-8';                             // Set Char. Set to render non-english characters
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = '<p>Please click the reset button to reset your password: <a href="http://localhost:8000/cms/reset.php?email=' .$receiver.'&token='.$token.'"'.'>Reset</a></p>';


            // Send the Email
            $mail->send();

        } catch (Exception $e) {

            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }
?>