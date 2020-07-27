<?php

defined('__CMS__') or die;


include_once 'inc.php';
include 'lang.php';

$statistic = new \project\statistic();

if (isset($_POST['getStatDaysData'])) {

    $data = $statistic->getStatDaysDataArray($_POST['date_start'], $_POST['date_end']);
    $result = array('success' => 1, 'data' => $data);
}
