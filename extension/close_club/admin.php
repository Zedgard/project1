<?php
defined('__CMS__') or die;

include_once DOCUMENT_ROOT . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$c_user = new \project\user();

if ($c_user->isEditor()) {

    include 'tmpl/admin.php';
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}
