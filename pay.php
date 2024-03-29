<?php
session_start();

/*
 * Скрипты оплаты
 * Для автоматической проверки платежей создайте задания CRON
 * Yandex
 * wget -O /dev/null https://edgardzaycev.com/check_pay.php?check_pay=ya
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';

/*
 * Узнаем цену  
 */
$price_total = 0;
if (isset($_SESSION['cart']['itms'])) {
    foreach ($_SESSION['cart']['itms'] as $key => $value) {
        $price = $value['price'];
        if ($value['price_promo'] > 0) {
            $price = $value['price_promo'];
        }
        $price_total += $price;
    }
// если цена = 0 то сразу активируем продукт у пользователя
    if ($price_total > 0) {
        $pay = 0;
        if (isset($_GET['yandex'])) {
            $pay = 1;
            include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/ya_pay.php';
        }
        if (isset($_GET['interkassa'])) {
            $pay = 1;
            include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/in_pay.php';
        }
        if (isset($_GET['paypal'])) {
            $pay = 1;
            include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/paypal_pay.php';
        }
        if (isset($_GET['tinkoff'])) {
            $pay = 1;
            include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/tk_pay.php';
        }
        if ($pay == 0) {
            header("Location: /404.php", true, 404);
        }
    } else {
        include $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/pay_scripts/pay_no_money.php';
    }
} else {
    ?>
    <div>Корзина пуста!</div>
    <?
}