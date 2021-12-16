<?php

session_start();
defined('__CMS__') or die;

include_once 'inc.php';

$webhook = new \project\webhook();
// $items = new \project\menu_item();

/*
 * Все аккаунты
 */
if (isset($_POST['product_id'])) {
    $data = $webhook->get_accounts_all();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

/*
 * Информация по одному меню
 */
if (isset($_POST['get_menu'])) {
    $menu_id = (isset($_POST['menu_id']) && $_POST['menu_id'] > 0) ? $_POST['menu_id'] : 0;
    $data = $menu->get_menu($menu_id);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

/*
 * Редактировать информацию по меню
 */
if (isset($_POST['edit_account'])) {
    $account_id = (isset($_POST['account_id']) && $_POST['account_id'] > 0) ? $_POST['account_id'] : 0;
    $account_name = (isset($_POST['account_name']) && strlen($_POST['account_name']) > 0) ? $_POST['account_name'] : '';
    $account_category = (isset($_POST['account_category']) && strlen($_POST['account_category']) > 0) ? $_POST['account_category'] : '';
    // $menu_descr = (isset($_POST['menu_descr']) && strlen($_POST['menu_descr']) > 0) ? $_POST['menu_descr'] : '';
    // $menu_role = (isset($_POST['menu_role']) && $_POST['menu_role'] > 0) ? $_POST['menu_role'] : 0;

    if (strlen($account_category) < 1) {
        $_SESSION['errors'][] = 'Код долже быть заполнен';
    }
    if (strlen($account_name) < 3) {
        $_SESSION['errors'][] = 'Наименование долже быть заполнено';
    }
    if (count($_SESSION['errors']) == 0) {
        if ($accounts->edit_account($account_id, $account_name, $account_category)) {
            $result = array('success' => 1, 'success_text' => 'Выполнено');
        } else {
            $_SESSION['errors'][] = 'Ошибка операции';
        }
    }
}

/*
 * Информация по одному меню
 */
if (isset($_POST['delete_account'])) {
    $account_id = (isset($_POST['account_id']) && $_POST['account_id'] > 0) ? $_POST['account_id'] : 0;
    if ($accounts->delete_account($account_id)) {
        $result = array('success' => 1, 'success_text' => 'Выполнено');
    } else {
        $_SESSION['errors'][] = 'Ошибка операции';
    }
}

// -----------------------------------------------------------------------------
// Данные по пунктам меню
// -----------------------------------------------------------------------------
// Список всех пунктов
if (isset($_POST['menu_items_list'])) {
    $data = $items->menu_items_list($_POST['menu_items_list']);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}
// Список всех пунктов
if (isset($_POST['list_items'])) {
    $data = $items->get_menu_items_list();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}
// редактирование пункта меню
if (isset($_POST['edit_item'])) {
    $id = ($_POST['edit_item'] > 0 ) ? $_POST['edit_item'] : 0;
    $menu_id = ($_POST['menu_id'] > 0) ? $_POST['menu_id'] : 0;
    $title = trim($_POST['title']);
    $link = trim($_POST['link']);
    $css = trim($_POST['css']);
    $parent_id = $_POST['parent_id'];
    $role = trim($_POST['menu_item_role']);
    if ($id == 0) {
        $position = $items->items_count($menu_id) + 1;
    }
    if ($menu_id > 0) {
        if ($items->edit_menu_item($id, $menu_id, $parent_id, $title, $link, $css, $position, $role)) {
            $result = array('success' => 1, 'success_text' => 'Выполнено');
        } else {
            $_SESSION['errors'][] = "Ошибка запроса";
        }
    } else {
        $_SESSION['errors'][] = "Не определено меню";
    }
}
// Обновить позицию
//if (isset($_POST['set_position'])) {
//    $item_id = $_POST['item_id'];
//    $menu_id = $_POST['menu_id'];
//    $position = $_POST['set_position'];
//    if ($items->set_position($menu_id, $item_id, $position)) {
//        
//    }
//}
// Обновить позицию
if (isset($_POST['ajax_metod'])) {
    // Сортировка 
    if ($_POST['ajax_metod'] == 'update_position') {
        $db_table = trim($_POST['db_table']);
        $db_row = trim($_POST['db_row']);
        $result = array('success' => 1, 'success_text' => '');
        if (count($_POST['ids']) > 0) {
            $i = 0;
            foreach ($_POST['ids'] as $value) {
                $items->position_update($db_table, $db_row, $value, $i);
                $i++;
            }
        }
    }
}

// Удаление элемента меню
if (isset($_POST['delete_item'])) {
    if ($items->delete_menu_item($_POST['delete_item'])) {
        $result = array('success' => 1, 'success_text' => 'Выполнено');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}