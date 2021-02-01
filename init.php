<?php

/*
 * Инициализация
 */

define('__CMS__', 1);

// Время прихода пользователя на сайт
if (!isset($_SESSION['user_load_page_time'])) {
    $_SESSION['user_load_page_time'];
}
//$_SESSION['user'] = array();
// Данные авторезированного пользователя
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = array();
}

// Ошибки которые произошли в системе
$_SESSION['url'] = array();
$_SESSION['page_url'] = '';
// Работать без кеша
$_SESSION['rand'] = '?v=' . rand();

// Ошибки которые произошли в системе
$_SESSION['errors'] = array();

// Сообщения сайта (Отображаются на странице сайта или всплывают)
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
if (!isset($_SESSION['message'])) {
    $_SESSION['message'] = array();
}

$_SESSION['body_javascript'] = array();
//$_SESSION['cart'] = array();
// Для корзины
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
// Для авторизации под другим пользователем
if (!isset($_SESSION['user']['other'])) {
    $_SESSION['user']['other'] = 0;
    $_SESSION['user']['other_info'] = array();
}

/*
 * Глобальные
 */

$_SESSION['REFERER'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['REQUEST_URI'];
$_SESSION['page'] = array();
// Настройки сайта
$_SESSION['config'] = array();

if (!isset($_SESSION['system']['sidebar_toggler'])) {
    $_SESSION['system']['sidebar_toggler'] = 'false';
}

unset($_SESSION['extension_init']);

