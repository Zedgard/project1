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
// https://forma.tinkoff.ru/online/demo-7022acef-91a8-469a-8a4e-430097178081
$site_url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['SERVER_NAME'];
$orderId = 18;
//Отправить запрос на кредит
$array = array(
    "shopId" => "db9d1536-707b-4697-aae0-e661be297bb1",
    "showcaseId" => "ca489979-d661-4070-9f93-fb7b98ca3856",
    "sum" => 100000,
    "promoCode" => 'installment_0_0_6_5',
    "items" => array(
        array(
            "name" => "iPhone",
            "quantity" => 1,
            "price" => 100000
        )
    ),
    "orderNumber" => "{$orderId}",
    "successURL" => "{$site_url}/credit_post.php?constants=SUCCESS", // /?credit_post.php?constants=SUCCESS",
    "returnURL" => "{$site_url}/credit_post.php?constants=CANCEL",
    "failURL" => "{$site_url}/credit_post.php?constants=CANCEL",
    "webhookURL" => "{$site_url}/credit_post.php?constants=HUK&orderId={$orderId}",
    "demoFlow" => "sms"
);

$url = 'https://forma.tinkoff.ru/api/partners/v2/orders/create-demo';
//$out = send_tinkoff($url, $array);

$j = json_decode($out);
//header('Location: ' . $j->link);




//$curl = curl_init();//Инициализация CURL
//curl_setopt($curl, CURLOPT_URL, 'https://forma.tinkoff.ru/online/demo-7022acef-91a8-469a-8a4e-430097178081');//Указываем адрес который хотим получить
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//$content = curl_exec($curl); //Результат запроса
//$response = curl_getinfo($curl); //Информация о запросе
//curl_close($curl);//Закрываем соединение
//echo $content;//Вывод содержимого
$content = file_get_contents('https://forma.tinkoff.ru/online/demo-7022acef-91a8-469a-8a4e-430097178081', false);
$content = str_replace('https://dev.edgardzaycev.com/', 'https://forma.tinkoff.ru/', $content);
//$content = str_replace('window.location.href', "'https://forma.tinkoff.ru/online/demo-7022acef-91a8-469a-8a4e-430097178081'", $content);

echo $content;


//$params = ['grant_type' => 'refresh_token',
//    'refresh_token' => ''
//];
//$headers = [
//    'POST /secure/token HTTP/1.1',
//    'Content-Type: application/x-www-form-urlencoded'
//];
//$curlURL = 'https://forma.tinkoff.ru/api/partners/v2/oauth/';
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $curlURL);
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//
//curl_setopt($ch, CURLOPT_HEADER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_VERBOSE, true);
//echo 111;
//$curl_res = curl_exec($ch);
//echo 2;
//$server_output = json_decode($curl_res);
//echo 3;
//
//echo $server_output;
