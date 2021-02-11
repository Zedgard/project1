<?php

/*
 * Api для получения данных 
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include 'metods.php';

// Для тестирования
if ($_SESSION['DEBUG'] == 1) {
    $token = get_param('api_token_g');

    if (strlen($api_token_g) > 0) {
        $_POST['api_token_g'] = $token;
    }
    //echo "api_token_g: {$_POST['api_token_g']} <br/>";
}

if (isset($_POST['api_token_g']) && $_POST['api_token_g'] == $api_token_g) {
    // имя метода для выполнения
    $metod = get_param('metod');

    if (function_exists($metod)) {
        /*
         * Реализация методов здесь
         */
        $result = api_route($metod, $params = array());
        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        echo "No metod!";
    }
} else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
}


