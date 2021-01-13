<?php

session_start();

/*
 * Скрипты оплаты
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';

/*
 * Узнаем цену  
 */
$price_total = 0;
foreach ($_SESSION['cart']['itms'] as $key => $value) {
    if ($value['price_promo'] > 0) {
        $price = $value['price_promo'];
    } else {
        $price = $value['price'];
    }
    $price_total += $price;
}
// если цена = 0 то сразу активируем продукт у пользователя
if ($price_total > 0) {
    if (isset($_GET['yandex'])) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/ya_pay.php';
    }
    if (isset($_GET['paypal'])) {
        //include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/ya_pay.php';
    }
    if (isset($_GET['interkassa'])) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/in_pay.php';
    }
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/pay_no_money.php';
}