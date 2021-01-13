<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . '/system/PHPMailer/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/PHPMailer/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/PHPMailer/SMTP.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

$body = '';//echo $body;
//exit();
try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->Host = 'smtp.gmail.com';
    //$mail->Host = 'smtp.agenstvnet.ru';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    //$mail->Port = 465;

    $mail->Username = 'koman1706@gmail.com'; // YOUR gmail email
    $mail->Password = '{f,fhjdcr 2011'; // YOUR gmail password
    //$mail->Username = 'admin@agenstvnet.ru'; // YOUR gmail email
    //$mail->Password = 'Kopass1987'; // YOUR gmail password
    // Sender and recipient settings
    $mail->setFrom('resko1987@mail.ru', 'ВКонтакте'); // samodinskaya1611@mail.ru
    $mail->addAddress('resko1987@mail.ru', 'ВКонтакте');
    $mail->addReplyTo('noreply@notify.vk.com', 'ВКонтакте'); // to set the reply to
    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "ВКонтакте восстановление страницы";
    $mail->Body = $body;
    //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

    $mail->send();
    echo "Email message sent.";
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}

//
