<?php

session_start();

/*
 * Скрипты проверки проведения платежей
 * Повесить данный процесс на CRON
 * 
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';

if (isset($_POST['check_pay'])) {
    $check_pay = $_POST['check_pay'];
}
if (isset($_GET['check_pay'])) {
    $check_pay = $_GET['check_pay'];
}

// обработка ответа yandex
if ($check_pay == 'ya') {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/ya_check_pay.php';
}
// Обработка ответа интеркассы
//if ($check_pay == 'in') {
    //include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/in_check_pay.php';
//}
// Обработка ответа интеркассы
if ($check_pay == 'tk') {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/tk_check_pay.php';
}
// Обработка ответа cloudpayments
if ($check_pay == 'cp') {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/cp_check_pay.php';
}