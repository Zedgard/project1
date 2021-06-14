<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/mail.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';

class get_emails extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Получить все email адреса
     * @return type
     */
    public function get_emails($email = '', $send_active = '') {
        if (strlen($email) == 0) {
            $querySelect = "SELECT * FROM `zay_get_emails` order by `id` DESC";
            return $this->getSelectArray($querySelect, array());
        } else {
            if (strlen($send_active) == 0) {
                // поиск по email
                $querySelect = "SELECT * FROM `zay_get_emails` WHERE `get_email`='?' order by `id` DESC";
                return $this->getSelectArray($querySelect, array($email));
            } else {
                // по условию 
                $querySelect = "SELECT * FROM `zay_get_emails` WHERE `get_email`='?' and `send_active`='?' order by `id` DESC";
                return $this->getSelectArray($querySelect, array($email, $send_active));
            }
        }
        return false;
    }

    /**
     * Добавим новый email адрес
     * @param type $email
     * @return type
     */
    public function set_email($email) {
        $token = $this->get_email_token();
        $query = "INSERT INTO `zay_get_emails`(`get_email`,`token`) VALUES ('?','?')";
        $return = $this->query($query, array($email, $token));
        if ($return) {
            // Отправить сообщение пользователю для подтверждения почты
            $send_emails = new \project\send_emails();
            if ($send_emails->send('set_emails', $email, array(
                'site_activate_email' => "/auth/?set_email_true={$token}",
                'site_unactivate_email' => "/auth/?set_email_false={$email}")
                )) {
                return true;
            }
        }
        return false;
    }

    /**
     * Подтверждение сеществования адреса электронной почты
     * @param type $token
     * @return boolean
     */
    public function get_email_activate($token) {
        $querySelect = "SELECT * FROM `zay_get_emails` WHERE `token`='?' ";
        $obj = $this->getSelectArray($querySelect, array($token));
        if (count($obj) > 0) {
            if ($obj[0]['id'] > 0) {
                // обновим статус
                $query = "UPDATE `zay_get_emails` SET `token`='',`activate`='1' WHERE `id`='?'";
                return $this->query($query, array($obj[0]['id']));
            }
        }
        return false;
    }
    /**
     * Отписаться от рассылки
     * @param type $email
     * @return boolean\
     */
    public function get_email_unactivate($email) {
        $querySelect = "SELECT * FROM `zay_get_emails` WHERE `get_email`='?' ";
        $obj = $this->getSelectArray($querySelect, array($email));
        if (count($obj) > 0) {
            if ($obj[0]['id'] > 0) {
                // обновим статус
                $query = "UPDATE `zay_get_emails` SET `token`='',`activate`='0' WHERE `id`='?'";
                return $this->query($query, array($obj[0]['id']));
            }
        }
        return false;
    }

    /**
     * Колличество не обработанных подписчиков
     * @return type
     */
    public function get_emails_col() {
        $querySelect = "SELECT count(*) as col FROM `zay_get_emails` WHERE `activate`='1' and send_active='0' ";
        return $this->getSelectArray($querySelect, array())[0]['col'];
    }

    /**
     * Обновить признак просмотра
     * @param type $id
     * @param type $send_activate
     * @return type
     */
    public function get_emails_send_active($id, $send_activate) {
        $query = "UPDATE `zay_get_emails` SET `send_active`='?' WHERE `id`='?'";
        return $this->query($query, array($send_activate, $id));
    }

    /**
     * Создать токен
     * @return type
     */
    private function get_email_token() {
        $token_str = sha1(time() . mt_rand(10000, 99999));
        return $token_str;
    }

}
