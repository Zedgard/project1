<?php

/*
 * Обработки cron заданий
 */

/*
 * Yandex kassa
 * Проверим статусы платежей и зафиксируем успешность проведения платежа
 * Повесить данный процесс на CRON
 * 
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/inc.php';

// Подключаем CloudPayments
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/cloudpayments-php-client-master/src/Manager.php';

// Подключаем библиотеку Я.Кассы
require $_SERVER['DOCUMENT_ROOT'] . '/system/yandex-checkout-sdk-php-master/lib/autoload.php';

use YandexCheckout\Client;

$sqlLight = new \project\sqlLight();
$config = new \project\config();
$pr_cart = new \project\cart();

if ($_GET['pay_type'] == 'ya') {

    $ya_shop_id = $config->getConfigParam('ya_shop_id');
    $ya_shop_api_key = $config->getConfigParam('ya_shop_api_key');

    $client = new Client();
    $client->setAuth($ya_shop_id, $ya_shop_api_key);


    if (isset($_GET['pay_key'])) {
        $pay_key = $_GET['pay_key'];
    } else {
        $pay_key = $_SESSION['PAY_KEY'];
    }

    $result = array();

    // Проверяем статус оплаты
    if (isset($pay_key)) {
        $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='ya' and `pay_key`='?'";
        $pays = $sqlLight->queryList($query, array($pay_key));
    } else {
        $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='ya' and `pay_date`>=CURRENT_DATE-1";
        $pays = $sqlLight->queryList($query);
    }

    //print_r($pays);
    //echo "count: " . count($pays) . "<br/>\n";
    // Получаем список платежей циклом
    if (count($pays) > 0) {
        foreach ($pays as $value) {
            $pay_id = $value['id'];
            $paymentId = $value['pay_key']; // Получаем ключ платежа
            //echo "pay_key: {$paymentId} <br/>\n";
            $payment = $client->getPaymentInfo($paymentId); // Получаем информацию о платеже
            $pay_check = $payment->getstatus(); // Получаем статус оплаты
            if ($pay_check != 'succeeded') { // Если статус оплаты не завершенный то проверяем оплату еще раз
                $pay_paid = $payment->getPaid();
                if ($pay_paid) {
                    $payment->setstatus('succeeded');
                    $pay_check = $payment->getstatus();
                }
            }
            //echo "pay_check: {$pay_check} <br/>\n";
            //    
            //    echo "paymentId: {$paymentId} <br/>\n";
            //    echo "pay_paid: {$pay_paid} <br/>\n";
            //    echo "payment: ";
            //    print_r($payment['payment_method']->_first6);
            //    echo "<br/>\n";
            //    echo "pay_check: {$pay_check} <br/>\n";
            // Если платеж прошел, то обновляем статус платежа
            $payment_type = $payment['payment_method']->_type;
            $payment_c = $payment['payment_method']->_first6 .
                    $payment['payment_method']->_last4 . ' ' .
                    $payment['payment_method']->_expiry_month . ' ' .
                    $payment['payment_method']->_expiry_year . ' ' .
                    $payment['payment_method']->_card_type . ' ' .
                    $payment['payment_method']->_issuer_country . ' ' .
                    $payment['payment_method']->_issuer_name;
            $payment_bank = $payment['payment_method']->_issuer_name;

            // Обновляем статус платежа
            $query_update = "UPDATE zay_pay "
                    . "SET pay_status='?', payment_type='?', payment_c='?', payment_bank='?' "
                    . "WHERE `pay_type`='ya' and pay_key = '?'";
            $sqlLight->query($query_update, array($pay_check, $payment_type, $payment_c, $payment_bank, $value['pay_key']), 0);
            if ($pay_check == 'succeeded') {

                // Зарегистрируем покупку
                $pr_cart->register_pay($pay_id);
                $result = array('success' => 1, 'success_text' => 'Платеж успешно проведен');
            } else {
                $result = array('success' => 0, 'success_text' => 'Не проведен! Проверьте чуть позже еще раз');
            }
        }
    }
    echo json_encode($result);
}

// CloudPayments
if ($_GET['pay_type'] == 'cp') {

    $publicKey = $config->getConfigParam('CloudPayments');
    $privateKey = $config->getConfigParam('CloudPayments_PrivateKey');

    $client = new \CloudPayments\Manager($publicKey, $privateKey);
    //echo "id: {$_GET['id']} <br/>\n";

    if (isset($_GET['id'])) {
        $pay_key = $_GET['id'];
    }
    if (isset($_POST['id'])) {
        $pay_key = $_POST['id'];
    }
    //echo "pay_key: {$pay_key} <br/>\n";

    // Проверяем статус оплаты
    if (isset($pay_key)) {
        $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='cp' and `id`='?'";
        $pays = $sqlLight->queryList($query, array($pay_key));
    } else {
        $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='cp' and `pay_date`>=CURRENT_DATE-1";
        $pays = $sqlLight->queryList($query);
    }


    if (count($pays) > 0) {
        foreach ($pays as $value) {
            $pay_id = $value['id'];
            $paymentId = $value['pay_key']; // Получаем ключ платежа
            try {
                $payment_info = $client->findPayment($value['id']);
                if ($client->getSuccess()) {

                    $pay_check = 'succeeded';
                    $payment_type = 'cp';
                    $payment_c = '';
                    $payment_bank = 'CloudPayments';

                    // Обновляем статус платежа
                    $query_update = "UPDATE zay_pay "
                            . "SET pay_status='?', payment_type='?', payment_c='?', payment_bank='?' "
                            . "WHERE `pay_type`='cp' and id='?'";
                    $sqlLight->query($query_update, array($pay_check, $payment_type, $payment_c, $payment_bank, $pay_id), 0);

                    // Зарегистрируем покупку
                    $pr_cart->register_pay($pay_id);

                    $result = array('success' => 1, 'success_text' => 'Платеж успешно выполнен', 'data' => array());
                } else {
                    if ($client->getSuccess()) {
                        $message = $client->getMessage();
                        //echo "message: {$message} <br/>\n";
                    }

                    $result = array('success' => 0, 'success_text' => 'Ошибка! ' . $message);
                }
                if (isset($_GET['dump'])) {
                    var_dump($payment_info);
                }
            } catch (Exception $exc) {
                //echo $exc->getTraceAsString();
                $result = array('success' => 0, 'success_text' => 'Ошибка! Не найдены транзакция по коду <b>' . $code . '</b>');
            }
        }
    }

    echo json_encode($result);
}