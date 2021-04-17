<?php

defined('__CMS__') or die;

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/close_club/inc.php';
include_once 'inc.php';

$pr_cart = new \project\cart();
$pr_products = new \project\products();
$p_user = new \project\user();
$config = new \project\config();


// Добавление в корзину
if (isset($_POST['cart_product_add'])) {
    $product_id = $_POST['cart_product_id'];
    $new_arr = array();
    if ($product_id > 0) {
        if (isset($_SESSION['cart']['itms']) && count($_SESSION['cart']['itms']) > 0) {
            foreach ($_SESSION['cart']['itms'] as $key => $value) {
                if ($product_id == $value['id']) {
                    //unset($_SESSION['cart']['itms'][$key]);
                } else {
                    $new_arr[] = $_SESSION['cart']['itms'][$key];
                }
            }
            $_SESSION['cart']['itms'] = $new_arr;
        }
        // Зарегистрируем товары
        $obj = $pr_products->getProductElem($product_id);
        //print_r($obj);
        $_SESSION['cart']['itms'][] = $obj;
        //init_prices();
    }
}

// Добавление в корзину консультации
if (isset($_POST['send_consultation_form'])) {
    unset($_SESSION['consultation']);
    //$_SESSION['cart']['itms'] = array();
    $first_name = $_POST['first_name'];
    $user_phone = $_POST['user_phone'];
    $user_email = $_POST['user_email'];
    $your_master = $_POST['your_master'];
    $your_master_text = $_POST['your_master_text'];
    $datepicker_data = $_POST['datepicker_data'];
    $timepicker_data = $_POST['timepicker_data'];
    $price = $_POST['price'];
    $period_id = $_POST['period_id'];
    $user_id = 0;

    /*
     * Проверим есть ли пользователь, если нет зарегистрирован регистрируем
     */
    $sqlLight = new \project\sqlLight();
    $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active` = 1";
    $users = $sqlLight->queryList($query, array($user_email, $user_phone));
    if (count($users) == 0) {
        $password = $this->password_generate();
        /*
         * Нужно еще отправлять пароль пользователю на почту !!!!!!!!!!!!!
         */
        $send_emails = new \project\send_emails();
        $send_emails->send('new_password', $user_email, array('user_password' => $password));
        $this->register($user_email, $user_phone, $password, $password, '1');
        $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active` = 1";
        $users = $sqlLight->queryList($query, array($user_email, $user_phone), 1);
        if (count($users) > 0) {
            $user_id = $users[0]['id'];
        }
    } else {
        $user_id = $users[0]['id'];
    }

    // положим в корзину
    $sign_up_consultation->set_cart_consultation(
            $user_id,
            $first_name,
            $user_phone,
            $user_email,
            $your_master,
            $datepicker_data,
            $timepicker_data,
            $price,
            $period_id
    );
}

// Добавление в корзину
if (isset($_POST['add_other_consultation_cart'])) {
    unset($_SESSION['consultation']);
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';
    $sign_up_consultation = new \project\sign_up_consultation();

    $product_period_id = trim($_POST['product_period_id']);
    $consultation_user_fio = trim($_POST['consultation_user_fio']);
    $consultation_date = $_POST['consultation_date'];
    $consultation_period = $_POST['consultation_period'];

    $_SESSION['cart']['itms'] = array();

    $data = $sign_up_consultation->get_consultation_on_period_info($product_period_id);

    $product_price = trim($data['period_price']);

    if (isset($_SESSION['user']['info']) && $_SESSION['user']['info']['id'] > 0) {

        if (strlen(trim($consultation_user_fio)) == 0) {
            $consultation_user_fio = $_SESSION['user']['info']['first_name'];
        }
        // положим в корзину
        $sign_up_consultation->set_cart_consultation(
                $_SESSION['user']['info']['id'],
                $consultation_user_fio,
                $_SESSION['user']['info']['phone'],
                $_SESSION['user']['info']['email'],
                $data['master_id'],
                $consultation_date,
                $consultation_period,
                $data['period_price'],
                $product_period_id
        );

        $result = array('success' => 1, 'success_text' => '');
    } else {
        $errors[] = 'Не определен пользователь!';
    }
}


