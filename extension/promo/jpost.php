<?php

session_start();

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$c_user = new \project\user();
$c_promo = new \project\promo();


// Получение всех принятых промо
if (isset($_POST['getCodePromos'])) {
    $errors = array();
    $data_promos = array();
    $promo_code = trim($_POST['getCodePromos']);
    $data = $c_promo->promo_get_code(trim($promo_code));
    if (count($data) > 0) {
        if ($data[0]['number_uses'] <= 0 && $promo_code != '0') {
            if (isset($_SESSION['promos'][$promo_code])) {
                unset($_SESSION['promos'][$promo_code]);
            }
            $_SESSION['errors'][] = 'Промо больше не доступно!';
        } else {
            //if(product_ids)
            $_SESSION['promos'][$data[0]['code']] = $data[0];
        }
    } else {

        if ($promo_code != '0') {
            $_SESSION['errors'][] = 'Промо не существует!';
        }
    }
    foreach ($_SESSION['promos'] as $key => $value) {
        if (strlen($key) > 0) {
            $data_promos[] = $value;
        }
    }
    $result = array('success' => 1, 'success_text' => '', 'data' => $data_promos);
}

// Уделение промо из массива
if (isset($_POST['deleteCodePromo'])) {
    if (isset($_SESSION['promos'][$_POST['deleteCodePromo']])) {
        unset($_SESSION['promos'][$_POST['deleteCodePromo']]);
    }
    $result = array('success' => 1, 'success_text' => '');
}
