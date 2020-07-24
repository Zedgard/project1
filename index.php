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
 */
//echo "user_auth_data: ";
//print_r($_SESSION['user_auth_data']);
//echo "<br/>\n";
//echo "Ok";
//echo '<a href="/system/">Форма авторизации (как редизайним?)</a>' . "<br/>\n";

//print_r($_SESSION['user_auth_data']);

//include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
//$extension = new \project\extension();

include_once $_SERVER['DOCUMENT_ROOT'] . '/url.php';
//print_r($_SESSION['message']);
//print_r($_SESSION['user_auth_data']);
$user = new \project\user();
$user->updateActiveLastdate();


$_SESSION['errors'] = array();
$_SESSION['message'] = array();

include 'system/chat/chat.php';