<?php

session_start();

require __DIR__ . '/system/google-api-php-client-master/vendor/autoload.php';

//if (php_sapi_name() != 'cli') {
//    throw new Exception('This application must be run on the command line.');
//} 

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object

  Client ID
  701809871836-bnlvaoh40los05tois521jqcl6j99i3a.apps.googleusercontent.com

  Client Secret
  Ji8chLpUWh0X6AJj1mRUpkoY
 * 
 * ----
 * 675584398132-0v6lqqa0rkj7dn5doe9mfilob4sus953.apps.googleusercontent.com
 * 
 * 7b8jrXTvHwhUDTwtpWFKlBnt

 */
// Holds the Google application Client Id, Client Secret and Redirect Url
require_once('settings.php');

// Holds the various APIs involved as a PHP class. Download this class at the end of the tutorial
require_once('google-login-api.php');

// Google passes a parameter 'code' in the Redirect Url
if (isset($_GET['code'])) {
    try {
        $capi = new GoogleCalendarApi();

        // Get the access token 
        $data = $capi->GetAccessToken(APPLICATION_ID, APPLICATION_REDIRECT_URL, APPLICATION_SECRET, $_GET['code']);

        // Access Token
        $access_token = $data['access_token'];

        // The rest of the code to add event to Calendar will come here
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}