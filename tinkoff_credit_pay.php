<?php
/*
 * Покупка по кредиту через Тинькоф
 * https://forma.tinkoff.ru/online/demo-7022acef-91a8-469a-8a4e-430097178081
 */

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

// рабочий адрес к Тинькоф
$credit_url = 'https://forma.tinkoff.ru/api/partners/v2/orders/create'; // https://forma.tinkoff.ru/api/partners/v2/orders/create-demo
//
// Тип банка
$pay_type = 'tk';

// Полный адрес сайта
$site_url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['SERVER_NAME'];

/*
 * Сдеть происходит обработка ответов от банка
 */
if (isset($_GET['response'])) {
    $add_url = '';
    // Тинькоф
    if ($_GET['type'] == 'tk') {
        ob_start();
        print_r($_GET);
        $get_str = ob_get_clean();

        if (isset($_GET['response'])) {
            switch ($_GET['response']) {
                case 'HOOK':
                    //mail('koman1706@gmail.com', 'Оплата тинькоф HOOK', "GET: {$get_str}\n");
                    break;
                case 'SUCCESS': // Если дали добро на кредит отметим покупку
                    $pay_status = 'succeeded';

                    if (isset($_GET['point']) && isset($_GET['orderId']) && $_GET['point'] > 0) {
                        $queryPay = "SELECT * FROM zay_pay WHERE pay_type='?' AND id='?' AND pay_key='?' "; // AND pay_status='pending'
                        $pay_data = $sqlLight->queryList($queryPay, array($pay_type, $_GET['point'], $_GET['orderId']));
                    }

                    if (count($pay_data) > 0) {
                        $query_update = "UPDATE zay_pay "
                                . "SET pay_status='?' "
                                . "WHERE id='?' AND pay_key='?' ";
                        $sqlLight->query($query_update, array($pay_status, $pay_data[0]['id'], $_GET['orderId']), 0);

                        $query_update_credit = "UPDATE zay_pay_credit "
                                . "SET pay_status='?' "
                                . "WHERE pay_id='?' AND pay_key='?' ";
                        $sqlLight->query($query_update_credit, array($pay_status, $pay_data[0]['id'], $_GET['orderId']), 0);

                        // Зарегистрируем покупку
                        $pr_cart->register_pay($pay_data[0]['id']);

                        // Зафиксируем продажу
                        $query_products = "select * from zay_pay_products WHERE pay_id='?'";
                        $products_data = $sqlLight->queryList($query_products, array($pay_data[0]['id']));
                        foreach ($products_data as $v) {
                            $products->setSoldAdd($v['product_id']);
                        }
                        $add_url = '/cart/?in_payment_true=1';

                        $_SESSION['cart']['cart_itms'] = $_SESSION['cart']['itms'];
                        $_SESSION['cart']['total'] = $total;
                        $_SESSION['cart']['pay_id'] = $pay_id;
                        $_SESSION['cart']['itms'] = array();
                        $_SESSION['PAY_KEY'] = '';
                        $_SESSION['PAY_AMOUNT'] = '';
                        unset($_SESSION['PAY_KEY']);
                        unset($_SESSION['PAY_AMOUNT']);
                        mail('koman1706@gmail.com', 'Оплата тинькоф SUCCESS', 'Оплата тинькф SUCCESS ' . "GET: {$get_str}\n");
                    }
                    break;
                case 'CANCEL':
                    $pay_status = 'canceled';

                    if (isset($_GET['point']) && isset($_GET['orderId']) && $_GET['point'] > 0) {
                        $queryPay = "SELECT * FROM zay_pay WHERE pay_type='?' AND pay_status='pending' AND id='?' AND pay_key='?' ";
                        $pay_data = $sqlLight->queryList($queryPay, array($pay_type, $_GET['point'], $_GET['orderId']));
                    }

                    if (count($pay_data) > 0) {
                        $query_update = "UPDATE zay_pay "
                                . "SET pay_status='?' "
                                . "WHERE id='?' AND pay_key='?' ";
                        $sqlLight->query($query_update, array($pay_status, $pay_data[0]['id'], $_GET['orderId']));

                        $query_update = "UPDATE zay_pay_credit "
                                . "SET pay_status='?' "
                                . "WHERE pay_id='?' AND pay_key='?' ";
                        $sqlLight->query($query_update, array($pay_status, $pay_data[0]['id'], $_GET['orderId']));
                    }
                    $add_url = '/cart/?in_payment_cancel=1';
                    mail('koman1706@gmail.com', 'Оплата тинькоф CANSEL', 'Оплата тинькф CANCEL' . "GET: {$get_str}\n");
                    break;
                default:
                    mail('koman1706@gmail.com', 'Оплата тинькоф defailt', 'Оплата тинькф defailt' . "GET: {$get_str}\n");
                    break;
            }
        }
        header('Location: ' . $site_url . $add_url);
    }
    exit();
}

