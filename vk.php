<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include $_SERVER['DOCUMENT_ROOT'] . '/system/vk-php-sdk-master/src/VK/Client/VKApiClient.php';
include $_SERVER['DOCUMENT_ROOT'] . '/system/vk-php-sdk-master/src/VK/OAuth/VKOAuth.php';

  
$oauth = new VKOAuth();
$client_id = 91602662;
$redirect_uri = 'https://1.sybix.ru/vk.php'; 
$display = VKOAuthDisplay::PAGE;
$scope = array(VKOAuthUserScope::WALL, VKOAuthUserScope::GROUPS);
$state = 'secret_state_code';
$revoke_auth = true;

$browser_url = $oauth->getAuthorizeUrl(VKOAuthResponseType::TOKEN, $client_id, $redirect_uri, $display, $scope, $state, null, $revoke_auth); 