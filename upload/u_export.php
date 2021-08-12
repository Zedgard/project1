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
    $queryInsert = "UPDATE `zay_import` SET `val`='?' WHERE `code`='wp_users'";
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
    $external_code = $sqlLight->queryList($queryInsertImport, array('wp_users'))[0]['val'];
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
$wp_users = $sqlLight->queryList("SELECT 
        `ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`,
        (SELECT m1.meta_value FROM `wp_usermeta` m1 WHERE `user_id` = u.ID and m1.meta_key='first_name') as first_name, 
        (SELECT m2.meta_value FROM `wp_usermeta` m2 WHERE `user_id` = u.ID and m2.meta_key='last_name') as last_name, 
        (SELECT m3.meta_value FROM `wp_usermeta` m3 WHERE `user_id` = u.ID and m3.meta_key='billing_address_1') as billing_address_1, 
        (SELECT m4.meta_value FROM `wp_usermeta` m4 WHERE `user_id` = u.ID and m4.meta_key='billing_city') as billing_city, 
        (SELECT m5.meta_value FROM `wp_usermeta` m5 WHERE `user_id` = u.ID and m5.meta_key='billing_postcode') as billing_postcode, 
        (SELECT m6.meta_value FROM `wp_usermeta` m6 WHERE `user_id` = u.ID and m6.meta_key='billing_phone') as billing_phone, 
        (SELECT m7.meta_value FROM `wp_usermeta` m7 WHERE `user_id` = u.ID and m7.meta_key='wc_last_active') as wc_last_active 
        FROM `wp_users` u where u.ID>? ORDER BY u.`ID` ASC limit 200 ", array($external_code), 1);

unset($sqlLight);
// новое подключение
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$sqlLight = new \project\sqlLight();

/**
 * Добавим обновим пользователей
 * @param type $email
 * @param type $phone
 * @param type $first_name
 * @param type $last_name
 * @param type $active_lastdate
 * @param type $external_code
 * @param type $orders
 * @param type $city
 * @param type $city_code
 * @param type $active_subscriber
 */
function updateOrInsertData($email, $user_pass, $phone, $first_name, $last_name, $active_lastdate, $external_code, $orders, $city, $city_code, $active_subscriber) {
    if (strlen(trim($active_lastdate)) > 0) {
        $active_lastdate = date("Y-m-d H:i:s", $active_lastdate);
    } else {
        $active_lastdate = date("Y-m-d H:i:s");
    }
    $sqlLight = new \project\sqlLight();
    // Поиск пользователя
    $querySelect = "select * from `zay_users` where `external_code`='?'";
    $objs = $sqlLight->queryList($querySelect, array($external_code));


    if (count($objs) > 0 && $objs[0]['id'] > 0) { // обновим если найден пользователь
        // обновление
        $queryUpdate = "update `zay_users` set u_pass='?' ,first_name='?', last_name='?', email='?', "
                . "city='?', city_code='?', phone='?', active_subscriber='?' "
                . "where id='?' ";
        if ($sqlLight->query($queryUpdate, array($user_pass, $first_name, $last_name, $email,
                    $city, $city_code, $phone, $active_subscriber, $objs[0]['id']), $active_subscriber)) {
            echo "-- update {$objs[0]['id']} true<br/>\n";
            $queryInsert = "UPDATE `zay_import` SET `val`='?' WHERE `code`='wp_users'";
            $sqlLight->query($queryInsert, array($external_code), 0);
        } else {
            echo "-- update {$objs[0]['id']} false<br/>\n";
            $sqlLight->query($queryUpdate, array($user_pass, $objs[0]['id']), 1);
            $queryInsert = "UPDATE `zay_import` SET `error`='?' WHERE `code`='wp_users'";
            $sqlLight->query($queryInsert, array('Ошибка ' . $external_code), 0);
            exit();
        }
    } else { // Создание новой записи
        $queryInsert = "INSERT INTO `zay_users`(`email`, `u_pass`, `phone`, `first_name`, `last_name`, "
                . "`active`, `active_code`, "
                . "`active_lastdate`, `external_code`, `orders`, `date_registered`, `city`, `city_code`, `active_subscriber`, `network`) "
                . "VALUES ('?','?','?','?', "
                . "'?','?','?', "
                . "'?','?','?',NOW(),'?','?','?','?')";
        if ($sqlLight->query($queryInsert,
                        array($email, $user_pass, $phone, $first_name, $last_name,
                            '1', '',
                            $active_lastdate, $external_code, '0',
                            $city, $city_code, $active_subscriber, ''), 0)) {
            echo "-- INSERT {$external_code} true<br/>\n";
            $queryInsert = "UPDATE `zay_import` SET `val`='?' WHERE `code`='wp_users'";
            $sqlLight->query($queryInsert, array($external_code), 0);
        } else {
            echo "-- INSERT {$external_code} false<br/>\n";
        }
    }
}

/*
 * Добавим или обновим все записи
 */
foreach ($wp_users as $v) {
    updateOrInsertData($v['user_email'], $v['user_pass'], $v['billing_phone'], $v['first_name'], $v['last_name'],
            $v['wc_last_active'], $v['ID'], 0, $v['billing_city'],
            $v['billing_postcode'], 0);
}

//SELECT `ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`,
//        (SELECT m1.meta_value FROM `wp_usermeta` m1 WHERE `user_id` = u.ID and m1.meta_key='first_name') as first_name, 
//        (SELECT m2.meta_value FROM `wp_usermeta` m2 WHERE `user_id` = u.ID and m2.meta_key='last_name') as last_name, 
//        (SELECT m3.meta_value FROM `wp_usermeta` m3 WHERE `user_id` = u.ID and m3.meta_key='billing_address_1') as billing_address_1, 
//        (SELECT m4.meta_value FROM `wp_usermeta` m4 WHERE `user_id` = u.ID and m4.meta_key='billing_city') as billing_city, 
//        (SELECT m5.meta_value FROM `wp_usermeta` m5 WHERE `user_id` = u.ID and m5.meta_key='billing_postcode') as billing_postcode, 
//        (SELECT m6.meta_value FROM `wp_usermeta` m6 WHERE `user_id` = u.ID and m6.meta_key='billing_phone') as billing_phone, 
//        (SELECT m7.meta_value FROM `wp_usermeta` m7 WHERE `user_id` = u.ID and m7.meta_key='wc_last_active') as wc_last_active 
//        FROM `wp_users` u where u.ID>286915 ORDER BY u.`ID` ASC limit 500