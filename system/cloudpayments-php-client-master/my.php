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
//$transaction = $client->chargeToken($amount, $currency, $accountId, $cardToken);
//var_dump($client);
echo "id: {$_GET['id']} <br/>\n"; 
try {
    $payment_info = $client->findPayment($_GET['id']);

    if ($client->getSuccess()) {
        echo "OK <br/>\n";
    }
    var_dump($payment_info);
    if ($client->getSuccess()) {
        $message = $client->getMessage();
        //echo "message: {$message} <br/>\n";
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}




