<?php

/*
 * Обработка запросов
 */

defined('__CMS__') or die;

include 'inc.php';

$auth = new \project\auth();

if (isset($_POST['authorization'])) {

    if ($auth->authorization($_POST['email'], $_POST['password'])) {
        $result = array('success' => 1);
    } else {
        $result = array('success' => 0);
    }
    
}

if (isset($_POST['registration'])) {

    if ($auth->register($_POST['email'], $_POST['phone'], $_POST['password'], $_POST['cpassword'], $_POST['check_indicator'])) {
        $result = array('success' => 1);
    } else {
        $result = array('success' => 0);
    }
    
}