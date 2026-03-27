<?php
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';
include 'lang.php';


$db_accs = new \project\accounts();
$usr = new \project\user();
if ($usr->isEditor()) {
    // $accounts = $db_accs->get_accounts_all();
        include 'tmpl/admin.php';
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}