// Настройки
$TinkoffShopId = $config->getConfigParam('TinkoffShopId');
$TinkoffShowcaseId = $config->getConfigParam('TinkoffShowcaseId');
$TinkoffPromoCode = $config->getConfigParam('TinkoffPromoCode');


$pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
$pay_status = "pending"; // Устанавливаем стандартный статус платежа

/*
  Собираем данные по платежу
 */
$p_user = new \project\user();

$price_total = 0;

$items = [];
$item_counts = 0;
foreach ($_SESSION['cart']['itms'] as $key => $value) {
    $email = $value['user_email'];
    if ($value['price_promo'] > 0) {
        $price = $value['price_promo'];
    } else {
        $price = $value['price'];
    }
    // Если админ
//    if ($p_user->isEditor()) {
//        $price = 1;
//    }
    $items[] = array("name" => $value['title'], "quantity" => 1, "price" => $price);
    $price_total += $price;
    $item_counts++;
}
/**
 * Заглушка для админов покупка за 1 рубль
 */
//if ($p_user->isEditor()) {
//    $price_total = $item_counts;
//}

$pay_key = uniqid('', true);
$client_id = ($p_user->isClientId() > 0) ? $p_user->isClientId() : 0;

// Передадим ID пользователя (Создается при консультации)
if ($client_id == 0) {
    $client_id = $_SESSION['cart']['itms'][0]['user_id'];
}
$pay_descr = (strlen($_SESSION['cart']['itms'][0]['pay_descr']) > 0) ? $_SESSION['cart']['itms'][0]['pay_descr'] : '';
if (strlen($pay_descr) > 0) {
    $_SESSION['consultation'] = $_SESSION['cart']['itms'][0];
}



if ($item_counts == 0) {
    $_SESSION['page_errors'][] = 'Корзина пуста!';
}

// Без оплатная продажа
if ($price_total == 0) {
    header('Location: /pay.php');
    exit();
}

if ($price_total < 3000) {
    $_SESSION['page_errors'][] = 'Кредитование возможно только от 3000 тысяч рублей!';
}

if ($client_id == 0) {
    $_SESSION['page_errors'][] = 'Нужна авторизация!';
}

// есл произошли проблемы 
if (count($_SESSION['page_errors']) > 0) {
    $_SESSION['page_error_title'] = 'Ошибки';
    header('Location: /page_error.php');
    exit();
}

// Определим ID покупки
$queryMaxId = "select MAX(p.id) max_id from `zay_pay` p";
$max_id = $sqlLight->queryList($queryMaxId, array())[0]['max_id'] + 1;

