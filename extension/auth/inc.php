<?php

namespace project;

session_start();

defined('__CMS__') or die;

/*
 * Авторизация пользователя
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/validator.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/mail.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/wordpress/class-phpass.php';

class auth extends \project\user {

    public function __construct() {
        
    }

    /**
     * Получить данные по пользователю
     * @param type $email
     * @param type $phone
     * @return array
     */
    function get_user_login($email, $phone = '') {
        $sqlLight = new \project\sqlLight();
        $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active`=1";
        $data = $sqlLight->queryList($query, array($email, $phone));
        if (count($data)) {
            return $data[0];
        }
        return array();
    }

    /**
     * Проверка на соответствие пароля
     * @param type $enter_password
     * @param type $db_password
     * @return boolean
     */
    function check_password($enter_password, $db_password) {
        $pass_hash = $this->passHash($enter_password);
        if ($pass_hash == $db_password) {
            return true;
        } else {
            $wp_hasher = new \project\PasswordHash(8, TRUE);
            //echo "{$enter_password}, {$db_password}\n";
            return $wp_hasher->CheckPassword($enter_password, $db_password);
        }
    }

    /**
     * Авторизацтя нового пользователя
     * @global \project\type $lang
     * @param type $email
     * @param type $password
     * @param type $set_cookie сохранить в куки
     * @return boolean
     */
    public function authorization($email, $password, $set_cookie = 0) {
        global $lang;
        if (strlen($email) > 2 && strlen($password) > 2) {
            $sqlLight = new \project\sqlLight();
//            $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and u.`u_pass`='?' and `active`=1";
//            $users = $sqlLight->queryList($query, array($email, $email, $pass_hash));
            $user = $this->get_user_login($email, $email);
//            if(count($user) == 0){
//                $_SESSION['errors'][] = 'Пользователь не зарегистрирован';
//            }
            // Если не получилось авторизироваться проверим есть ли регистрация и не активная запись
            if (!isset($user['id'])) {
                $pass_hash = $this->passHash($password);
                $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and u.`u_pass`='?' and `active`=0";
                $find_user = $sqlLight->queryList($query, array($email, $email, $pass_hash));
                if (count($find_user) > 0) {
                    $_SESSION['errors'][] = 'Учетная запиь не активирована!';
                    return false;
                } else {
                    $_SESSION['errors'][] = 'Не найдена учетная запись, пожалуйста зарегистируйтесь в системе!<br/>'
                            . '<a class="text-blue" href="/auth/?registrations">Регистрация</a>';
                    return false;
                }
            }

            if (isset($user['id']) && $user['id'] > 0) {
                // Проверим на пароль
                if ($this->check_password($password, $user['u_pass'])) {
                    // если галочку поставили то запомним куку
                    if ($set_cookie == 1) {
                        $this->set_cookie($user['id']);
                    } else {
                        $this->unset_cookie($user['id']);
                    }
                    $_SESSION['user']['info'] = $user;
                    $data = $this->getUserInfo($user['id']);
                    $_SESSION['user']['info'] = $data;
                    if (strlen($_SESSION['user']['info']['avatar']) == 0) {
                        // Аватар по умолчанию
                        $_SESSION['user']['info']['avatar'] = '/assets/img/user/user.jpg';
                    }
                    return true;
                } else {
                    $_SESSION['errors'][] = 'Пароль неверный';
                }
            }
        } else {
            $_SESSION['errors'][] = $lang['no_input_form'];
        }
        return false;
    }

    /**
     * Обновим данные пользователя
     * @param type $user_id
     * @param type $row
     * @param type $val
     * @return type
     */
    public function user_update_row($user_id, $row, $val) {
        $sqlLight = new \project\sqlLight();
        $query = "UPDATE `zay_users` SET `{$row}`='?' WHERE `id`='?'";
        return $sqlLight->query($query, array($val, $user_id));
    }

    /**
     * Регистрация нового пользователя
     * @global \project\type $lang
     * @param type $email
     * @param type $phone
     * @param type $pass
     * @param type $pass_r
     * @param type $check_private
     * @return boolean
     */
    public function register($email, $phone, $pass, $pass_r, $check_private, $active = 0) {
        global $lang;
        $error = array();
        $sqlLight = new \project\sqlLight();
        if (strlen($email) > 2 && strlen($pass) > 2) {

            $validator = new Validator();
            if (!$validator->valid_email($email)) {
                $error[] = $lang['email_false'];
            }

            if ($check_private != 1) {
                $error[] = 'Необходимо согласиться с условиями!';
            }

            $phone = $this->phoneReplace($phone);

            if ($pass == $pass_r) {
                //$pass_hash = $this->passHash($pass);
                $wp_hasher = new \project\PasswordHash(8, TRUE);
                $pass_hash = $wp_hasher->HashPassword(trim($pass));
            }

            $activate_codeBase64 = '';
            // Если не активируем то создаем код активации
            if ($active == 0) {
                $activate_code = $this->passHash(PRIVATE_CODE . $email . $pass . time());
                $activate_codeBase64 = base64_encode($activate_code);
            }

            if (strlen($phone) == 0) { // если не передан номер телефона
                $query = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and `active`=1"; // and `active` = 1 // Только активированых 
                $users = $sqlLight->queryList($query, array($email));
            } else {
                $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active`=1"; // and `active` = 1 // ТОлько активированых 
                $users = $sqlLight->queryList($query, array($email, $phone));
            }

            if (count($users) > 0) {
                $error[] = $lang['auth'][$_SESSION['lang']]['user_search_register_true'];
            }
            // поиск возможно существующей учетки
            $query_find_user = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and `active`=0";
            $find_user = $sqlLight->queryList($query_find_user, array($email));

            if (count($error) == 0) {
                if (count($find_user) == 0) {
                    $_SESSION['db_next_id'] = $sqlLight->queryNextId('zay_users');
                    $query = "INSERT INTO `zay_users`(`email`, `phone`, `first_name`, `last_name`, `u_pass`, `active`, `active_code`, `active_lastdate`) "
                            . "VALUES ('?','?','','','?','?','?', NOW() )";
                    if ($sqlLight->query($query, array($email, $phone, $pass_hash, $active, $activate_code), 0)) {
                        if (strlen($activate_codeBase64) > 0) {
                            $this->sendActivateEmail($email, $activate_codeBase64);
                        }
                        return true;
                    } else {
                        $error[] = $lang['auth'][$_SESSION['lang']]['error_register_form'];
                    }
                } else {
                    $error[] = 'Уже зарегистрирован!';
                }
            } else {
//                $query_update = "UPDATE `zay_users` SET `phone`='?',`first_name`='?',`last_name`='?',`u_pass`='?', "
//                        . "`active`='?',`active_code`='?',`active_lastdate`=NOW() "
//                        . "WHERE `id`='?' ";
//
//                // Если ввели новый телефон то обновим его
//                $phone_up = $find_user[0]['phone'];
//                if (strlen(trim($phone)) > 0) {
//                    $phone_up = trim($phone);
//                }
//                if ($sqlLight->query($query_update, array($phone_up, $pass_hash, $active, $activate_code), 0)) {
//                    if (strlen($activate_codeBase64) > 0) {
//                        $this->sendActivateEmail($email, $activate_codeBase64);
//                    }
//                    return true;
//                }
                $error[] = 'Ошибка!';
            }
        } else {
            $error[] = 'Не заполнены поля!';
        }

        //print_r($error);
        if (count($error) > 0) {

            $_SESSION['errors'] = $error;
        }
        return false;
    }

    /**
     * Регистрируем куки
     * @param type $user_id
     * @return boolean
     */
    public function set_cookie($user_id) {
        $sqlLight = new \project\sqlLight();
        //Создаём токен
        $password_cookie_token = md5($user_id . time());
        $query = "UPDATE `zay_users` SET `cookie`='{$password_cookie_token}' WHERE `id`='{$user_id}'";
        if ($sqlLight->query($query, array($password_cookie_token, $user_id), 0)) {
            setcookie("edgard_master_cookie_token", $password_cookie_token, time() + (1000 * 60 * 60 * 24 * 30));
            return true;
        }
        return false;
    }

    /**
     * Удаляем куки
     * @return boolean
     */
    public function unset_cookie() {
        $sqlLight = new \project\sqlLight();
        $user_id = $_SESSION['user']['info']['id'];
        //Если галочка "запомнить меня" небыла поставлена, то мы удаляем куки
        if (isset($_COOKIE["edgard_master_cookie_token"])) {
            $query = "UPDATE `zay_users` SET `cookie`='?' WHERE  `id`='?'";
            if ($sqlLight->query($query, array('', $user_id))) {
                //Удаляем куку 
                setcookie('edgard_master_cookie_token', '', time() - 3600);
                return true;
            }
        }
        return false;
    }

    /**
     * Авторизация спомощью cookie
     * @param type $cookie
     * @return boolean
     */
    public function authorization_cookie($cookie) {
        $sqlLight = new \project\sqlLight();
        $query = "SELECT * FROM `zay_users` u WHERE cookie='?' and `active`=1";
        $users = $sqlLight->queryList($query, array($cookie));

        // Если найден пользователь то авторизируем его
        if (count($users) > 0) {
            $_SESSION['user']['info'] = $users[0];
            $data = $this->getUserInfo($users[0]['id']);
            $_SESSION['user']['info'] = $data;
            if (strlen($_SESSION['user']['info']['avatar']) == 0) {
                // Аватар по умолчанию
                $_SESSION['user']['info']['avatar'] = '/assets/img/user/user.jpg';
            }
            return true;
        }
    }

    /**
     * Проверка есть ли такой пользователь в системе
     * @param type $email
     * @param type $phone
     * @return boolean
     */
    public function check_user($email, $phone) {
        $error = array();
        $sqlLight = new \project\sqlLight();

        $query = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and `active`='1' ";
        $users = $sqlLight->queryList($query, array($email));
        if ($sqlLight->getCount() > 0) {
            return true;
        }

        $query = "SELECT * FROM `zay_users` u WHERE u.`phone`='?' `active`='1'";
        $users = $sqlLight->queryList($query, array($phone));
        if ($sqlLight->getCount() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Поиск пользователя по почте или телефону
     * @param type $email почта
     * @param type $phone телефон
     * @return type array
     */
    function find_user_email_and_phone_data($email, $phone) {
        $data = array();
        $str1 = trim($email);
        $str2 = trim($phone);
        if (strlen($str1) > 0 || strlen($str2) > 0) {
            $select = "SELECT u.* FROM `zay_users` u "
                    . "WHERE (u.email='?' or u.phone='?') and u.active='1'";
            $data = $this->getSelectArray($select, array($str1, $str2), 0)[0];
        }
        return $data;
    }

    /**
     * Авторизация и Регистрация через uLogin
     * @param type $token
     * @return boolean
     */
//    public function uLogin_auth_registred($token) {
//        $host = 'www.edgardzaycev.com'; //$_SERVER['HTTP_HOST'];
//        $token_url = 'https://ulogin.ru/token.php?token=' . $token . '&host=' . $host;
//        // получим с сервера
//        //echo "token_url: {$token_url}";
//        $request = curl_init($token_url);
//        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
//        $result = curl_exec($request);
//        $json_s = json_decode($result, true);
//        // отобразить для просмотра
//        //print_r($json_s);
//        // данные 
//        $verified_email = $json_s['verified_email'];
//        $email = $json_s['email'];
//        $phone = (isset($json_s['phone']) || strlen($json_s['phone']) > 0) ? $json_s['phone'] : '';
//        $first_name = $json_s['first_name'];
//        $last_name = $json_s['last_name'];
//        $first_name = $json_s['first_name'];
//        $uid = $json_s['uid'];
//        // json
//        $network = $json_s['network'];
//        //$identity = $json_s['identity'];
//        // проверка на секрет
//        //print_r($json_s);
//        if ($verified_email == '1' && $uid > 0 && $_GET['s_login'] == '273456781') {
//            $phone = $this->phoneReplace($phone);
//            //echo "first_name: {$phone}<br/>\n";
//
//            $sqlLight = new \project\sqlLight();
//            if (strlen($phone) == 0) {
//                $query = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and `active`=0";
//                $user_not_activate = $sqlLight->queryList($query, array($email), 0);
//                if (count($user_not_activate) > 0) {
//                    $_SESSION['errors'][] = 'Активируйте учетную запись<br/>письмо уже выслано на электронный адрес ( ' . $email . ' ) ';
//                    return false;
//                } else {
//                    $query = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and `active`=1";
//                    $users = $sqlLight->queryList($query, array($email), 0);
//                }
//            } else {
//                $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active`=1";
//                $users = $sqlLight->queryList($query, array($email, $phone), 0);
//            }
//
//            //print_r($users);
//
//            if (count($users) > 0) {
//                $_SESSION['user']['info'] = $users[0];
//                $data = $this->getUserInfo($users[0]['id']);
//                //print_r($data);
//                $_SESSION['user']['info'] = $data;
//                return true;
//            } else {
//                $password = $this->password_generate();
//                /*
//                 * Нужно еще отправлять пароль пользователю на почту !!!!!!!!!!!!!
//                 */
//                $send_emails = new \project\send_emails();
//                //$send_emails->send('new_password', $email, array('user_password' => $password));
//                // Процесс регистрации
//                if ($this->register($email, $phone, $password, $password, 1, 1)) {
//                    $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active` = 1";
//                    $users = $sqlLight->queryList($query, array($email, $phone), 0);
//                    if (count($users) > 0) {
//                        $_SESSION['user']['info'] = $users[0];
//                        $this->insertRole($users[0]['id'], 3);
//                        $data = $this->getUserInfo($users[0]['id']);
//                        //print_r($data);
//                        $_SESSION['user']['info'] = $data;
//                        return true;
//                    }
//                } else {
//                    $_SESSION['errors'][] = 'Ошибка авторизации';
//                }
//            }
//        }
//
//        return false;
//    }

    public function emailValid($email) {
        $validator = new Validator();
        if ($validator->valid_email($email)) {
            return true;
        }
        return false;
    }

    public function phoneReplace($phone) {
        //$phone = str_replace('+7', '', $phone);
        //$phone = preg_replace("/[^,.0-9]/", '', $phone);
        $phone = preg_replace("/[^0-9]/", '', $phone);
        return $phone;
    }

    /**
     * Обновить пароль
     * @param type $newPassword
     * @param type $user_id
     * @return type
     */
    public function updateUserPassword($newPassword, $user_id) {
        $s = "UPDATE `zay_users` u set u.u_pass='?' "
                . "where u.id='?' ";
        $newPasswordHash = $this->passHash($newPassword);
        return $this->query($s, array($newPasswordHash, $user_id));
    }

    /**
     * Сгенерировать хеш пароля
     * @param type $password
     * @return type
     */
    public function passHash($password) {
        return sha1($password);
    }

    /**
     * Получить тело письма
     * @param type $file_name
     * @param type $email
     * @return type
     */
    private function fileTmpl($file_name, $email = '') {
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'] . '/system/user/auth/emailTmpl/' . $file_name . '_' . $_SESSION['lang'];
        $html = ob_get_clean();
        $html = str_replace('{email}', $email, $html);
        return $html;
    }

    /**
     * Отправка письма от администратора
     * @global \project\type $lang
     * @param type $email
     * @return boolean
     */
    public function sendActivateEmail($email, $activate_code, $email_format_code = '') {
        global $lang;
        $send_emails = new \project\send_emails();
        $config = new \project\config();
//        $link_ed_mailto = $config->getConfigParam('link_ed_mailto'); //'hello@edgardzaitsev.com';
//        if (strlen($config->getConfigParam('link_ed_mailto')) > 0) {
//            $link_ed_mailto = $config->getConfigParam('link_ed_mailto');
//        }
//        $from_name = str_replace(' ', '_', $lang['site_author_name']);
        // получи фаил шаблона письма
//        $email_body = $this->fileTmpl('mailActivateAccount', $email);
//        // заменим тэги
//        $email_body = str_replace("{site}", $_SERVER['SERVER_NAME'], $email_body);
//        $email_body = str_replace("{activate_code}", "?activation=" . $activate_code, $email_body);
//
//        $mail = new \project\Mail($link_ed_mailto);  // Создаём экземпляр класса
//        $mail->setType('text/html');
//        $mail->setFromName($from_name); // Устанавливаем имя в обратном адресе
//        if ($mail->send($email, "{$lang['text_activate_account']} {$_SERVER['SERVER_NAME']}", $email_body)) {
//            return true;
//        }
        $format_code = 'register_new_user';
        if (strlen($email_format_code) > 0) {
            $format_code = $email_format_code;
        }
        if ($send_emails->send($format_code, $email, array('site' => 'https://www.' . $_SERVER['SERVER_NAME'], 'activate_code' => "/?activation=" . $activate_code))) {
            return true;
        }
        return false;
    }

    /**
     * Активация пользователя
     * @global \project\type $lang
     * @param type $activate_code
     * @return boolean
     */
    public function activate($activate_code) {
        global $lang;
        $code = base64_decode($activate_code);
        $sqlLight = new \project\sqlLight();

        $query = "SELECT * FROM `zay_users` u WHERE `active_code`='?' ";
        $users = $sqlLight->queryList($query, array($code));
        if (count($users) > 0) {
            $queryUpdate = "UPDATE `zay_users` SET `active`='1', `active_code`='' "
                    . "WHERE `id`='?' and `active_code`='?' ";
            if ($sqlLight->query($queryUpdate, array($users[0]['id'], $code))) {
                // присвоим роль
                $this->insertRole($users[0]['id'], 3);

                //Авторизируем сразу
                $data = $this->getUserInfo($users[0]['id']);
                $_SESSION['user']['info'] = $data;
                return true;
            }
        }
        return false;
    }

    /**
     * Добавить роль к новому пользователю
     * @param type $user_id
     * @param type $role_id
     * @return boolean
     */
    private function insertRole($user_id, $role_id) {
        $sqlLight = new \project\sqlLight();
        $querySelect = "select * from `zay_roles_users` WHERE `user_id`='?'";
        $obj = $sqlLight->queryList($querySelect, array($user_id))[0];
        $query = '';
        if ($obj['user_id'] == 0) {
            $query = "INSERT `zay_roles_users` (`role_id`,`user_id`) "
                    . "VALUES ('?','?') ";
        } else {
            $query = "UPDATE `zay_roles_users` SET `role_id`='?' "
                    . "WHERE `user_id`='?' ";
        }
        if ($this->query($query, array($role_id, $user_id))) {
            return true;
        }
        return false;
    }

    public function password_generate() {
        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        // Количество символов в пароле.
        $max = 6;
        // Определяем количество символов в $chars
        $size = StrLen($chars) - 1;
        // Определяем пустую переменную, в которую и будем записывать символы.
        $password = null;
        // Создаём пароль.

        while ($max--) {
            $password .= $chars[rand(0, $size)];
        }
        return $password;
    }

    /**
     * Создадим ссылку для восстановления пароля
     * @param type $email
     * @return boolean
     */
    public function re_password($email) {
        $querySelectUser = "SELECT * FROM `zay_users` u WHERE u.email='?'";
        $objs = $this->getSelectArray($querySelectUser, array($email));
        if (count($objs) > 0) {
            $u_id = $objs[0]['id'];
            $u_email = $objs[0]['email'];
            $u_re_pass = $objs[0]['re_pass'];
            $re_pass = $this->passHash(time());
            $queryUpdate = "UPDATE `zay_users` SET `re_pass`='?' WHERE `id`='?'";
            if ($this->query($queryUpdate, array($re_pass, $u_id))) {
                $send_emails = new \project\send_emails();
                // Отправка подготовленного сообщения
                if ($send_emails->send('re_password', $email, array('site' => 'https://www.' . $_SERVER['SERVER_NAME'], 'link' => "<a href='https://www.{$_SERVER['SERVER_NAME']}/auth/?repassword={$re_pass}' target='_blank'>перейти</a>"))) {
                    return true;
                }
            }
        } else {
            $_SESSION['errors'][] = 'Пользователь не зарегистрирован или неверно указали адрес электронной почты';
        }
        return false;
    }

    /**
     * Изменение пароля
     * @param type $re_pass
     * @param type $p
     * @param type $p2
     * @return boolean
     */
    public function re_password_go($re_pass, $p, $p2) {
        if (strlen($re_pass)) {
            if (strlen($p) >= 3) {
                if ($p == $p2) {
                    $password = $this->passHash($p);
                    $queryUpdate = "UPDATE `zay_users` u SET u.`u_pass`='?', u.`re_pass`='' WHERE u.`re_pass`='?'";
                    if ($this->query($queryUpdate, array($password, $re_pass))) {
                        return true;
                    }
                } else {
                    $_SESSION['errors'][] = 'Пароли не совпадают!';
                }
            } else {
                $_SESSION['errors'][] = 'Слишком короткий пароль!';
            }
        } else {
            $_SESSION['errors'][] = 'Ошибка процедуры!';
        }
        return false;
    }

    /**
     * Назначить код интеграции
     * @param type $email
     * @param type $code
     * @return boolean
     */
    public function set_code_integration($email, $code) {
        $error = array();
        $sqlLight = new \project\sqlLight();

        $query = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and `active` = '1' ";
        $users = $sqlLight->queryList($query, array($email));

        if ($users[0]['id'] > 0) {
            $q = "UPDATE `zay_users` SET `code_integration`='?' WHERE `id`='?' ";
            if ($sqlLight->query($q, array($code, $users[0]['id']))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Авторизация по интеграционному коду 
     * @param type $code
     * @return boolean
     */
    public function code_integration_auth_user($code) {
        $error = array();
        $sqlLight = new \project\sqlLight();
        $query = "SELECT * FROM `zay_users` u WHERE u.`code_integration`='?' and `active` = '1' ";
        $users = $sqlLight->queryList($query, array($code));

        $query = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and u.`u_pass`='?' and `active` = 1";
        $user = $sqlLight->queryList($query, array($users[0]['email'], $users[0]['u_pass']));

        if (count($user) > 0) {
            $_SESSION['user']['info'] = $user[0];
            $data = $this->getUserInfo($user[0]['id']);
            $_SESSION['user']['info'] = $data;
            return true;
        }
        return false;
    }

}
