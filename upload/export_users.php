<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/config_old.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';

$sqlLight = new \project\sqlLight();
$u = new \project\user();

// оставляет только цифры
function number_replace($v) {
    return preg_replace("/[^0-9]/", '', $v);
}

// Вычищает лишние пробелы в строке.
function tab_replace($v) {
    return preg_replace('/\s+/', '', $v);
}

function tab_tag($v) {
    return str_replace('"', '', $v);
}

/**
 * Добавим роли
 * @param type $user_id
 * @param type $role_id
 */
function setUserRole($user_id, $role_id) {
    $sqlLight = new \project\sqlLight();
    $querySelect = "select * from `zay_roles_users` where `user_id`='?'";
    $objs = $sqlLight->queryList($querySelect, array($user_id));
    if (count($objs) == 0) {
        $queryInsert = "INSERT INTO `zay_roles_users`(`role_id`, `user_id`) VALUES ('?','?')";
        $sqlLight->query($queryInsert, array($role_id, $user_id));
    }
}

/**
 * Добавим удалим пользователей
 * @param type $table
 * @param array $params
 */
function updateOrInsertData($table, $params) {
    $now = date("Y-m-d H:i:s");
    $sqlLight = new \project\sqlLight();
    $querySelect = "select * from `{$table}` where `external_code`='?'";
    $objs = $sqlLight->queryList($querySelect, array($params[0]));

    $date_registered = (strlen($params[6]) > 0) ? $params[6] : $now;
    $active_subscriber = ($params[10] = 'No') ? 0 : 1;

    if (strlen($params[0]) > 0 && $params[0] > 0) {
//    echo "date_registered: {$date_registered} \n";
//    echo "active_subscriber: {$active_subscriber} \n";
//    echo "active_subscriber: {$active_subscriber} \n";

        if (count($objs) > 0 && $objs[0]['id'] > 0) {
            $role_id = 0;
            if ($params[1] == 'customer') {
                $role_id = 3;
            }
            if ($params[1] == 'subscriber') {
                $role_id = 2;
            }
            if ($role_id > 0) {
                setUserRole($objs[0]['id'], $role_id);
            }
            $queryUpdate = "update `{$table}` set first_name='?', last_name='?', email='?', orders='?', date_registered='?', "
                    . "city='?', city_code='?', phone='?', active_subscriber='?' "
                    . "where id='?' ";
            if ($sqlLight->query($queryUpdate, array($params[2], $params[3], $params[4], $params[5], $date_registered,
                        $params[7], $params[8], $params[9], $active_subscriber, $objs[0]['id']), 1)) {
                echo "-- update {$objs[0]['id']} true<br/>\n";
            } else {
                echo "-- update {$objs[0]['id']} false<br/>\n";
            }
        } else {
            $queryInsert = "INSERT INTO `{$table}`(`email`, `phone`, `first_name`, `last_name`, `u_pass`, `active`, `active_code`, "
                    . "`active_lastdate`, `external_code`, `orders`, `date_registered`, `city`, `city_code`, `active_subscriber`) "
                    . "VALUES ('?','?','?','?','?','?','?',NOW(),'?','?','?','?','?','?')";
            if ($sqlLight->query($queryInsert, array($params[4], $params[9], $params[2], $params[3], '', '0', '',
                        $params[0], $params[5], $date_registered, $params[6], $params[7], $active_subscriber), 1)) {
                echo "-- INSERT {$params[0]} true<br/>\n";
            } else {
                echo "-- INSERT {$params[0]} false<br/>\n";
            }
        }
    }
}

$url = $_SERVER['DOCUMENT_ROOT'] . '/upload/export_user.csv';
$file_str = fileGet($url);

$list = array('UserID', 'FirstName', 'UserRole', 'LastName', 'E-mail', 'Orders', 'DateRegistered', 'Платёжныйадресклиента:Город', 'Платёжныйадресклиента:Почтовыйиндекс', 'Платёжныйадресклиента:Телефон', 'ActiveSubscriber');

// разделитель
$ex_row = "\r";
$rows = explode($ex_row, $file_str);
$a = 0;
$users = array();
$col_list = array();
foreach ($rows as $key => $value) {
    $user_params = array();

    $expload_row = explode(',', $value);
    //echo "--------------------------------------------------------------<br/>\n";
    //echo "<div>{$value}</div>\n";
    for ($i = 0; $i < count($expload_row); $i++) {
        $str = tab_tag($expload_row[$i]);
        /*
         * Сначала найдем нужные нам поля
         */
        if ($a == 0) {
            $str = tab_replace($str);
            if (in_array($str, $list)) {
                //echo "col-{$i}: {$str} YYY<br/>\n";
                $col_list[] = $i;
            }
        }
        if ($i == 0) {
            $user_params[] = $str;
        }
        /*
         * Подготовим массив с данными
         */
        if (in_array($i, $col_list)) {
            //echo "col-{$i}: {$str} YYY<br/>\n";
            $user_params[] = $str;
        } else {
            //echo "col-{$i}: {$str}<br/>\n";
        }
    }
    //if ($a > 3) {
    //    break;
    //}
    $users[] = $user_params;
    $a++;
}

//print_r($col_list);
//echo "--------------------------------------------------------------------<br/>\n";
//print_r($users);
//exit();
if (count($users) > 0) {
    $ii = 0;
    foreach ($users as $value) {
        echo " {$value[$ii]} {$ii}<br/>\n";
        if ($ii > 0) {
            print_r($value);
            updateOrInsertData('zay_users', $value);
            //break;
        }

//        if ($ii < 10) {
//            break;
//        }
        $ii++;
    }
}
/*
 * UserID,UserRole,FirstName,LastName,E-mail,Orders,DateRegistered,Платёжныйадресклиента:Город,Платёжныйадресклиента:Почтовыйиндекс,
 * Платёжныйадресклиента:Телефон,ActiveSubscriber<br/>
  11170,customer,Дарья,Середкина,___Mirage___@mail.ru,1,2019-07-0611:14:10,,,89501300034,No<br/>
 */
