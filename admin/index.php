<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

define('__CMS__', 1);

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';

/*
 * Кэширование 
 */
$cache = 1;

if ($cache == 1) {
    include $_SERVER['DOCUMENT_ROOT'] . '/cache.php';
}

include $_SERVER['DOCUMENT_ROOT'] . '/config.php';


$_SESSION['site_title'] = $_SESSION['site_name'] . ' - Панель администратора';

// Токен
include_once $_SERVER['DOCUMENT_ROOT'] . '/app/token.php';
$token = new \project\token();

/**
 * Регистрируем javascript скрипты здесь
 */
$_body_javascript[] = $token->javascript();

if ($_SESSION['DEBUG'] == 1) {
    echo "user_auth_data: " . $_SESSION['user_auth_data'] . "<br/>\n";
    echo "Errors: "; 
    print_r($_SESSION['errors']);
}

$_body = $_SERVER['DOCUMENT_ROOT'] . '/admin/user/auth/tmpl/login.php';


include 'tmpl/index.php';

$_SESSION['errors'] = array();