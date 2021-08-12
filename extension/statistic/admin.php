<?php
/*
 * Админка статистики
 */
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';

$user = new \project\user();

if ($user->isEditorUTM()) {
    include_once 'inc.php';
    include 'lang.php';

    include 'tmpl/admin.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/pay/tmpl/info.php';
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}