<?php

/*
 * Страница index
 */

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/category/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/topic/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/page/inc.php';
include_once 'inc.php';

$c_category = new \project\category();
$c_topic = new \project\topic();
$c_wares = new \project\wares();
$c_product = new \project\products();
$page = new \project\page();

$categoryArray = $c_category->getCategoryArray('product_category', '');
$topicArray = $c_category->getCategoryArray('product_topic', ''); // $c_topic->getTopicArray(''); 

/* Все продукты сайта с учетом фильтра */
$querySelect = "SELECT ip.id as ip_id, ip.position as position, p.* "
        . "FROM zay_index_promo ip "
        . "left join zay_product p on p.id=ip.product_id "
        . "WHERE p.active='1' and p.is_delete='0'"
        . "ORDER BY ip.position ASC";
$productsFilterArray = $c_product->getSelectArray($querySelect, array());
$productsFilterCount = count($productsFilterArray);

include 'tmpl/index_promo.php';
include 'tmpl/go_cart_modal.php';
