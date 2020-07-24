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
        if(\project\user::isAdmin() || \project\user::isEditor()){
            $url = '/admin/';
        }
        if(\project\user::isClient()){
            $url = '/office/';
        }
        $result = array('success' => 1, 'success_text' => 'Успешно авторизирован', 'action' => $url, 'action_time' => '2');
    }
}
/*
 * Регистрация
 */
if (isset($_POST['registration'])) {
    if ($auth->register($_POST['email'], $_POST['phone'], $_POST['password'], $_POST['cpassword'], $_POST['check_indicator'])) {
        $result = array('success' => 1, 'success_text' => 'Успешно зарегистрирован');
    }
}

if (isset($_POST['logout'])) {
    unset($_SESSION['user_auth_data']);
    $result = array('success' => 1, 'success_text' => 'Вышли из системы', 'action' => '/', 'action_time' => '2');
}
