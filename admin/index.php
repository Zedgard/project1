<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

/*
 * Кэширование 
 */
$cache = 1;

if ($cache == 1) {
    include $_SERVER['DOCUMENT_ROOT'] . '/cache.php';
}

include $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include 'tmpl/login.php';
