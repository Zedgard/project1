<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$pr_get_emails = new \project\get_emails();

$user = new \project\user();
if ($user->isEditor()) {

    //$pr_products = new \project\products();
    $emails = $pr_get_emails->get_emails();
    include 'tmpl/admin.php';
    
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}