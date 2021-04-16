<?php

defined('__CMS__') or die;

include 'inc.php';
include 'lang.php';

$auth = new \project\auth();

/*
 * Авторизация
 */
if (isset($_POST['authorization'])) {

    $data = array();
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
        if (strlen($get_url) > 0) {
            $url = $get_url;
        }

        // Вернем некоторые данные
        $data['email'] = $_SESSION['user']['info']['email'];
        $data['first_name'] = $_SESSION['user']['info']['first_name'];
        $data['last_name'] = $_SESSION['user']['info']['last_name'];
        $data['avatar'] = $_SESSION['user']['info']['avatar'];
        // Не куда не перенаправляем
        if ($get_url == 'none') {
            $result = array('success' => 1, 'success_text' => '', 'action_time' => '0', 'data' => $data);
        } else {
            $result = array('success' => 1, 'success_text' => '', 'action' => $url, 'action_time' => '0', 'data' => $data);
        }
    } else {
        $result = array('success' => 0, 'success_text' => '', 'action_time' => '0', 'data' => $data);
    }
}
/*
 * Регистрация
 */
if (isset($_POST['registration'])) {
    if ($_POST['check_indicator'] != '1') {
        $result = array('success' => 0, 'success_text' => 'Вы не поставили галочку (Я согласен с условиями и положениями)!');
    } else {
        if ($auth->register($_POST['email'], $_POST['phone'], $_POST['password'], $_POST['cpassword'], $_POST['check_indicator'])) {
            $result = array('success' => 1, 'success_text' => 'Успешно зарегистрирован, ссылка для активации отправлена на указанный почтовый адрес', 'action' => '/auth/', 'action_time' => '20');
        }
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


// Проверить есть ли учетка пользователя, если есть то авторизируем пользователя
if (isset($_POST['check_user'])) {
    /*
     * Сдесь сделать авторизацию если клиент зарегистрирован
     * иначе регистрируем
     */
    // Определим пользователя и разрешим ему отправлять запросы
    if (isset($_SESSION['token_hash']) && strlen($_SESSION['token_hash']) > 0) {
        $_SESSION['consultation_user_fio'] = trim($_POST['consultation_user_fio']);
        $_SESSION['consultation_user_phone'] = trim($_POST['consultation_user_phone']);
        $_SESSION['consultation_user_email'] = trim($_POST['consultation_user_email']);
        $_SESSION['consultation_user_pass'] = trim($_POST['consultation_user_pass']);

        $user = $auth->find_user_email_and_phone_data($_SESSION['consultation_user_email'], $_SESSION['consultation_user_phone']);
        if ($user['id'] > 0) {
            $_SESSION['consultation_user_fio'] = $user['first_name'];
            $_SESSION['consultation_user_phone'] = $user['phone'];
            $_SESSION['consultation_user_email'] = $user['email'];
            $_SESSION['user']['info'] = $auth->getUserInfo($user['id']);

            $result = array('success' => 1, 'success_text' => '');
        } else {
            $result = array('success' => 0, 'success_text' => 'Не авторизован');
        }
    } else {
        $result = array('success' => 0, 'success_text' => 'Tokken error!');
    }
}

// Проверить есть ли учетка пользователя, если есть то авторизируем или зарегистрируем пользователя
if (isset($_POST['check_and_register_user'])) {
    // Определим пользователя и разрешим ему отправлять запросы
    if (isset($_SESSION['token_hash']) && strlen($_SESSION['token_hash']) > 0) {
        $_SESSION['consultation_user_fio'] = trim($_POST['consultation_user_fio']);
        $_SESSION['consultation_user_phone'] = trim($_POST['consultation_user_phone']);
        $_SESSION['consultation_user_email'] = trim($_POST['consultation_user_email']);
        $_SESSION['consultation_user_pass'] = trim($_POST['consultation_user_pass']);

        if (strlen($_SESSION['consultation_user_phone']) == 0) {
            $_SESSION['errors'][] = 'Не введен номер телефона!';
            $result = array('success' => 0, 'success_text' => '');
        } else {
            $user = $auth->find_user_email_and_phone_data($_SESSION['consultation_user_email'], $_SESSION['consultation_user_phone']);
            if ($user['id'] > 0) {
                $_SESSION['consultation_user_fio'] = $user['first_name'];
                if (strlen($user['phone']) > 0) {
                    $_SESSION['consultation_user_phone'] = $user['phone'];
                }
                //$_SESSION['consultation_user_email'] = $user['email'];
                $_SESSION['user']['info'] = $auth->getUserInfo($user['id']);

                $result = array('success' => 1, 'success_text' => '');
            } else {
                if ($auth->register($_POST['consultation_user_email'], $_POST['consultation_user_phone'], $_POST['consultation_user_pass'], $_POST['consultation_user_pass'],
                                1, 1)) {
                    $user = $auth->find_user_email_and_phone_data($_SESSION['consultation_user_email'], $_SESSION['consultation_user_phone']);
                    if ($user['id'] > 0) {
                        $_SESSION['consultation_user_fio'] = $user['first_name'];
                        //$_SESSION['consultation_user_phone'] = $user['phone'];
                        $_SESSION['consultation_user_email'] = $user['email'];
                        $_SESSION['user']['info'] = $auth->getUserInfo($user['id']);
                        $result = array('success' => 1, 'success_text' => '');
                    } else {
                        $result = array('success' => 0, 'success_text' => 'Нет такой учетки извините, необходимо зарегистрироваться!');
                    }
                } else {
                    $result = array('success' => 0, 'success_text' => 'Ошибка регистрации!');
                }
            }
        }
    } else {
        $result = array('success' => 0, 'success_text' => 'Token error!');
    }
}

// серверное время 
if (isset($_POST['get_real_time'])) {
    $date_time = date("Y-m-d") . 'T' . date("H:i:s"); // . '00';
    $result = array('success' => 1, 'success_text' => '', 'data' => $date_time);
}
