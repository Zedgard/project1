<?php

/**
 * Отображение чата в вебинаре
 */
defined('__CMS__') or die;

include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$c_chat = new \project\chat();
$u = new \project\user();
$ClientId = $u->isClientId();
include 'tmpl/main.php';
