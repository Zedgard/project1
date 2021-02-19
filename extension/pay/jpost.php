<?php

defined('__CMS__') or die;


include_once 'inc.php';
include_once DOCUMENT_ROOT . '/extension/auth/inc.php';
include_once DOCUMENT_ROOT . '/extension/users/inc.php';
include 'lang.php';

$pay = new \project\pay();
$p_user = new \project\user();

if ($p_user->isEditor()) {

    // список для таблицы
    if (isset($_POST['pay_data_page'])) {
        $col = $_POST['pay_data_page'];
        $excel_from = $_POST['excel_from'];
        $excel_to = $_POST['excel_to'];
        $search_pay_user_str = $_POST['search_pay_user_str'];
        $pay_search_type = $_POST['pay_search_type'];
        $pay_search_status = $_POST['pay_search_status'];
        
        $_SESSION['admin_pay_filter']['excel_from'] = $excel_from;
        $_SESSION['admin_pay_filter']['excel_to'] = $excel_to;
        $_SESSION['admin_pay_filter']['search_pay_user_str'] = $search_pay_user_str;
        $_SESSION['admin_pay_filter']['pay_search_type'] = $pay_search_type;
        $_SESSION['admin_pay_filter']['pay_search_status'] = $pay_search_status;
        $data = $pay->pay_data_list($col, $search_pay_user_str, $excel_from, $excel_to, $pay_search_type, $pay_search_status);
        //print_r($data);
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
    // Данные по тразакции
    if (isset($_POST['get_pay_info'])) {
        $data = $pay->get_pay_info($_POST['get_pay_info']);
        if ($data['user_id'] > 0) {
            $data_user = $p_user->getUserInfo($data['user_id']);
        }
        $data_products = $pay->get_pay_products_info($_POST['get_pay_info']);
        $result = array('success' => 1, 'success_text' => '', 'data' => $data, 'data_user' => $data_user, 'data_products' => $data_products);
    }

    // Получить типы операций
    if (isset($_POST['pay_select_type'])) {
        $data = $pay->get_pay_all_tipes();
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);
    }
    
    // Получить типы операций
    if (isset($_POST['pay_select_status'])) {
        $data = $pay->get_pay_all_status();
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);
    }
}