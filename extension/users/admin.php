<?php
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

include_once 'inc.php';
include 'lang.php';

$user = new \project\user();

if ($user->isEditor()) {
    //$users_data = $user->getUserInfo();
    include 'tmpl/admin.php';
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}
