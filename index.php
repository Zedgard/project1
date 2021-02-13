<?php

session_start();

/**
 * Перенаправление на https://
 */
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http') {
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
    exit();
}
/**
 * Перенаправление без www
 */
$server_http = explode('.', $_SERVER['HTTP_HOST']);
if ($server_http[0] == 'www') {
    //echo 'https://' . $server_http[1] . '.' . $server_http[2] . $_SERVER['REQUEST_URI'];
    header('Location: https://' . $server_http[1] . '.' . $server_http[2] . $_SERVER['REQUEST_URI'], true, 301);
    exit();
}

// Timer
if (basename(__FILE__, '.php') == 'index') {
    if (!isset($_SESSION['site_time'])) {
        $_SESSION['site_time'] = time();
    }
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';

//unset($_SESSION);// = array();
/*
 * Кэширование 
 */
$cache = 1;

if ($cache == 1) {
    opcache_reset();
    include_once 'cache.php';
}
//print_r($_SESSION['user']['info']);
if (isset($_GET['ya_payment_true'])) {
    $_SESSION['cart']['itms'] = array();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';

//include_once $_SERVER['DOCUMENT_ROOT'] . '/system/user/inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/class/validator.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/class/mail.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/url.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
//print_r($_SERVER);
//echo "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}<br/>";
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
$send_emails = new \project\send_emails();
$p_auth = new \project\auth();

//if($send_emails->send(1,'resko1987@mail.ru', array('user_password'=>12345) )){
//    echo 'Ok'; 
//}
//else{
//    echo 'Not';
//}
// send_emails
//print_r($_SESSION);
// Авторизация спомощью cookie
//echo 'edgard_master_cookie_token: ' . $_COOKIE["edgard_master_cookie_token"];
if ($_SESSION['user']['other'] == 0 && isset($_COOKIE["edgard_master_cookie_token"])) {
    $p_auth->authorization_cookie($_COOKIE["edgard_master_cookie_token"]);
}

if (isset($_COOKIE[$_SESSION['SERVER_NAME'] . '_cookie_access'])) {
    $_SESSION['cookie_access'] = $_COOKIE[$_SESSION['SERVER_NAME'] . '_cookie_access'];
}

$user = new \project\user();
$user->upUserRole(); // role_privilege

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/menu/index.php';

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
$config = new \project\config();
$_SESSION['site_title'] = $config->getConfigParam('site_title');

//echo "{$_SESSION['rand']} <br/>\n";
include_once $_SERVER['DOCUMENT_ROOT'] . '/url.php';

//$config->getConfigParam('link_ed_mailto');
//$config->getConfigParam('language_enable');
$user->updateActiveLastdate();


if (is_file($_SERVER['DOCUMENT_ROOT'] . '/extension/statistic/inc.php')) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/statistic/inc.php';
    $statistic = new \project\statistic();
    //$statistic->visitorInit();
    $statistic->updateLastTime();
}

$_SESSION['errors'] = array();
$_SESSION['message'] = array();
