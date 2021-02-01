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
if ($_GET['set_email_true']) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/get_emails/inc.php';
    $pr_get_emails = new \project\get_emails();
    if ($pr_get_emails->get_email_activate($_GET['set_email_true'])) {
        header("refresh: 4; url=/");
        ?>
        <div>Активировано!</div>
        <?
    }
    exit();
}

// Авторизация спомощью cookie
if ($_SESSION['user']['other'] == 0 && isset($_COOKIE["edgard_master_cookie_token"])) {
    $auth->authorization_cookie($_COOKIE["edgard_master_cookie_token"]);
}

/*
 * Редирект в зависимости от роли
 */
if ($user->isAdmin()) {
    location_href('/admin/');
}
if ($user->isEditor()) {
    location_href('/admin/');
}

if ($user->isClient()) {
    //location_href('/office/?katalog');
}

/*
 * Авторизация через uLogin
 */
//echo $auth->password_generate();
//print_r($_SESSION['user']['info']);
//print_r($_POST);
if (isset($_GET['s_login'])) {
    if (isset($_POST['token']) && strlen($_POST['token']) > 0) {
        if ($auth->uLogin_auth_registred($_POST['token'])) {
            location_href('/auth/');
            exit();
        } else {
            $_SESSION['errors'][] = 'Ошибка авторизации!';
        }
    } else {
        $_SESSION['errors'][] = 'Ошибка токена дочерней системы!';
    }
}


// Отображаем фоорму
include 'tmpl/login.php';
