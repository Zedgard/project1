<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$extension = new \project\extension();
/*
 * Обработка SuperForm отправки данных
 */
if (isset($_GET['super']) && isset($_POST['elm_edit'])) {
    $elm_id = (isset($_POST['elm_id'])) ? $_POST['elm_id'] : '0';
    $value = (isset($_POST['value']) && strlen($_POST['value']) > 0) ? $_POST['value'] : 'null';
    $elm_table = (isset($_POST['elm_table'])) ? $_POST['elm_table'] : '';
    $elm_row = (isset($_POST['elm_row'])) ? $_POST['elm_row'] : '';
    if (strlen($elm_table) > 0 && strlen($elm_row) > 0 && $elm_id > 0) {
        if ($extension->initSuperFormPOST($elm_id, $value, $elm_table, $elm_row)) {
            $result = array('success' => 1, 'success_text' => '');
        } else {
            $result = array('success' => 0, 'success_text' => 'Ошибка операции');
        }
    }
}

/*
 * Удаление элемента
 */
if (isset($_GET['super']) && isset($_POST['elm_delete'])) {
    $elm_id = (isset($_POST['elm_id'])) ? $_POST['elm_id'] : '0';
    $elm_table = (isset($_POST['elm_table'])) ? $_POST['elm_table'] : '';
    if ($extension->initSuperFormDelete($elm_id, $elm_table)) {
        $result = array('success' => 1, 'success_text' => '');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка операции');
    }
}