<?php
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$user = new \project\user();
$c_product = new \project\products();

$productsFilterArray = $c_product->getProductsIndex('');
$productsFilterCount = count($productsFilterArray);


if ($user->isEditor()) {
    // для администрирования
    
    if (!isset($_SESSION['product']['searchStr'])) {
        $_SESSION['product']['searchStr'] = '';
    }
    
    $get_page = '';
    if (isset($_GET['index_promo'])) {
        $get_page = 'index_promo';
    }
    switch ($get_page) {
        case 'index_promo':
            $page_url = 'tmpl/admin_index_promo.php';
            break;
        default:
            $page_url = 'tmpl/admin.php';
            break;
    }
    include $page_url;
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}