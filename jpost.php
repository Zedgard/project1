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

    /*
     *  Регистрация token
     */

    
    if (isset($_POST['t'])) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/class/token.php';
        $token = new \project\token();
        
        // Сам хеш если он есть 
        if (!isset($_SESSION['token_hash'])) {
            $_SESSION['token_hash'] = '';
        }
        
        if ($token->register()) {
            $result = array('t' => 1);
        } else {
            $result = array('t' => 0);
        }
        
    }

    // Определим пользователя и разрешим ему отправлять запросы
    if (isset($_SESSION['token_hash']) && strlen($_SESSION['token_hash']) > 0) {
        //include_once $_SERVER['DOCUMENT_ROOT'] . '/system/user/auth/jpost.php';

        /*
         * Отправляем данные на расширения
         */

        if (isset($_GET['extension']) && strlen($_GET['extension']) > 0) {
            if (is_file($_SERVER['DOCUMENT_ROOT'] . '/extension/' . $_GET['extension'] . '/jpost.php')) {
                include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/' . $_GET['extension'] . '/jpost.php';
            } else {
                $_SESSION['errors'][] = 'Not file jpost!';
            }
        }
    }


    /*
     * Обработки
     */

    // Если имеются ошибки!
    if (is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
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