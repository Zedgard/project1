<?php

ob_start();
print_r($_GET);
$get_str = ob_get_clean();

ob_start();
print_r($_POST);
$post_str = ob_get_clean();

ob_start();
print_r($_ENV);
$env_str = ob_get_clean();

ob_start();
print_r($_REQUEST);
$req_str = ob_get_clean();

if (isset($_GET['constants'])) {
    switch ($_GET['constants']) {
        case 'HUK':
            mail('koman1706@gmail.com', 'Оплата тинькоф HUK6', "GET: {$get_str}\n POST: {$post_str}\n ENV: {$env_str}\n REQUEST: {$req_str}\n");
            break;
        case 'SUCCESS':
            mail('koman1706@gmail.com', 'Оплата тинькоф SUCCESS', 'Оплата тинькф SUCCESS ' . "GET: {$get_str}\n POST: {$post_str}\n ENV: {$env_str}\n REQUEST: {$req_str}\n");
            break;
        case 'CANCEL':
            mail('koman1706@gmail.com', 'Оплата тинькоф CANSEL', 'Оплата тинькф CANCEL' . "GET: {$get_str}\n POST: {$post_str}\n ENV: {$env_str}\n REQUEST: {$req_str}\n");
            break;
        default:
            mail('koman1706@gmail.com', 'Оплата тинькоф defailt', 'Оплата тинькф defailt' . "GET: {$get_str}\n POST: {$post_str}\n ENV: {$env_str}\n REQUEST: {$req_str}\n");
            break;
    }
    $site_url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['SERVER_NAME'];
    header('Location: ' . $site_url);
//    if ($_GET['constants'] == 'HUK') {
//        //echo "GET: {$get_str}\n POST: {$post_str}\n";
//        mail('koman1706@gmail.com', 'Оплата тинькф HUK6', "GET: {$get_str}\n POST: {$post_str}\n ENV: {$env_str}\n REQUEST: {$req_str}\n");
//    } else {
//        if ($_GET['constants'] == 'SUCCESS') {
//            mail('koman1706@gmail.com', 'Оплата тинькф SUCCESS', 'Оплата тинькф SUCCESS ' . "GET: {$get_str}\n POST: {$post_str}\n ENV: {$env_str}\n REQUEST: {$req_str}\n");
//        } else {
//            mail('koman1706@gmail.com', 'Оплата тинькф CANSEL', 'Оплата тинькф CANCEL' . "GET: {$get_str}\n POST: {$post_str}\n ENV: {$env_str}\n REQUEST: {$req_str}\n");
//        }
//    }
}