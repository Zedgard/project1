<?php

session_start();

// Время и память скрипта
$start = microtime(true);
$memory = memory_get_usage();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

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
    //print_r($server_http);
    //echo 'https://' . $server_http[1] . '.' . $server_http[2] . '.' . $server_http[3] . $_SERVER['REQUEST_URI'];
    $href_add_1 = '';
    if (isset($server_http[3]) && strlen($server_http[3]) > 0) {
        $href_add_1 = '.' . $server_http[3];
    }
    header('Location: https://' . $server_http[1] . '.' . $server_http[2] . $href_add_1 . $_SERVER['REQUEST_URI'], true, 301);
    exit();
}

// Timer
if (basename(__FILE__, '.php') == 'index') {
    if (!isset($_SESSION['site_time'])) {
        $_SESSION['site_time'] = time();
    }
}

/*
 * Кэширование 
 */
include_once 'system/init_cache.php';

//print_r($_SESSION['user']['info']);
if (isset($_GET['ya_payment_true'])) {
    $_SESSION['cart']['itms'] = array();
}


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

// DEBUG
$_SESSION['DEBUG'] = 0;
$noindex_file = 'system/DEBUG.php';
if (is_file($noindex_file)) {
    $_SESSION['DEBUG'] = inc($noindex_file);
}

// Откючаем индексирование сайта NOINDEX
$noindex_file = 'system/noindex.php';
$_SESSION['noindex'] = '';
if ($_SESSION['DEBUG'] == 1 && is_file($noindex_file)) {
    $_SESSION['noindex'] = inc($noindex_file);
}

// '<meta name="robots" content="noindex, nofollow">';
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

/**
 * Данные о производительности
 */
if ($user->isEditor()) {
    $memory = memory_get_usage() - $memory;
    $time = microtime(true) - $start;

// Подсчет среднего времени.
    $f = fopen('time.log', 'a');
    fwrite($f, $time . PHP_EOL);
    fclose($f);
    $log = file('time.log');
    $time = round(array_sum($log) / count($log), 3);

// Перевод в КБ, МБ.
    $i = 0;
    while (floor($memory / 1024) > 0) {
        $i++;
        $memory /= 1024;
    }

    $name = array('байт', 'КБ', 'МБ');
    $memory = round($memory, 2) . ' ' . $name[$i];

    $memory = memory_get_usage() - $memory;

    echo '<span class="system_memory">' . $time . ' сек. / ' . $memory . '</span>';
}