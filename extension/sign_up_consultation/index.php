<?php

/*
 * Страница index
 */

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';

$sqlLight = new \project\sqlLight();
$config = new \project\config();
$products = new \project\products();
$u = new \project\user();

$url_ref = $config->getConfigParam('pay_site_url_ref');
$url_ref = "{$url_ref}/shop/cart/?pay_payment_true=1";

$paypal_email = $config->getConfigParam('paypal_email');

$price_total = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart']['itms']) > 0) {
    $title = "";
    foreach ($_SESSION['cart']['itms'] as $key => $value) {
        $email = $value['user_email'];
        $title .= $value['pay_descr'] . " : ";
        if ($value['price_promo'] > 0) {
            $price = $value['price_promo'];
        } else {
            $price = $value['price'];
        }
        $price_total += $price;
    }
}

// Если авторезированный
if (strlen($u->isClientEmail()) > 0) {
    $email = $u->isClientEmail();
}

include_once 'tmpl/index.php';
