<?php

defined('__CMS__') or die;

include_once 'inc.php';

$pr_utm = new \project\utm();

// Все теги
if (isset($_POST['utm_tags_list'])) {
    $data = $pr_utm->utm_tags_list();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Добавление тега
if (isset($_GET['utm_tag_insert'])) {
    $data = '';
    if ($pr_utm->utm_tag_insert()) {
        $result = array('success' => 1, 'success_text' => '');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}

// Удаление тега
if (isset($_POST['utm_tag_delete'])) {
    if ($pr_utm->utm_tag_delete($_POST['utm_tag_delete'])) {
        $result = array('success' => 1, 'success_text' => '');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}