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

$redirect_uri_ya = 'https://edgardzaycev.com/auth/?oauth=ya'; // Адрес сайта
//$ya_client_id = '2364a38f027c4ae284253c2c2e8791b2'; // ID приложения
//$ya_client_secret = 'ed4e37ffd59b4bbbbc9515972285cf20'; // Защищённый ключ 

if (!isset($_GET['oauth']) && empty($_GET['code'])) {
    $params = array(
        'client_id' => $ya_client_id,
        'redirect_uri' => $redirect_uri_ya,
        'response_type' => 'code',
        'state' => '123'
    );

    $ya_link = '';
    if (empty($_SESSION['user']['info']['id']) && $_SESSION['user']['info']['id'] > 0) {
        
    } else {
        $ya_link = 'https://oauth.yandex.ru/authorize?' . urldecode(http_build_query($params));
    }
}

if (isset($_GET['oauth']) && $_GET['oauth'] = 'ya') {
    if (!empty($_GET['code'])) {
        $result = false;
        // Отправляем код для получения токена (POST-запрос).
        $params = array(
            'grant_type' => 'authorization_code',
            'code' => $_GET['code'],
            'client_id' => $ya_client_id,
            'client_secret' => $ya_client_secret,
        );

        $ch = curl_init('https://oauth.yandex.ru/token');
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
            $ch = curl_init('https://login.yandex.ru/info');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('format' => 'json'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: OAuth ' . $data['access_token']));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $info = curl_exec($ch);
            curl_close($ch);

            $info = json_decode($info, true);
            /*
             * Array ( 
             * [id] => 42411884 
             * [login] => resko1987 
             * [client_id] => 2364a38f027c4ae284253c2c2e8791b2 
             * [display_name] => resko1987 
             * [real_name] => Виктор Караваев 
             * [first_name] => Виктор 
             * [last_name] => Караваев 
             * [sex] => male 
             * [default_email] => resko1987@yandex.ru 
             * [emails] => 
             * 		Array ( 
             * 			[0] => resko1987@yandex.ru 
             * 		) 
             * [psuid] => 1.AAb5Eg.P3Sn3R4IBh3oKRecsxl8HQ.i8f2g4gzPlorvG-nTihNQw )
             */
            //echo "email: {$info['default_email']}<br/>\n";
            print_r($info);

            $email = $info['default_email'];
            //$phone = (isset($json_s['phone']) || strlen($json_s['phone']) > 0) ? $json_s['phone'] : '';
            $first_name = $info['first_name'];
            $uid = $info['id'];

            //echo "uid: {$uid}<br/>\n";
            // проверка на секрет
            if ($uid > 0) {
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
        }
        //print_r($_SESSION['errors']);
        //print_r($_SESSION['user']['info']);
        //exit();
        if ($result) {
            location_href('/auth/');
        }else {
                $_SESSION['errors'][] = 'Ошибка авторизации';
            }
    }
}
