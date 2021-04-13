<?php

$ch = curl_init('http://ip-api.com/json/' . $_SERVER['HTTP_CF_CONNECTING_IP'] . '?lang=ru');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);

$res = json_decode($res, true);
//print_r($_SERVER);
echo "IP: {$_SERVER['HTTP_CF_CONNECTING_IP']} <br/>\n";
print_r($res);
