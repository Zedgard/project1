<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';

$p_user = new \project\user();
$p_auth = new \project\auth();

$redirect_uri_google = 'https://edgardzaycev.com/system/oauth/google.php'; ///'https://edgardzaycev.com/auth/?oauth=google';


if (!isset($_GET['oauth']) && empty($_GET['code'])) {
    $params = array(
	'client_id'     => $google_client_id,
	'redirect_uri'  => $redirect_uri_google,
	'response_type' => 'code',
	'scope'         => 'https://www.googleapis.com/auth/userinfo.email',
	'state'         => '123'
);

    $google_link = '';
    if (empty($_SESSION['user']['info']['id']) && $_SESSION['user']['info']['id'] > 0) {
        
    } else {
        $google_link = 'https://accounts.google.com/o/oauth2/auth?' . urldecode(http_build_query($params));
    }
}

if (!empty($_GET['code']) && $_GET['oauth'] = 'google') {
    // Отправляем код для получения токена (POST-запрос).
    $params = array(
        'client_id' => $google_client_id,
        'client_secret' => $google_client_secret,
        'redirect_uri' => $redirect_uri_google,
        'grant_type' => 'authorization_code',
        'code' => $_GET['code']
    );

    $ch = curl_init('https://accounts.google.com/o/oauth2/token');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $data = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($data, true);
    if (!empty($data['access_token'])) {
        // Токен получили, получаем данные пользователя.
        $params = array(
            'access_token' => $data['access_token'],
            'id_token' => $data['id_token'],
            'token_type' => 'Bearer',
            'expires_in' => 3599
        );

        $info = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?' . urldecode(http_build_query($params)));
        $info = json_decode($info, true);

        $id = $info['id'];
        $email = $info['email'];
        
        if ($id > 0) {
            //$phone = $this->phoneReplace($phone);

            $sqlLight = new \project\sqlLight();
            if (strlen($phone) == 0) {
                $query = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and `active`=0";
                $user_not_activate = $sqlLight->queryList($query, array($email), 0);
                if (count($user_not_activate) > 0) {
                    $_SESSION['errors'][] = 'Активируйте учетную запись<br/>письмо уже выслано на электронный адрес ( ' . $email . ' ) ';
                    return false;
                } else {
                    $query = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and `active`=1";
                    $users = $sqlLight->queryList($query, array($email), 0);
                }
            } else {
                $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active`=1";
                $users = $sqlLight->queryList($query, array($email, $phone), 0);
            }

            //print_r($users);

            if (count($users) > 0) {
                $_SESSION['user']['info'] = $users[0];
                $data = $p_user->getUserInfo($users[0]['id']);
                $_SESSION['user']['info'] = $data;
                $result = true;
            } else {
                $password = $p_auth->password_generate();
                /*
                 * Нужно еще отправлять пароль пользователю на почту !!!!!!!!!!!!!
                 */
                $send_emails = new \project\send_emails();
                //$send_emails->send('new_password', $email, array('user_password' => $password));
                // Процесс регистрации
                if ($p_auth->register($email, $phone, $password, $password, 1, 1)) {
                    $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active` = 1";
                    $users = $sqlLight->queryList($query, array($email, $phone), 0);
                    if (count($users) > 0) {
                        $_SESSION['user']['info'] = $users[0];
                        $p_auth->insertRole($users[0]['id'], 3);
                        $data = $p_user->getUserInfo($users[0]['id']);
                        //print_r($data);
                        $_SESSION['user']['info'] = $data;
                        $result = true;
                    }
                } else {
                    $_SESSION['errors'][] = 'Ошибка авторизации';
                }
            }
        } else {
            $_SESSION['errors'][] = 'Нет учетных данных';
        }

        if ($result) {
            location_href('/auth/');
        } else {
            $_SESSION['errors'][] = 'Ошибка авторизации';
        }
        
    }
}