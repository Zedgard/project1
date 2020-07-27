<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';

/*
 * Кэширование 
 */
$cache = 1;

if ($cache == 1) {
    include 'cache.php';
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/system/user/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/validator.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/mail.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/url.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';


/*
 * Система управления
 * 
 * Управление данными 
 * 
 * Настройка шаблона 
 * 
 * Расширения
 *  
 */;
//echo "<br/>\n";
//echo "Ok";
//echo '<a href="/system/">Форма авторизации (как редизайним?)</a>' . "<br/>\n";
//include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
//$extension = new \project\extension();
//print_r($_SESSION['user']);
//$_SESSION['visitor'] = array();
//$_SESSION['token_hash'] = array();
//$_SESSION['token_hash'] = '';
//$_SESSION['visitor'] = array();
//echo "visitor: <br/>\n";
//print_r($_SESSION['visitor']);
//echo "token_hash: <br/>\n";
//print_r($_SESSION['token_hash']);
include_once $_SERVER['DOCUMENT_ROOT'] . '/url.php';

$user = new \project\user();
$user->updateActiveLastdate();


if (is_file($_SERVER['DOCUMENT_ROOT'] . '/extension/statistic/inc.php')) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/statistic/inc.php';
    $statistic = new \project\statistic();
    //$statistic->visitorInit();
    $statistic->updateLastTime();
}

$_SESSION['errors'] = array();
$_SESSION['message'] = array();

