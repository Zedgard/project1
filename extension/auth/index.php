<?php

/* 
 * Страница index
 */

defined('__CMS__') or die;

include_once DOCUMENT_ROOT . '/extension/users/inc.php';
include_once DOCUMENT_ROOT . '/class/functions.php';
$user = new \project\user();

if($user->isAdmin()){
    location_href('/admin/');
}
if($user->isEditor()){
    location_href('/admin/');
}
if($user->isClient()){
    location_href('/office/');
}
include 'tmpl/login.php';