<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/page/inc.php';

$p = new \project\page();
$pages = $p->adminList(0);

include 'tmpl/admin.php';