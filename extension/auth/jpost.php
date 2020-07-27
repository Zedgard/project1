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
    }
}
/*
 * Регистрация
 */
if (isset($_POST['registration'])) {
    if ($auth->register($_POST['email'], $_POST['phone'], $_POST['password'], $_POST['cpassword'], $_POST['check_indicator'])) {
        $result = array('success' => 1, 'success_text' => 'Успешно зарегистрирован, ссылка для активации отправлена на указанный почтовый адрес');
    }
}

if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
    $result = array('success' => 1, 'success_text' => 'Вышли из системы', 'action' => '/', 'action_time' => '1');
}
