<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * [ik_co_id] => 5f5dfdf8f3f7ad5888515cd6 [ik_inv_id] => 244440086 [ik_inv_st] => success [ik_pm_no] => 1 ) 
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/inc.php';

require $_SERVER['DOCUMENT_ROOT'] . '/system/paypal-sdk/autoload.php';

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

$sqlLight = new \project\sqlLight();
$config = new \project\config();
$pr_cart = new \project\cart();
$p_user = new \project\user();

// Данные платежной системы
$clientId = $config->getConfigParam('paypal_client_id');
$clientSecret = $config->getConfigParam('paypal_client_secret');

// Подключаемся к системе
if ($clientId == 'AWhQommTsM02uROFM78sl252sngt6qgOLDOJ9VkuyG1F61ZJ8rjUUuQjE-IJvgfhQtV1hXMLeoKbvwfe') {
    $environment = new ProductionEnvironment($clientId, $clientSecret);
} else {
    $environment = new SandboxEnvironment($clientId, $clientSecret); // Для тестирования
}
$client = new PayPalHttpClient($environment);

$total = 0;
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
        $total += $price;
    }
}

$pay_key = $_SESSION['pay_key'];
$pay_check = 'succeeded';

// Подтверждение заказа клиента
if (isset($_GET['token'])) {
    $paypal_status = '';
    //print_r($_GET);
    if (isset($_GET['type']) && $_GET['type'] == 'success') {
        $pay_check = 'succeeded';
    } else {
        $pay_check = 'canceled'; // Отмена заказа
    }
// Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
// $response->result->id gives the orderId of the order created above
    $request = new OrdersCaptureRequest($_GET['token']);
    $request->prefer('return=representation');
    try {
        // Call API with your client and get a response for your call
        $response = $client->execute($request);

        // If call returns body in response, you can get the deserialized version from the result attribute of the response
        //print_r($response);
//      echo "<br/>\n";
//      echo "<b>code: </b>{$_SESSION['code']}<br/>\n";
//      echo "<br/>\n";
//      echo "response: {$response->statusCode} | {$response->result->id} | {$response->result->status}<br/>\n";
        $pay_id = 0;
        // Завершаем оплату успешным результатом
        if ($response->result->status == 'COMPLETED') {
            if (strlen($pay_key) > 0) {
                $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='pp' and `pay_status`='pending' and `pay_date`>=CURRENT_DATE-1 and pay_key='?'";
                $pays = $sqlLight->queryList($query, array($pay_key));
            } else {
                $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='pp' and `pay_status`='pending' and `pay_date`>=CURRENT_DATE-1";
                $pays = $sqlLight->queryList($query, array(), 0);
            }

            if (count($pays) > 0) {
                foreach ($pays as $value) {
                    $pay_id = $value['id'];
                    $query_update = "UPDATE zay_pay SET pay_status='?' WHERE id='?' ";
                    if ($sqlLight->query($query_update, array($pay_check, $pay_id))) {

                        $pr_cart->register_pay($pay_id);
                    } else {
                        echo 'Ошибка регистрации платежа! Пожалуйста сообщите администрации сайта о данный проблеме!';
                    }
                }
            }
            //goBack($url = '/shop/cart/?in_payment_true=1', $time = '0');
            $_SESSION['cart']['cart_itms'] = $_SESSION['cart']['itms'];
            $_SESSION['cart']['total'] = $total;
            $_SESSION['cart']['pay_id'] = $pay_id;
            $_SESSION['cart']['itms'] = array();
            $_SESSION['PAY_KEY'] = '';
            $_SESSION['PAY_AMOUNT'] = '';
            unset($_SESSION['PAY_KEY']);
            unset($_SESSION['PAY_AMOUNT']);
            $result = array('success' => 1, 'success_text' => 'Платеж успешно проведен', 'action' => '/?page_type=pay_thanks');
            location_href('/?page_type=pay_thanks');
        } else {
            $result = array('success' => 0, 'success_text' => "Ошибка платежа!");
        }
    } catch (HttpException $ex) {
        //echo $ex->statusCode;
        //print_r($ex->getMessage());
        $result = array('success' => 0, 'success_text' => "Не проведен! code: {$ex->statusCode}");
    }
} else {
    // Подтверждение транзакций
    $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='pp' and `pay_status`='pending' and `pay_date`>=CURRENT_DATE-1";
    $pays = $sqlLight->queryList($query, array(), 0);

    if (count($pays) > 0) {
        foreach ($pays as $value) {
            $pay_id = $value['id'];

            $request = new OrdersCaptureRequest($value['pay_key']);
            $request->prefer('return=representation');
            try {
                // Call API with your client and get a response for your call
                $response = $client->execute($request);
                // Завершаем оплату успешным результатом
                if ($response->result->status == 'COMPLETED') {
                    $query_update = "UPDATE zay_pay SET pay_status='?' WHERE id='?' ";
                    if ($sqlLight->query($query_update, array($pay_check, $pay_id))) {

                        $pr_cart->register_pay($pay_id);
                    } else {
                        echo 'Ошибка регистрации платежа! Пожалуйста сообщите администрации сайта о данный проблеме!';
                    }
                }
            } catch (HttpException $ex) {
                echo $ex->statusCode;
                print_r($ex->getMessage());
            }
        }
    }
}    