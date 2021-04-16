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
    $waresClub = $c_products->getProductsClubArray();
    include 'tmpl/office.php';
}