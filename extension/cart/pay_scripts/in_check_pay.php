<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * [ik_co_id] => 5f5dfdf8f3f7ad5888515cd6 [ik_inv_id] => 244440086 [ik_inv_st] => success [ik_pm_no] => 1 ) 
 */
include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';

$sqlLight = new \project\sqlLight();
$u = new \project\user();
$p_products = new \project\products();
$config = new \project\config();
$sign_up_consultation = new \project\sign_up_consultation();

$in_shop_id = $config->getConfigParam('in_shop_id');
$in_secret_key = $config->getConfigParam('in_secret_key');


$client_email = $u->isClientEmail();
$client_id = ($u->isClientId() > 0) ? $u->isClientId() : 0;

$total = 0;
$pay_key = $_SESSION['pay_key'];
if (count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart']['prices'] as $value) {
        $total += $value;
    }
}

/*
  echo "client_email: {$client_email} <br/>\n";
  echo "client_id: {$client_id} <br/>\n";
  echo "total: {$total} <br/>\n";
  echo "idempotenceKey: {$pay_key} <br/>\n";
 */

$pay_check = 'succeeded';

$ik_co_id = $_POST['ik_co_id'];
$ik_inv_id = $_POST['ik_inv_id'];
$ik_inv_st = $_POST['ik_inv_st'];
$ik_pm_no = $_POST['ik_pm_no'];

// Array ( [ik_co_id] => 5f5dfdf8f3f7ad5888515cd6 [ik_inv_id] => 283226857 [ik_inv_st] => success [ik_pm_no] => 1 )
if (isset($_POST['ik_co_id']) && strlen($pay_key) > 0 && $ik_co_id == $in_shop_id) {
    if ($ik_inv_st == 'success') {
        echo $ik_inv_st;
        $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='in' and `pay_status`='pending' and pay_key='?'";
        $pays = $sqlLight->queryList($query, array($pay_key));
        foreach ($pays as $value) {
            //echo "- {$value['id']}<br/>\n";
            $pay_id = $value['id'];
            $query_update = "UPDATE zay_pay SET pay_status='?', pay_interkassa_id='?' WHERE id='?' ";
            if ($sqlLight->query($query_update, array($pay_check, $ik_inv_id, $value['id']))) {
                /*
                 * Если установлена настройка отправим в календарь событие
                 */
                if ($_SESSION['consultation']['your_master_id'] > 0) {
//                    if ($config->getConfigParam('event_sent_on_pay_calendar') == '1') {
//
//                        $queryMaster = "SELECT * FROM `zay_consultation_master` WHERE id='?' ";
//                        $master = $sqlLight->queryList($queryMaster, array($_SESSION['consultation']['your_master_id']))[0];
//                        $master_token = $master['token_file_name'];
//                        $master_credentials = $master['credentials_file_name'];
//
//                        $first_name = $_SESSION['consultation']['first_name'];
//                        $user_phone = $_SESSION['consultation']['user_phone'];
//                        $user_email = $_SESSION['consultation']['user_email'];
//                        $pay_descr = $_SESSION['consultation']['pay_descr'];
//                        $user_date = $_SESSION['consultation']['date'];
//                        $user_time = $_SESSION['consultation']['time'];
//                        /*
//                          'your_master_id' => $your_master,
//                          'first_name' => $first_name,
//                          'user_phone' => $user_phone,
//                          'user_email' => $user_email,
//                          'pay_descr' => "<div>Консультация с {$first_name}</div>"
//                          . "<div>Телефон: {$user_phone}</div>"
//                          . "<div>Email: {$user_email}</div>"
//                          . "<div>Консультант: {$your_master_text}</div>"
//                          . "<div>Дата и время: {$datepicker_data} {$timepicker_data}</div>",
//                          'date' => $datepicker_data,
//                          'time' => $timepicker_data,
//                          'price' => $price
//                         */
//                        //$master_token = $master['credentials_file_name'];
//                        //include $_SERVER['DOCUMENT_ROOT'] . '/system/google-api-php-client-master/addevent.php';
//                    }
                    /*
                     * Если это консультация 
                     */
                    if ($_SESSION['consultation']['your_master_id'] > 0) {
                        $_SESSION['consultation']['pay_id'] = $max_id;
                        $sign_up_consultation->add_consultation($_SESSION['consultation']);
                    }
                }

                $p_products->setSoldAdd($pay_id);

                $_SESSION['cart']['cart_itms'] = $_SESSION['cart']['itms'];
                $_SESSION['cart']['total'] = $total;
                $_SESSION['cart']['pay_id'] = $pay_id;
                $_SESSION['cart']['itms'] = array();
                unset($_SESSION['pay_key']);
                $_SESSION['PAY_KEY'] = '';
                unset($_SESSION['PAY_KEY']);
                goBack('/shop/cart/?in_payment_true=1', '0');
            } else {
                echo 'Ошибка регистрации платежа! Пожалуйста сообщите администрации сайта о данный проблеме!';
            }
        }
    }
} else {
    ?>
    <div>Произошла ошибка платежа!</div>
    <div>Сессия утеряна</div>
    <?
    goBack('/shop/', '10000');
}