<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

include_once 'inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/inc.php';
include 'lang.php';

$user = new \project\user();
$auth = new \project\auth();

$show = 0;
if (isset($_GET['user_roles'])) {
    include 'tmpl/admin_user_roles.php';
    $show = 1;
}

if (isset($_GET['edit_user'])) {
    include 'tmpl/edit_user.php';
    $show = 1;
}
if (isset($_GET['user_product_edit'])) {
    $first_user_data = $user->getUserInfo($_GET['user_product_edit']);
    $p_cart = new \project\cart();
    $get_pay_user_list = $p_cart->get_pay_user_list($first_user_data['id']);
    
    $get_pay_user_href_list = array();
    $user_href_data = array();
    if(isset($_GET['user_href'])){
        $user_href_data = $user->getUserInfo($_GET['user_href']);
        $get_pay_user_href_list = $p_cart->get_pay_user_list($_GET['user_href']);
    }
    include 'tmpl/user_product_edit.php';
    $show = 1;
}

if ($show == 0) {
    $user_count = $user->user_count();
    include 'tmpl/admin.php';
}
