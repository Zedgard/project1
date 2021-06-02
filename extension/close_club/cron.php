<?php

/*
 * Оповещение о окончании абонемента закрытого клуба
 * выполнять по CRON раз в сутки
 */

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
include_once 'inc.php';

$close_club = new \project\close_club();
$send_emails = new \project\send_emails();

$array = array();
if (isset($_GET['user_id'])) {
    $where = "WHERE cc.user_id='?'";
    $array[] = $_GET['user_id'];
}

$query_select = "SELECT 
cc.*, u.email,
if(DATEDIFF(DATE_ADD(cc.end_date, INTERVAL -1 DAY) , CURRENT_DATE)=0, 1, 0) as day_1,
if(DATEDIFF(DATE_ADD(cc.end_date, INTERVAL -3 DAY) , CURRENT_DATE)=0, 1, 0) as day_3,
if(DATEDIFF(DATE_ADD(cc.end_date, INTERVAL -5 DAY) , CURRENT_DATE)=0, 1, 0) as day_5,
if(DATEDIFF(DATE_ADD(cc.end_date, INTERVAL -7 DAY) , CURRENT_DATE)=0, 1, 0) as day_7
FROM zay_close_club cc 
left join zay_users u on u.id=cc.user_id 
{$where}
";

$data = $close_club->getSelectArray($query_select, $array);
//print_r($data);
if (count($data) > 0) {
    foreach ($data as $value) {
        $params = array();
        if ($value['day_1'] == '1') {
            $params['day_str'] = 'один день';
        }
        if ($value['day_3'] == '1') {
            $params['day_str'] = 'три дня';
        }
        if ($value['day_5'] == '1') {
            $params['day_str'] = 'пять дней';
        }
        if ($value['day_7'] == '1') {
            $params['day_str'] = 'семь дней';
        }

        echo "email: {$value['email']} <br/>\n";
        if (count($params) > 0 && isset($_GET['send'])) {
            if ($send_emails->send('close_club_end_ticket', $value['email'], $params)) {
                echo "Отправлено<br/>\n";
            } else {
                echo "Ошибка<br/>\n";
            }
        }
        echo "--------<br/>\n";
    }
}

