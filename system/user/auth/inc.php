<?php

namespace project;

/*
 * Авторизация пользователя
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/user/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/validator.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/mail.php';

class auth extends \project\user {

    public function __construct() {
        parent::__construct();
        ;
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
                $_SESSION['user_auth_data'] = $users;
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

            $sqlLight = new \project\sqlLight();

            $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active` = 1";
            $users = $sqlLight->queryList($query, array($email, $phone));
            if ($sqlLight->getCount() > 0) {
                $error[] = $lang['user_search_register_true'];
            }

            if (count($error) == 0) {
                $query = "INSERT INTO `zay_users`(`email`, `phone`, `first_name`, `last_name`, `u_pass`, `active`, `active_lastdate`) "
                        . "VALUES ('?','?','','','?',0, NOW() )";
                if ($sqlLight->query($query, array($email, $phone, $pass_hash))) {
                    //$this->sendActivateEmail($email);
                    return true;
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
     * Отправка формы после регистрации
     * @global type $lang
     * @param type $email
     * @return boolean
     */
    private function sendActivateEmail($email) {
        global $lang;
        $from_name = str_replace(' ', '_', $lang['site_author_name']);

        $email_body = $this->fileTmpl('mailActivateAccount', $email);

        $m = new \project\Mail();  // utf-8 проходит везде на отлично.  можно сразу указать кодировку, можно ничего не указывать ($m= new Mail;)
        $m->From("{$from_name};{$_SERVER['SERVER_NAME']}"); // от кого Можно использовать имя, отделяется точкой с запятой
        $m->ReplyTo("{$from_name}};hello@edgardzaitsev.com"); // куда ответить, тоже можно указать имя
        $m->To("hello@edgardzaitsev.com");   // кому, в этом поле так же разрешено указывать имя
        $m->Subject("{$lang['text_activate_account']} {$_SERVER['SERVER_NAME']}");
        $m->Body($email_body);
        //$m->Cc("kopiya@asd.ru");  // кому отправить копию письма
        //$m->Bcc("skritaya_kopiya@asd.ru"); // кому отправить скрытую копию
        $m->Priority(4); // установка приоритета
        //$m->Attach("/toto.gif", "", "image/gif"); // прикрепленный файл типа image/gif. типа файла указывать не обязательно
        //$m->smtp_on("smtp.asd.com", "login", "passw", 25, 10); // используя эу команду отправка пойдет через smtp
        $m->Send(); // отправка
        return true;
    }

}
