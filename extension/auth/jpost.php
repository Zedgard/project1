<?php

defined('__CMS__') or die;

include 'inc.php';
include 'lang.php';

$auth = new \project\auth();

/*
 * Авторизация
 */
if (isset($_POST['authorization'])) {
    $get_url = (isset($_GET['url']) && strlen($_GET['url']) > 0) ? $_GET['url'] : '';
    // галка запомни меня
    $remember_me = 0;
    if (isset($_POST['remember_me']) && $_POST['remember_me'] == 1) {
        $remember_me = 1;
    }

    if ($auth->authorization($_POST['email'], $_POST['password'], $remember_me)) {

        $r = 0;
        if (isset($_POST['cart'])) {
            $url = '/shop/cart/';
            $r = 1;
        }
        if (\project\user::isAdmin() || \project\user::isEditor()) {
            $url = '/admin/';
            $r = 1;
        }
        if (\project\user::isClient()) {
            $url = '/office/?katalog';
            $r = 1;
        }
        if ($r == 0) {
            $url = '/';
        }
        
        // Если передали GET url
        if(strlen($get_url) > 0){
            $url = $get_url;
        }

        $result = array('success' => 1, 'success_text' => '', 'action' => $url, 'action_time' => '0');
    } else {
        $result = array('success' => 0, 'success_text' => '', 'action_time' => '0');
    }
}
/*
 * Регистрация
 */
if (isset($_POST['registration'])) {
    if ($auth->register($_POST['email'], $_POST['phone'], $_POST['password'], $_POST['cpassword'], $_POST['check_indicator'])) {
        $result = array('success' => 1, 'success_text' => 'Успешно зарегистрирован, ссылка для активации отправлена на указанный почтовый адрес', 'action' => '/auth/', 'action_time' => '20');
    }
}
/*
 * Выход
 */
if (isset($_POST['logout'])) {
    if ($_SESSION['user']['other'] == 1 && isset($_SESSION['user']['other_info'])) {
        $_SESSION['user']['info'] = $_SESSION['user']['other_info'];
        $_SESSION['user']['other'] = 0;
        $result = array('success' => 1, 'success_text' => 'Вышли из системы', 'action' => '/admin/', 'action_time' => '0');
    } else {
        $auth->unset_cookie();
        unset($_SESSION['user']);
        unset($_SESSION['user']['other_info']);
        $result = array('success' => 1, 'success_text' => 'Вышли из системы', 'action' => '/', 'action_time' => '0');
    }
    //print_r($_SESSION['user']);
}
/*
 * Восстановление пароля
 */
if (isset($_POST['re_password'])) {
    $email = trim($_POST['re_user_email']);
    if ($auth->re_password($email)) {
        $result = array('success' => 1, 'success_text' => 'На указанную почту отправлено письмо с инструкцией восстановления', 'action' => '/', 'action_time' => '5');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка процедуры!');
    }
}
if (isset($_POST['re_password_go'])) {
    $p = trim($_POST['p']);
    $p2 = trim($_POST['p2']);
    $repassword = $_SESSION['repassword'];
    if ($auth->re_password_go($repassword, $p, $p2)) {
        $result = array('success' => 1, 'success_text' => 'Выполнено', 'action' => '/auth/', 'action_time' => '0');
    } else {
        $result = array('success' => 0, 'success_text' => '');
    }
}
