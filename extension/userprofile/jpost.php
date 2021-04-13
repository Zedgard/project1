<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$userprofile = new \project\userprofile();
$user = new \project\user();

// Данные по авторезированному пользователю
if (isset($_POST['get_user_info'])) {
    $data = $userprofile->get_user_info($_SESSION['user']['info']['id']);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if (isset($_POST['save_user_info'])) {
//    $user_phone = trim($_POST['user_phone']);
//    $first_name = trim($_POST['first_name']);
//    $last_name = trim($_POST['last_name']);
//    $login_instagram = trim($_POST['login_instagram']);
//    $city = trim($_POST['city']);
//    $city_code = trim($_POST['city_code']);
//    $active_subscriber = $_POST['active_subscriber'];
    $data = array(
        'user_phone' => trim($_POST['user_phone']),
        'first_name' => trim($_POST['first_name']),
        'last_name' => trim($_POST['last_name']),
        'login_instagram' => trim($_POST['login_instagram']),
        'city' => trim($_POST['city']),
        'city_code' => trim($_POST['city_code']),
        'active_subscriber' => trim($_POST['active_subscriber']),
    );
    
    if ($userprofile->save_user_info($_SESSION['user']['info']['id'], $data)) {
        $result = array('success' => 1, 'success_text' => 'Сохранено');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка сохраниния общей информации');
    }
}