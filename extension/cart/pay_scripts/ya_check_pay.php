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

// Проверяем статус оплаты
if (isset($_SESSION['PAY_KEY'])) {
    $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='ya' and `pay_date`>=CURRENT_DATE-1 and `pay_key`='?'";
    $pays = $sqlLight->queryList($query, array($_SESSION['PAY_KEY']));
} else {
    $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='ya' and `pay_status`='pending' and `pay_date`>=CURRENT_DATE-1";
    $pays = $sqlLight->queryList($query);
}
//print_r($pays);
//echo "\n";
// Получаем список платежей циклом
if (count($pays) > 0) {
    foreach ($pays as $value) {
        $paymentId = $value['pay_key']; // Получаем ключ платежа
        $payment = $client->getPaymentInfo($paymentId); // Получаем информацию о платеже
        $pay_check = $payment->getstatus(); // Получаем статус оплаты
        $pay_paid = $payment->getPaid();
        $payment->setstatus('succeeded');
        //$pay_check = $payment->getstatus();
//    echo "1111\n";
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
        $sqlLight->query($query_update, array($pay_check, $payment_type, $payment_c, $payment_bank, $value['pay_key']));
        if ($pay_check == 'succeeded') {
            // Зафиксируем продажу
            $products->setSoldAdd($value['id']);
            $result = array('success' => 1, 'success_text' => 'Платеж успешно проведен');
        } else {
            $result = array('success' => 0, 'success_text' => 'Не проведен! Проверьте чуть позже еще раз');
        }
    }
}


if (isset($_POST['check_pay']) && isset($_SESSION['PAY_KEY']) && strlen($_SESSION['PAY_KEY']) > 0 && $u->isClientId() > 0) {
    // Проверяем статус оплаты
    $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='ya' and `pay_status`='succeeded' and `user_id`='?' and pay_key='?' ";
    $pay_succeede = $sqlLight->queryList($query, array($u->isClientId(), $_SESSION['PAY_KEY']));
    $total = $pay_succeede[0]['pay_sum'];
    $pay_id = $pay_succeede[0]['id'];

    if (count($pay_succeede) > 0) {
        /*
         * Если установлена настройка отправим в календарь событие
         */
        if ($_SESSION['consultation']['your_master_id'] > 0) {
            if ($config->getConfigParam('event_sent_on_pay_calendar') == '1') {

                // Данные по консультанту для календаря
                // Если календарь не используем не нужно
//                $queryMaster = "SELECT * FROM `zay_consultation_master` WHERE id='?' ";
//                $master = $sqlLight->queryList($queryMaster, array($_SESSION['consultation']['your_master_id']))[0];
//                $master_token = $master['token_file_name'];
//                $master_credentials = $master['credentials_file_name'];
//                $first_name = $_SESSION['consultation']['first_name'];
//                $user_phone = $_SESSION['consultation']['user_phone'];
//                $user_email = $_SESSION['consultation']['user_email'];
//                $pay_descr = $_SESSION['consultation']['pay_descr'];
//                $user_date = $_SESSION['consultation']['date'];
//                $user_time = $_SESSION['consultation']['time'];
//                $period_id = $_SESSION['consultation']['period_id'];
//


                /*
                  'your_master_id' => $your_master,
                  'first_name' => $first_name,
                  'user_phone' => $user_phone,
                  'user_email' => $user_email,
                  'pay_descr' => "<div>Консультация с {$first_name}</div>"
                  . "<div>Телефон: {$user_phone}</div>"
                  . "<div>Email: {$user_email}</div>"
                  . "<div>Консультант: {$your_master_text}</div>"
                  . "<div>Дата и время: {$datepicker_data} {$timepicker_data}</div>",
                  'date' => $datepicker_data,
                  'time' => $timepicker_data,
                  'price' => $price
                 */
                //$master_token = $master['credentials_file_name'];
                // В последний раз чтото не работало 403 ошибка мол превышен лимит  и не добавлялось событие
                //include $_SERVER['DOCUMENT_ROOT'] . '/system/google-api-php-client-master/addevent.php';
            }
            //$sign_up_consultation->add_consultation($_SESSION['consultation']);
        }
        $result = array('success' => 1, 'success_text' => 'Платеж успешно проведен');
    } else {
        $result = array('success' => 0, 'success_text' => 'Платеж не проведен! Проверьте чуть позже еще раз!');
    }
    $_SESSION['cart']['cart_itms'] = $_SESSION['cart']['itms'];
    $_SESSION['cart']['total'] = $total;
    $_SESSION['cart']['pay_id'] = $pay_id;
    $_SESSION['cart']['itms'] = array();
    $_SESSION['PAY_KEY'] = '';
    unset($_SESSION['PAY_KEY']);
    echo json_encode($result);
}