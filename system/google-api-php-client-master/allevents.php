<?php

require __DIR__ . '/vendor/autoload.php';

/*
 * Получить все события пользователя
 */
/*

  610380269026-fik8jmj273e2hccjseng17cj7ltpmobv.apps.googleusercontent.com
 * 
 * JaRfJ5Xy_9C4epysp3QAsQue
 *  */
//if (php_sapi_name() != 'cli') {
//    throw new Exception('This application must be run on the command line.');
//}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient() {
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
    $client->setAuthConfig(__DIR__ . '/tokens/' . $_SESSION['consultation_credentials']);// credentials.json
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    // Мой токен, для нового человека нужен новый токен генерировать
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
            if (isset($_GET['show'])) {
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
            }
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
    }else{
        //echo 'NOT isAccessTokenExpired';
    }
    return $client;
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
    'maxResults' => 31,
    'orderBy' => 'startTime',
    'singleEvents' => true,
    'timeMin' => date('c'),
);
/*
 * Отобразить информацию о ближайших событиях
 *  */
$results = $service->events->listEvents($calendarId, $optParams);
$events = $results->getItems();

$data = array();
$errors = array();

if (empty($events)) {
    //$errors[] = "Нет событий.\n";
} else {
    if (isset($_GET['show'])) {
        print "all events:<br/>\n";
    }
    foreach ($events as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        $end = $event->end->dateTime;
        if (empty($start)) {
            $end = $event->end->date;
        }

        $hangoutLink = $event->hangoutLink;
        $status = $event->status;
        if ($status == 'tentative') {
            $status_ru = 'предварительный';
        }
        if ($status == 'cancelled') {
            $status_ru = 'отменен';
        }
        if ($status == 'confirmed') {
            $status_ru = 'подтверждено';
        }



        $attendees_email = array();
        for ($a = 0; $a < count($event->attendees); $a++) {
            $attendees_email[] = $event->attendees[$a]->email;
        }

        if (isset($_GET['show'])) {
            //print_r($event->htmlLink);
            ?>
            <div>
                <span style="font-weight: bold">title:</span> <?= $event->getSummary() ?><br/> 
                <span style="font-weight: bold">descr:</span> <?= $event->getDescription() ?><br/>
                <span style="font-weight: bold">ID:</span> <?= $event->id ?><br/>
                <span style="font-weight: bold">htmlLink:</span> <?= $event->htmlLink ?><br/>
                <span style="font-weight: bold">attendees_email:</span> <? print_r($attendees_email) ?><br/>
            </div>
            <hr/>
            <?
        } else {
            if (!isset($_POST['event_id'])) {
                $data[] = array(
                    'id' => $event->id,
                    'iCalUID' => $event->iCalUID,
                    'title' => $event->getSummary(),
                    'summary' => $event->getSummary(),
                    'description' => $event->getDescription(),
                    'start' => $start,
                    'end' => $end,
                    'hangoutLink' => $hangoutLink,
                    //'url' => $event->htmlLink,
                    'status' => $status,
                    'status_ru' => $status_ru,
                    'attendees' => $attendees_email
                );
            } else {
                /*
                 * Получить данные по 1 событию
                 */
                if ($_POST['event_id'] == $event->id) {
                    $data[] = array(
                        'id' => $event->id,
                        'iCalUID' => $event->iCalUID,
                        'title' => $event->getSummary(),
                        'summary' => $event->getSummary(),
                        'description' => $event->getDescription(),
                        'start' => $start,
                        'end' => $end,
                        'hangoutLink' => $hangoutLink,
                        'url' => $event->htmlLink,
                        'status' => $status,
                        'status_ru' => $status_ru,
                        'attendees' => $attendees_email
                    );
                }
            }
        }


        // echo "<div><span>title:</span> {$event->getSummary()} <span>start</span> {$start}</div>";
        //printf("%s (%s)\n", $event->getSummary(), $start);
    }
}
//echo json_encode($data);