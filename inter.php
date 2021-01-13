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
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';

$sqlLight = new \project\sqlLight();
$u = new \project\user();

$client_email = $u->isClientEmail();
$client_id = $u->isClientId();

$total = 0;
foreach ($_SESSION['cart']['prices'] as $value) {
    $total += $value;
}

$pay_key = $_SESSION['pay_key'];

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
    
if (isset($_POST['ik_co_id']) && strlen($pay_key) > 0 && $ik_co_id == $in_shop_id) {
    if ($ik_inv_st == 'success') {
        $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='in' and `pay_status`='pending' and pay_key='?'";
        $pays = $sqlLight->queryList($query, array($pay_key));
        foreach ($pays as $value) {
            //echo "- {$value['id']}<br/>\n";
            $query_update = "UPDATE zay_pay SET pay_status='?', pay_interkassa_id='?' WHERE id='?' ";
            $sqlLight->query($query_update, array($pay_check, $ik_inv_id, $value['id']));
            $_SESSION['cart']['itms'] = array();
            unset($_SESSION['pay_key']);
            //goBack('/shop/cart/?in_payment_true=1', '0');
            // /shop/cart/?in_payment_true=1
            
        }
        header('Location: ' . '/shop/cart/?in_payment_true=1');
    }
}