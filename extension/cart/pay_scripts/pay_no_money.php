<?php

/*
 * Покупка без оплаты
 */

include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/inc.php';

$pr_cart = new \project\cart();
$sqlLight = new \project\sqlLight();
$config = new \project\config();
$products = new \project\products();
$u = new \project\user();
$sign_up_consultation = new \project\sign_up_consultation();
$close_club = new \project\close_club();

$pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
$pay_status = "succeeded"; // Устанавливаем стандартный статус платежа

if (count($_SESSION['cart']['itms']) > 0) {
    $client_id = ($u->isClientId() > 0) ? $u->isClientId() : 0;

    // Передадим ID пользователя (Создается при консультации)
    if ($client_id == 0) {
        $client_id = $_SESSION['cart']['itms'][0]['user_id'];
    }

    $pay_descr = (strlen($_SESSION['cart']['itms'][0]['pay_descr']) > 0) ? $_SESSION['cart']['itms'][0]['pay_descr'] : '';
    if (strlen($pay_descr) > 0) {
        $_SESSION['consultation'] = $_SESSION['cart']['itms'][0];
    }

    $queryMaxId = "select MAX(p.id) max_id from `zay_pay` p";
    $max_id = $sqlLight->queryList($queryMaxId, array())[0]['max_id'] + 1;


    $query = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `pay_status`, `pay_interkassa_id`, `pay_descr`, `confirmationUrl`) "
            . "VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?')";
    if ($sqlLight->query($query, array(($max_id), 'nm', $client_id, $price_total, $pay_date, '', $pay_status, '', $pay_descr, ''), 0)) {
//        foreach ($_SESSION['cart']['itms'] as $key => $value) {
//            $product_id = $value['id'];
//            if ($product_id > 0) {
//                if ($value['price_promo'] > 0) {
//                    $price = $value['price_promo'];
//                } else {
//                    $price = $value['price'];
//                }
//                $queryProductRegister = "INSERT INTO `zay_pay_products`(`pay_id`, `product_id`, `product_price`) "
//                        . "VALUES ('?','?','?')";
//                $sqlLight->query($queryProductRegister, array($max_id, $product_id, $price));
//            }
//        }
        
        // Сохраним связи с продуктами
        $pr_cart->pay_insert_pay_products($max_id, $_SESSION['cart']['itms']);

        // Зарегистрируем покупку
        $pr_cart->register_pay($max_id);

        // Зафиксируем продажу
        $query_products = "select * from zay_pay_products WHERE pay_id='?'";
        $products_data = $sqlLight->queryList($query_products, array($max_id));
        foreach ($products_data as $v) {
            $products->setSoldAdd($v['product_id']);
        }

        $_SESSION['cart']['itms'] = array();
        // Отправляем пользователя на страницу оплаты
        header('Location: /?page_type=pay_thanks');
    } else {
        echo 'Ошибка операции!';
    }
} else {
    echo 'Корзина пуста!';
}