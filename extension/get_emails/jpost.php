<?php

defined('__CMS__') or die;

include_once 'inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/validator.php';

$validator = new \project\Validator();
$pr_get_emails = new \project\get_emails();

// получение списка электронных адресов 
if (isset($_POST['set_email'])) {
    $set_email = (strlen($_POST['set_email']) > 0) ? $_POST['set_email'] : '';
    $get_data = $pr_get_emails->get_emails($set_email, 1);
    // Проверим подписан ли человек
    if (count($get_data) > 0) {
        $result = array('success' => 0, 'success_text' => 'Вы уже подписаны');
    } else {
        if (strlen($set_email) > 0 && $validator->valid_email($set_email)) {
            if ($pr_get_emails->set_email($set_email)) {
                $result = array('success' => 1, 'success_text' => 'Успешно отправлено! ');
            } else {
                $result = array('success' => 0, 'success_text' => 'Ошибка!');
            }
        } else {
            $result = array('success' => 0, 'success_text' => 'Не верно указали адрес Email!');
        }
    }
}

/**
 * Обновить признак просмотра
 */
if (isset($_POST['send_active'])) {
    $objid = $_POST['objid'];
    $send_active = $_POST['send_active'];
    if ($pr_get_emails->get_emails_send_active($objid, $send_active)) {
        $result = array('success' => 1, 'success_text' => '');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}

/**
 * Колличество не обработанных заявок
 */
if (isset($_POST['get_emails_col'])) {
    $get_emails_col = $pr_get_emails->get_emails_col();
    $result = array('success' => 1, 'success_text' => '', 'get_emails_col' => $get_emails_col);
}