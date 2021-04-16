<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/system/PHPMailer/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/PHPMailer/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';

// Настройки SMTP
//$mail->isSMTP();
//$mail->SMTPAuth = true;
$mail->SMTPDebug = 1;

//$mail->SMTPOptions = array(
//    'ssl' => array(
//        'verify_peer' => false,
//        'verify_peer_name' => false,
//        'allow_self_signed' => true
//    )
//);

//$mail->Host = 'smtp.edgardzaycev.com';
//$mail->Port = 465;
//$mail->Username = 'info@edgardzaycev.com';
//$mail->Password = 'L2f6lernBsFZ';

// От кого
$mail->setFrom('info@edgardzaycev.com', 'edgardzaycev.com');

// Кому
$mail->addAddress('koman1706@gmail.com', 'Виктор Евгеньевич');

// Тема письма
$mail->Subject = 'Проверка';

// Тело письма
$body = '<p><strong>«Hello, world!» </strong></p>';
$mail->msgHTML($body);

// Приложение
//$mail->addAttachment(__DIR__ . '/image.jpg');


if ($mail->send()) {
    echo "Send";
} else {
    echo "NO!";
}



/*
 * zen.spamhaus.org
pbl.spamhaus.org
cbl.abuseat.org
b.barracudacentral.org
all.s5h.net
spambot.bls.digibase.ca
 * 
 * "v=spf1 +a +mx +ip4:10.128.0.10 ~all"
 */