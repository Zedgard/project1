<?php

defined('__CMS__') or die;


include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
include_once 'inc.php';

$pr_cart = new \project\cart();
$pr_products = new \project\products();
$p_user = new \project\user();
$config = new \project\config();


// Добавление в корзину
if (isset($_POST['cart_product_add'])) {
    $product_id = $_POST['cart_product_id'];
    $new_arr = array();
    if ($product_id > 0) {
        if (isset($_SESSION['cart']['itms']) && count($_SESSION['cart']['itms']) > 0) {
            foreach ($_SESSION['cart']['itms'] as $key => $value) {
                if ($product_id == $value['id']) {
                    //unset($_SESSION['cart']['itms'][$key]);
                } else {
                    $new_arr[] = $_SESSION['cart']['itms'][$key];
                }
            }
            $_SESSION['cart']['itms'] = $new_arr;
        }
        // Зарегистрируем товары
        $obj = $pr_products->getProductElem($product_id);
        $_SESSION['cart']['itms'][] = $obj;
        init_prices();
    }
}

// Добавление в корзину консультации
if (isset($_POST['send_consultation_form'])) {
    unset($_SESSION['consultation']);
    $_SESSION['cart']['itms'] = array();
    $first_name = $_POST['first_name'];
    $user_phone = $_POST['user_phone'];
    $user_email = $_POST['user_email'];
    $your_master = $_POST['your_master'];
    $your_master_text = $_POST['your_master_text'];
    $datepicker_data = $_POST['datepicker_data'];
    $timepicker_data = $_POST['timepicker_data'];
    $price = $_POST['price'];
    $period_id = $_POST['period_id'];
    $user_id = 0;

    /*
     * Проверим есть ли пользователь, если нет зарегистрирован регистрируем
     */
    $sqlLight = new \project\sqlLight();
    $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active` = 1";
    $users = $sqlLight->queryList($query, array($user_email, $user_phone));
    if (count($users) == 0) {
        $password = $this->password_generate();
        /*
         * Нужно еще отправлять пароль пользователю на почту !!!!!!!!!!!!!
         */
        $send_emails = new \project\send_emails();
        $send_emails->send('new_password', $user_email, array('user_password' => $password));
        $this->register($user_email, $user_phone, $password, $password, '1');
        $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active` = 1";
        $users = $sqlLight->queryList($query, array($user_email, $user_phone), 1);
        if (count($users) > 0) {
            $user_id = $users[0]['id'];
        }
    } else {
        $user_id = $users[0]['id'];
    }
    // -------------------------------------------------------------------------

    $data_itm = array(
        'id' => 0,
        'your_master_id' => $your_master,
        'user_id' => $user_id,
        'first_name' => $first_name,
        'user_phone' => $user_phone,
        'user_email' => $user_email,
        'pay_descr' => "<div>Консультация с {$first_name}</div>"
        . "<div>Телефон: {$user_phone}</div>"
        . "<div>Email: {$user_email}</div>"
        . "<div>Консультант: {$your_master_text}</div>"
        . "<div>Дата и время: {$datepicker_data} {$timepicker_data}</div>"
        . "<div>Цена: {$price}</div>",
        'date' => $datepicker_data,
        'time' => $timepicker_data,
        'price' => $price,
        'period_id' => $period_id,
    );
    $_SESSION['consultation'] = $data_itm;
    $_SESSION['cart']['itms'][] = $data_itm;
}

// Удаление из корзины
if (isset($_POST['cart_product_remove'])) {
    $product_id = $_POST['cart_product_id'];
    $new_arr = array();
    if ($product_id > 0) {
        foreach ($_SESSION['cart']['itms'] as $key => $value) {
            if ($product_id == $value['id']) {
                //unset($_SESSION['cart']['itms'][$key]);
            } else {
                $new_arr[] = $_SESSION['cart']['itms'][$key];
            }
        }
        $_SESSION['cart']['itms'] = $new_arr;
        init_prices();
    }
}

if (isset($_POST['cart_product_get_array'])) {
    $arr = array();
    if (isset($_SESSION['cart']['itms']) && count($_SESSION['cart']['itms']) > 0) {
        foreach ($_SESSION['cart']['itms'] as $key => $value) {
            if (strlen($value['pay_descr']) == 0) {
                $arr[] = $value;
            }
            //    echo "itms: {$_SESSION['cart']['itms'][$key]}\n";
            //$_SESSION['cart']['itms'][$key]['product_info'] = $pr_products->getProductElem($_SESSION['cart']['itms'][$key]);
            //print_r($pr_products->getProductElem($_SESSION['cart']['itms'][$key]));
            //    echo "\n";
        }
    }
    // $_SESSION['cart']['itms']
    $result = array('success' => 1, 'success_text' => '', 'data' => $arr);
}

if (isset($_POST['cart_product_get_count'])) {
    $count = count($_SESSION['cart']['itms']);
    if ($count > 0) {
        
    } else {
        $count = 0;
    }
    $result = array('success' => 1, 'success_text' => '', 'data' => array('count' => $count));
}
/**
 * Колличество не обработанных заявок
 */
if (isset($_POST['not_processed_col'])) {
    $querySelect = "SELECT count(*) as not_processed_col FROM `zay_pay` WHERE `processed` = 0";
    $not_processed_col = $pr_cart->getSelectArray($querySelect)[0]['not_processed_col'];
    $result = array('success' => 1, 'success_text' => '', 'not_processed_col' => $not_processed_col);
}

if (isset($_POST['user_send_message'])) {
    $user_fio = $_POST['user_fio'];
    $user_email = $_POST['user_email'];
    $user_subject = $_POST['user_subject'];
    $user_message = $_POST['user_message'];
    $arrayReplaseText = array(
        'user_fio' => $user_fio,
        'user_email' => $user_email,
        'user_subject' => $user_subject,
        'user_message' => $user_message,
    );

    if (strlen($config->getConfigParam('link_ed_mailto')) > 0) {
        $link_ed_mailto = $config->getConfigParam('link_ed_mailto');
        //$link_ed_mailto = 'koman1706@gmail.com';

        if ($p_user->sendEmail($link_ed_mailto, 'Письмо технической поддержки', 'send_user_message', $arrayReplaseText)) {
            $result = array('success' => 1, 'success_text' => 'Успешно отправлено, ждите ответа.');
        } else {
            $_SESSION['errors'][] = 'Не отправлено!';
            $result = array('success' => 0, 'success_text' => '');
        }
    }
}