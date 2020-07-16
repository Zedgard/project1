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

    //array_reverse($_SESSION['url']);
    $pageArray = $page->show();
    //echo "site_title: {$_SESSION['site_title']}<br/>\n";
    //print_r($pageArray);
    
    $theme = new \project\theme();
    $html = $theme->getTemplateFile($pageArray['server_name'], '');
    //print_r($_SESSION['page']['info']);
    
    echo $html;
}



