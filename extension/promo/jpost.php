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
    $data_promos = array();
    $data = $c_promo->promo_get_code(trim($_POST['getCodePromos']));
    if (count($data) > 0) {
        $_SESSION['promos'][$data[0]['code']] = $data[0];
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
