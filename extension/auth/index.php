<?php

/*
 * Страница index
 */

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once DOCUMENT_ROOT . '/extension/auth/inc.php';
include_once DOCUMENT_ROOT . '/extension/users/inc.php';
include_once DOCUMENT_ROOT . '/extension/pay/inc.php';
include_once DOCUMENT_ROOT . '/class/functions.php';
$user = new \project\user();
$auth = new \project\auth();
$pay = new \project\pay();

/*
 * код интеграции для сторонних сайтов
 */
if (isset($_GET['code_integration'])) {
    $auth->code_integration_auth_user($_GET['code_integration']);
    if (isset($_GET['pay']) && strlen($_GET['pay']) > 0) {
        $total = (isset($_GET['total']) && $_GET['total'] > 0) ? $_GET['total'] : 0;
        $pay->set_product_pay($_SESSION['user']['info']['id'], $_GET['pay'], $total);
    }
    //location_href('/auth/');
    //    exit();
}

// подтверждение email адреса подписки \
// модуль get_emails 
if (isset($_GET['set_email_true'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/get_emails/inc.php';
    $pr_get_emails = new \project\get_emails();
    if ($pr_get_emails->get_email_activate($_GET['set_email_true'])) {
        header("refresh: 4; url=/");
        $_SESSION['page_success'][] = 'Успешно подписаны!';
        include $_SERVER['DOCUMENT_ROOT'] . '/page_error.php';
    } else {
        $_SESSION['page_errors'][] = 'Ошибка токена!';
        include $_SERVER['DOCUMENT_ROOT'] . '/page_error.php';
    }
    exit();
}
if (isset($_GET['set_email_false'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/get_emails/inc.php';
    $pr_get_emails = new \project\get_emails();
    if ($pr_get_emails->get_email_unactivate($_GET['set_email_false'])) {
        header("refresh: 4; url=/");
        $_SESSION['page_errors'][] = 'Отписались от рассылки!';
    } else {
        $_SESSION['page_errors'][] = 'Ошибка токена!';
        include $_SERVER['DOCUMENT_ROOT'] . '/page_error.php';
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/page_error.php';
    exit();
}

// Авторизация спомощью cookie 
if ($_SESSION['user']['other'] == 0 && isset($_COOKIE["edgard_master_cookie_token"])) {
    $auth->authorization_cookie($_COOKIE["edgard_master_cookie_token"]);
}

/*
 * Авторизация через свои API
 *   */
if (isset($_GET['oauth'])) {
    if ($_GET['oauth'] == 'vk') {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/system/oauth/vk.php';
    }
}

// присвоим роль если она не назначена
if (isset($_SESSION['user']) && $_SESSION['user']['info']['id'] > 0 && trim($_SESSION['user']['info']['role_privilege']) == '') {
    $auth->insertRole($_SESSION['user']['info']['id'], 3);
}

/*
 * Редирект в зависимости от роли
 */

$user->isAccess(1);

//if ($user->isAdmin()) {
//    location_href('/admin/');
//}
//if ($user->isEditor()) {
//    location_href('/admin/');
//}
//
//if ($user->isClient()) {
//    location_href('/office/?katalog');
//}

/*
 * Авторизация через uLogin
 */
//echo $auth->password_generate();
//print_r($_SESSION['user']['info']);
//if (isset($_GET['s_login'])) {
//   // print_r($_POST);
//    //print_r($_REQUEST);
//   // exit();
//    if (isset($_POST['token']) && strlen($_POST['token']) > 0) {
//        if ($auth->uLogin_auth_registred($_POST['token'])) {
//            location_href('/auth/');
//            exit();
//        } else {
//            $_SESSION['errors'][] = 'Ошибка авторизации!';
//        }
//    } else {
//        $_SESSION['errors'][] = 'Ошибка токена дочерней системы!';
//    }
//}

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/oauth/ya.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/oauth/vk.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/oauth/facebook.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/oauth/google.php';

// Отображаем форму
include 'tmpl/login.php';
