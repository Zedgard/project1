<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once 'inc.php';

$c_user = new \project\user();
$close_club = new \project\close_club();

$c_products = new \project\products();

if ($c_user->isClient() || $c_user->isEditor()) {
    $close_club_info = $close_club->get_club_user_info($_SESSION['user']['info']['id']);
    //print_r($close_club_info);

    /*
     * Заморозить абонемент кнопки
     */
    $class = 'default';
    $button_class = 'freeze_user_active';
    if ($close_club_info[0]['freeze_day'] < 10) {
        $class = 'lock';
        $button_class = 'lock';
    }
    $freeze_day_buttons[] = array(
        'title_sum' => 10,
        'title_name' => 'дней',
        'button_text' => 'добавить',
        'class' => $class,
        'button_class' => $button_class
    );
    if ($close_club_info[0]['freeze_day'] < 20) {
        $class = 'lock';
        $button_class = 'lock';
    }
    $freeze_day_buttons[] = array(
        'title_sum' => 20,
        'title_name' => 'дней',
        'button_text' => 'добавить',
        'class' => $class,
        'button_class' => $button_class
    );
    if ($close_club_info[0]['freeze_day'] < 30) {
        $class = 'lock';
        $button_class = 'lock';
    }
    $freeze_day_buttons[] = array(
        'title_sum' => 30,
        'title_name' => 'дней',
        'button_text' => 'добавить',
        'class' => $class,
        'button_class' => $button_class
    );
    if ($close_club_info[0]['freeze_day'] < 40) {
        $class = 'lock';
        $button_class = 'lock';
    }
    $freeze_day_buttons[] = array(
        'title_sum' => 40,
        'title_name' => 'дней',
        'button_text' => 'добавить',
        'class' => $class,
        'button_class' => $button_class
    );


    $waresClub = $c_products->getProductsClubArray();
    include 'tmpl/office.php';
}