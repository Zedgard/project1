<?php

/*
 * Yandex оплата
 * Настройки находятся в файле config.php 
 * 
 *  */
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';

$sqlLight = new \project\sqlLight();
$config = new \project\config();
$products = new \project\products();
$sign_up_consultation = new \project\sign_up_consultation();

// Ссылка на переадресацию ответа 
$url_ref = $config->getConfigParam('pay_site_url_ref');
$ya_shop_id = $config->getConfigParam('ya_shop_id');
$ya_shop_api_key = $config->getConfigParam('ya_shop_api_key');

$pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
$pay_status = "pending"; // Устанавливаем стандартный статус платежа
// Подключаем библиотеку Я.Кассы
require $_SERVER['DOCUMENT_ROOT'] . '/system/yandex-checkout-sdk-php-master/lib/autoload.php';

use YandexCheckout\Client;

$client = new Client();
$client->setAuth($ya_shop_id, $ya_shop_api_key);

/*
  Собираем данные по платежу
 */
$p_user = new \project\user();

$price_total = 0;
if (isset($_SESSION['cart']['itms']) && count($_SESSION['cart']['itms']) > 0) {
    foreach ($_SESSION['cart']['itms'] as $key => $value) {
        $email = $value['user_email'];
        if ($value['price_promo'] > 0) {
            $price = $value['price_promo'];
        } else {
            $price = $value['price'];
        }
        $price_total += $price;
    }
    /**
     * Заглушка для админов покупка за 1 рубль
     */
    if ($p_user->isEditor()) {
        $price_total = 1;
    }

    $client_id = ($p_user->isClientId() > 0) ? $p_user->isClientId() : 0;

    // Передадим ID пользователя (Создается при консультации)
    if ($client_id == 0) {
        $client_id = $_SESSION['cart']['itms'][0]['user_id'];
    }
    if ($client_id > 0) {
        $pay_descr = (strlen($_SESSION['cart']['itms'][0]['pay_descr']) > 0) ? $_SESSION['cart']['itms'][0]['pay_descr'] : '';
        if (strlen($pay_descr) > 0) {
            $_SESSION['consultation'] = $_SESSION['cart']['itms'][0];
        }

        // Создаем платеж
        $idempotenceKey = uniqid('', true); // Генерируем ключ 
        //print_r($_SESSION['user']['info']['email']);
        //echo $price_total . " em: {$_SESSION['user']['info']['email']} | {$p_user->isClientEmail()}<br/>\n";
        //echo $p_user->isClientEmail();
        //echo $p_user->isClientEmail();
        //  exit();
        $errors = 0;

        // Если авторезированный
        if (strlen($p_user->isClientEmail()) > 0) {
            $email = $p_user->isClientEmail();
        }
        $return_url = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}/check_pay.php?check_pay=ya";//?page_type=pay_thanks";

        $data_array = array(
            "amount" => array(
                "value" => $price_total, // Сумма платежа
                "currency" => "RUB" // Валюта платежа
            ),
            "confirmation" => array(
                "type" => "embedded",
                "return_url" => $return_url //"{$url_ref}/shop/cart/?ya_payment_true=1" // Куда отправлять пользователя после оплаты
            ),
            "capture" => true, // Платеж в один этап
            //"save_payment_method" => true,
            "receipt" => array(
                "customer" => array(
                    "email" => $email,
                ),
                "items" => array(
                    array(
                        "description" => "Описание услуги",
                        "quantity" => "1.00", // Количество
                        "amount" => array(
                            "value" => $price_total,
                            "currency" => "RUB"
                        ),
                        "tax_system_code" => "2", // Налогообложение 
                        "vat_code" => "2",
                        "payment_mode" => "full_prepayment", // Полный платеж
                        "payment_subject" => "service" // Услуга
                    )
                )
            ),
                //'save_payment_method' => true  // сохранение данных о платеже, при тестовом платеже вызывает ошибку
        );
        //print_r($data_array);
        //exit();
        try {
            $payment = $client->createPayment(
                    $data_array,
                    uniqid('', true)
            );
        } catch (Exception $exc) {
            $errors = 1;
            //echo $exc->getTraceAsString();
            echo 'Ошибка генерации массива данных';
        }

        if ($errors == 0) {
            //print_r($payment);
            // Получаем ссылку на оплату
            //$confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();
            // Получаем платежный ключ
            $pay_key = $payment->getid();
            $_SESSION['PAY_KEY'] = $pay_key;

            $queryMaxId = "select MAX(p.id) max_id from `zay_pay` p";
            $max_id = $sqlLight->queryList($queryMaxId, array())[0]['max_id'] + 1;
            $pay_id = $max_id;
            //echo "pay_key: {$pay_key} <br/>\n";
            //print_r($payment);
//echo $max_id . "<br/>\n";
// Сохраняем данные платежа в базу
            $queryPay = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `payment_type`, `payment_c`, `payment_bank`, `pay_status`, `pay_interkassa_id`, `pay_descr`, `confirmationUrl`) "
                    . "VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?')";
            if ($sqlLight->query($queryPay, array(($max_id), 'ya', $client_id, $price_total, $pay_date, $pay_key, '', '', '', $pay_status, '', $pay_descr, $confirmationUrl), 0)) {
                foreach ($_SESSION['cart']['itms'] as $key => $value) {
                    $product_id = $value['id'];
                    if ($product_id > 0) {
                        if ($value['price_promo'] > 0) {
                            $price = $value['price_promo'];
                        } else {
                            $price = $value['price'];
                        }
                        $queryProductRegister = "INSERT INTO `zay_pay_products`(`pay_id`, `product_id`, `product_price`) "
                                . "VALUES ('?','?','?')";
                        $sqlLight->query($queryProductRegister, array($max_id, $product_id, $price));
                        // Зафиксируем продажу
                        //$products->setSoldAdd($product_id);
                    }
                }
                /*
                 * Если это консультация 
                 */
//                if ($_SESSION['consultation']['your_master_id'] > 0) {
//                    $_SESSION['consultation']['pay_id'] = $max_id;
//                    $sign_up_consultation->add_consultation($_SESSION['consultation']);
//                }

                if ($pay_status == 'succeeded') {
                    // Зарегистрируем покупку
                    $pr_cart->register_pay($pay_id);
                }

                // Отправляем пользователя на страницу оплаты
                //header('Location: ' . $confirmationUrl);
            } else {
                $_SESSION['errors'][] = 'Ошибка операции!';
            }
        } else {
            $_SESSION['errors'][] = "<div>Ошибка операции!</div>";
        }
    }
} else {
    $_SESSION['errors'][] = 'Нет товаров к покупке!';
}