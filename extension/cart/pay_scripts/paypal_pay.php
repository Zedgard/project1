<?php

/*
 * Оплата через PayPal
 */
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';

/*
  // Справка
  // https://dcblog.dev/how-to-integrate-paypal-into-php
  // $paypal_url = "https://ipnpb.paypal.com/cgi-bin/webscr"; // работает когда простая форма

  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="<?= $paypal_email ?>">
  <input type="hidden" name="item_name" value="<?= $title ?>">
  <input type="hidden" name="item_number" value="1">
  <input type="hidden" name="amount" value="<?= $price_total ?>">
  <input type="hidden" name="return" value="<?= $url_ref ?>">
  <input type="hidden" name="no_shipping" value="1">
  <input type="hidden" name="currency_code" value="RUB">
  <input type="hidden" name="lc" value="RU" />
  <input type="hidden" name="email" value="<?= $email ?>">
  <input type="submit" name="submit" border="0" class="btn button btngreen2 text-center btn_cart btn_cart_paypal" value="PayPal">
  </form>
 */

$sign_up_consultation = new \project\sign_up_consultation();
$sqlLight = new \project\sqlLight();
$config = new \project\config();
$products = new \project\products();
$c_cart = new \project\cart();
$p_user = new \project\user();

$paypal_url = "https://ipnpb.sandbox.paypal.com/cgi-bin/webscr"; // работает через curl

$url_ref = $config->getConfigParam('pay_site_url_ref');
$url_ref = "{$url_ref}/pay.php?paypal=1";
$paypal_email = $config->getConfigParam('paypal_email');

$paypal_email = $config->getConfigParam('paypal_email');
//print_r($_SESSION['cart']['itms']);
$price_total = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart']['itms']) > 0) {
    $title = "";
    foreach ($_SESSION['cart']['itms'] as $key => $value) {
        $email = $value['user_email'];
        $title .= $value['title'] . " : ";
        if ($value['price_promo'] > 0) {
            $price = $value['price_promo'];
        } else {
            $price = $value['price'];
        }
        $price_total += $price;
    }
}

/**
 * Заглушка для админов покупка за 1 рубль
 */
if ($p_user->isEditor()) {
    $price_total = 1;
}

// Если авторезированный
if (strlen($p_user->isClientEmail()) > 0) {
    $email = $p_user->isClientEmail();
}

/*
 * Зафиксируем платеж в базе данных 
 */
// подготовим данные
if (!isset($_SESSION['pay_key'])) {
    $_SESSION['pay_key'] = uniqid('', true);
}
$pay_key = $_SESSION['pay_key'];

$client_email = $p_user->isClientEmail();
$client_id = ($p_user->isClientId() > 0) ? $p_user->isClientId() : 0;

// Передадим ID пользователя (Создается при консультации)
if ($client_id == 0) {
    $client_id = $_SESSION['cart']['itms'][0]['user_id'];
}
$pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
$pay_status = "pending"; // Устанавливаем стандартный статус платежа

$pay_descr = (strlen($_SESSION['cart']['itms'][0]['pay_descr']) > 0) ? $_SESSION['cart']['itms'][0]['pay_descr'] : '';
if (strlen($pay_descr) > 0) {
    $_SESSION['consultation'] = $_SESSION['cart']['itms'][0];
}

// начнем заносить данные в базу данных
$querySelect = "select * from `zay_pay` WHERE pay_type='pp' AND pay_key='?'";
$pays = $sqlLight->queryList($querySelect, array($pay_key));
if (count($pays) == 0) {
    $queryMaxId = "select MAX(p.id) max_id from `zay_pay` p";
    $max_id = $sqlLight->queryList($queryMaxId, array())[0]['max_id'] + 1;

    // Сохраняем данные платежа в базу
    $query = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `pay_status`, `pay_descr`, `confirmationUrl`) "
            . "VALUES ('?', '?','?', '?', '?', '?', '?', '?', '?')";
    if ($sqlLight->query($query, array(($max_id), 'pp', $client_id, $price_total, $pay_date, $pay_key, $pay_status, $pay_descr, ''))) {
        foreach ($_SESSION['cart']['itms'] as $key => $value) {
            $product_id = $value['id'];
            if ($product_id > 0) {
                if ($value['price_promo'] > 0) {
                    $price = $value['price_promo'];
                } else {
                    $price = $value['price'];
                }
                // доп. данные
                $queryProductRegister = "INSERT INTO `zay_pay_products`(`pay_id`, `product_id`, `product_price`) "
                        . "VALUES ('?','?','?')";
                $sqlLight->query($queryProductRegister, array($max_id, $product_id, $price));
                // Зафиксируем продажу
//                echo $product_id . "<br/>\n";
//                $products->setSoldAdd($product_id);
            }
        }
        /*
         * Если это консультация 
         */
        if ($_SESSION['consultation']['your_master_id'] > 0) {
            $_SESSION['consultation']['pay_id'] = $max_id;
            $sign_up_consultation->add_consultation($_SESSION['consultation']);
        }
    }
}


$pay_email = trim($_GET['pay_email']);

$post_array = array('cmd' => '_xclick',
    'business' => $paypal_email,
    'item_name' => 'test_1',
    'item_number' => '1',
    'amount' => $price_total,
    'return' => $url_ref,
    'no_shipping' => '1',
    'currency_code' => 'RUB',
    'lc' => 'RU',
    'email' => $pay_email//'koman1706@gmail.com'
    );
foreach ($post_array as $key => $value) {
    $req .= "&{$key}={$value}";
}
//$req = '&cmd=_xclick';
$ch = curl_init($paypal_url);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
$res = curl_exec($ch);

if (curl_errno($ch) != 0) {
    throw new \Exception("Can't connect to PayPal to validate IPN message: " . curl_error($ch));
} else {
    $ex = explode("\n", $res);
    foreach ($ex as $value) {
        $ex2 = explode(": ", $value);
        if ($ex2[0] == 'X-PP-HTTP-FORWARD') {
            header("Location: {$ex2[1]}");
        }
    }
}
curl_close($ch);
