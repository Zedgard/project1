<?php

defined('__CMS__') or die;

include_once 'inc.php';

$pr_category = new \project\category();

if (isset($_POST['getCategoryAllArray'])) {
    $searchStr = (strlen($_POST['searchStr']) > 0) ? $_POST['searchStr'] : '';
    $data = $pr_category->getCategoryAllArray($searchStr);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Все категорий продуктов с фильром
if (isset($_POST['getCategoryArray'])) {
    $searchStr = (strlen($_POST['searchStr']) > 0) ? $_POST['searchStr'] : '';
    $data = $pr_category->getCategoryArray('product_category', $searchStr);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if ($_POST['categories_add']) {
    $type = (isset($_POST['type'])) ? $_POST['type'] : '';
    $title = (isset($_POST['title'])) ? $_POST['title'] : '';
    $color = (isset($_POST['color'])) ? $_POST['color'] : '';
    if ($pr_category->addCategory($type, $title, $color)) {
        $result = array('success' => 1, 'success_text' => '');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка операции');
    }
}

// Все категорий продуктов с фильром
if (isset($_POST['getTopicArray'])) {
    $searchStr = (strlen($_POST['searchStr']) > 0) ? $_POST['searchStr'] : '';
    $data = $pr_category->getCategoryArray('product_topic', $searchStr);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Все категорий продуктов с фильром
if (isset($_POST['getProductTheme'])) {
    $searchStr = (strlen($_POST['searchStr']) > 0) ? $_POST['searchStr'] : '';
    $data = $pr_category->getCategoryArray('product_theme', $searchStr);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if (isset($_POST['getCategoryType'])) {
    $searchStr = (strlen($_POST['searchStr']) > 0) ? $_POST['searchStr'] : '';
    $data = $pr_category->getCategoryArray($_POST['getCategoryType'], $searchStr);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}