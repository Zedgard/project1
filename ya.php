<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';

$p_user = new \project\user();
$p_auth = new \project\auth(); 

/*
 * ID: 2364a38f027c4ae284253c2c2e8791b2
Пароль: ed4e37ffd59b4bbbbc9515972285cf20
Callback URL: https://edgardzaycev.com/auth/
 * */
$ya_client_id = '2364a38f027c4ae284253c2c2e8791b2'; // ID приложения
$ya_client_secret = 'ed4e37ffd59b4bbbbc9515972285cf20'; // Защищённый ключ 
if (empty($_GET['code'])) {
	$params = array(
		'client_id'     => $ya_client_id,
		'redirect_uri'  => 'https://edgardzaycev.com/ya.php',
		'response_type' => 'code',
		'state'         => '123'
	);

	$url = 'https://oauth.yandex.ru/authorize?' . urldecode(http_build_query($params));
	echo '<a href="' . $url . '">Авторизация через Яндекс</a>';
}

if (!empty($_GET['code'])) {
	// Отправляем код для получения токена (POST-запрос).
	$params = array(
		'grant_type'    => 'authorization_code',
		'code'          => $_GET['code'],
		'client_id'     => $ya_client_id,
		'client_secret' => $ya_client_secret,
	);
	
	$ch = curl_init('https://oauth.yandex.ru/token');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$data = curl_exec($ch);
	curl_close($ch);	
			 
	$data = json_decode($data, true);
	if (!empty($data['access_token'])) {
		// Токен получили, получаем данные пользователя.
		$ch = curl_init('https://login.yandex.ru/info');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('format' => 'json')); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: OAuth ' . $data['access_token']));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$info = curl_exec($ch);
		curl_close($ch);
 
		$info = json_decode($info, true);
		/*
		 * Array ( 
		 * [id] => 42411884 
		 * [login] => resko1987 
		 * [client_id] => 2364a38f027c4ae284253c2c2e8791b2 
		 * [display_name] => resko1987 
		 * [real_name] => Виктор Караваев 
		 * [first_name] => Виктор 
		 * [last_name] => Караваев 
		 * [sex] => male 
		 * [default_email] => resko1987@yandex.ru 
		 * [emails] => 
		 * 		Array ( 
		 * 			[0] => resko1987@yandex.ru 
		 * 		) 
		 * [psuid] => 1.AAb5Eg.P3Sn3R4IBh3oKRecsxl8HQ.i8f2g4gzPlorvG-nTihNQw )
		 */ 
		echo "email: {$info['default_email']}<br/>\n";
		
		print_r($info);
	}
}

//$_SESSION['id'] = $userInfo['id'];
