<?php

defined('__CMS__') or die;

include_once 'inc.php';

$config = new \project\config();

if (isset($_POST['getConfigArray'])) {
    $category_id = ($_POST['category_id'] > 0) ? $_POST['category_id'] : '0';
    $searchStr = (strlen($_POST['searchStr']) > 0) ? $_POST['searchStr'] : '';
    $data = $config->getConfigArray($category_id, $searchStr);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if (isset($_POST['getConfigElemId'])) {
    $id = $_POST['getConfigElemId'];
    $data = $config->getConfigElem($id)[0];
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if (isset($_POST['deleteConfig'])) {
    if ($data = $config->deleteConfig($_POST['deleteConfig'])) {
        $result = array('success' => 1, 'success_text' => 'Список настроек получен');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка удаления');
    }
}

if (isset($_POST['configEdit'])) {
    $id = ($_POST['configEdit'] != '') ? $_POST['configEdit'] : 0;
    $config_code = $_POST['config_code'];
    $config_title = $_POST['config_title'];
    $config_descr = $_POST['config_descr'];
    $config_type = $_POST['config_type'];
    $config_val = $_POST['config_val'];
    $config_category = $_POST['config_category'];
    if (strlen($config_code) > 0 && strlen($config_title) > 0) {
        if ($config->insertOrUpdateConfig($id, $config_category, $config_code, $config_title, $config_descr, $config_type, $config_val)) {
            $result = array('success' => 1, 'success_text' => 'Успешно сохранено');
        } else {
            $result = array('success' => 0, 'success_text' => 'Ошибка сохранения');
        }
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка поля Код или Наименование настройки');
    }
}

if (isset($_POST['get_config_categoryes'])) {
    $data = $config->getCategoryes();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}