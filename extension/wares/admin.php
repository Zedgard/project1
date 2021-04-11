<?php
session_start();

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$wares = new \project\wares();
$user = new \project\user();
if ($user->isEditor()) {
    if (!isset($_SESSION['wares']['searchStr'])) {
        $_SESSION['wares']['searchStr'] = '';
    }
    $pr_wares = new \project\wares();

    if (isset($_GET['edit'])) {
        $wares_id = ($_GET['edit'] > 0) ? $_GET['edit'] : 0;
        include 'tmpl/admin_edit_form.php';
    } else {
        include 'tmpl/admin.php';
    }
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}