<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once 'inc.php';


$sign_up_consultation = new \project\sign_up_consultation();

$send_emails = new \project\send_emails();
$config = new \project\config();
$link_ed_mailto = $config->getConfigParam('link_ed_mailto');

// Получение списка консультанков
$consultation_masters = $sign_up_consultation->get_consultation_master();
//print_r($_SESSION['consultation']);
//echo "consultation_masters: {$link_ed_mailto}<br/>\n";
//$data = array();

// L2f6lernBsFZ
//$messageId='<'.time().'-'.md5($fromMail.$to).'@'.$_SERVER['SERVER_NAME'].'>';
//$headers = 'MIME-Version: 1.0' . "\r\n";
//$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
//$headers .= "From: " . 'koman1706@gmail.com' . " <" . $_SERVER['SERVER_NAME'] . "> \r\n";
//$headers .= "Date: " . date(DATE_RFC2822) . " \r\n";
//$headers .= "Message-ID: " . $messageId . " \r\n";
//mail('koman1706@gmail.com', 'тема', 'Сообщение текст 1212236', $headers);
//if ($send_emails->send('consultation', 'koman1706@gmail.com', array(
//            'site' => 'https://www.' . $_SERVER['SERVER_NAME'],
//            'fio' => $data['first_name'], 'email' => $data['user_email'], 'phone' => $data['user_phone'], 'descr' => $data['pay_descr'], 'date' => $data['date'], 'time' => $data['time'], 'period' => $period_str))) {
//    echo "OK";
//} else {
//    echo "NOOO!";
//}
//unset($_SESSION['consultation']);

//count($_SESSION['consultation']);
//$sign_up_consultation->set_consultation_times(1, array('03:00','04:00'));
include 'tmpl/admin.php';
