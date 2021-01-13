<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';

/**
 * Создаем чат и работаем с ним<br/>
 * $chat = new \project\chat();<br/>
 * $chat->init_chat('chat_' . $id);<br/>
 */
class chat extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Запомним чат с котрым будем работать
     * @param type $chat_code
     */
    public function chat_init($chat_code) {
        $_SESSION['chat_code'] = $chat_code;
    }

    /**
     * Отобразим чат на интерфейсе
     */
    public function chat_show() {
        include $_SERVER['DOCUMENT_ROOT'] . '/extension/chat/office_webinars.php';
    }

    /**
     * Отправть сообщение
     * @param type $user_id
     * @param type $message
     */
    public function chat_send_message($message) {
        $user = new \project\user();
        $user_id = $user->isClientId();
        if (strlen($_SESSION['chat_code']) > 0) {
            if ($user_id > 0) {
                $query = "INSERT INTO `zay_chat`(`chat_code`, `user_id`, `message`) "
                        . "VALUES ('?','?','?')";
                return $this->query($query, array($_SESSION['chat_code'], $user_id, $message));
            }
        }
        return false;
    }

    /**
     * Получить сообщения чата
     * @return type
     */
    public function chat_get_messages() {
        if (strlen($_SESSION['chat_code']) > 0) {
            $query = "SELECT ch.*, u.email, u.phone, u.first_name, u.last_name FROM `zay_chat` ch "
                    . "left join `zay_users` u on u.`id`=ch.`user_id` "
                    . "WHERE ch.`chat_code`='?' ORDER by ch.`last_date` DESC LIMIT 50";
            return $this->getSelectArray($query, array($_SESSION['chat_code']));
        }
        return array();
    }

    /**
     * Удаление сообщения (Только собственное сообщение)
     * @param type $message_id
     * @return boolean
     */
    public function chat_del_message($message_id) {
        $user = new \project\user();
        $user_id = $user->isClientId();
        if (strlen($_SESSION['chat_code']) > 0) {
            if ($user_id > 0) {
                $query = "DELETE FROM `zay_chat` WHERE `chat_code`='?' and `user_id`='?' and `id`='?'";
                return $this->query($query, array($_SESSION['chat_code'], $user_id, $message_id));
            }
        }
        return false;
    }

    /**
     * Пингуем фаил
     * @param type $ping
     * @return type
     */
    private function ping_messages($ping = 0) {
        $ret = 0;
        $file = $_SERVER['DOCUMENT_ROOT'] . '/extension/chat/data/' . $_SESSION['chat_code'];
        if ($ping > 0) {
            fileSet($file, $ping);
        } else {
            $ret = fileGet($file);
        }
        return $ret;
    }

}
