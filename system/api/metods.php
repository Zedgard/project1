<?php

/*
 * Здесь описываются методы
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';

//include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
//$config = new \project\config();

/**
 * Основная функция работы с методами
 * @param type $func
 * @param type $params
 */
function api_route($func, $params = array()) {
    return $func($params);
}

/*
 * Здесь описываем все методы
 */

function check_user($params) {
    echo 'check_user';
}

function user_update($params) {
    echo 'user_update';
}

function transaction($params) {
    echo 'transaction';
}

function booked($params) {
    echo 'booked';
}

function ya_payment($params) {
    echo 'ya_payment';
}

function appointment($params) {
    echo 'appointment';
}

function appointment_v2($params) {
    echo 'appointment_v2';
}

function appointment_employee($params) {
    echo 'appointment_employee';
}

function create_appointment($params) {
    echo 'create_appointment';
}

function order_connecton($params) {
    echo 'order_connecton';
}

function order_completed($params) {
    echo 'order_completed';
}

function apple_pay($params) {
    echo 'apple_pay';
}

function update_token_firebase($params) {
    echo 'update_token_firebase';
}

function get_case_products($params) {
    echo 'get_case_products';
}

function products_v2($params) {
    echo 'products_v2';
}

function list_categories($params) {
    echo 'list_categories';
}

function my_list_employee($params) {
    echo 'my_list_employee';
}

/**
 * Роут для авторизации по новой схеме в мобильном приложении
 * @param type $params
 * @return array
 */
function auth_v2_check_user($params) {
    //echo 'auth_v2_check_user';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
    $auth = new \project\auth();
    $type = get_param('type');
    $login = trim(get_param('login'));

    //проверяем на корректность параметр тип логина
    if ($type != "login" && $type != "email") {

        $return = [
            'result' => 'error',
            'error' => 'incorrect_field_type',
            'error_description' => 'Field type wrong (only login or email)'
        ];
    } else {//если передадные параметры корректны
        //ищем юзера по переданному типу
        $user = $auth->get_user_login($login, $login);

        if (isset($user['id']) && $user['id'] > 0) {//нашли, возвращем успешный ответ
            $return = [
                'result' => 'success',
                'description' => "User {$login} by {$type} found.",
                'user_id' => $user['id'],
                'email' => $user['email']
            ];
        } else {// не нашли, возвращем ошибку
            $return = [
                'result' => 'error',
                'error' => 'user_not_found',
                'error_description' => "User $login by $type not found."
            ];
        }
    }
    return $return;
}

function auth_v2_send_temp_pass($params) {
    echo 'auth_v2_send_temp_pass';
}

function auth_v2_login($params) {
    echo 'auth_v2_login';
}
