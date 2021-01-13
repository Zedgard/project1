<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

include_once 'inc.php';


$sign_up_consultation = new \project\sign_up_consultation();

// Получение списка консультанков
$consultation_masters = $sign_up_consultation->get_consultation_master();

include 'tmpl/admin.php';
