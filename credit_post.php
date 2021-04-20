<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';

$send_emails = new \project\send_emails();



echo "POST: ";
print_r($_POST);

echo "<br/>\n";
echo "GET: ";
print_r($_GET);
echo "<br/>\n";

if (isset($_GET['constants']) && $_GET['constants'] == 'SUCCESS') {
    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; //DEBUG_SERVER; // for detailed debug output
        //$mail->isSMTP();
        $mail->CharSet = "UTF-8";
        //$mail->Host = 'smtp.gmail.com';
        //$mail->Host = 'smtp.edgardzaycev.com';
        //$mail->SMTPAuth = true;
        $mail->SMTPDebug = 0;
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //$mail->Port = 587; // google
        //$mail->Port = 465;
        //$mail->Username = $user_info['user_email']; // YOUR gmail email
        //$mail->Password = $user_info['user_password']; // YOUR gmail password
        //$mail->Username = 'admin@agenstvnet.ru'; // YOUR gmail email
        //$mail->Password = 'Kopass1987'; // YOUR gmail password
        // Sender and recipient settings
        $mail->setFrom('info@edgardzaycev.com', 'info@edgardzaycev.com'); // samodinskaya1611@mail.ru
        $mail->addAddress('koman1706@gmail.com', 'info@edgardzaycev.com');
        $mail->addReplyTo($email_info['email_reply_to'], $email_info['email_subject']); // to set the reply to
        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = 'Тиньков оплата SUCCESS';
        $mail->Body = 'Тиньков оплата SUCCESS';
        //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
        $return = $mail->send();
        if (!$return) {
            $_SESSION['errors'][] = $mail->ErrorInfo;
            echo "{$mail->ErrorInfo} <br/>\n";
        }
    } catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; //DEBUG_SERVER; // for detailed debug output
        //$mail->isSMTP();
        $mail->CharSet = "UTF-8";
        //$mail->Host = 'smtp.gmail.com';
        //$mail->Host = 'smtp.edgardzaycev.com';
        //$mail->SMTPAuth = true;
        $mail->SMTPDebug = 0;
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //$mail->Port = 587; // google
        //$mail->Port = 465;
        //$mail->Username = $user_info['user_email']; // YOUR gmail email
        //$mail->Password = $user_info['user_password']; // YOUR gmail password
        //$mail->Username = 'admin@agenstvnet.ru'; // YOUR gmail email
        //$mail->Password = 'Kopass1987'; // YOUR gmail password
        // Sender and recipient settings
        $mail->setFrom('info@edgardzaycev.com', 'info@edgardzaycev.com'); // samodinskaya1611@mail.ru
        $mail->addAddress('koman1706@gmail.com', 'info@edgardzaycev.com');
        $mail->addReplyTo($email_info['email_reply_to'], $email_info['email_subject']); // to set the reply to
        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = 'Тиньков оплата CANCEL';
        $mail->Body = 'Тиньков оплата CANCEL';
        //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
        $return = $mail->send();
        if (!$return) {
            $_SESSION['errors'][] = $mail->ErrorInfo;
            echo "{$mail->ErrorInfo} <br/>\n";
        }
    } catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}