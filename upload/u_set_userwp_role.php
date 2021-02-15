<?php

/*
 * Раздача ролей пользователям
 */

session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';

$sqlLight = new \project\sqlLight();
$p_user = new \project\user();

// найдем роль пользователей
$query_role = "SELECT * FROM `zay_roles` WHERE `role_code` = 'clients'";
$role_obj = $sqlLight->queryList($query_role, array())[0];

// найдем всех активных клиентов у которых уже есть пароли 
$query = "SELECT
    uru.role_id,
    u.id,
    u.email,
    u.phone,
    u.u_pass,
    u.external_code,
    u.active
FROM
    zay_users u
LEFT JOIN zay_roles_users uru ON
    uru.user_id = u.id
WHERE
    u.u_pass IS NOT NULL AND u.active = 1 AND u.external_code IS NOT NULL AND uru.id IS NULL
ORDER BY
    u.id ASC";

if ($role_obj['id'] > 0) {
    $objs = $sqlLight->queryList($query, array());
    foreach ($objs as $value) {
        echo "- {$value['id']} <br/>\n";
        $p_user->edit_user_role($value['id'], $role_obj['id']);
    }
}