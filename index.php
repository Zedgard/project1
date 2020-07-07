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

echo "Ok";
