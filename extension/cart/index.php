<?php
/*
 * Страница index
 */


defined('__CMS__') or die;

include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';

include_once 'inc.php';

$config = new \project\config();
$p_products = new \project\products();
$c_cart = new \project\cart();
$p_user = new \project\user();
$auth = new \project\auth();

//$client_id = $c_cart->get_user_id_fast_login();
//echo "client_id: {$client_id}";
//echo "col: " . count($_SESSION['cart']['itms']) . "<br/>\n";
/*
 * Добавления товара в корзину
 */
if (isset($_GET['go_cart'])) {
    $product_id = $_GET['go_cart'];
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
        $obj = $p_products->getProductElem($product_id);
        $_SESSION['cart']['itms'][] = $obj;
        init_prices();
    }
    goBack('/shop/cart/', 0);
}
//print_r($_SESSION['cart']['itms']);
$form_show = 0;
if (isset($_GET['ya_payment_true'])) {
    $form_show = 1;
    ?>
    <div class="container mb-5">
        <div class="row pt-5 pb-5 text-center">
            <div class="col-lg-12">
                <h1 class="fontbold" style="">Проверить платеж</h1>
                <br/>
                <hr/>
            </div>

            <div class="col-lg-12 pay_result form_result pt-5 pb-5 font-size-20">

            </div>
            <div class="col-lg-12">
                <a href="javascript:void(0)" class="btn btn-primary pay_check">Проверить подтверждение платежа</a>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {

            $(".pay_check").click(function () {
                $(".form_result").html("");
                sendPostLigth('/check_pay.php', {"check_pay": 'ya'}, function (e) {
                    //console.log(e);
                    $(".form_result").html(e['success_text']);
                    if (e['success'] == '1') {
                        $(".pay_check").html("Перейти в личный кабинет");
                        $(".pay_check").attr("href", "/office/");
                    }
                });
            });

            sendPostLigth('/check_pay.php', {"check_pay": 'ya'}, function (e) {
                $(".form_result").html(e['success_text']);
                if (e['success'] == '1') {
                    $(".pay_check").html("Перейти в личный кабинет");
                    $(".pay_check").attr("href", "/office/");
                }
            });

            window.dataLayer = window.dataLayer || [];
            for (var i = 0; i < cart_itms.length; i++) {
                var isPromo = 0;
                var product_price = 0;
                if (cart_itms[i]['price_promo'].length > 0 && Number(cart_itms[i]['price_promo']) > 0) {
                    isPromo = 1;
                }
                if (isPromo == 1) {
                    product_price = cart_itms[i]['price_promo'];
                } else {
                    product_price = cart_itms[i]['price'];
                }
                var product_info_title = $.trim(cart_itms[i]['title']);
                var product_info_price = product_price;
                //console.log("product_info_title: " + product_info_title + ' - ' + product_info_price);
                dataLayer.push({
                    'ecommerce': {
                        'currencyCode': 'UAH',
                        'coupon': none, // Должен подтягиваться код купона при успешной реализации 
                        'checkout': {
                            'actionField': {'step': 1},
                            'products': [{
                                    "name": product_info_title,
                                    "price": product_info_price,
                                    "quantity": 1
                                },
                                {
                                    "name": product_info_title,
                                    "price": product_info_price,
                                    "quantity": 1
                                }]
                        }
                    },
                    'event': 'gtm-ee-event',
                    'gtm-ee-event-category': 'Enhanced Ecommerce',
                    'gtm-ee-event-action': 'Checkout Step 1',
                    'gtm-ee-event-non-interaction': 'False',
                });
            }

        });
    </script>
    <?
}

if (isset($_GET['in_payment_true'])) {
    $form_show = 1;
    ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card text-center mt-5 mb-5">
                    <!--
                    <div class="card-header">
                        
                    </div>
                    -->
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-12 mb-5 mt-3">
                                        <h2>Платеж принят</h2>
                                    </div>
                                    <div class="col-lg-12">
                                        <a href="/office/" class="btn btn-primary">Перейти в личный кабинет</a>
                                    </div>

                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <?
}

if (isset($_GET['in_payment_cancel'])) {
    $form_show = 1;
    ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card text-center mt-5 mb-5">
                    <!--
                    <div class="card-header">
                        
                    </div>
                    -->
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-12 mb-5 mt-3">
                                        <h2>Заявка отменена</h2>
                                    </div>
                                    <div class="col-lg-12">
                                        <a href="/cart/" class="btn btn-primary">Перейти в корзину</a>
                                    </div>

                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <?
}

if ($form_show == 0) {
    /**
     * Подготолви данные для PayPal
     */
    $url_ref = $config->getConfigParam('pay_site_url_ref');
    $url_ref = "{$url_ref}/pay.php?pay_payment_true=1";

    $paypal_email = $config->getConfigParamByCategory('paypal_email',7);
    //print_r($_SESSION['cart']['itms']);
    $price_total = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']['itms']) > 0) {
        $title = "";
        foreach ($_SESSION['cart']['itms'] as $key => $value) {
            if($value['account_id'] != 2){//kaijean
                $email = $value['user_email'];
                $title .= $value['title'] . " : ";
                if ($value['price_promo'] > 0) {
                    $price = $value['price_promo'];
                } else {
                    $price = $value['price'];
                }
                $price_total += $price;
            }
        }
    }

    /**
     * Заглушка для админов покупка за 1 рубль
     */
//    if ($p_user->isEditor()) {
//        $price_total = 1;
//    }
    // Если авторезированный
    if (strlen($p_user->isClientEmail()) > 0) {
        $email = $p_user->isClientEmail();
    }

    include_once $_SERVER['DOCUMENT_ROOT'] . '/system/oauth/ya.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/system/oauth/vk.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/system/oauth/facebook.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/system/oauth/google.php';

    //$c_cart->register_business_check(279558, array());
    //print_r($_SESSION);

    include 'tmpl/index.php';
} else {
    if (isset($_SESSION['cart']['itms']) && count($_SESSION['cart']['itms']) > 0) {
        $_SESSION['cart']['cart_itms'] = $_SESSION['cart']['itms'];
    }
    /*
     * Отметим что купили продукт
     */
    ?>
    <script>
        window.dataLayer = window.dataLayer || [];
    <?
    foreach ($_SESSION['cart']['cart_itms'] as $key => $value) {

        $isPromo = 0;
        if ($value['price_promo'] > 0) {
            $isPromo = 1;
        }
        if ($isPromo == 1) {
            $product_price = $value['price_promo'];
        } else {
            $product_price = $value['price'];
        }
        $product_info_title = $value['title'];
        $product_info_price = $product_price;
//echo "T: {$product_info_title} p: {$product_info_price}<br/>\n";
        ?>
            dataLayer.push({
                'ecommerce': {
                    'currencyCode': 'RUB',
                    'purchase': {
                        'actionField': {
                            'id': "<?= $_SESSION['cart']['pay_id'] ?>",
                            'revenue': "<?= $_SESSION['cart']['total'] ?>",
                        },
                        'products': [{
                                "name": "<?= $product_info_title ?>",
                                "price": "<?= $product_info_price ?>",
                                "quantity": 1,
                            },
                            {
                                "name": "<?= $product_info_title ?>",
                                "price": "<?= $product_info_price ?>",
                                "quantity": 1,
                            }]
                    }
                },
                'event': 'gtm-ee-event',
                'gtm-ee-event-category': 'Enhanced Ecommerce',
                'gtm-ee-event-action': 'Purchase',
                'gtm-ee-event-non-interaction': 'False'
            });
        <?
    }
    ?>
    </script>
    <?
}

