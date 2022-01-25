<?php

/*
 * Работает на сайте
 */
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';

include_once 'inc.php';



if(!empty($_POST) && isset($_POST['payment']))
{
	include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/webhook/inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/pay/inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
	// $p_pay = json_decode($_POST['payment']);
	$p_products = new \project\products();
	$prod_wares = new \project\wares();//список кейсов
	$p_user = new \project\user();
	$auth = new \project\auth();
	$sqlLight = new \project\sqlLight();
	$webhook = new \project\webhook();
	$p_pay = new \project\pay();
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
	$prod_ids = [];//массив идентификаторов продуктов
	if(!empty($_POST['payment']['products'])) //проверяем, передано ли название товара
	{
		if(is_array($_POST['payment']['products']))
		{
			foreach ($_POST['payment']['products'] as $prod) //для каждого названия
			{
				$pay_descr .= $prod["name"]; //записываем название в таблицу
			}
		}
		else
		{
			$pay_descr = $_POST['payment']['products'];
		}
	}
	if(!empty($_POST['payment']["amount"]))
	{
		$pay_sum = $_POST['payment']["amount"];
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
	if(isset($_POST['product_id']))//если передан ид продукта
	{
		$prod_ids[] = $_POST['product_id'];//получаем продукт в базе
		// if(!empty($product['id']))
		// {
			// file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", json_encode($product));
		// }
	}
	elseif (isset($_POST['wares_id']))//
	{
		$prod_arrays = $prod_wares->getProductsByWaresId($_POST['wares_id']);//получаю продукты кейса
		foreach ($prod_arrays as $prod)
		{
			$prod_ids[] = $prod['product_id'];
		}
		file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", json_encode($prod_ids));
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
	if(!empty($prod_ids) && !empty($user) && !empty($pay_type) && !empty($pay_sum) && !empty($pay_descr))
	{
		// $p_payment = $webhook->create_payment($max_id, $pay_type, $user['id'], $pay_sum, $pay_date, $pay_key, $pay_status, $pay_descr ,$confirm_url);//добавляем оплату в базу
		$some = $p_products->getProductsByIds($prod_ids);
		// foreach ($prod_ids as $prod_id)
		// {
			// $p_products->getProductId($prod_id);

		// }
		// $res = $p_pay->insert_pay_products($max_id, $product['id'], $pay_sum);
		// $data = array('id' => $max_id, 'pay_type' => $pay_type, 'user_id' => $user['id'], 'pay_sum' => $pay_sum, 'pay_date' => $pay_date, 'pay_key' => $pay_key, 'pay_status' => $pay_status, 'pay_descr' => $pay_descr,'confirm_url' => $confirm_url);
		$result = json_encode($some);
		file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", $result);
		// file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", json_encode($p_payment));
	}

}
else
{
	goBack('/',0);
}




//echo $_SESSION['site_menu']['top'];