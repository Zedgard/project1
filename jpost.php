<?php

/*
 * Все POST запросы отправляем на эту форму
 */
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php'; не подключаем а то токен не будет работать

/*
 * Кэширование 
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/init_cache.php';

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';



if (isset($_POST)) {
    //echo "post \n";
    // Результат выполнения запроса
    $result = array();
    $_SESSION['errors'] = array();
    $_SESSION['input_style'] = array();
    $_SESSION['action'] = '';
    $_SESSION['action_time'] = 0;

    /*
     *  Регистрация token
     */
    if (isset($_POST['t'])) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/class/token.php';
        $token = new \project\token();

        if ($token->register()) {
            /*
             * Соберем статистику о посетителе
             */
            if (is_file($_SERVER['DOCUMENT_ROOT'] . '/extension/statistic/inc.php')) {
                include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/statistic/inc.php';
                $statistic = new \project\statistic();
                $_SESSION['browser']['height'] = $_POST['h'];
                $_SESSION['browser']['width'] = $_POST['w'];
                $statistic->visitorInit();
                unset($_SESSION['browser']['height']);
                unset($_SESSION['browser']['width']);
            }
            $result = array('t' => 1);
        } else {
            $result = array('t' => 0);
        }
    }

    /*
     * Регистрация разрешения cookie 
     */
    if (isset($_POST['bottom_cookie_btn'])) {
        $cookie_val = $_SESSION['SERVER_NAME'] . '_cookie_access';
        //setcookie($cookie_val, '1'); // это не работает, задавать cookie надо через javascript
        $result = array('success' => 1, 'success_text' => '', 'data' => $cookie_val);
    }
    

    // Определим пользователя и разрешим ему отправлять запросы
    if ((isset($_SESSION['token_hash']) && strlen($_SESSION['token_hash']) > 0) || (isset($_COOKIE['site_user_ajax_access']) && $_COOKIE['site_user_ajax_access'] > 0)) {
        //include_once $_SERVER['DOCUMENT_ROOT'] . '/system/user/auth/jpost.php';

        /*
         * Отправляем данные на расширения
         */
        if (isset($_GET['extension']) && strlen($_GET['extension']) > 0) {
            if (is_file($_SERVER['DOCUMENT_ROOT'] . '/extension/' . $_GET['extension'] . '/jpost.php')) {
                //echo $_SERVER['DOCUMENT_ROOT'] . '/extension/' . $_GET['extension'] . '/jpost.php' . "\n";
                include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/' . $_GET['extension'] . '/jpost.php';
            } else {
                $_SESSION['errors'][] = 'Not file jpost!';
            }
        }
    } else {
        $_SESSION['errors'][] = 'Сессия устарела';
        $result = array('success' => 0, 'errors' => $_SESSION['errors'], 'action' => 'reload');
        echo json_encode($result);
        exit();
    }

    /*
     * Отправка только редакторы сайта
     */
    $user = new \project\user();
    if ($user->isEditor()) {
        include $_SERVER['DOCUMENT_ROOT'] . '/system/extension/jpost.php';
    }

    /*
     * Обработки
     * Если имеются ошибки!
     */
    if ($result['success'] == '0') {
        //$result = array('success' => 0, 'errors' => array($result['success_text']));
        if (isset($result['success_text']) && strlen($result['success_text']) > 0) {
            $_SESSION['errors'] = array();
            $_SESSION['errors'][] = $result['success_text'];
        }
    }

    if (is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
        $result = array('success' => 0, 'errors' => $_SESSION['errors'], 'input_style' => $_SESSION['input_style'], 'action' => $_SESSION['action'], 'action_time' => $_SESSION['action_time']);
    }


    $_SESSION['errors'] = array();

    echo json_encode($result);
}