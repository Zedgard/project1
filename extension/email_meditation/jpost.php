<?php

session_start();
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/page/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$p_user = new \project\user();
$p_pages = new \project\email_meditation();
