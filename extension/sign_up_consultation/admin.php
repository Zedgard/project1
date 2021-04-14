<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

include_once 'inc.php';


$sign_up_consultation = new \project\sign_up_consultation();

// Получение списка консультанков
$consultation_masters = $sign_up_consultation->get_consultation_master();

//$sign_up_consultation->set_consultation_times(1, array('03:00','04:00'));
include 'tmpl/admin.php';
