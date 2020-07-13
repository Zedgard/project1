<?php

/*
 * Инициализация
 */

// Время
$_SESSION['time'] = time();

// Время прихода пользователя на сайт
if (!isset($_SESSION['user_load_page_time']))
    $_SESSION['user_load_page_time'];

// Данные авторезированного пользователя
if (!isset($_SESSION['user_auth_data']))
    $_SESSION['user_auth_data'];

// Ошибки которые произошли в системе
if (!isset($_SESSION['url']))
    $_SESSION['url'] = array();

// Ошибки которые произошли в системе
if (!isset($_SESSION['errors']))
    $_SESSION['errors'] = array();