<?php

/*
 * Tinkoff оплата
 * 
 *  */
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/inc.php';

$sqlLight = new \project\sqlLight();
$config = new \project\config();
$products = new \project\products();
$sign_up_consultation = new \project\sign_up_consultation();
$pr_cart = new \project\cart();

// Ссылка на переадресацию ответа 
$url_ref = $config->getConfigParam('pay_site_url_ref');
$tk_shop_terminal_key = $config->getConfigParam('tk_shop_terminal_key');
$tk_shop_secret_key = $config->getConfigParam('tk_shop_secret_key');

/*
 *  Для тестирования
  тестовый платеж номер 1 (оплачено)
  4300 0000 0000 0777       1122     111

  тестовый платеж номер 2 (не удалось оплатить, на карте недостаточно средств)
  5000 0000 0000 0009       1122      111

  тестовый платеж номер 3 (отмена платежа в лк у Тинькоф)
  4000 0000 0000 0119      1122        111
 */

//$email = 'koman1706@gmail.com';
$emailCompany = 'edzaytsev.psy@gmail.com';
$phone = '89141820605';
// Тестовые данные
$emailCompany = 'testCompany@test.com';
$phone = '89179990000';

/*
 * Общие настройки 
 */
$taxations = [
    'osn' => 'osn', // Общая СН
    'usn_income' => 'usn_income', // Упрощенная СН (доходы)
    'usn_income_outcome' => 'usn_income_outcome', // Упрощенная СН (доходы минус расходы)
    'envd' => 'envd', // Единый налог на вмененный доход
    'esn' => 'esn', // Единый сельскохозяйственный налог
    'patent' => 'patent'              // Патентная СН
];

$paymentMethod = [
    'full_prepayment' => 'full_prepayment', //Предоплата 100%
    'prepayment' => 'prepayment', //Предоплата
    'advance' => 'advance', //Аванc
    'full_payment' => 'full_payment', //Полный расчет
    'partial_payment' => 'partial_payment', //Частичный расчет и кредит
    'credit' => 'credit', //Передача в кредит
    'credit_payment' => 'credit_payment', //Оплата кредита
];

$paymentObject = [
    'commodity' => 'commodity', //Товар
    'excise' => 'excise', //Подакцизный товар
    'job' => 'job', //Работа
    'service' => 'service', //Услуга
    'gambling_bet' => 'gambling_bet', //Ставка азартной игры
    'gambling_prize' => 'gambling_prize', //Выигрыш азартной игры
    'lottery' => 'lottery', //Лотерейный билет
    'lottery_prize' => 'lottery_prize', //Выигрыш лотереи
    'intellectual_activity' => 'intellectual_activity', //Предоставление результатов интеллектуальной деятельности
    'payment' => 'payment', //Платеж
    'agent_commission' => 'agent_commission', //Агентское вознаграждение
    'composite' => 'composite', //Составной предмет расчета
    'another' => 'another', //Иной предмет расчета
];

$vats = [
    'none' => 'none', // Без НДС
    'vat0' => 'vat0', // НДС 0%
    'vat10' => 'vat10', // НДС 10%
    'vat20' => 'vat20' // НДС 20%
];
/*
 * Общие настройки  КОНЕЦ
 */


spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

//spl_autoload('TinkoffMerchantAPI');
$api = new TinkoffMerchantAPI(
        $tk_shop_terminal_key, //Ваш Terminal_Key
        $tk_shop_secret_key    //Ваш Secret_Key
);


$enabledTaxation = true;


/*
  Собираем данные по платежу
 */
$p_user = new \project\user();

$price_total = 0;

foreach ($_SESSION['cart']['itms'] as $key => $value) {
    $email = $value['user_email'];
    if ($value['price_promo'] > 0) {
        $price = $value['price_promo'];
    } else {
        $price = $value['price'];
    }
    $price_total += $price;
}
/**
 * Заглушка для админов покупка за 1 рубль
 */
//if ($p_user->isEditor()) {
//    $price_total = 1;
//}

$amount = $price_total * 100;

$client_id = ($p_user->isClientId() > 0) ? $p_user->isClientId() : 0;

// Если авторезированный
if (strlen($p_user->isClientEmail()) > 0) {
    $email = $p_user->isClientEmail();
}

// Получаем платежный ключ
$pay_key = uniqid('', true);
$_SESSION['PAY_KEY'] = $pay_key;

$max_id = $sqlLight->queryNextId('zay_pay');

//if(strlen($max_id)==0){
//    echo "max_id: {$max_id}";
//    exit();
//}

$params = [
    'OrderId' => $max_id,
    'Amount' => $amount,
    'DATA' => [
        'Email' => $email,
        'Connection_type' => 'example'
    ],
];

$receipt = [
    'EmailCompany' => $emailCompany,
    'Email' => $email,
    'Taxation' => $taxations['osn'],
    'Items' => [[
    "Name" => "Продажа товаров",
    "Price" => $amount,
    "Quantity" => 1.00,
    "Amount" => $amount,
    "Tax" => "none"
        ]],
];

if ($enabledTaxation) {
    $params['Receipt'] = $receipt;
}
//echo "<br/>\n";
//print_r($params);
//echo "<br/>\n"; 
$api->init($params);

//echo "response: " . $api->response . "<br/>\n";
//echo "<br/>\n";

if ($api->error) {
    echo "error: " . $api->error . "<br/>\n";
} else {
    $pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
    $pay_status = "pending"; // Устанавливаем стандартный статус платежа
    $pay_key = $api->paymentId;
    $_SESSION['PAY_KEY'] = $pay_key;
    $pay_descr = (strlen($_SESSION['cart']['itms'][0]['pay_descr']) > 0) ? $_SESSION['cart']['itms'][0]['pay_descr'] : '';

    // Сохраняем данные платежа в базу
    $queryPay = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `payment_type`, `payment_c`, `payment_bank`, `pay_status`, `pay_interkassa_id`, `pay_descr`, `confirmationUrl`) "
            . "VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?')";
    if ($sqlLight->query($queryPay, array(($max_id), 'tk', $client_id, $price_total, $pay_date, $pay_key, 'Tinkoff', '', '', $pay_status, '', $pay_descr, $api->paymentUrl), 1)) {

        foreach ($_SESSION['cart']['itms'] as $key => $value) {
            $product_id = $value['id'];
            if ($product_id > 0) {
                if ($value['price_promo'] > 0) {
                    $price = $value['price_promo'];
                } else {
                    $price = $value['price'];
                }
                $queryProductRegister = "INSERT INTO `zay_pay_products`(`pay_id`, `product_id`, `product_price`) "
                        . "VALUES ('?','?','?')";
                $sqlLight->query($queryProductRegister, array($max_id, $product_id, $price));
            }
        }
        /*
         * Если это консультация 
         */
//        if ($_SESSION['consultation']['your_master_id'] > 0) {
//            $_SESSION['consultation']['pay_id'] = $max_id;
//            $sign_up_consultation->add_consultation($_SESSION['consultation']);
//        }
        // Отправляем пользователя на страницу оплаты
        header('Location: ' . $api->paymentUrl);
    } else {
        echo 'Ошибка операции!';
    }

    echo "paymentUrl: " . $api->paymentUrl . "<br/>\n";
    echo "paymentId: " . $api->paymentId . "<br/>\n";
}