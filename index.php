<?php

session_start();

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
