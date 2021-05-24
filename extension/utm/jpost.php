<?php

defined('__CMS__') or die;

include_once 'inc.php';

$pr_utm = new \project\utm();

/* --- УПРАВЛЕНИЕ UTM --- */
if (isset($_POST['utm_list'])) {
    $data = $pr_utm->utm_list();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}
if (isset($_GET['utm_insert'])) {
    if ($pr_utm->utm_insert()) {
        $result = array('success' => 1, 'success_text' => '');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}

/* --- УПРАВЛЕНИЕ ТЕГАМИ --- */
// Все теги
if (isset($_POST['utm_tags_list'])) {
    $data = $pr_utm->utm_tags_list();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Добавление тега
if (isset($_GET['utm_tag_insert'])) {
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

// Данные по тегам
if (isset($_POST['utm_tag_values_list'])) {
    $utm_id = $_POST['utm_id'];
    $data = $pr_utm->utm_tag_values_list($utm_id);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if (isset($_POST['utm_list_filter'])) {
    $utm_id = $_POST['utm_filter'];
    $date_start = $_POST['utm_date_start_filter'];
    $date_end = $_POST['utm_date_end_filter'];
    $utm_tags_list_filter = ($_POST['utm_tags_list_filter'] > 0) ? $_POST['utm_tags_list_filter'] : 0;
    $data = $pr_utm->utm_href_list($utm_id, $date_start, $date_end, $utm_tags_list_filter);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}