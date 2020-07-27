<?php

namespace project;

defined('__CMS__') or die;

/*
 * Авторизация пользователя
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/system/user/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/validator.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/mail.php';

class auth2 {

    public function __construct() {
        //parent::__construct();
        //;
    }

    /**
     * Авторизацтя нового пользователя
     * @global \project\type $lang
     * @param type $email
     * @param type $password
     * @return boolean
     */
    public function authorization($email, $password) {
        global $lang;
        if (strlen($email) > 2 && strlen($password) > 2) {
            $pass_hash = $this->passHash($password);

            $sqlLight = new \project\sqlLight();
            $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and u.`u_pass`='?' and `active` = 1";
            $users = $sqlLight->queryList($query, array($email, $email, $pass_hash));

            if (count($users) > 0) {
                $_SESSION['user']['info'] = $users;
                return true;
            } else {
                $_SESSION['errors'][] = $lang['user_search_authorization_false'];
            }
        } else {
            $_SESSION['errors'][] = $lang['no_input_form'];
        }
        return false;
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
    public function register($email, $phone, $pass, $pass_r, $check_private) {
        global $lang;
        $error = array();
        // если все поля введены
        if (strlen($email) > 2 && strlen($phone) > 2 && strlen($pass) > 2) {

            $validator = new Validator();
            if (!$validator->valid_email($email)) {
                $error[] = $lang['email_false'];
            }

            if ($check_private != 1) {
                $error[] = $lang['check_positions'];
            }

            $phone = $this->phoneReplace($phone);

            if ($pass == $pass_r) {
                $pass_hash = $this->passHash($pass);
            }

            $activate_code = $this->passHash(PRIVATE_CODE . $email . $pass . time());
            $activate_codeBase64 = base64_encode($activate_code);

            $sqlLight = new \project\sqlLight();

            $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active` = 1";
            $users = $sqlLight->queryList($query, array($email, $phone));
            if ($sqlLight->getCount() > 0) {
                $error[] = $lang['user_search_register_true'];
            }

            if (count($error) == 0) {
                $query = "INSERT INTO `zay_users`(`email`, `phone`, `first_name`, `last_name`, `u_pass`, `active`, `active_code`, `active_lastdate`) "
                        . "VALUES ('?','?','','','?',0, '?', NOW() )";
                if ($sqlLight->query($query, array($email, $phone, $pass_hash, $activate_code))) {
                    $this->sendActivateEmail($email, $activate_codeBase64);
                    return true;
                } else {
                    $error[] = $sqlLight->errors();
                }
            }
        } else {
            $error[] = $lang['no_input_form'];
        }

        if (count($error) > 0) {
            $_SESSION['errors'] = $error;
        }
        return false;
    }

    protected function phoneReplace($phone) {
        $phone = str_replace('+7', '', $phone);
        $phone = preg_replace("/[^,.0-9]/", '', $phone);
        return $phone;
    }

    /**
     * Сгенерировать хеш пароля
     * @param type $password
     * @return type
     */
    protected function passHash($password) {
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
    private function sendActivateEmail($email, $activate_code) {
        global $lang;
        $from_name = str_replace(' ', '_', $lang['site_author_name']);

        // получи фаил шаблона письма
        $email_body = $this->fileTmpl('mailActivateAccount', $email);
        // заменим тэги
        $email_body = str_replace("{site}", $_SERVER['SERVER_NAME'], $email_body);
        $email_body = str_replace("{activate_code}", "?activation=" . $activate_code, $email_body);

        $mail = new \project\Mail("hello@edgardzaitsev.com");  // Создаём экземпляр класса
        $mail->setType('text/html');
        $mail->setFromName($from_name); // Устанавливаем имя в обратном адресе
        if ($mail->send($email, "{$lang['text_activate_account']} {$_SERVER['SERVER_NAME']}", $email_body)) {
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

        $query = "SELECT * FROM `zay_users` u WHERE `active_code`='?' and `active`=0 ";
        $users = $sqlLight->queryList($query, array($code));
        if ($sqlLight->getCount() > 0) {
            $queryUpdate = "UPDATE `zay_users` SET `active`='1', `active_code`='' "
                    . "WHERE `id`='?' and `active_code`='?' ";
            if ($sqlLight->query($queryUpdate, array($users[0]['id'], $code))) {
                return true;
            } else {
                return false;
            }
        }
    }

}
