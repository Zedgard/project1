<?php
/*
 * Yandex оплата
 * Настройки находятся в файле config.php 
 * 
 *  */
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';

$sqlLight = new \project\sqlLight();
$config = new \project\config();
$products = new \project\products();
$sign_up_consultation = new \project\sign_up_consultation();
$pr_cart = new \project\cart();

// Ссылка на переадресацию ответа 
$url_ref = $config->getConfigParam('pay_site_url_ref');
// $ya_shop_id = $config->getConfigParam('ya_shop_id');
// $ya_shop_api_key = $config->getConfigParam('ya_shop_api_key');
$ya_shop_id = $config->getConfigParamByCategory('ya_shop_id',7);//kaijean
$ya_shop_api_key = $config->getConfigParamByCategory('ya_shop_api_key',7);//kaijean

$pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
$pay_status = "pending"; // Устанавливаем стандартный статус платежа
// Подключаем библиотеку Я.Кассы
require $_SERVER['DOCUMENT_ROOT'] . '/system/yandex-checkout-sdk-php-master/lib/autoload.php';

use YandexCheckout\Client;

$client = new Client();
$client->setAuth($ya_shop_id, $ya_shop_api_key);

/*
  Собираем данные по платежу
 */
$p_user = new \project\user();

$price_total = 0;

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
        $price_total += $price;
    }
}

//foreach ($_SESSION['cart']['itms'] as $key => $value) {
//    $email = $value['user_email'];
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
    /**
     * Заглушка для админов покупка за 1 рубль
     */
//    if ($p_user->isEditor()) {
//        $price_total = 1;
//    }

    $client_id = ($p_user->isClientId() > 0) ? $p_user->isClientId() : 0;
    if (count($_SESSION['cart']['itms']) > 0) {

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
        $idempotenceKey = uniqid('', true); // Генерируем ключ 
        //print_r($_SESSION['user']['info']['email']);
        //echo $price_total . " em: {$_SESSION['user']['info']['email']} | {$p_user->isClientEmail()}<br/>\n";
        //echo $p_user->isClientEmail();
        //echo $p_user->isClientEmail();
        //  exit();
        $errors = 0;

        // Если авторезированный
        if (strlen($p_user->isClientEmail()) > 0) {
            $email = $p_user->isClientEmail();
        }

        $data_array = array(
            "amount" => array(
                "value" => $price_total, // Сумма платежа
                "currency" => "RUB" // Валюта платежа
            ),
            "confirmation" => array(
                "type" => "redirect",
                "return_url" => "{$url_ref}/?page_type=pay_thanks" // Куда отправлять пользователя после оплаты
            ),
            "capture" => true, // Платеж в один этап
            "receipt" => array(
                "customer" => array(
                    "email" => $email,
                ),
                "items" => array(
                    array(
                        "description" => "Описание услуги",
                        "quantity" => "1.00", // Количество
                        "amount" => array(
                            "value" => $price_total,
                            "currency" => "RUB"
                        ),
                        "tax_system_code" => "2", // Налогообложение 
                        "vat_code" => "2",
                        "payment_mode" => "full_prepayment", // Полный платеж
                        "payment_subject" => "service" // Услуга
                    )
                )
            ),
                //'save_payment_method' => true  // сохранение данных о платеже, при тестовом платеже вызывает ошибку
        );
        //print_r($data_array);
        try {
            $payment = $client->createPayment(
                    $data_array,
                    uniqid('', true)
            );
        } catch (Exception $exc) {
            $errors = 1;
            //echo $exc->getTraceAsString();
            echo 'Ошибка генерации массива данных';
        }

        if ($errors == 0) {
//print_r($payment);
// Получаем ссылку на оплату
            $confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();

// Получаем платежный ключ
            $pay_key = $payment->getid();
            $_SESSION['PAY_KEY'] = $pay_key;

            $queryMaxId = "select MAX(p.id) max_id from `zay_pay` p";
            $max_id = $sqlLight->queryList($queryMaxId, array())[0]['max_id'] + 1;
//echo $max_id . "<br/>\n";
// Сохраняем данные платежа в базу
            $queryPay = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `payment_type`, `payment_c`, `payment_bank`, `pay_status`, `pay_interkassa_id`, `pay_descr`, `confirmationUrl`, `manual_status`) "
                    . "VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?')";
            if ($sqlLight->query($queryPay, array(($max_id), 'ya', $client_id, $price_total, $pay_date, $pay_key, '', '', '', $pay_status, '', $pay_descr, $confirmationUrl, ''), 1)) {
                //foreach ($_SESSION['cart']['itms'] as $key => $value) {
                //    $product_id = $value['id'];
                //if ($product_id > 0) {
//                        if ($value['price_promo'] > 0) {
//                            $price = $value['price_promo'];
//                        } else {
//                            $price = $value['price'];
//                        }
//                        $queryProductRegister = "INSERT INTO `zay_pay_products`(`pay_id`, `product_id`, `product_price`) "
//                                . "VALUES ('?','?','?')";
//                        $sqlLight->query($queryProductRegister, array($max_id, $product_id, $price));
                //}
                //}
                // Сохраним связи с продуктами
                $pr_cart->pay_insert_pay_products($max_id, $_SESSION['cart']['itms']);
                /*
                 * Если это консультация 
                 */
//            if ($_SESSION['consultation']['your_master_id'] > 0) {
//                $_SESSION['consultation']['pay_id'] = $max_id;
//                $sign_up_consultation->add_consultation($_SESSION['consultation']);
//            }
                // Отправляем пользователя на страницу оплаты
                header('Location: ' . $confirmationUrl);
            } else {
                echo 'Ошибка операции!';
            }
        } else {
            echo "<div>Ошибка операции!</div>";
        }
    } else {
        ?>
        <div>Корзина пуста</div>
        <?
    }
}