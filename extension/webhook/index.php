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
	$phone = null;//переменная номер телефона
	$email = null;//переменная почтового адреса
	$name = null;//переменная имени
	if(isset($_POST['phone']) && isset($_POST['email']))//если название полей параметров в нижнем регистре
	{
		$phone = $_POST['phone'];
		$email = $_POST['email'];		
	}
	elseif(isset($_POST['Phone']) && isset($_POST['Email']))//иначе если названия полей параметров в CaseCamel регистре
	{
		$phone = $_POST['Phone'];
		$email = $_POST['Email'];
	}
	if(isset($_POST['name']))
	{
		$name = $_POST['name'];
	}
	elseif(isset($_POST['Name']))
	{
		$name = $_POST['Name'];
	}
	if(!empty($phone) && !empty($email) && !empty($name))
	{
		$user = $p_user->user_info_by_phone_or_email($email,$phone);//проверяем есть ли пользователь уже в базе
		$registered = false;
		if(empty($user))//если пользователя нет в базе
		{
			$registered = $auth->register_fast_with_email_phone_name($email, $phone, $name, 1);//запрашиваем быструю регистрацию и получаем её результат
			if($registered)
			{
				$user = $p_user->user_info_by_phone_or_email($email,$phone);//проверяем есть ли пользователь уже в базе
			}
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", json_encode($_SESSION['errors']));
		}
		// file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", json_encode($user));
	}
	if(!empty($prod_ids) && !empty($user) && !empty($pay_type) && !empty($pay_sum) && !empty($pay_descr))
	{
		$p_payment = $webhook->create_payment($max_id, $pay_type, $user['id'], $pay_sum, $pay_date, $pay_key, $pay_status, $pay_descr ,$confirm_url);//добавляем оплату в базу
		$prodAr = $p_products->getProductsByIds($prod_ids);
		foreach ($prodAr as $prod)
		{
			// $p_products->getProductId($prod_id);
			$p_pay->insert_pay_products($max_id, $prod['id'], $prod['price']);
		}
		// $res = $p_pay->insert_pay_products($max_id, $product['id'], $pay_sum);
		// $data = array('id' => $max_id, 'pay_type' => $pay_type, 'user_id' => $user['id'], 'pay_sum' => $pay_sum, 'pay_date' => $pay_date, 'pay_key' => $pay_key, 'pay_status' => $pay_status, 'pay_descr' => $pay_descr,'confirm_url' => $confirm_url);
		$result = json_encode($prodAr);
		file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", $result);
		// file_put_contents($_SERVER['DOCUMENT_ROOT']."/webhook.txt", json_encode($p_payment));
	}

}
elseif(isset($_GET['sendpulse']) && $_GET['sendpulse'] == "yes")
{

}
else
{
	goBack('/',0);
}




//echo $_SESSION['site_menu']['top'];