<?php

/*
 * Обработка запросов на сайте
 */

defined('__CMS__') or die;

/*
 * Автивация пользователя
 */
//$activation = \project\url::getTag('activation');

include_once DOCUMENT_ROOT . "/system/user/auth/get.php";

//print_r($_SESSION['url']);

if($_SESSION['url'][1]=='admin'){
    echo 'admin';
} 

if($_SESSION['url'][1]=='office'){
    echo 'office';
} 

