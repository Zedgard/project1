<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/cloudpayments-php-client-master/src/Manager.php';

$config = new \project\config();
$publicKey = $config->getConfigParam('CloudPayments');
$privateKey = $config->getConfigParam('CloudPayments_PrivateKey');

$client = new \CloudPayments\Manager($publicKey, $privateKey);
//echo "id: {$_GET['id']} <br/>\n";

if (isset($_GET['id'])) {
    $code = $_GET['id'];
}
if (isset($_POST['id'])) {
    $code = $_POST['id'];
}
try {
    $payment_info = $client->findPayment($code);
    if ($client->getSuccess()) {
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

echo json_encode($result);



