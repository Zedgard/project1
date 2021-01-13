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


if(isset($_POST['check_pay']) && $_POST['check_pay'] == 'ya'){
    
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/ya_check_pay.php';
}
if(isset($_POST['check_pay']) && $_POST['check_pay'] == 'in'){
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/in_check_pay.php';
}