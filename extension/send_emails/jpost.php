<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/page/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include 'inc.php';
include 'lang.php';

$send_emails = new \project\send_emails();
$u = new \project\user();

if ($u->isEditor()) {

    if (isset($_POST['get_emails'])) {
        $data = $send_emails->get_emails();
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);
    }

    if (isset($_POST['get_file_body'])) {
        if (strlen($_POST['get_file_body']) > 0) {
            $body_text = $send_emails->file_get(trim($_POST['get_file_body']));
            $result = array('success' => 1, 'success_text' => '', 'data' => $body_text);
        }
    }

    /*
     * Редактирование сообщений
     */
    if (isset($_POST['edit_email_smtp'])) {
        $email_id = (isset($_POST['email_id']) && $_POST['email_id'] > 0) ? $_POST['email_id'] : 0;
        $email_subject = $_POST['email_subject'];
        $email_descr = $_POST['email_descr'];
        $email_body_file = $_POST['email_body_file'];
        $email_reply_to = $_POST['email_reply_to'];
        $email_text = $_POST['email_text'];
        $email_send = (isset($_POST['email_send']) && $_POST['email_send'] == '1') ? $_POST['email_send'] : 0;

        if ($send_emails->file_set($email_body_file, $email_text)) {
            if ($send_emails->edit_email_smtp($email_id, $email_subject, $email_descr, $email_body_file, $email_reply_to, $email_send)) {
                $result = array('success' => 1, 'success_text' => 'Сохранено');
            } else {
                $result = array('success' => 0, 'success_text' => 'Ошибка!');
            }
        } else {
            $result = array('success' => 0, 'success_text' => 'Ошибка сохранения файла!');
        }
    }


    /*
     * Получение настроек SMTP
     */
    if (isset($_POST['get_smtp_user_info'])) {
        $data = $send_emails->get_smtp_user_info();
        if (is_array($data)) {
            $result = array('success' => 1, 'success_text' => '', 'data' => $data);
        } else {
            $result = array('success' => 0, 'success_text' => 'Ошибка получения данных get_smtp_user_info');
        }
    }

    /*
     *  редактирование настроек SMTP
     */
    if (isset($_POST['edit_smtp_user_info'])) {
        $user_email = $_POST['config_email_username'];
        $user_password = $_POST['config_email_password'];
        if (strlen($user_email) > 0 && strlen($user_password) > 0) {
            if ($send_emails->edit_smtp_user_info($user_email, $user_password)) {
                $result = array('success' => 1, 'success_text' => '');
            } else {
                $result = array('success' => 0, 'success_text' => 'Ошибка обновления настроек edit_smtp_user_info');
            }
        } else {
            $result = array('success' => 0, 'success_text' => 'Необходимо заполнить все поля');
        }
    }

    /*
     * Предпросмотр body сообщения
     */
    if (isset($_POST['show_body_text_message'])) {
        if (strlen($_POST['show_body_text_message']) > 0) {
            $data = $send_emails->file_get_html(trim($_POST['show_body_text_message']));
            $result = array('success' => 1, 'success_text' => '', 'data' => $data);
        } else {
            $result = array('success' => 0, 'success_text' => 'Ошибка получения данных show_body_text_message');
        }
    }

    /*
     * Отправка тестового сообщения
     */
    if (isset($_POST['send_test_email'])) {
        if ($send_emails->send($_POST['email_code'], trim($_POST['send_test_email']), array())) {
            $result = array('success' => 1, 'success_text' => '');
        } else {
            $result = array('success' => 0, 'success_text' => '');
        }
    }
}