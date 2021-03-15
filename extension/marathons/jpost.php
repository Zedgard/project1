<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once 'inc.php';

$c_marathons = new \project\marathons();
$user = new \project\user();
$config = new \project\config();

