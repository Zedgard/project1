<?php

$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Дополнительные заголовки
//$headers .= "To: <{$to_email}>\r\n";
$headers .= "From: <koman1706@gmail.com>\r\n";
//$headers[] = 'Cc: birthdayarchive@example.com';
//$headers[] = 'Bcc: birthdaycheck@example.com';
// Отправляем
$return = mail('koman1706@gmail.com', 'email_subject', 'test 1', $headers);
