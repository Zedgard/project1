<?php

require __DIR__ . '/vendor/autoload.php';

/*

  610380269026-fik8jmj273e2hccjseng17cj7ltpmobv.apps.googleusercontent.com
 * 
 * JaRfJ5Xy_9C4epysp3QAsQue
 *  */
//if (php_sapi_name() != 'cli') {
//    throw new Exception('This application must be run on the command line.');
//}

/**
 * Получить номер первой недели месяца
 * @param type $m ищем номер недели указаннного месяца
 * @return int номер недели 
 */
function getWeekNow($m = 0) {
    if ($m == 0) {
        $m = date('m');
    }
    $date = new DateTime();
    for ($i = 2; $i < 51; $i++) {
        $date->setISODate(date('Y'), $i);
        if ($date->format('n') == $m) {
            return $i;
            break;
        }
    }
    return 0;
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient() {
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $client->setAuthConfig(__DIR__ . '/tokens/' . $_SESSION['consultation_credentials']);
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = __DIR__ . '/tokens/' . $_SESSION['consultation_token']; // token.json
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
    'maxResults' => 10,
    'orderBy' => 'startTime',
    'singleEvents' => true,
    'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);
$events = $results->getItems();


// Refer to the PHP quickstart on how to setup the environment:
// https://developers.google.com/calendar/quickstart/php
// Change the scope to Google_Service_Calendar::CALENDAR and delete any stored
// credentials.
/*
  $master = $sqlLight->queryList($queryMaster, array($_SESSION['consultation']['your_master_id']))[0];
  $master_token = $master['token_file_name'];
  $master_credentials = $master['credentials_file_name'];

  $first_name = $_SESSION['consultation']['first_name'];
  $user_phone = $_SESSION['consultation']['user_phone'];
  $user_email = $_SESSION['consultation']['user_email'];
  $pay_descr = $_SESSION['consultation']['pay_descr'];
  $user_date = $_SESSION['consultation']['date'];
  $user_time = $_SESSION['consultation']['time'];
 */
//$br = "<br/>\n";
//echo 'now: ' . date('c') . $br;
$date = new DateTime();

$user_date_ex = explode('/', $user_date); // 26/09/2020
$user_time_ex = explode(':', $user_time); // 26/09/2020

$date->setDate($user_date_ex[2], $user_date_ex[1], $user_date_ex[0]);
$date->setTime($user_time_ex[0], $user_time_ex[1]);

$start_date = $date->format('Y-m-d\TH:i:s+00:00');
//echo "start_date: {$start_date} {$br}";
//
$date->setDate($user_date_ex[2], $user_date_ex[1], $user_date_ex[0]);
$date->setTime($user_time_ex[0] + 1, $user_time_ex[1]);
$end_date = $date->format('Y-m-d\TH:i:s+00:00');
//echo "end_date: {$end_date} {$br}"; // . $date->format('Y-m-d\TH:i:s+00:00') . $br;

$event = new Google_Service_Calendar_Event(
        array(
    'summary' => "Онлайн консультация для {$first_name}",
    //'location' => 'Хабаровск, Хабаровский край',
    'description' => $pay_descr,
    'start' => array(
        'dateTime' => $start_date, //,//'2015-05-28T09:00:00-07:00',
    //'timeZone' => 'Europe/Moscow',
    ),
    'end' => array(
        'dateTime' => $end_date, //,//'2015-05-28T17:00:00-07:00',
        'timeZone' => 'Europe/Moscow',
    ),
    'recurrence' => array(
        'RRULE:FREQ=DAILY;COUNT=1'
    ),
    'attendees' => array(
        array('email' => $user_email),
    //array('email' => 'sbrin@example.com'),
    ),
    'reminders' => array(
        'useDefault' => FALSE,
        'overrides' => array(
            array('method' => 'email', 'minutes' => 24 * 60),
            array('method' => 'popup', 'minutes' => 60),
        ),
    ),
    //      'visibility' => 'public',
    'conferenceDataVersion' => '1', // включить конференцию через meet
    'sendNotifications' => 'true', // отправить оповещение на email
        )
);

$calendarId = 'primary';
$event = $service->events->insert($calendarId, $event);
//printf('Event created: %s\n', $event->htmlLink);
