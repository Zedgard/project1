<?php
/*
 * Оплата через PayPal
 */
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/inc.php';

require $_SERVER['DOCUMENT_ROOT'] . '/system/paypal-sdk/autoload.php';

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

$sqlLight = new \project\sqlLight();
$config = new \project\config();
$pr_cart = new \project\cart();
$p_user = new \project\user();

// Данные платежной системы
// $clientId = $config->getConfigParam('paypal_client_id');
// $clientSecret = $config->getConfigParam('paypal_client_secret');
$clientId = $config->getConfigParamByCategory('paypal_client_id',7);//kaijean
$clientSecret = $config->getConfigParamByCategory('paypal_client_secret',7);//kaijean

// Подключаемся к системе
if ($clientId == 'AWhQommTsM02uROFM78sl252sngt6qgOLDOJ9VkuyG1F61ZJ8rjUUuQjE-IJvgfhQtV1hXMLeoKbvwfe') {
    $environment = new ProductionEnvironment($clientId, $clientSecret);
} else {
    $environment = new SandboxEnvironment($clientId, $clientSecret); // Для тестирования
}
$client = new PayPalHttpClient($environment);

// Сопутствующие данные
$site_url = $config->getConfigParam('pay_site_url_ref');
$site_url_thanks = '/?page_type=pay_thanks';
$url_ref = $site_url . $site_url_thanks;
$paypal_email = $config->getConfigParam('paypal_email');

$pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
$pay_status = "pending"; // Устанавливаем стандартный статус платежа

$price_total = 0;
$item_name = '';

$data = array();
$promo_array = array();
if (isset($_SESSION['cart']['itms']) && count($_SESSION['cart']['itms']) > 0) {
    foreach ($_SESSION['cart']['itms'] as $key => $value) {
        $alliance = 1;
        if (count($_SESSION['promos']) > 0) {
            foreach ($_SESSION['promos'] as $v) {
                if (strlen($v['code']) > 0) {
                    if ($v['alliance'] == 0) {
                        $alliance = 0;
                    }
                }
            }
        }
        if (count($_SESSION['promos']) > 0) {
            foreach ($_SESSION['promos'] as $v) {
                if (strlen($v['code']) > 0) {
                    $price = (int) $value['price'];
                    if (strlen($v['product_ids']) > 0) {
                        $ex = explode(',', $v['product_ids']);
                        foreach ($ex as $product_id) {
                            if ($value['id'] == $product_id) {
                                if ($v['amount'] > 0) {
                                    if ($value['price_promo'] > 0 && $alliance == 1) {
                                        $value['price_promo'] = ($value['price_promo'] - $v['amount']);
                                    } else {
                                        $value['price_promo'] = ($price - $v['amount']);
                                    }
                                }
                                if ($v['percent'] > 0) {
                                    if ($value['price_promo'] > 0 && $alliance == 1) {
                                        $value['price_promo'] = $value['price_promo'] - (($v['percent'] / 100) * $price);
                                    } else {
                                        $value['price_promo'] = $price - (($v['percent'] / 100) * $price);
                                    }
                                }
                            }
                        }
                    } else {
                        if ($v['amount'] > 0) {
                            if ($value['price_promo'] > 0 && $v['alliance'] > 0) {
                                $value['price_promo'] = ($value['price_promo'] - $v['amount']);
                            } else {
                                $value['price_promo'] = ($price - $v['amount']);
                            }
                        }
                        if ($v['percent'] > 0) {
                            if ($value['price_promo'] > 0 && $v['alliance'] > 0) {
                                $value['price_promo'] = $value['price_promo'] - (($v['percent'] / 100) * $price);
                            } else {
                                $value['price_promo'] = $price - (($v['percent'] / 100) * $price);
                            }
                        }
                    }
                }
            }
        }
        $data[] = $value;
    }
}
foreach ($data as $item) {
    if($item['account_id'] != 2){//kaijean
        if($item['price_promo'] > 0) {
            $price = $item['price_promo'];
        } else {
            $price = $item['price'];
        }
        $email = $item['user_email'];
        if (strlen($item_name) == 0) {
            $item_name = 'Товар';
        }
        $price_total += $price;
    }
}

//foreach ($_SESSION['cart']['itms'] as $key => $value) {
//    $email = $value['user_email'];
//    if (strlen($item_name) == 0) {
//        $item_name = 'Товар';
//        //$item_name = preg_replace('/[a-zA-Zа-яА-Я]/', '', $value['title']);
//    }
//    if ($value['price_promo'] > 0) {
//        $price = $value['price_promo'];
//    } else {
//        $price = $value['price'];
//    }
//    $price_total += $price;
//}

