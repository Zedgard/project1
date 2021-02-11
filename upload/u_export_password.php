<?php

/*
 * Процедура импорта пользователей, можно запускать по крон заданию или вручную
 * /upload/u_export.php
 * 
 * Обнулить данные
 * /upload/u_export.php?zay_import_clear=1
 */
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
$sqlLight = new \project\sqlLight();

/*
 * Обнулить данные
 */
if (isset($_GET['zay_import_clear'])) {
    $queryInsert = "UPDATE `zay_import` SET `val`='?' WHERE `code`='wp_password'";
    if ($sqlLight->query($queryInsert, array(0))) {
        echo 'zay_import clear OK!';
    }
    exit();
}

/*
 * Получим начальное значение последнего импорта
 */
$external_code = 0;
try {
    $queryInsertImport = "select i.val from `zay_import` i WHERE i.`code`='?' ";
    $external_code = $sqlLight->queryList($queryInsertImport, array('wp_password'))[0]['val'];
} catch (Exception $exc) {
    exit('В таблице "zay_import" отсутствует запись! ' . $exc);
}
echo "external_code: {$external_code} <br/>\n";

// подключаемся к сторонней базе
unset($sqlLight);
include $_SERVER['DOCUMENT_ROOT'] . '/config_old.php';
$sqlLight = new \project\sqlLight();

/*
 * Импортируем данные из другой базы
 */
$wp_users = $sqlLight->queryList("SELECT "
        . "`ID`, `user_login`, `user_pass`, `user_email` "
        . "FROM `wp_users` u where u.ID>? ORDER BY u.`ID` ASC limit 500 ", array($external_code), 1);

unset($sqlLight);
// новое подключение
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$sqlLight = new \project\sqlLight();

/**
 * Обновим пароль
 * @param type $external_code
 * @param type $email
 * @param type $user_pass
 */
function updateOrInsertData($external_code, $email, $user_pass) {
    $sqlLight = new \project\sqlLight();
    // Поиск пользователя
    $querySelect = "select * from `zay_users` where `external_code`='?'";
    $objs = $sqlLight->queryList($querySelect, array($external_code));

    $e = 0;
    if (count($objs) > 0 && $objs[0]['id'] > 0) { // обновим если найден пользователь
        // обновление
        $queryUpdate = "update `zay_users` set u_pass='?' "
                . "where id='?' ";
        if ($sqlLight->query($queryUpdate, array($user_pass, $objs[0]['id']), 0)) {
            echo "-- update {$objs[0]['id']} true<br/>\n";
        } else {
            $e = 1;
            echo "-- update {$objs[0]['id']} false<br/>\n";
            $sqlLight->query($queryUpdate, array($user_pass, $objs[0]['id']), 1);
            $queryInsert = "UPDATE `zay_import` SET `error`='?' WHERE `code`='wp_password'";
            $sqlLight->query($queryInsert, array('Ошибка ' . $external_code), 0);
            exit();
        }
    }
    if ($e == 0) {
        $queryInsert = "UPDATE `zay_import` SET `val`='?' WHERE `code`='wp_password'";
        $sqlLight->query($queryInsert, array($external_code), 0);
    }
}

/*
 * Добавим или обновим все записи
 */
foreach ($wp_users as $v) {
    updateOrInsertData($v['ID'], $v['user_email'], $v['user_pass']);
}
