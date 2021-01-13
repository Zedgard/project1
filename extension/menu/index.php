<?php

/*
 * Работает на сайте
 */
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';

include_once 'inc.php';
include_once 'inc_items.php';

function init_menus() {
    $menu = new \project\menu();
    $items = new \project\menu_item();
    $querySelect = "SELECT * FROM `zay_menu`";
    $data = $menu->getSelectArray($querySelect, array(), 0);
    if (count($data) > 0) {
        foreach ($data as $key => $value) {
            $_SESSION['site_menu'][$value['menu_code']] = $items->index_menu_items_list($value['id']);
        }
    }
}

init_menus();





//echo $_SESSION['site_menu']['top'];