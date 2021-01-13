<?php

defined('__CMS__') or die;


include_once 'inc.php';
include_once DOCUMENT_ROOT . '/extension/auth/inc.php';
include_once DOCUMENT_ROOT . '/extension/users/inc.php';
include 'lang.php';

$pay = new \project\pay();
$u = new \project\user();

if ($u->isEditor()) {

    // список для таблицы
    if (isset($_POST['pay_data_page'])) {
        $col = $_POST['pay_data_page'];
        $search_pay_user_str = $_POST['search_pay_user_str'];
        $data = $pay->pay_data_list($col, $search_pay_user_str);
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);
    }

    // признак обработки
    if (isset($_POST['set_processed'])) {
        $obj_id = $_POST['set_processed'];
        if ($pay->check_processed($obj_id)) {
            $result = array('success' => 1, 'success_text' => '');
        } else {
            $result = array('success' => 0, 'success_text' => 'Ошибка операции');
        }
    }
}