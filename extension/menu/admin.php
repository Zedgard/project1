<?php
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$user = new \project\user();
$menu = new \project\menu();
if ($user->isEditor()) {
    if (!isset($_GET['menu_items'])) {
        include 'tmpl/admin.php';
    }
    if (isset($_GET['menu_items']) and $_GET['menu_items'] > 0) {
        include 'tmpl/edit_items.php';
    }
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}