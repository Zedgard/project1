<?php

defined('__CMS__') or die;


include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once 'inc.php';

$c_chat = new \project\chat();
$user = new \project\user();
$config = new \project\config();

// Получим сообщения чата
if (isset($_POST['get_messages'])) {
    $data = $c_chat->chat_get_messages();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// отправим сообщение 
if (isset($_POST['send_message'])) {
    $result = array('success' => 0, 'success_text' => 'Ошибка');
    $message = (isset($_POST['message'])) ? trim($_POST['message']) : '';
    if (strlen($message) > 2) {
        if ($c_chat->chat_send_message($message)) {
            $result = array('success' => 1, 'success_text' => '');
        }
    } else {
        $result = array('success' => 0, 'success_text' => 'Слишком короткое сообщение');
    }
}

// Удалим сообщение
if (isset($_POST['del_messages'])) {
    $result = array('success' => 0, 'success_text' => 'Ошибка');
    $message_id = (isset($_POST['message_id'])) ? $_POST['message_id'] : 0;
    if ($message_id > 0) {
        if ($c_chat->chat_del_message($message_id)) {
            $result = array('success' => 1, 'success_text' => '', 'data' => $data);
        }
    }
}