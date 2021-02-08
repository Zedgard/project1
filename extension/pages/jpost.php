<?php

session_start();
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/page/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include 'lang.php';

$p = new \project\page();
$u = new \project\user();

// редактировать страницу
if (isset($_POST['page_edit'])) {
    $id = $_POST['page_edit'];
    $url = (isset($_POST['url'])) ? $_POST['url'] : '';
    $url_ex = (isset($_POST['url_ex'])) ? $_POST['url_ex'] : '';
    $page_title = (isset($_POST['page_title'])) ? $_POST['page_title'] : '';
    $description = (isset($_POST['description'])) ? $_POST['description'] : '';
    $theme_id = (isset($_POST['theme_id'])) ? $_POST['theme_id'] : '0';
    $visible = (isset($_POST['visible'])) ? $_POST['visible'] : '0';
    $higter = ($_POST['higter'] > '0') ? $_POST['higter'] : '0';
    $page_role = (isset($_POST['page_role'])) ? $_POST['page_role'] : array();
    if ($p->edit($id, $url, $url_ex, $page_title, $description, $theme_id, $visible, $higter, $page_role)) {
        $result = array('success' => 1, 'success_text' => $lang['pages'][$_SESSION['lang']]['success'], 'action' => './', 'action_time' => '0');
        $_SESSION['message'][] = $lang['pages'][$_SESSION['lang']]['success'];
    } else {
        $_SESSION['errors'][] = $lang['pages'][$_SESSION['lang']]['error'];
    }
}

// Роли доступные для страницы
if (isset($_POST['get_roles_page_id']) && $_POST['get_roles_page_id'] > 0) {
    $data = $p->page_select_roles_list($_POST['get_roles_page_id']);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// редактировать материал
if (isset($_POST['edit_material'])) {
    $id = $_POST['edit_material'];
    if ($p->contentEdit($id, $_POST['content_title'], $_POST['page_id'], $_POST['block_id'], $_POST['content_descr'], $_POST['ext_urls'])) {
        $result = array('success' => 1, 'success_text' => $lang['pages'][$_SESSION['lang']]['success']//, 'action' => './?content=' . $_POST['page_id']
                );
        $_SESSION['message'][] = $lang['pages'][$_SESSION['lang']]['success'];
    } else {
        $_SESSION['errors'][] = $lang['pages'][$_SESSION['lang']]['error'];
    }
}

// удалить материал
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

if (isset($_POST['block_id_save_info']) && $_POST['block_id_save_info'] > 0) {
    $block_id = $_POST['block_id_save_info'];
    $block_name = $_POST['block_name'];
    $block_code = $_POST['block_code'];
    $block_role = $_POST['block_role'];
    if (!is_array($block_role)) {
        $block_role = array();
    }
    //echo "\n send_roles: ";
    //print_r($block_role);
    $result = array('success' => 0, 'success_text' => 'Ошибка выполнения');
    if ($p->set_block_info($block_id, $block_code, $block_name, $block_role)) {
        $result = array('success' => 1, 'success_text' => 'Упешно выполнено');
    }
}

// Данные по блокам
if (isset($_POST['init_body_list_blocks'])) {
    $data = $p->bloksListArray(0);
    for ($i = 0; $i < count($data); $i++) {
        $data[$i]['roles'] = $p->blok_select_roles_list($data[$i]['id']);
    }
    //print_r($data);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Данные по блоку
if (isset($_POST['block_id_info']) && $_POST['block_id_info'] > 0) {
    $data = $p->bloksListArray($_POST['block_id_info'])[0];
    $data['roles'] = $p->blok_select_roles_list($data['id']);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Роли доступные блока
if (isset($_POST['get_roles_block_id']) && $_POST['get_roles_block_id'] > 0) {
    $data = $p->blok_select_roles_list($_POST['get_roles_block_id']);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}
// Список всех страниц
if (isset($_POST['adminList'])) {
    $data = $p->adminList(0);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}