<?php

defined('__CMS__') or die;

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/close_club/inc.php';
include_once 'inc.php';

$config = new \project\config();
$p_user = new \project\user();

/**
 * Письмо пользователю
 */
if (isset($_POST['user_send_message'])) {
    $user_fio = $_POST['user_fio'];
    $user_email = $_POST['user_email'];
    $user_subject = $_POST['user_subject'];
    $user_message = $_POST['user_message'];
    $arrayReplaseText = array(
        'user_fio' => $user_fio,
        'user_email' => $user_email,
        'user_subject' => $user_subject,
        'user_message' => $user_message,
    );

    if (strlen($config->getConfigParam('link_ed_mailto')) > 0) {
        $link_ed_mailto = $config->getConfigParam('link_ed_mailto');
        //$link_ed_mailto = 'koman1706@gmail.com';
         
        //echo "link_ed_mailto: {$link_ed_mailto} <br/>\n";

        if ($p_user->sendEmail($link_ed_mailto, 'send_user_message', $arrayReplaseText)) {
            $result = array('success' => 1, 'success_text' => 'Успешно отправлено, ждите ответа.');
        } else {
            $_SESSION['errors'][] = 'Не отправлено!';
            $result = array('success' => 0, 'success_text' => '');
        }
    }
}