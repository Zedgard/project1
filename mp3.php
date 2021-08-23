<?php

// 
$url = 'https://download.edgardzaitsev.com/catalog/books/audio-kniga-razmyshleniya-du-ra-ka-zhizn-vne-poiskov-smysla/audio-kniga-razmyshleniya-du-ra-ka-zhizn-vne-poiskov-smysla-zapisana-muzhskim-golosom.mp3';
//$file_name = __DIR__ . '/file.html';
//$file = @fopen($file_name, 'w');

$timeout = 20;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, 'Seo Bot'); // Можно указать заголовок USERAGENT
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); // Максимально позволенное количество секунд для выполнения cURL-функций.
curl_setopt($ch, CURLOPT_HEADER, false);  // TRUE для включения заголовков в вывод. 
$data = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$cURL_info = curl_getinfo($ch);

curl_close($ch);

echo $data; // вывод страницы https://ma-nu.ru

echo $http_code; // код ответа сервера, например 200, 301, 403 и тд.

print_r($cURL_info); // все данные ответа