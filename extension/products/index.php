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
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/page/inc.php';
include_once 'inc.php';

$c_category = new \project\category();
$c_topic = new \project\topic();
$c_wares = new \project\wares();
$p_user = new \project\user();
$c_product = new \project\products();
$page = new \project\page();

$categoryArray = $c_category->getCategoryArray('product_category', '');
$topicArray = $c_category->getCategoryArray('product_topic', ''); // $c_topic->getTopicArray(''); 
$themeArray = $c_category->getCategoryArray('product_theme', ''); // $c_topic->getTopicArray(''); 
//productSearchString
/*
 * Настройки фильтров
 */
$productTopicStr = '';
if (isset($_GET['productTopic'])) {
    $productTopicStr = $_GET['productTopic'];
    $topikInfo = $c_topic->getTopicElem($_GET['productTopic']);
    $_SESSION['site_title'] .= ' - ' . $topikInfo['title'];
}
//print_r($topikInfo);
$ProductNew = '0';
if (isset($_SESSION['product']['filter']['ProductNew'])) {
    $ProductNew = $_SESSION['product']['filter']['ProductNew'];
}

$ProductPromo = '0';
if (isset($_SESSION['product']['filter']['ProductPromo'])) {
    $ProductPromo = $_SESSION['product']['filter']['ProductPromo'];
}

$productSearchString = '';
if (isset($_SESSION['product']['filter']['productSearchString']) && strlen($_SESSION['product']['filter']['productSearchString']) > 0) {
    $productSearchString = $_SESSION['product']['filter']['productSearchString'];
}

$product_theme = '0';
if (isset($_SESSION['product']['filter']['product_theme'])) {
    $product_theme = $_SESSION['product']['filter']['product_theme'];
}

/* Все продукты сайта с учетом фильтра */
$productsFilterArray = $c_product->getProductsIndex($productSearchString, '', $productTopicStr, $ProductPromo, $ProductNew, $product_theme);
$productsFilterCount = count($productsFilterArray);

// Для рекомендаций
$rand_product1 = mt_rand(0, $productsFilterCount);
$rand_product2 = mt_rand(0, $productsFilterCount);
$rand_product3 = mt_rand(0, $productsFilterCount);

/*
 * Когда выбрали товар информация по товару
 */
if (isset($_GET['product'])) {
    /* Получнеи данных по продукту */
    $productId = 0;
    if ($_GET['product'] > 0) {
        $productId = $_GET['product'];
    }
    if ($productId > 0) {
        $productData = $c_product->getProductElem($productId);

        // Определим категорию
        $title_category = array();
        $exp_category_ids = explode(',', $productData['category_ids']);
        $category_count = count($exp_category_ids);

        $class_category = '';
        $color_category = '';
        $bg_category = '';
        $position = '';
        $positio_z = '';
        $title_category_bg = '';
        if ($category_count > 0) {
            for ($c = 0; $c < $category_count; $c++) {
                for ($c2 = 0; $c2 < count($categoryArray); $c2++) {
                    if ($categoryArray[$c2]['id'] == $exp_category_ids[$c]) {
                        $positio_z = $c * 2.8;
                        $position = "margin-top: {$positio_z}rem;";
                        $bg_category = 'background-color: ' . $categoryArray[$c2]['color'] . ';';
                        $color_category = 'color: ' . $categoryArray[$c2]['color'] . ';';
                        //$title_category[] = "{$categoryArray[$c2]['title']}";
                        // <button type="button" elm="29" data-filter=".category-29" class="btn_category_controll border_radius3 mb-2 btn_category_controll_active mixitup-control-active">Другое</button>
                        $title_category[] = "<span class=\"class_category2 btn_category_controll_cart \" elm=\"{$categoryArray[$c2]['id']}\" style=\"{$color_category}\">{$categoryArray[$c2]['title']}</span>";
                        $title_category_bg .= "<span class=\"class_category_lbl opacity50\" style=\"{$bg_category}{$position}\">{$categoryArray[$c2]['title']}</span>";
                    }
                }
            }
            $title_category_str = implode(', ', $title_category) . "<span class=\"class_category2\" style=\"{$color_category}\">:</span>";
        }
        $_SESSION['url_href'] = "/ {$productData['title']}";

        $page->bread_add('', $productData['title']);
        //echo 'bread_get: ' . $page->bread_get() . "<br/>\n";
        //echo 'url_href: ' .$_SESSION['url_href']; 
    }
}

//foreach ($productsFilterArray as $value) {
//print_r($value);
//break;
//}

include 'tmpl/index.php';

if (isset($_GET['cart_clear'])) {
    $_SESSION['cart']['itms'] = array();
}