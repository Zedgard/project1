<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/cloudpayments-php-client-master/src/Manager.php';

$publicKey = 'pk_ae3b603c5c8518915e82a60298cd3';
$privateKey = '7693198309f9c3745b6c8e2c203be498';

$client = new \CloudPayments\Manager($publicKey, $privateKey);
//$transaction = $client->chargeToken($amount, $currency, $accountId, $cardToken);
//var_dump($client);

try {
    $payment_info = $client->findPayment(4584);

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





    

