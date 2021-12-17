<?php

/*
 * Работает на сайте
 */
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

include_once 'inc.php';



if(!empty($_POST) && isset($_POST['payment']))
{
	include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
	$p_payment = json_decode($_POST['payment']);
	$p_products = new \project\products();
	$p_user = new \project\user();
	$auth = new \project\auth();
	$sqlLight = new \project\sqlLight();
	$webhook = new \project\webhook();
	$sqlLight = new \project\sqlLight();
	$product = null;//приобретаемый товар
	$user = null;//пользователь
	$pay_date = date("Y-m-d H:i:s");//текущая дата
	$queryMaxId = "select MAX(p.id) max_id from `zay_pay` p";//идентификатор последней записи в таблице платежей
	$max_id = $sqlLight->queryList($queryMaxId, array())[0]['max_id'] + 1;//новый идентификатор для записи в базу
	$pay_key = uniqid('', true); // Генерируем ключ
	$pay_type = null;//платежная система
	$pay_sum = null;//сумма платежа
	$pay_status = "succeeded";//статус платежа
	$pay_descr = null;//описание платежа
	$confirm_url = $_SERVER['HTTP_REFERER'];//адрес, откуда пришли данные
	if(isset($p_payment['products']))//проверяем, передано ли название товара
	{
		foreach ($p_payment['products'] as $prod_name)//для каждого названия
		{
			$pay_descr .= $prod_name;//записываем название в таблицу
		}
	}
	if(isset($p_payment['amount']))
	{
		$pay_sum = $p_payment['amount'];
	}
	if(isset($_POST['paymentsystem']))
	{
		switch($_POST['paymentsystem'])
		{
			case 'cloudpayments': 
			{
				$pay_type = 'cp';
				$payment_type = 'CloudPayments';
				break;
			}
			case 'tinkoff': 
			{
				$pay_type = 'tk';
				$payment_type = 'Tinkoff';
				break;
			}
			case 'paypal': 
			{
				$pay_type = 'pp';
				$payment_type = 'PayPal';
				break;
			}
			// default:
		}
	}
	if(isset($_POST['product_id']))
	{
		$product = $p_products->getProductId($_POST['product_id']);
		// if(!empty($product['id']))
		// {
			// file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", json_encode($product));
		// }
	}
	// if(isset($_POST['email']))
	// {
	// 	$user = $p_user->user_info($_POST['email']);
	// }
	if(isset($_POST['phone']) && isset($_POST['email']))
	{
		$user = $p_user->user_info_by_phone_or_email($_POST['phone'],$_POST['email']);
		// file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", json_encode($user));
	}
	// if(!empty($product) && !empty($user) && !empty($pay_type) && !empty($pay_sum) && !empty($pay_descr))
	// {
		// $result = $webhook->create_payment($max_id, $pay_type, $user['id'], $pay_sum, $pay_date, $pay_key, $pay_status, $pay_descr ,$confirmUrl);
		$data = ['id' => $max_id, 'pay_type' => $pay_type, 'user_id' => $user['id'], 'pay_sum' => $pay_sum, 'pay_date' => $pay_date, 'pay_key' => $pay_key, 'pay_status' => $pay_status, 'pay_descr' => $pay_descr,'confirm_url' => $confirm_url];
		file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", json_encode($data));
		// file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", json_encode($p_payment));
	// }


}
else
{
	goBack('/',0);
}




//echo $_SESSION['site_menu']['top'];