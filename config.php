<?php

defined('__CMS__') or die;

/*
 * Все настройки
 */
// Режим отладки
$_SESSION['DEBUG'] = 1;

// Язык сайта
$_SESSION['lang'] = 'ru';
include $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';

// Заголовок
$_SESSION['site_name'] = $lang['site_title'];

// Подключение к базе данных
$cfg_db_name = 'resko_zay';
$cfg_db_user = 'resko_zay';
$cfg_db_pass = 'Kopass1987'; // Niko1706
$cfg_db_host = 'localhost';
$cfg_db_prefix = 'zay_';
