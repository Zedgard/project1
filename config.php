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
$_SESSION['lang'] = 'ru';
include DOCUMENT_ROOT . '/system/lang/' . $_SESSION['lang'] . '.php';

// Заголовок
$_SESSION['site_title'] = $lang['site_title'];

// Подключение к базе данных
$cfg_db_name = 'resko_zay';
$cfg_db_user = 'resko_zay';
$cfg_db_pass = 'Kopass1987'; // Niko1706
$cfg_db_host = 'localhost';
$cfg_db_prefix = 'zay_';