//Отправить запрос на кредит
$array = array(
    "shopId" => "{$TinkoffShopId}",
    "showcaseId" => "{$TinkoffShowcaseId}",
    "sum" => $price_total,
    "promoCode" => "{$TinkoffPromoCode}",
    "items" => $items,
    "orderNumber" => "{$pay_key}",
    "successURL" => "{$site_url}/tinkoff_credit_pay.php?response=SUCCESS&type={$pay_type}&point={$max_id}&orderId={$pay_key}", // /?credit_post.php?constants=SUCCESS",
    "returnURL" => "{$site_url}/tinkoff_credit_pay.php?response=CANCEL&type={$pay_type}&point={$max_id}&orderId={$pay_key}",
    "failURL" => "{$site_url}/tinkoff_credit_pay.php?response=CANCEL&type={$pay_type}&point={$max_id}&orderId={$pay_key}",
    "webhookURL" => "{$site_url}/tinkoff_credit_pay.php?response=HOOK&type={$pay_type}&point={$max_id}&orderId={$pay_key}", // изменение по заявке, когда сможем создавать токен нужно будет по этому запросу проверять статус заявки
    "demoFlow" => "sms"
);

// для тестирования
//$orderId = $pay_key;
//$array_test = array(
//    "shopId" => "db9d1536-707b-4697-aae0-e661be297bb1",
//    "showcaseId" => "ca489979-d661-4070-9f93-fb7b98ca3856",
//    "sum" => 20000,
//    "promoCode" => 'installment_0_0_6_5',
//    "items" => array(
//        array(
//            "name" => "iPhone",
//            "quantity" => 1,
//            "price" => 10000
//        ),
//        array(
//            "name" => "iPhone",
//            "quantity" => 1,
//            "price" => 10000
//        )
//    ),
//    "orderNumber" => "{$orderId}",
//    "successURL" => "{$site_url}/credit_post.php?constants=SUCCESS", // /?credit_post.php?constants=SUCCESS",
//    "returnURL" => "{$site_url}/credit_post.php?constants=CANCEL",
//    "failURL" => "{$site_url}/credit_post.php?constants=CANCEL",
//    "webhookURL" => "{$site_url}/credit_post.php?constants=HUK&orderId={$orderId}",
//    "demoFlow" => "sms"
//);
//print_r($array);
//print_r($array_test);
// Отправить запрос в тинькоф
function send_tinkoff($url, $array) {
    $postdata = json_encode($array);

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//echo "<br/>\n";
$out = send_tinkoff($credit_url, $array);
//echo $out . "<br/>\n";
$j = json_decode($out);
$pay_tinkoff_id = $j->id;
$pay_tinkoff_link = $j->link;
//echo "link; {$j->link} <br/>\n";
//exit();
//
// Добавим данные по кредиту
$query_insert = "INSERT INTO `zay_pay_credit`(`pay_id`, `pay_type`, `pay_key`, `pay_status`, `pay_tinkoff_id`, `pay_tinkoff_link`, `lastdate`) "
        . "VALUES ('?','?','?','?','?','?', NOW())";
if ($sqlLight->query($query_insert, array($max_id, $pay_type, $pay_key, $pay_status, $pay_tinkoff_id, $pay_tinkoff_link))) {

    // Зафиксируем покупку
    $queryPay = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `payment_type`, `payment_c`, `payment_bank`, `pay_status`, `pay_interkassa_id`, `pay_descr`, `confirmationUrl`) "
            . "VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?')";
    if ($sqlLight->query($queryPay, array(($max_id), $pay_type, $client_id, $price_total, $pay_date, $pay_key, '', '', '', $pay_status, '', $pay_descr, $pay_tinkoff_link), 0)) {
        // Создадим связь с продуктами
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

        // Отправляем пользователя на страницу оплаты
        header('Location: ' . $pay_tinkoff_link);
        exit();
    } else {
        echo 'Ошибка операции!';
    }
}

echo "<br/>\n";

echo 'Возникли какие-то проблемы!';
if (count($_SESSION['errors']) > 0) {
    foreach ($_SESSION['errors'] as $value) {
        ?>
        <div class="alert alert-danger" role="alert">
            <?= $value ?>
        </div>
        <?
    }
}
