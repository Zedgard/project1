<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/cloudpayments-php-client-master/src/Manager.php';

/**
 * для CRON
 * https://edgardzaycev.com/check_pay.php?check_pay=tk
 */

$config = new \project\config();
$sqlLight = new \project\sqlLight();
$publicKey = $config->getConfigParam('CloudPayments');
$privateKey = $config->getConfigParam('CloudPayments_PrivateKey');

$client = new \CloudPayments\Manager($publicKey, $privateKey);
//echo "id: {$_GET['id']} <br/>\n";

$query = "SELECT * FROM `zay_pay` WHERE `pay_type`='cp' and `pay_status`!='succeeded' and `pay_date`>=CURRENT_DATE-1";
$pays = $sqlLight->queryList($query);
if (count($pays) > 0) {
    foreach ($pays as $value) {
        $code = $value['id'];

        try {
            $payment_info = $client->findPayment($code);
            if ($client->getSuccess()) {
                $query_update = "UPDATE zay_pay SET pay_status='succeeded' WHERE id='?'";
                $sqlLight->query($query_update, array($code));
                echo "pay_id: {$code} status=succeeded <br/>\n";
                $result = array('success' => 1, 'success_text' => 'Платеж успешно выполнен', 'data' => array());
            } else {
                if ($client->getSuccess()) {
                    $query_update = "UPDATE zay_pay SET pay_status='succeeded' WHERE id='?'";
                    $sqlLight->query($query_update, array($code));
                    echo "pay_id: {$code} status=succeeded <br/>\n";
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



