<?php

//echo "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}<br/>\n";
header('Content-Type: application/json');

$h = file_get_contents('https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=Hx_NMiail28&format=json');
echo $h;
//print_r($_SERVER);

//var_dump(mail('koman1706@gmail.com', 'тема', 'сообщение', 'Заголовок'));

//$to      = 'koman1706@gmail.com';
//$subject = 'the subject';
//$message = 'hello';
//$headers = 'From: hello@edgardzaycev.com' . "\r\n" .
//    'Reply-To: hello@edgardzaycev.com' . "\r\n" .
//    'X-Mailer: PHP/' . phpversion();
//
//var_dump(mail($to, $subject, $message, $headers));