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
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/url.php';

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
?> 
<a href="/system/">Форма авторизации (как редизайним?)</a>
<br/>
<? 
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/url.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/url.php';

//print_r($_SESSION['message']);
print_r($_SESSION['user_auth_data']);

$_SESSION['errors'] = array();
$_SESSION['message'] = array();
