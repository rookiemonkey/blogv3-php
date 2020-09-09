<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require __DIR__ . '/../vendor/autoload.php';

    function toEmailContactRequest() {
        if(isset($_POST['submit_contact'])) {
            $subject = $_POST['subject'];
            $message =  $_POST['body'];
            $email = $_POST['email'];

            try {
                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);
                
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
                $mail->addAddress('kevinroirigorbasina@protonmail.com');              

                // Content
                $mail->isHTML(true);                                    // Set email format to HTML
                $mail->CharSet = 'UTF-8';                               // Set Char. Set to render non-english characters
                $mail->Subject = $subject;
                $mail->Body    = "<p>${message} Contact me on: ${email}</p>";

                // Send the Email
                $mail->send();

                // destroy the instance of the mail
                unset($mail);

                View::alert_Success('Successfully sent your contact request!');

            } 
            
            catch (Exception $e) {

                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

                View::alert_Failed('Something went wrong. Please try again later');

            }
        }
    }
?>