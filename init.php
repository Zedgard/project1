<?php

/*
 * Инициализация
 */

define('__CMS__', 1);

if (!isset($_SESSION['cookie_access'])) {
    $_SESSION['cookie_access'] = 0;
}

if (!isset($_SESSION['SERVER_NAME'])) {
    $ex = explode('.', $_SERVER['SERVER_NAME']);
    $_SESSION['SERVER_NAME'] = $ex[0];
}


if (!isset($_SESSION['meta'])) {
    $_SESSION['meta'] = '';
}

// Время прихода пользователя на сайт
if (!isset($_SESSION['user_load_page_time'])) {
    $_SESSION['user_load_page_time'];
}

if (!isset($_SESSION['token_hash'])) {
    $_SESSION['token_hash'] = '';
}

//$_SESSION['user'] = array();
// Данные авторезированного пользователя
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = array();
}
if (!isset($_SESSION['user_roles'])) {
    $_SESSION['user_roles'] = array();
}

// Ошибки которые произошли в системе
$_SESSION['url'] = array();
$_SESSION['page_url'] = '';

// Работать без кеша
$_SESSION['rand'] = '?v=' . mt_rand(1000, 9999);

// Ошибки которые произошли в системе
if (!isset($_SESSION['page_errors'])) {
    $_SESSION['page_errors'] = array();
}
if (!isset($_SESSION['errors'])) {
    $_SESSION['errors'] = array();
}
if (!isset($_SESSION['input_style'])) {
    $_SESSION['input_style'] = array();
}
if (!isset($_SESSION['action_time'])) {
    $_SESSION['action_time'] = 0;
}
if (!isset($_SESSION['action'])) {
    $_SESSION['action'] = '';
}

// Для промо
if (!isset($_SESSION['promos'])) {
    $_SESSION['promos'] = array();
}
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

// Переход по UTM метки для фиксации продажи
if (!isset($_SESSION['utm_tag_href_id'])) {
    $_SESSION['utm_tag_href_id'] = 0;
}



