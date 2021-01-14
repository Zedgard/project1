<?php

defined('__CMS__') or die;

include 'inc.php';
include 'lang.php';

$auth = new \project\auth();

/*
 * Авторизация
 */
if (isset($_POST['authorization'])) {

    if ($auth->authorization($_POST['email'], $_POST['password'])) {

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
            $url = '/office/';
            $r = 1;
        }
        if ($r == 0) {
            $url = '/';
        }
        $result = array('success' => 1, 'success_text' => 'Успешно авторизирован', 'action' => $url, 'action_time' => '0');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка авторизации', 'action_time' => '0');
    }
}
/*
 * Регистрация
 */
if (isset($_POST['registration'])) {
    if ($auth->register($_POST['email'], $_POST['phone'], $_POST['password'], $_POST['cpassword'], $_POST['check_indicator'])) {
        $result = array('success' => 1, 'success_text' => 'Успешно зарегистрирован, ссылка для активации отправлена на указанный почтовый адрес', 'action' => '/auth/');
    } 
}
/*
 * Выход
 */
if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
    $result = array('success' => 1, 'success_text' => 'Вышли из системы', 'action' => '/', 'action_time' => '0');
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
    $re_password = trim($_POST['u_re_password']);
    $re_password2 = trim($_POST['u_re_password2']);
    $repassword = $_SESSION['repassword'];
    if ($auth->re_password_go($repassword, $re_password, $re_password2)) {
        $result = array('success' => 1, 'success_text' => 'Выполнено', 'action' => '/auth/', 'action_time' => '0');
    } else {
        $result = array('success' => 0, 'success_text' => '');
    }
}
