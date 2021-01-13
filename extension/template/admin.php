<?php
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$user = new \project\user();
if ($user->isEditor()) {
    $pr_template = new \project\template();
    if (!isset($_GET['template'])) {
        include 'tmpl/admin.php';
    } else {
        if (!isset($_GET['file_edit'])) {
            include 'tmpl/list.php';
        } else {
            include 'tmpl/file_edit.php';
        }
    }
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}