<?php

/*
 * Все POST запросы отправляем на эту форму
 */


session_start();

define('__CMS__', 1);

include $_SERVER['DOCUMENT_ROOT'] . '/config.php';


if (isset($_POST)) {
    //echo "post";
    // Результат выполнения запроса
    $result = array();

    // Регистрация пользователя
    if (isset($_POST['t'])) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/class/token.php';
        $token = new \project\token();
        if ($token->register()) {
            echo json_encode(array('t' => 1));
        } else {
            echo json_encode(array('t' => 0));
        }
        // Сам хеш если он есть 
        if (!isset($_SESSION['token_hash'])) {
            $_SESSION['token_hash'] = '';
        }
    }

    // Определим пользователя и разрешим ему отправлять запросы
    if (isset($_SESSION['token_hash']) && strlen($_SESSION['token_hash']) > 0) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/system/user/auth/jpost.php';
    }

    // Если имеются ошибки!
    if (count($_SESSION['errors']) > 0) {
        $result = array('success' => 0, 'errors' => $_SESSION['errors']);
    }

    $_SESSION['errors'] = array();

    echo json_encode($result);

    // sidebar_toggler
    if (isset($_POST['sidebar_toggler'])) {
        if ($_POST['sidebar_toggler'] == 'true') {
            $sidebar_toggler == 'false';
        } else {
            $sidebar_toggler == 'true';
        }
        $_SESSION['system']['sidebar_toggler'] = $sidebar_toggler;
    }
}