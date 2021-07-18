<?php
/*
 * Страница index
 */


defined('__CMS__') or die;

include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$c_keise = new \project\keise();
$u = new \project\user();

