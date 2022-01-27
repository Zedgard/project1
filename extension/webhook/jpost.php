<?php

session_start();
defined('__CMS__') or die;

include_once 'inc.php';

$webhook = new \project\webhook();
// $items = new \project\menu_item();

//получаю данные пользователя
if (isset($_POST['user_payments']))
{
	$productsAr = [];//массив для хранения данных по покупкам продуктов
	$productsPayAr = [];//количество продаж товаров
	$productsCount = 0;//количество проданных товаров
	$productsPayCount = 0;//количество продаж
	$productsPaySum = 0;//сумма продаж

	$consultAr = [];//массив для хранения данных по покупкам консультаций
	$consultCount = 0;//количество консультаций
	$consultSum = null;//сумма продаж консультаций
    // if(isset($_POST['user_id']) && $_POST['user_id'] > 0)
    // {
	//из файла
        $usersFile = fopen($_SERVER['DOCUMENT_ROOT']."/upload/zay_users.csv", "r");
        // $idxFile = fopen($_SERVER['DOCUMENT_ROOT']."/upload/idx.txt", "w");
    //индекс считываемого символа в файле пользователей
        $idx = file_get_contents($_SERVER['DOCUMENT_ROOT']."/upload/idx.txt");
        // if(empty($idx))
        // {
        //     $idx = 0;
        // }
        fseek($usersFile, $idx);//перемещаю указатель на нужный символ в файле пользователей
        $usersStr = "";
        while(false !== ($char = fgetc($usersFile)))//пока считываются символы
        {
            if($char == "\n" || $char == "\r")//если символ равен окончанию или переносу строки
            {
                break;//выход из цикла
            }
            else
            {
                $usersStr .= $char;//записываем символ в строку хранения
            }
        }
        $usersAr = explode(";", $usersStr);//разбиваем строку для получения данных конкретного пользователя
        $user_id = $usersAr[0];//идентификатор пользователя
        if($user_id != "id")//если не первая строка со списком полей,то
        {
        	$productsData = $webhook->user_product_payments(15);//получаем данные по продажам продуктов пользователя
        	foreach ($productsData as $index => $dataRow)
        	{
        		if (!array_key_exists($dataRow['product_id'],$productsAr))
        		{
        			$productsAr[$dataRow['product_id']] = $dataRow['product_title'];
        			$productsCount++;
        		}
        		if(!array_key_exists($dataRow['payment_id'], $productsPayAr))
        		{
        			$productsPayAr[$dataRow['payment_id']] = floatval($dataRow['payment_sum']);
        			$productsPayCount++;
        			$productsPaySum += floatval($dataRow['payment_sum']);
        		}
        	}
        	if(!empty($productsData[0]))//если данные имеются
        	{
        		$consultData = $webhook->user_consultations($productsData[0]['phone'],$productsData[0]['email']);//получить данные по консультациям пользователя
        		foreach ($consultData as $index => $dataRow)
	        	{
	        		if(!array_key_exists($dataRow['id'],$consultAr))
	        		{
	        			$consultAr[$dataRow['id']] = floatval($dataRow['pay_sum']);
	        			$consultCount++;
	        			$consultSum += floatval($dataRow['pay_sum']);
	        		}
	        	}
        	}
            $regTimeStamp = strtotime($usersAr[12]);//
            $regDate = date("m/d/Y",$regTimeStamp);//
            $lastTimeStamp = strtotime($usersAr[9]);//
            $lastDate = date("m/d/Y", $lastTimeStamp);//
        	$userVars = ['Phone' => $usersAr[2],'first_name' => $usersAr[3], 'last_name' => $usersAr[4], 'products_list' => implode("|", $productsAr), 'products_count' => $productsCount,'products_pays_count' => $productsPayCount, 'products_pay_sum' => array_sum($productsPayAr), 'consult_count' => $consultCount, 'consult_sum' => $consultSum, 'register_date' => $regDate, 'last_date' => $lastDate];
        	$userData = ["email" => $usersAr[1], 'variables' => $userVars];
        	$data['emails'] = [$userData];
        }

        $idx = ftell($usersFile)+1;//записываю новую позицию указателя
        // file_put_contents($_SERVER['DOCUMENT_ROOT']."/upload/idx.txt", $idx);//записываю индекс укзаателя в файл
        // $data = $productsPayAr;
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);//возвращаю данные
    // }
}

if (isset($_POST['product_id'])) {
    $data = $webhook->get_accounts_all();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

/*
 * Информация по одному меню
 */
if (isset($_POST['get_menu'])) {
    $menu_id = (isset($_POST['menu_id']) && $_POST['menu_id'] > 0) ? $_POST['menu_id'] : 0;
    $data = $menu->get_menu($menu_id);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}