// Удаление из корзины
if (isset($_POST['cart_product_remove'])) {
    $product_id = $_POST['cart_product_id'];
    $new_arr = array();
    if ($product_id > 0) {
        foreach ($_SESSION['cart']['itms'] as $key => $value) {
            if ($product_id == $value['id']) {
                //unset($_SESSION['cart']['itms'][$key]);
            } else {
                $new_arr[] = $_SESSION['cart']['itms'][$key];
            }
        }
        $_SESSION['cart']['itms'] = $new_arr;
        init_prices();
    } else {
        foreach ($_SESSION['cart']['itms'] as $key => $value) {
            if (0 == $value['id']) {
                //unset($_SESSION['cart']['itms'][$key]);
            } else {
                $new_arr[] = $_SESSION['cart']['itms'][$key];
            }
        }
        $_SESSION['cart']['itms'] = $new_arr;
        init_prices();
    }
}

if (isset($_POST['cart_product_get_array'])) {
    $data = array();
    if (isset($_SESSION['cart']['itms']) && count($_SESSION['cart']['itms']) > 0) {
        foreach ($_SESSION['cart']['itms'] as $key => $value) {
//            if (strlen($value['pay_descr']) == 0) {
//                $data[] = $value;
//            }
            $data[] = $value;
            //    echo "itms: {$_SESSION['cart']['itms'][$key]}\n";
            //$_SESSION['cart']['itms'][$key]['product_info'] = $pr_products->getProductElem($_SESSION['cart']['itms'][$key]);
            //print_r($pr_products->getProductElem($_SESSION['cart']['itms'][$key]));
            //    echo "\n";
        }
    }
    // $_SESSION['cart']['itms']
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if (isset($_POST['cart_product_get_count'])) {
    $count = count($_SESSION['cart']['itms']);
    if ($count > 0) {
        
    } else {
        $count = 0;
    }
    $result = array('success' => 1, 'success_text' => '', 'data' => array('count' => $count));
}
/**
 * Колличество не обработанных заявок
 */
if (isset($_POST['not_processed_col'])) {
    $querySelect = "SELECT count(*) as not_processed_col FROM `zay_pay` WHERE `processed` = 0";
    $not_processed_col = $pr_cart->getSelectArray($querySelect)[0]['not_processed_col'];
    $result = array('success' => 1, 'success_text' => '', 'not_processed_col' => $not_processed_col);
}

/**
 * Письмо пользователю
 */
if (isset($_POST['user_send_message'])) {
    $user_fio = $_POST['user_fio'];
    $user_email = $_POST['user_email'];
    $user_subject = $_POST['user_subject'];
    $user_message = $_POST['user_message'];
    $arrayReplaseText = array(
        'user_fio' => $user_fio,
        'user_email' => $user_email,
        'user_subject' => $user_subject,
        'user_message' => $user_message,
    );

    if (strlen($config->getConfigParam('link_ed_mailto')) > 0) {
        $link_ed_mailto = $config->getConfigParam('link_ed_mailto');
        //$link_ed_mailto = 'koman1706@gmail.com';

        if ($p_user->sendEmail($link_ed_mailto, 'Письмо технической поддержки', 'send_user_message', $arrayReplaseText)) {
            $result = array('success' => 1, 'success_text' => 'Успешно отправлено, ждите ответа.');
        } else {
            $_SESSION['errors'][] = 'Не отправлено!';
            $result = array('success' => 0, 'success_text' => '');
        }
    }
}

/**
 * Создание платежа на cloudpayments
 */
if (isset($_POST['set_cloudpayments'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';

    $sqlLight = new \project\sqlLight();
    $config = new \project\config();
    $products = new \project\products();
    $sign_up_consultation = new \project\sign_up_consultation();


    $CloudPayments_id = $config->getConfigParam('CloudPayments');
    $pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
    $pay_status = "pending"; // Устанавливаем стандартный статус платежа

    /*
      Собираем данные по платежу
     */
    $p_user = new \project\user();

    $_SESSION['errors'] = array();
    $price_total = 0;

    if (isset($_SESSION['cart']['itms']) && count($_SESSION['cart']['itms']) > 0) {
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
        if ($p_user->isEditor()) {
            $price_total = 1;
        }

        $client_id = ($p_user->isClientId() > 0) ? $p_user->isClientId() : 0;

        // Передадим ID пользователя (Создается при консультации)
        if ($client_id == 0) {
            $client_id = $_SESSION['cart']['itms'][0]['user_id'];
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

        $data_array = array(
            "publicId" => $CloudPayments_id,
            "amount" => $price_total, // Сумма платежа
            "currency" => "RUB", // Валюта платежа
            "customer_email" => $email,
        );

        $_SESSION['PAY_AMOUNT'] = $price_total;
        //print_r($data_array);

        if (count($_SESSION['errors']) == 0) {
            $pay_objs = array();
            if (isset($_SESSION['PAY_KEY']) && isset($_SESSION['PAY_TYPE_CP']) && $_SESSION['PAY_TYPE_CP'] == 'cp') {
                $select = "select * from zay_pay p WHERE p.pay_type='cp' and pay_date>=(CURRENT_DATE-1) and p.pay_key='?' ";
                $pay_objs = $sqlLight->queryList($select, array($_SESSION['PAY_KEY']));
            }

            /*
             * Если уже платеж был не будем дублировать платеж
             */
            if (count($pay_objs) == 0) {
                $_SESSION['PAY_KEY'] = $pay_key;
                $_SESSION['PAY_TYPE_CP'] = 'cp';


                $queryMaxId = "select MAX(p.id) max_id from `zay_pay` p";
                $max_id = $sqlLight->queryList($queryMaxId, array())[0]['max_id'] + 1;
                //echo $max_id . "<br/>\n";
                // Сохраняем данные платежа в базу
                $queryPay = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `payment_type`, `payment_c`, `payment_bank`, `pay_status`, `pay_interkassa_id`, `pay_descr`, `confirmationUrl`) "
                        . "VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?')";
                if ($sqlLight->query($queryPay, array(($max_id), 'cp', $client_id, $price_total, $pay_date, $pay_key, '', '', '', $pay_status, '', $pay_descr, ''), 0)) {
                    foreach ($_SESSION['cart']['itms'] as $key => $value) {
                        //$product_id = $max_id;
                        $product_id = $value['id'];
                        $data_array['pay_id'] = $product_id;
                        if ($product_id > 0) {
                            if ($value['price_promo'] > 0) {
                                $price = $value['price_promo'];
                            } else {
                                $price = $value['price'];
                            }
                            $queryProductRegister = "INSERT INTO `zay_pay_products`(`pay_id`, `product_id`, `product_price`) "
                                    . "VALUES ('?','?','?')";
                            $sqlLight->query($queryProductRegister, array($max_id, $product_id, $price));
                            // Зафиксируем продажу
                            //$products->setSoldAdd($product_id);
                        }
                    }
                    
                    // Отправляем пользователя на страницу оплаты
                    //header('Location: ' . $confirmationUrl);
                    $result = array('success' => 1, 'success_text' => '', 'data' => $data_array);
                } else {
                    $_SESSION['errors'][] = 'Ошибка сохранения платежа!';
                }
            } else {

                if ($_SESSION['consultation']['your_master_id'] > 0) {
                    $_SESSION['consultation']['pay_id'] = $max_id;
                    $data_array['pay_descr'] = $_SESSION['consultation']['pay_descr'];
                }
                $data_array['pay_descr'] = 'Покупка товара';

                $data_array['pay_id'] = $pay_objs[0]['id'];
                $result = array('success' => 1, 'success_text' => '', 'data' => $data_array);
            }
        } else {
            $_SESSION['errors'][] = 'Ошибка операции!';
        }
    } else {
        $_SESSION['errors'][] = 'Корзина пуста!';
    }

    // Если есть ошибки
    if (is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
        $result = array('success' => 0, 'errors' => $_SESSION['errors']);
    }
}
/**
 * Подтверждение платежа cloudpayments
 */
if (isset($_POST['check_cloudpayments'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';

    $sqlLight = new \project\sqlLight();
    $u = new \project\user();
    $products = new \project\products();
    $config = new \project\config();
    $sign_up_consultation = new \project\sign_up_consultation();
    $close_club = new \project\close_club();

    $CloudPayments_id = $config->getConfigParam('CloudPayments');

// Проверяем статус оплаты
    if (isset($_SESSION['PAY_KEY'])) {
        $query = "SELECT * FROM `zay_pay` WHERE `pay_type`='cp' and `pay_date`>=CURRENT_DATE-1 and `pay_key`='?'";
        $pay_obj = $sqlLight->queryList($query, array($_SESSION['PAY_KEY']));
    }
//print_r($pays);
//echo "\n";
// Получаем список платежей циклом
//    if (count($pays) > 0) {
//        foreach ($pays as $value) {
//            $paymentId = $value['pay_key']; // Получаем ключ платежа
//            $pay_check = 'succeeded';
//
//            // Обновляем статус платежа
//            $query_update = "UPDATE zay_pay "
//                    . "SET pay_status='?', payment_type='?', payment_c='?', payment_bank='?' "
//                    . "WHERE `pay_type`='ya' and pay_key = '?'";
//            $sqlLight->query($query_update, array($pay_check, 'CloudPayments', '', '', $paymentId));
//            if ($pay_check == 'succeeded') {
//                // Зафиксируем продажу
//                $products->setSoldAdd($product_id);
//                $result = array('success' => 1, 'success_text' => 'Платеж успешно проведен');
//            } else {
//                $result = array('success' => 0, 'success_text' => 'Не проведен! Проверьте чуть позже еще раз');
//            }
//        }
//    }


    if (isset($_SESSION['PAY_KEY']) && strlen($_SESSION['PAY_KEY']) > 0 && count($pay_obj) > 0 && $u->isClientId() > 0) {
        $total = $pay_obj[0]['pay_sum'];
        $pay_id = $pay_obj[0]['id'];

        $pay_check = 'pending';

        if ($_POST['paymentResult']['success'] == true) {
            $pay_check = 'succeeded';
        }
        //echo "GG: {$_POST['paymentResult']['success']} check: {$pay_check}";
        //Обновляем статус платежа
        $query_update = "UPDATE zay_pay "
                . "SET pay_status='?', pay_sum='?', payment_type='?', payment_c='?', payment_bank='?' "
                . "WHERE `pay_type`='cp' and pay_key='?' and id='?' ";

        if ($sqlLight->query($query_update, array($pay_check, $_SESSION['PAY_AMOUNT'], 'CloudPayments', '', '', $_SESSION['PAY_KEY'], $pay_id), 0) && $pay_check == 'succeeded') {

            // Зарегистрируем покупку
            $pr_cart->register_pay($pay_id);

            // Зафиксируем продажу
            $products->setSoldAdd($pay_id);
            $result = array('success' => 1, 'success_text' => 'Платеж успешно проведен');
        } else {
            $result = array('success' => 0, 'success_text' => 'Не проведен! Недостаточно средств или карта не активна!');
        }

        $_SESSION['cart']['cart_itms'] = $_SESSION['cart']['itms'];
        $_SESSION['cart']['total'] = $total;
        $_SESSION['cart']['pay_id'] = $pay_id;
        $_SESSION['cart']['itms'] = array();
        $_SESSION['PAY_KEY'] = '';
        $_SESSION['PAY_AMOUNT'] = '';
        unset($_SESSION['PAY_KEY']);
        unset($_SESSION['PAY_AMOUNT']);
        //echo json_encode($result);
    }
}

if (isset($_POST['get_cart_other'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/ya.php';
    //$html = inc($_SERVER['DOCUMENT_ROOT'] . '/extension/cart/ya_block.php');
    $result = array('success' => 1, 'pay_key' => $pay_key, 'return_url' => $return_url);
}