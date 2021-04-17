<?php

/*
 * Tinkoff 
 * Проверим статусы платежей и зафиксируем успешность проведения платежа
 * Повесить данный процесс на CRON
 * 
 */
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/close_club/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/inc.php';

$pr_cart = new \project\cart();
$sqlLight = new \project\sqlLight();
$config = new \project\config();
$u = new \project\user();
$products = new \project\products();
$sign_up_consultation = new \project\sign_up_consultation();
$close_club = new \project\close_club();

// Ссылка на переадресацию ответа 
$url_ref = $config->getConfigParam('pay_site_url_ref');
$tk_shop_terminal_key = $config->getConfigParam('tk_shop_terminal_key');
$tk_shop_secret_key = $config->getConfigParam('tk_shop_secret_key');


spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

//spl_autoload('TinkoffMerchantAPI');
$api = new TinkoffMerchantAPI(
        $tk_shop_terminal_key, //Ваш Terminal_Key
        $tk_shop_secret_key    //Ваш Secret_Key
);

// Проверяем статус оплаты
//echo "PAY_KEY: {$_SESSION['PAY_KEY']}<br/>\n";
//echo "get: ";
//print_r($_GET);
//echo "<br/>\n";
//echo "POST: ";
//print_r($_POST);
if (isset($_SESSION['PAY_KEY']) && isset($_GET['Success'])) {
    $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='tk' and `pay_date`>=CURRENT_DATE-1 and `pay_key`='?'";
    $pays = $sqlLight->queryList($query, array($_SESSION['PAY_KEY']), 0);
    if (count($pays) > 0) {
        foreach ($pays as $value) {
            $paymentId = $value['pay_key']; // Получаем ключ платежа
            $pay_id = $value['id'];

            $params = [
                'PaymentId' => $value['pay_key'],
            ];

            $api->getState($params);

            if ($api->status == 'CONFIRMED') {
                $pay_check = 'succeeded';
            } else {
                $pay_check = 'pending';
            }
//            if ($_GET['Success'] == 'true') {
//                $pay_check = 'succeeded';
//            }
            // Обновляем статус платежа
            $query_update = "UPDATE zay_pay "
                    . "SET pay_status='?' "
                    . "WHERE `pay_type`='tk' and id='?'";
            $sqlLight->query($query_update, array($pay_check, $value['id']));
            if ($pay_check == 'succeeded') {

                // Зарегистрируем покупку
                $pr_cart->register_pay($pay_id);

                // Зафиксируем продажу
                $products->setSoldAdd($value['id']);
                $result = array('success' => 1, 'success_text' => 'Платеж успешно проведен');
            } else {
                $result = array('success' => 0, 'success_text' => 'Не проведен! Проверьте чуть позже еще раз');
            }
        }
    }
    header('Location: ' . '/shop/cart/?in_payment_true=1');
    exit();
} else {
    $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='tk' and `pay_status`!='succeeded' and `pay_date`>=CURRENT_DATE-1";
    $pays = $sqlLight->queryList($query);
    if (count($pays) > 0) {
        foreach ($pays as $value) {
            $params = [
                'PaymentId' => $value['pay_key'],
            ];

            $api->getState($params);

            if ($api->status == 'CONFIRMED') {
                $pay_check = 'succeeded';
            } else {
                $pay_check = 'pending';
            }

            // Обновляем статус платежа
            $query_update = "UPDATE zay_pay "
                    . "SET pay_status='?' "
                    . "WHERE `pay_type`='tk' and id='?'";
            $sqlLight->query($query_update, array($pay_check, $value['id']));
            if ($pay_check == 'succeeded') {

                // Зарегистрируем покупку
                $pr_cart->register_pay($pay_id);

                // Зафиксируем продажу
                $products->setSoldAdd($value['id']);
                $result = array('success' => 1, 'success_text' => 'Платеж успешно проведен');
            } else {
                $result = array('success' => 0, 'success_text' => 'Не проведен! Проверьте чуть позже еще раз');
            }
//                if ($api->error){ 
//                echo '<p><span class="error">' .$api->error. '</span></p>';
//                }
            /*
             * <p><span class="highlight">Response</span>: <?= $api->response ?></p>
              <p><span class="highlight">Status</span>: <?= $api->status ?></p>
              <p><span class="highlight">PaymentId</span>: <?= $api->paymentId ?></p>
              <p><span class="highlight">OrderId</span>: <?= $api->orderId ?></p>
             */

            $paymentId = $value['pay_key']; // Получаем ключ платежа
            if ($_GET['Success'] == 'true') {
                $pay_check = 'succeeded';
            }
        }
    }
    header('Location: ' . '/shop/cart/?in_payment_true=2');
    exit();
}
/*
 * https://edgardzaycev.com/check_pay.php?check_pay=tk&
 * Success=true
 * &ErrorCode=0
 * &Message=None
 * &Details=
 * &Amount=100
 * &MerchantEmail=hello%40edgardzaitsev.com&MerchantName=Edgard+Zaycev
 * &OrderId=279162
 * &PaymentId=484747211
 * &TranDate=
 * &BackUrl=http%3A%2F%2Fedgardzaycev.com&CompanyName=ИП+ЗАЙЦЕВ+ЭДГАРД+АЛЕКСАНДРОВИЧ
 * &EmailReq=hello%40edgardzaitsev.com
 * &PhonesReq=9098405559
 */
//print_r($pays);
//echo "\n";
// Получаем список платежей циклом


//if (isset($_GET['check_pay']) && isset($_SESSION['PAY_KEY']) && strlen($_SESSION['PAY_KEY']) > 0 && $u->isClientId() > 0 && isset($_GET['Success']) && $_GET['Success'] == 'true') {
//    // Проверяем статус оплаты
//    $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='tk' and `pay_status`='succeeded' and `user_id`='?' and pay_key='?' ";
//    $pay_succeede = $sqlLight->queryList($query, array($u->isClientId(), $_SESSION['PAY_KEY']), 1);
//    $total = $pay_succeede[0]['pay_sum'];
//    $pay_id = $pay_succeede[0]['id'];
//
//    if (count($pay_succeede) > 0) {
//        // Зарегистрируем покупку
//        $pr_cart->register_pay($pay_id);
//        
//        $result = array('success' => 1, 'success_text' => 'Платеж успешно проведен');
//    } else {
//        $result = array('success' => 0, 'success_text' => 'Платеж не проведен! Проверьте чуть позже еще раз!');
//    }
//    $_SESSION['cart']['cart_itms'] = $_SESSION['cart']['itms'];
//    $_SESSION['cart']['total'] = $total;
//    $_SESSION['cart']['pay_id'] = $pay_id;
//    $_SESSION['cart']['itms'] = array();
//    $_SESSION['PAY_KEY'] = '';
//    unset($_SESSION['PAY_KEY']);
//    echo json_encode($result);
//    //goBack('/shop/cart/?in_payment_true=1', '0');
//    header('Location: ' . '/shop/cart/?in_payment_true=1');
//    exit();
//}
header('Location: ' . '/');
