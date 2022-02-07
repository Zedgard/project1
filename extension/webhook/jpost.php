<?php

// session_start();
defined('__CMS__') or die;

require $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";//подключаем sendpulse
include_once 'inc.php';

use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;
// API credentials from https://login.sendpulse.com/settings/#api
define('API_USER_ID', '1e2246d5cf334cf3490810cc11ecc80a');
define('API_SECRET', 'd2f5d50a9981d9d399abecc1c5d812f7');
// define('PATH_TO_ATTACH_FILE', __FILE__);

$SPApiClient = new ApiClient(API_USER_ID, API_SECRET, new FileStorage());//api клиент sendpulse
$bookID = 89384270;

$webhook = new \project\webhook();
$data = [];
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
	$consultSum = 0;//сумма продаж консультаций
    // if(isset($_POST['user_id']) && $_POST['user_id'] > 0)
    // {
	//из файла
        $usersFile = fopen($_SERVER['DOCUMENT_ROOT']."/upload/zay_users.csv", "r");
        // $idxFile = fopen($_SERVER['DOCUMENT_ROOT']."/upload/idx.txt", "w");
    //индекс считываемого символа в файле пользователей
        $str = file_get_contents($_SERVER['DOCUMENT_ROOT']."/upload/idx.txt");
        $idxAr = explode(",", $str);
        // if(empty($idx))
        // {
        //     $idx = 0;
        // }
        $idx = $idxAr[0];//индекс считываемого символа из файла
        $count = $idxAr[1];//количество обработанных записей
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
        if($user_id != "id" && !empty($user_id))//если не первая строка со списком полей,то и не конец файла, то
        {
        	$productsData = $webhook->user_product_payments($user_id);//получаем данные по продажам продуктов пользователя
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
        	$consultData = $webhook->user_consultations($usersAr[2],$usersAr[1]);//получить данные по консультациям пользователя
        	foreach ($consultData as $index => $dataRow)
	        {
	        	if(!array_key_exists($dataRow['id'],$consultAr))
	        	{
	        		$consultAr[$dataRow['id']] = floatval($dataRow['pay_sum']);
	        		$consultCount++;
	        		$consultSum += floatval($dataRow['pay_sum']);
	        	}
	        }
            $regTimeStamp = strtotime($usersAr[12]);//
            $regDate = date("m/d/Y",$regTimeStamp);//
            $lastTimeStamp = strtotime($usersAr[9]);//
            $lastDate = date("m/d/Y", $lastTimeStamp);//
            $prodStr = "";
            foreach ($productsAr as $prod_id => $prod_name)
            {
                $prodStr .= $prod_id.":".$prod_name."|";
            }
            $prodStr = substr($prodStr, 0, -1);
        	$userVars = ['Phone' => $usersAr[2],'first_name' => $usersAr[3], 'last_name' => $usersAr[4], 'products_list' => $prodStr, 'products_count' => $productsCount,'products_pays_count' => $productsPayCount, 'products_pay_sum' => array_sum($productsPayAr), 'consult_count' => $consultCount, 'consult_sum' => $consultSum, 'register_date' => $regDate, 'last_date' => $lastDate];
        	$userData = ["email" => $usersAr[1], 'variables' => $userVars];
        	$data['emails'] = [$userData];
        }
        $idx = ftell($usersFile)+1;//записываю новую позицию указателя
        // $data = $productsPayAr;
        if (!empty($data))
        {
            $tmpResult = $SPApiClient->addEmails($bookID, $data['emails']);
            $data['result'] = $tmpResult;
            $data['count'] = $count+1;
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/upload/idx.txt", $idx.",".$data['count']);//записываю индекс указателя в файл
        }
        else
        {
            $data = "end";
        }
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);//возвращаю данные
    // }
}
if (isset($_POST['user_payments_today']))
{
    $usersProds = [];
    $usersConsults = [];
    // $data = "lolkek";
    $lastDay = new DateTime('now -1 day');
    $lastDayFormat = $lastDay->format('Y-m-d');
    $lastDayStart = $lastDayFormat." 00:00:00";
    $lastDayEnd = $lastDayFormat." 23:59:59";
    $productsData = $webhook->user_product_payments_by_now_date($lastDayStart, $lastDayEnd);
    // $data = [$lastDayStart,$lastDayEnd];
    foreach ($productsData as $index => $row)
    {
        if(!array_key_exists($row['email'], $usersProds))
            $usersProds[$row['email']] = ['id' => $row['id'], 'phone' => $row['phone'], 'first_name' => $row['first_name'], 'last_name' => $row['last_name'], 'last' => $row['active_lastdate'], 'register' => $row['date_registered']];
    }
    $consultData = $webhook->user_consultations_by_now_date($lastDayStart, $lastDayEnd);
    foreach ($consultData as $index => $row)
    {
        if(!array_key_exists($row['user_email'], $usersConsults))
            $usersConsults[$row['user_email']] = ['phone' => $row['user_phone'],'first_name' => $row['first_name'], 'last_name' => $row['last_name'], 'last' => $row['active_lastdate'], 'register' => $row['date_registered']];
    }
    $p = [];//массив данных продаж по продуктам
    $c = [];//массив данных продаж по консультациям
    $userData = [];//массив для записи полученных данных пользователя
    
    foreach ($usersProds as $email => $dataUser)
    {
//    	$data[] = $dataUser['id'];

        $p[$email] = getDataUserProds($dataUser['id'],$webhook);
        
    }
    // $data = [$p];
    foreach ($usersConsults as $email => $dataUser)
    {
        $c[$email] = getDataUserConsults($dataUser['phone'],$email,$webhook);
    }
    $resAr = array_unique(array_merge(array_keys($p),array_keys($c)));//массив пользователей для отправки запросов
    foreach ($resAr as $email)
    {
        $userVars = [];
        if(array_key_exists($email, $usersProds))
        {
            $userVars['Phone'] = $usersProds[$email]['phone'];
            $userVars['first_name'] = $usersProds[$email]['first_name'];
            $userVars['last_name'] = $usersProds[$email]['last_name'];

            $regTimeStamp = strtotime($usersProds[$email]['register']);//
            $regDate = date("m/d/Y",$regTimeStamp);//
            $userVars['register_date'] = $regDate;

            $lastTimeStamp = strtotime($usersProds[$email]['last']);//
            $lastDate = date("m/d/Y", $lastTimeStamp);//
            $userVars['last_date'] = $lastDate;
        }
        elseif(array_key_exists($email, $usersConsults))
        {
            $userVars['Phone'] = $usersConsults[$email]['phone'];
            $userVars['first_name'] = $usersConsults[$email]['first_name'];
            $userVars['last_name'] = $usersConsults[$email]['last_name'];

            $regTimeStamp = strtotime($usersConsults[$email]['register']);//
            $regDate = date("m/d/Y",$regTimeStamp);//
            $userVars['register_date'] = $regDate;

            $lastTimeStamp = strtotime($usersConsults[$email]['last']);//
            $lastDate = date("m/d/Y", $lastTimeStamp);//
            $userVars['last_date'] = $lastDate;
        }
        if(array_key_exists($email, $p))
        {
            $userVars['products_list'] = $p['list'];
            $userVars['products_count'] = $p['count'];
            $userVars['products_pays_count'] = $p['pays_count'];
            $userVars['products_pay_sum'] = $p['pays_sum'];
        }
        if(array_key_exists($email, $c))
        {
            $userVars['consult_count'] = $c['count'];
            $userVars['consult_sum'] = $c['sum'];
        }
        $userData[] = ["email" => $email, 'variables' => $userVars];
    }
    if(!empty($userData))
    {
        $data['emails'] = $userData;
        $tmpResult = $SPApiClient->addEmails($bookID, $data['emails']);
        $data['result'] = $tmpResult;
    }
    else
    {
        $data['result'] = "end";
    }
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);//возвращаю данные
    // $regTimeStamp = strtotime($usersAr[12]);//
    // $regDate = date("m/d/Y",$regTimeStamp);//
    // $lastTimeStamp = strtotime($usersAr[9]);//
    // $lastDate = date("m/d/Y", $lastTimeStamp);//

}
function getDataUserProds($userId = "", $webhook)
{
    $productsAr = [];//массив для хранения данных по покупкам продуктов
    $productsPayAr = [];//количество продаж товаров
    $productsCount = 0;//количество проданных товаров
    $productsPayCount = 0;//количество продаж
    $productsPaySum = 0;//сумма продаж
    $prodStr = "";
    if(!empty($userId))
    {
        $prodsData = $webhook->user_product_payments($userId);//получаем данные по продажам продуктов пользователя
       foreach ($prodsData as $index => $dataRow)
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
        // return $userId;
       foreach ($productsAr as $prod_id => $prod_name)
       {
           $prodStr .= $prod_id.":".$prod_name."|";
       }
       $prodStr = substr($prodStr, 0, -1);
    }
//    return [$userId];
    return ['list' => $prodStr, 'count' => $productsCount, 'pays_count' => $productsPayCount, 'pays_sum' => $productsPaySum];
}
function getDataUserConsults($phone = "",$email = "",$webhook)
{
    $consultAr = [];//массив для хранения данных по покупкам консультаций
    $consultCount = 0;//количество консультаций
    $consultSum = 0;//сумма продаж консультаций
    if (!empty($email))
    {
        $consultData = $webhook->user_consultations($phone,$email);//получить данные по консультациям пользователя
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
    return ['count' => $consultCount,'sum' => $consultSum];
}
