<?php

/*
 * Апи для взаимодействия с внешних систем
 */

session_start();

include_once 'init.php';
include_once 'config.php';
include_once 'extension/auth/inc.php';
include_once 'extension/close_club/inc.php';


$auth = new \project\auth();
$close_club = new \project\close_club();

// Просмотреть закодированную строку
if (isset($_GET['url_base64'])) {
    // base64_encode
    $en = base64_encode($_SERVER['QUERY_STRING']);
    $de = base64_decode($en);
    echo 'en: ' . $en . "<br/>\n";
    echo 'de: ' . $de;
    exit();
}


// Обработаем запрос и получим данные из параметров
if (isset($_GET['set_url'])) {
    $de = base64_decode($_GET['set_url']);
    $ex = explode('&', $de);
    foreach ($ex as $value) {
        $exv = explode('=', $value);
        $_GET[$exv[0]] = $exv[1];
    }
}

header('Content-Type: application/json');
/**
 * Проверка уникального кода 
 */
if (isset($_GET['API_CODE']) && PRIVATE_CODE == $_GET['API_CODE']) {
    $data = array();
    $result = array('success' => 1, 'success_text' => 'OK', 'data' => $data);

    /**
     * Регистрация пользователя со стороннего ресурса
     */
    if (isset($_GET['check_user_login_and_register'])) {
        $result = array('success' => 0, 'errors' => 'Ошибка авторизации');
        if (isset($_GET['user_email']) && isset($_GET['user_phone']) && isset($_GET['user_password']) &&
                strlen($_GET['user_email']) > 0 && strlen($_GET['user_phone']) > 0 && strlen($_GET['user_password']) > 0) {
            // Если пользователь уже зарегистрирован
            if ($auth->check_user($_GET['user_email'], $_GET['user_phone'])) {
                if ($auth->authorization($_GET['user_email'], $_GET['user_password'])) {
                    $result = array('success' => 1, 'success_text' => 'OK');
                } else {
                    $result = array('success' => 0, 'errors' => 'Не верный пароль!');
                    $errors[] = 'Не верный пароль!';
                }
            } else {
                // Если не зарегистрирован регистрируем
                if ($auth->register($email, $phone, $pass, $pass_r, 1)) {
                    $result = array('success' => 1, 'success_text' => 'OK');
                }
            }
        }
    }

    /**
     * Создадим интеграционный код для авторизации
     */
    if (isset($_GET['user_set_code_integration'])) {
        $result = array('success' => 0, 'errors' => 'Ошибка code_integration');
        if (isset($_GET['code_integration']) && isset($_GET['user_email']) &&
                strlen($_GET['code_integration']) > 0 && strlen($_GET['user_email']) > 0) {

            if ($auth->set_code_integration($_GET['user_email'], $_GET['code_integration'])) {
                $result = array('success' => 1, 'success_text' => 'OK');
            }
        }
    }

    /**
     * Все активные пользователи закрытого клуба
     */
    if (isset($_GET['close_club_active_users'])) {
        $data = $close_club->close_club_active_users($_GET['close_club_active_users']);
        $result = array('success' => 1, 'success_text' => 'OK', 'data' => $data);
    }
} else {
    $errors[] = 'Не верный сервисный код!';
}

/**
 * Обработаем ошибки и внесем их 
 */
if (count($_SESSION['errors']) > 0) {
    $errors = $_SESSION['errors'];
}
if (is_array($errors) && count($errors) > 0) {
    $err = [];
    foreach ($errors as $value) {
        $err[] = $value . "<br/>";
    }

    $result = array('success' => 0, 'errors' => implode(" ", $err));
}

//print_r($errors);
echo json_encode($result);
