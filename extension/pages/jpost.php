<?php

defined('__CMS__') or die;


include_once $_SERVER['DOCUMENT_ROOT'] . '/system/page/inc.php';
include 'lang.php';

$p = new \project\page();

if (isset($_POST['page_edit'])) {
    $id = $_POST['page_edit'];
    $url = (isset($_POST['url'])) ? $_POST['url'] : '';
    $page_title = (isset($_POST['page_title'])) ? $_POST['page_title'] : '';
    $theme_id = $_POST['theme_id'];
    $visible = $_POST['visible'];
    if ($p->edit($id, $url, $page_title, $theme_id, $visible)) {
        $result = array('success' => 1, 'success_text' => $lang['pages'][$_SESSION['lang']]['success'], 'action' => './');
        $_SESSION['message'][] = $lang['pages'][$_SESSION['lang']]['success'];
    } else {
        $_SESSION['errors'][] = $lang['pages'][$_SESSION['lang']]['error'];
    }
}

if (isset($_POST['edit_material'])) {
    $id = $_POST['edit_material'];
    if ($p->contentEdit($id, $_POST['content_title'], $_POST['page_id'], $_POST['block_id'], $_POST['content_descr'], $_POST['ext_urls'])) {
        $result = array('success' => 1, 'success_text' => $lang['pages'][$_SESSION['lang']]['success'], 'action' => './?content=' . $_POST['page_id']);
        $_SESSION['message'][] = $lang['pages'][$_SESSION['lang']]['success'];
    } else {
        $_SESSION['errors'][] = $lang['pages'][$_SESSION['lang']]['error'];
    }
}

if (isset($_POST['delete_material'])) {
    $id = $_POST['delete_material'];
    if ($p->materialDelete($id)) {
        $result = array('success' => 1, 'success_text' => 'Упешно удалено');
        $_SESSION['message'][] = 'Упешно удалено';
    } else {
        $_SESSION['errors'][] = $lang['pages'][$_SESSION['lang']]['error'];
    }
}

if (isset($_POST['sortable'])) {
    $json_data = json_decode($_POST['json_data']);
    for ($i = 0; $i < count($json_data->data); $i++) {
        //echo "P: {$json_data->data[$i]->content_id} \n";
        $p->contentSorted($json_data->data[$i]->content_id, $json_data->data[$i]->sort);
    }
}