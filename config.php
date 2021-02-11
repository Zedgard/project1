<?php

defined('__CMS__') or die;

/*
 * Все настройки
 */
// Режим отладки
$_SESSION['DEBUG'] = 1;

// Приватный код для защиты данных
define('PRIVATE_CODE', 3947);

// корневая дирректория
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

// Язык сайта
if (!isset($_SESSION['lang']))
    $_SESSION['lang'] = 'ru';  

include DOCUMENT_ROOT . '/system/lang/' . $_SESSION['lang'] . '.php';

$_SESSION['HOUR'] = 7;

// Заголовок
$_SESSION['site_title'] = $lang['site_title'];

// Подключение к базе данных  xn--80aagbeciot0etdvd.xn--p1ai  84.201.189.112 
//$cfg_db_name = 'resko_zay';
//$cfg_db_user = 'resko_zay';
//$cfg_db_pass = 'Kopass1987'; // Niko1706 
//$cfg_db_host = 'localhost';
//$cfg_db_prefix = 'zay_';
/*
 * old site
//The name of the database for WordPress 
  *define( 'DB_NAME', 'edgardzaitsevcom' );
// MySQL database username 
define( 'DB_USER', 'mysqluser' );
// MySQL database password 
define( 'DB_PASSWORD', '58ca5215569643f0' );
// MySQL hostname 
define( 'DB_HOST', 'rc1a-icoad25j27c229o5.mdb.yandexcloud.net' );
 */
$cfg_db_name = 'user1_zay_db';
$cfg_db_user = 'user1_zay';
$cfg_db_pass = 'Kopass1987'; // Niko1706 
$cfg_db_host = 'localhost';
$cfg_db_prefix = 'zay_';


/*
 * Доступ к API token
 */
$api_token_g = '1';//'Y2tfY2NlMGMyZTBhN2QzMzVhZWM0ZDNlOTQ4YzYxZWUzNjczNGRiYWQyNTpjc181MTNkYjRjY2E3OWU3YjdkMDkyMjg0YmQ1NzIxZDYxNmUxZGU3ZmZh';
/* 
 * Для платежей
 */
// yandex
//$ya_shop_id = 562437;
//$ya_shop_api_key = 'test_ziioTqfzg1LyIHzYckIdz7jtXd6OEuzGoixG-uwc1LM';

// interkassa
//$in_shop_id = '5f5dfdf8f3f7ad5888515cd6';
//$in_secret_key = 'd5fWukz9AQxhWKH5';
