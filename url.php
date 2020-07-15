<?php

/*
 * Обработка запросов на сайте
 */

session_start();

defined('__CMS__') or die;

/*
 * Для пользователя
 */
include_once DOCUMENT_ROOT . "/system/user/auth/get.php";
include_once DOCUMENT_ROOT . "/system/page/inc.php";
include_once DOCUMENT_ROOT . "/system/theme/inc.php";

/*
 * Отобразим страницы сайта
 */
if ($p == 0) {
    $page = new \project\page();

    $pageArray = $page->show($_SESSION['url'][1]);
    
    $theme = new \project\theme();
    $html = $theme->getTemplateFile($pageArray['server_name'], '');

    echo $html;
}