if ($price_total == 0) {
    $result = array('success' => 1, 'success_text' => '', 'data' => array(), 'action' => '/pay.php');
} else {


    $client_id = ($p_user->isClientId() > 0) ? $p_user->isClientId() : 0;
    if (count($_SESSION['cart']['itms']) > 0) {


        $client_id = ($p_user->isClientId() > 0) ? $p_user->isClientId() : 0;
        // Передадим ID пользователя (Создается при консультации)
        if ($client_id == 0) {
            $client_id = $_SESSION['cart']['itms'][0]['user_id'];
        }
        if ($client_id == 0) {
            $client_id = $pr_cart->get_user_id_fast_login();
        }

        $pay_descr = (strlen($_SESSION['cart']['itms'][0]['pay_descr']) > 0) ? $_SESSION['cart']['itms'][0]['pay_descr'] : '';
        if (strlen($pay_descr) > 0) {
            $_SESSION['consultation'] = $_SESSION['cart']['itms'][0];
        }

        // Создаем платеж
        $pay_key = uniqid('', true); // Генерируем ключ
        $errors = 0;

        // Если авторезированный
        if (strlen($p_user->isClientEmail()) > 0) {
            $email = $p_user->isClientEmail();
        }

        /*
         * Зафиксируем платеж в базе данных 
         */

        $queryMaxId = "select MAX(p.id) max_id from `zay_pay` p";
        $max_id = $sqlLight->queryList($queryMaxId, array())[0]['max_id'] + 1;

        $_SESSION['PAY_AMOUNT'] = $price_total;

        $_SESSION['PAY_KEY'] = $pay_key;
        $_SESSION['PAY_TYPE_CP'] = 'pp';

        // Paypal Создаем транзакцию
        $amount_val = floatval($price_total);
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "id" => $max_id,
            "intent" => "CAPTURE",
            "purchase_units" => [[
            "reference_id" => $max_id,
            "amount" => [
                "value" => $amount_val,
                "currency_code" => "RUB"
            ]
                ]],
            "application_context" => [
                "cancel_url" => "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}/check_pay.php?check_pay=pp&type=canceled",
                "return_url" => "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}/check_pay.php?check_pay=pp&type=success"
            ]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            $href = '';
            if ($response->result->status == 'CREATED') {
                $pay_key = $response->result->id;
                $_SESSION['PAY_KEY'] = $pay_key;

                // If call returns body in response, you can get the deserialized version from the result attribute of the response
                //echo "response: {$response->statusCode} | {$response->result->id} | {$response->result->status}<br/>\n";
                //echo "links: {$response->links} | {$response->result->id} | {$response->result->status}<br/>\n";
//            print_r($response);
//            echo "<br/>\n";
//            echo "<br/>\n";
//            print "Status Code: {$response->statusCode}<br/>\n";
//            print "Status: {$response->result->status}<br/>\n";
//            print "Order ID: {$response->result->id}<br/>\n";
//            print "Intent: {$response->result->intent}<br/>\n";
//            print "Links:\n";
//            foreach ($response->result->links as $link) {
//                print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}<br/>\n";
//            }
//            echo "<br/>\n";
                $_SESSION['code'] = $response->result->id;

                $i = 0;
                foreach ($response->result->links as $value) {
                    $i++;
                    $pos = strpos($value->href, 'checkoutnow');
                    if ($pos > 0) {
                        $href = $value->href;
                    }
                }

                // Сохраняем данные платежа в базу
                $queryPay = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `payment_type`, `payment_c`, `payment_bank`, `pay_status`, `pay_interkassa_id`, `pay_descr`, `confirmationUrl`, `manual_status`) "
                        . "VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?' ,'?')";
                if ($sqlLight->query($queryPay, array(($max_id), 'pp', $client_id, $price_total, $pay_date, $pay_key, '', '', '', $pay_status, '', $pay_descr, $href, ''), 0)) {
                    // Сохраним связи с продуктами
                    $pr_cart->pay_insert_pay_products($max_id, $_SESSION['cart']['itms']);

                    // Отправляем пользователя на страницу оплаты
                    //header('Location: ' . $confirmationUrl);

                    if (strlen($href) > 0) {
                        location_href($href);
                    }
                } else {
                    $_SESSION['errors'][] = 'Ошибка сохранения платежа!';
                }
            } else {
                $_SESSION['errors'][] = "Status: {$response->result->status}!";
            }
        } catch (HttpException $ex) {
            $_SESSION['errors'][] = $ex->statusCode . ' | ' . $ex->getMessage();
        }



        // Если есть ошибки
        if (is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
            $result = array('success' => 0, 'errors' => $_SESSION['errors']);
        }
    } else {
        ?>
        <div>Корзина пуста</div>
        <?
    }
}