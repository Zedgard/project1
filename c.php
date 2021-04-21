<?php

// Отправить запрос в тинькоф
function send_tinkoff($url, $array) {
    $postdata = json_encode($array);

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

// Отправить запрос в тинькоф
function send_tinkoff_get($url, $token) {

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic <' . $token . '>'));
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic <' . $token . '>','Content-Type: application/json'));
//
//    $headers = array(
//        'Authorization: Basic <' . $token . '>',
//    );
//    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//Отправить запрос на кредит
$array = array(
    "shopId" => "db9d1536-707b-4697-aae0-e661be297bb1",
    "showcaseId" => "ca489979-d661-4070-9f93-fb7b98ca3856",
    "sum" => 10000,
    "items" => array(
        array(
            "name" => "iPhone",
            "quantity" => 1,
            "price" => 10000
        )
    ),
    "orderNumber" => "2",
    "demoFlow" => "sms"
);
$url = 'https://forma.tinkoff.ru/api/partners/v2/orders/create-demo';
print_r(send_tinkoff($url, $array));


//Поверить заявку на кредит
$array = array();
// demo-a29c9c7c-8210-431e-a51e-993df8b87e4c
$url = 'https://forma.tinkoff.ru/api/partners/v2/orders/1/info';
//print_r(send_tinkoff_get($url, 'demo-a29c9c7c-8210-431e-a51e-993df8b87e4c'));
