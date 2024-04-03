<?php
session_start();

require __DIR__ . "/../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['captcha_code'])) {
    // Redirigez l'utilisateur vers la page de formulaire avec un message d'erreur
    header('Location: /portfoliofin/index.php?error=captcha');
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$captcha = $_POST['captcha'];

if ($captcha === $_SESSION['captcha_code']) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'ssl0.ovh.net';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contact@vosoft.fr';
        $mail->Password   = 'k/u49pGUU2su&=p';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('contact@vosoft.fr', 'Sender Name');
        $mail->addAddress('srko.dj@gmail.com', 'Recipient Name');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Name: {$name}<br>Email: {$email}<br>Message: {$message}";

        $mail->send();
        $status = 'success';
        $title = 'Message has been sent';
        unset($_SESSION['captcha_code']);
    } catch (Exception $e) {
        $status = 'error';
        $title = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    header('Location: /portfoliofin/php/notification.php?status=' . urlencode($status) . '&title=' . urlencode($title));
} else {
    $status = 'error';
    $title = 'Captcha code is incorrect';
    header('Location: /portfoliofin/index.php?error=captcha');
}
?>
