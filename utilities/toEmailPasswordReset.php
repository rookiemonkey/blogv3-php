<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';

    // Load custom configuration
    require '_config_email.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    function toEmailPasswordReset($receiver) {
        try {

            global $mail;
            
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
            $mail->isSMTP();                                          // Send using SMTP
            $mail->Host       = EmailConfig::SMTP_HOST;               // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                 // Enable SMTP authentication
            $mail->Username   = EmailConfig::SMTP_USERNAME;           // SMTP username
            $mail->Password   = EmailConfig::SMTP_PASSWORD;           // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption;
            $mail->Port       = EmailConfig::SMTP_PORT;               // TCP port to connect to

            //Recipients
            $mail->setFrom(EmailConfig::SMTP_EMAIL, EmailConfig::SMTP_MAILER);
            $mail->addAddress($receiver);              

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

            $mail->send();
            echo 'Message has been sent';
            
        } catch (Exception $e) {

            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }
?>