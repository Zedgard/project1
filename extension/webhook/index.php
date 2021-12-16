<?php

/*
 * Работает на сайте
 */
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';

include_once 'inc.php';

$p_products = new \project\products();
$p_user = new \project\user();
$auth = new \project\auth();


if(!empty($_POST))
{
	if(isset($_POST['product_id']))
	{
		$product = $p_products->getProductSelect($_POST['product_id']);
		if(!empty($product['id']))
			file_put_contents($_SERVER['SERVER_NAME']."/webhook.txt", json_encode($product));
	}
}
else
{
	goBack('/',0);
}




//echo $_SESSION['site_menu']['top'];