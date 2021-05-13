<?php

/*
 * Раздел мои покупки
 */

defined('__CMS__') or die;

include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
include_once 'inc.php';

$p_cart = new \project\cart();
//$p_products = new \project\products();
//$c_cart = new \project\cart();
//$p_user = new \project\user();
//$auth = new \project\auth();

$get_pay_user_list = $p_cart->get_pay_user_list();

include 'tmpl/shopping.php';