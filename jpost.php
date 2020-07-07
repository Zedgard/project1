<?php

/*
 * Все POST запросы отправляем на эту форму
 */

session_start();

if (isset($_POST)) {
    //echo "post";
    // Регистрация пользователя
    if (isset($_POST['t'])) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/app/token.php';
        $token = new \core_app\token();
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
}