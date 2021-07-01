<?php

/*
 * SendPulse REST API Usage Example
 *
 * Documentation
 * https://login.sendpulse.com/manual/rest-api/
 * https://sendpulse.com/api
 *
 * Settings
 * https://login.sendpulse.com/settings/#api
 */

require($_SERVER['DOCUMENT_ROOT'] . "/system/sendpulse-rest-api-php-master/src/ApiInterface.php");
require($_SERVER['DOCUMENT_ROOT'] . "/system/sendpulse-rest-api-php-master/src/ApiClient.php");
require($_SERVER['DOCUMENT_ROOT'] . "/system/sendpulse-rest-api-php-master/src/Storage/TokenStorageInterface.php");
require($_SERVER['DOCUMENT_ROOT'] . "/system/sendpulse-rest-api-php-master/src/Storage/FileStorage.php");
require($_SERVER['DOCUMENT_ROOT'] . "/system/sendpulse-rest-api-php-master/src/Storage/SessionStorage.php");
require($_SERVER['DOCUMENT_ROOT'] . "/system/sendpulse-rest-api-php-master/src/Storage/MemcachedStorage.php");
require($_SERVER['DOCUMENT_ROOT'] . "/system/sendpulse-rest-api-php-master/src/Storage/MemcacheStorage.php");

use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

define('API_USER_ID', 'c45c87020b636d2642eaa77b7a2cc25b');
define('API_SECRET', 'd9f486960c73c26d23f6d4f8f289ec7b');
define('PATH_TO_ATTACH_FILE', __FILE__);

$bookID = 2249296;
$email = 'koman1706@gmail.com';

$SPApiClient = new ApiClient(API_USER_ID, API_SECRET, new FileStorage());

// Get Mailing Lists list example
//$listAddressBooks = $SPApiClient->listAddressBooks();
//print_r($listAddressBooks);
// 2249296

$emails = array(
    array(
        'email' => $email
    )
);

$additionalParams = array(
    'status' => 1,
    'status_explain' => 'Active'
);

if ($SPApiClient->removeEmailFromAllBooks($email)) {
    echo "<div>True removeEmailFromAllBooks</div>";
}
$addEmail = $SPApiClient->addEmails($bookID, $emails, $additionalParams);
if ($addEmail) {
    echo "<div>True addEmails</div>";
    // Изменим информацию переменной
//    if ($SPApiClient->updateEmailVariables($bookID, $email, array('status' => 1))) {
//        echo "<div>True updateEmailVariables status_explain</div>";
//        if ($SPApiClient->updateEmailVariables($bookID, $email, array('status_explain' => 'Active'))) {
//            echo "<div>True updateEmailVariables status_explain</div>";
//        }
          // Данные по EMAIL
//        //$EmailInfo = $SPApiClient->getEmailInfo($bookID, $email);
//        //print_r($EmailInfo);
//    }
}

