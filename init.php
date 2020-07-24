<?php

/*
 * Инициализация
 */

session_start();

define('__CMS__', 1);

// Время
$_SESSION['time'] = time();

// Время прихода пользователя на сайт
if (!isset($_SESSION['user_load_page_time']))
    $_SESSION['user_load_page_time'];

// Данные авторезированного пользователя
if (!isset($_SESSION['user_auth_data']))
    $_SESSION['user_auth_data'] = array();

// Ошибки которые произошли в системе
$_SESSION['url'] = array();

// Ошибки которые произошли в системе
$_SESSION['errors'] = array();

// Сообщения сайта (Отображаются на странице сайта или всплывают)
if (!isset($_SESSION['message']))
    $_SESSION['message'] = array();

$_SESSION['body_javascript'] = array();

/*
 * примеры подсветки
 * http://1.sybix.ru/assets/panel/alert.html
 * $_SESSION['message'] = array('type' => 'primary', 'text' => $lang['text']);
 * $_SESSION['message'] = array('type' => 'secondary', 'text' => $lang['text']);
 * $_SESSION['message'] = array('type' => 'success', 'text' => $lang['text']);
 * $_SESSION['message'] = array('type' => 'danger', 'text' => $lang['text']);
 * $_SESSION['message'] = array('type' => 'warning', 'text' => $lang['text']);
 * $_SESSION['message'] = array('type' => 'info', 'text' => $lang['text']);
 * $_SESSION['message'] = array('type' => 'light', 'text' => $lang['text']);
 * $_SESSION['message'] = array('type' => 'dark', 'text' => $lang['text']);
 */

/*
 * Глобальные
 */
$_SESSION['page'] = array();

if (!isset($_SESSION['system']['sidebar_toggler'])) {
    $_SESSION['system']['sidebar_toggler'] = 'false';
}
 
unset($_SESSION['extension_init']);