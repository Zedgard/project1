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

$redirect_uri_facebook = 'https://edgardzaycev.com/system/oauth/facebook.php'; // не работает https://edgardzaycev.com/auth/?oauth=facebook


if (!isset($_GET['oauth']) && empty($_GET['code'])) {
    $params = array(
        'client_id' => $facebook_client_id,
        'redirect_uri' => $redirect_uri_facebook,
        'scope' => 'email',
        'response_type' => 'code',
        'state' => '1232'
    );

    $facebook_link = '';
    $facebook_link = 'https://www.facebook.com/dialog/oauth?' . urldecode(http_build_query($params));
}

if (!empty($_GET['code']) && $_GET['oauth'] = 'facebook') {
    $result = false;

    $params = array(
        'client_id' => $facebook_client_id,
        'client_secret' => $facebook_client_secret,
        'redirect_uri' => $redirect_uri_facebook,
        'code' => $_GET['code']
    );

    // Получение access_token
    $data = file_get_contents('https://graph.facebook.com/oauth/access_token?' . urldecode(http_build_query($params)));
    $data = json_decode($data, true);

    if (!empty($data['access_token'])) {
        $params = array(
            'access_token' => $data['access_token'],
            'fields' => 'id,email,first_name,last_name,picture'
        );

        // Получение данных пользователя
        $info = file_get_contents('https://graph.facebook.com/me?' . urldecode(http_build_query($params)));
        $info = json_decode($info, true);

        //var_dump($info);
        $email = $info['email'];
        //echo "email: {$email}<br/>\n";
        if (strlen($email) > 0) {
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