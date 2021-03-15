<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$c_marathons = new \project\marathons();
$c_user = new \project\user();
if ($c_user->isEditor()) {

    //$pr_products = new \project\products();
    
    include 'tmpl/admin.php';
    
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}
