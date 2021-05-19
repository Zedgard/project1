<?php
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$user = new \project\user();
$pr_utm = new \project\utm();

if ($user->isEditor()) {
    if (isset($_GET['edit'])) {
        include 'tmpl/edit.php';
    } elseif ($_GET['edit_tags']) {
        include 'tmpl/edit_tags.php';
    } else {
        include 'tmpl/admin.php';
    }
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}