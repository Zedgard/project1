<?php

defined('__CMS__') or die;

include_once 'inc.php';

$pr_topic = new \project\topic();


// Все темы с фильром
if (isset($_POST['getTopicArray'])) {
    $searchStr = (strlen($_POST['searchStr']) > 0) ? $_POST['searchStr'] : '';
    $data = $pr_topic->getTopicArray($searchStr);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}