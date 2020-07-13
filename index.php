<?php

session_start();

define('__CMS__', 1);

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';

/*
 * Кэширование 
 */
$cache = 1;

if ($cache == 1) {
    include 'cache.php';
}

include $_SERVER['DOCUMENT_ROOT'] . '/config.php';

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

$_SESSION['errors'] = array();


include_once $_SERVER['DOCUMENT_ROOT'] . '/class/url.php';

$url = new \project\url();
$url->request();

echo $url->getParam(2) . "<br>\n";
echo $url->getTag('id') . "<br>\n";
print_r($_SESSION['url']);
