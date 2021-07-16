<?php

/*
 * Yandex kassa
 * Проверим статусы платежей и зафиксируем успешность проведения платежа
 * Повесить данный процесс на CRON
 * 
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/inc.php';

$pr_cart = new \project\cart();
$sqlLight = new \project\sqlLight();
$u = new \project\user();
$products = new \project\products();
$config = new \project\config();
$sign_up_consultation = new \project\sign_up_consultation();

$ya_shop_id = $config->getConfigParam('ya_shop_id');
$ya_shop_api_key = $config->getConfigParam('ya_shop_api_key');
//echo "ya_shop_id: {$ya_shop_id}, ya_shop_api_key: {$ya_shop_api_key} \n";
//echo "PAY_KEY: {$_SESSION['PAY_KEY']}\n";
//$connection = mysqli_connect($cfg_db_host, $cfg_db_user, $cfg_db_pass, $cfg_db_name) or die(mysqli_error($connection)); // Подключаемся к базе данных
// Подключаем библиотеку Я.Кассы
require $_SERVER['DOCUMENT_ROOT'] . '/system/yandex-checkout-sdk-php-master/lib/autoload.php';

use YandexCheckout\Client;

$client = new Client();
$client->setAuth($ya_shop_id, $ya_shop_api_key);


if (isset($_GET['pay_key'])) {
    $pay_key = $_GET['pay_key'];
} else {
    $pay_key = $_SESSION['PAY_KEY'];
}

$result = array();

echo "pay_key: {$pay_key} <br/>\n";
// Проверяем статус оплаты
if (isset($pay_key)) {
    $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='ya' and `pay_key`='?'";
    $pays = $sqlLight->queryList($query, array($pay_key));
} else {
    $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='ya' and `pay_status`='pending' and `pay_date`>=CURRENT_DATE-1";
    $pays = $sqlLight->queryList($query);
}

//print_r($pays);
echo "count: " . count($pays) . "<br/>\n";
// Получаем список платежей циклом
if (count($pays) > 0) {
    foreach ($pays as $value) {
        $paymentId = $value['pay_key']; // Получаем ключ платежа
        $payment = $client->getPaymentInfo($paymentId); // Получаем информацию о платеже
        $pay_check = $payment->getstatus(); // Получаем статус оплаты
        echo "pay_check: {$pay_check} <br/>\n";
        $pay_paid = $payment->getPaid();
        $payment->setstatus('succeeded');
        $pay_check_new = $payment->getstatus();
        echo "pay_check_new: {$pay_check_new} <br/>\n";
//    //
//    echo "paymentId: {$paymentId} <br/>\n";
//    echo "pay_paid: {$pay_paid} <br/>\n";
//    echo "payment: ";
//    print_r($payment['payment_method']->_first6);
//    echo "<br/>\n";
//    echo "pay_check: {$pay_check} <br/>\n";
        // Если платеж прошел, то обновляем статус платежа
        //if ($pay_check == 'waiting_for_capture' or $pay_check == 'succeeded' || $pay_check == 'canceled') {
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

//            // Зарегистрируем покупку
//            $pr_cart->register_pay($value['id']);
//            
//            $_SESSION['cart']['cart_itms'] = $_SESSION['cart']['itms'];
//            $_SESSION['cart']['total'] = $total;
//            $_SESSION['cart']['pay_id'] = $pay_id;
//            $_SESSION['cart']['itms'] = array();
//            $_SESSION['PAY_KEY'] = '';
//            unset($_SESSION['PAY_KEY']);
            $result = array('success' => 1, 'success_text' => 'Платеж успешно проведен', 'action' => '/?page_type=pay_thanks');
//            location_href('/?page_type=pay_thanks');
        } else {
            $result = array('success' => 0, 'success_text' => 'Не проведен! Проверьте чуть позже еще раз');
        }
    }
}
echo json_encode($result);
