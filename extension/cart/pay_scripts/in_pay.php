<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
$sqlLight = new \project\sqlLight();

include_once DOCUMENT_ROOT . '/extension/users/inc.php';
include_once DOCUMENT_ROOT . '/class/functions.php';
$p_user = new \project\user();

$config = new \project\config();

// Ссылка на переадресацию ответа 
$url_ref = $config->getConfigParam('pay_site_url_ref');
$in_shop_id = $config->getConfigParam('in_shop_id');
$in_secret_key = $config->getConfigParam('in_secret_key');

// подготовим данные
if (!isset($_SESSION['pay_key'])) {
    $_SESSION['pay_key'] = uniqid('', true);
}
$pay_key = $_SESSION['pay_key'];


$client_email = $p_user->isClientEmail();
$client_id = ($p_user->isClientId() > 0) ? $p_user->isClientId() : 0;

// Передадим ID пользователя (Создается при консультации)
if ($client_id == 0) {
    $client_id = $_SESSION['cart']['itms'][0]['user_id'];
}

$pay_descr = (strlen($_SESSION['cart']['itms'][0]['pay_descr']) > 0) ? $_SESSION['cart']['itms'][0]['pay_descr'] : '';
if (strlen($pay_descr) > 0) {
    $_SESSION['consultation'] = $_SESSION['cart']['itms'][0];
}

$titles = '';
if (count($_SESSION['cart']['itms']) > 0) {
    foreach ($_SESSION['cart']['itms'] as $key => $value) {
        $titles .= '"' . $value['title'] . '", ';
    }
}
$titles = $sqlLight->setSpecialcharsHtml($titles);

$price_total = 0;
//print_r($_SESSION['cart']);
if (count($_SESSION['cart']['itms']) > 0) {
    foreach ($_SESSION['cart']['itms'] as $value) {
        $price_total += $value['price'];
    }
}

/**
 * Заглушка для админов покупка за 1 рубль
 */
if ($p_user->isEditor()) {
    $price_total = 1;
}

if ($price_total > 0) {
    $pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
    $pay_status = "pending"; // Устанавливаем стандартный статус платежа
//
// начнем заносить данные в базу данных
    $querySelect = "select * from `zay_pay` WHERE pay_type='in' AND pay_key='?'";
    $pays = $sqlLight->queryList($querySelect, array($pay_key));
    if (count($pays) == 0) {
        $queryMaxId = "select MAX(p.id) max_id from `zay_pay` p";
        $max_id = $sqlLight->queryList($queryMaxId, array())[0]['max_id'] + 1;

        // Сохраняем данные платежа в базу
        $query = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `pay_status`, `pay_descr`, `confirmationUrl`) "
                . "VALUES ('?', '?','?', '?', '?', '?', '?', '?', '?')";
        if ($sqlLight->query($query, array(($max_id), 'in', $client_id, $price_total, $pay_date, $pay_key, $pay_status, $pay_descr, ''))) {
            foreach ($_SESSION['cart']['itms'] as $key => $value) {
                $product_id = $value['id'];
                if ($product_id > 0) {
                    if ($value['price_promo'] > 0) {
                        $price = $value['price_promo'];
                    } else {
                        $price = $value['price'];
                    }
                    // доп. данные
                    $queryProductRegister = "INSERT INTO `zay_pay_products`(`pay_id`, `product_id`, `product_price`) "
                            . "VALUES ('?','?','?')";
                    $sqlLight->query($queryProductRegister, array($max_id, $product_id, $price));
                    // Зафиксируем продажу
                    echo $product_id . "<br/>\n";
                    $products->setSoldAdd($product_id);
                }
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ru">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8"> 
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title><?= $_SESSION['site_title'] ?></title>
            <meta name="description" content="<?= $_SESSION['page']['info']['description'] ?>" />
            <link href="/themes/site1/images/favicon.png" rel="icon">
            <meta name="google-site-verification" content="Sozz79bTt3VOI21yJOn4xH2czaki3n7psELbIxXdI34" />
            <meta name="interkassa-verification" content="777d8a842d5f8a07fe433d7f9e9537fd" />

            <!-- SLEEK CSS -->
            <link id="sleek-css" rel="stylesheet" href="/assets/panel/assets/css/sleek.css" />
            <link rel="stylesheet" href="/themes/site1/css/plugins.css">
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" 
                  integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" 
                  crossorigin="anonymous">
            <link rel="stylesheet" href="/themes/site1/css/style.css">
            <link href="/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />

            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="/assets/plugins/jquery/jquery.js"></script>
            <link rel="stylesheet" href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.css">
            <link rel="stylesheet" href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.theme.css">
            <script src="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>

            <!-- timepicker -->
            <script type="text/javascript" src="/assets/plugins/jquery/timepicker/jquery-ui-timepicker-addon.js"></script>
            <script type="text/javascript" src="/assets/plugins/jquery/timepicker/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
            <script type="text/javascript" src="/assets/plugins/jquery/timepicker/jquery-ui-sliderAccess.js"></script>
            <link rel="stylesheet" media="all" type="text/css" href="/assets/plugins/jquery/timepicker/jquery-ui-timepicker-addon.css" />

            <script type="text/javascript" src="/assets/plugins/mixitup/mixitup.min.js"></script>
            <script type="text/javascript" src="/assets/js/init.js"></script>
            <script type="text/javascript" src="/assets/plugins/lazyload/lazyload.min.js"></script>
        </head>  
        <body data-spy="scroll" data-target=".navbar" data-offset="90">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div class="card text-center mt-5 mb-5">
                            <div class="card-header">
                                Платежная система Interkassa
                            </div>
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <img src="/assets/img/interkassa_logo_ru.png" class="card-img-top w-75 mt-4 mb-5" title="www.interkassa.com">
                                        <form action="https://sci.interkassa.com/" method="post">
                                            <input type="hidden" name="ik_co_id" value="<?= $in_shop_id ?>" />
                                            <input type="hidden" name="ik_am" value="<?= $price_total ?>" />
                                            <input type="hidden" name="ik_pm_no" value="1" />
                                            <input type="hidden" name="ik_desc" value="<?= $titles ?>" />
                                            <input type="hidden" name="ik_loc" value="ru" />
                                            <input type="hidden" name="ik_x_baggage" value="test_baggage" />
                                            <input type="hidden" name="ik_cur" value="RUB" />
                                            <input type="hidden" name="ik_cli" value="<?= $client_email ?>" />
                                            <button type="submit" class="btn btn-lg button btngreen2 text-center btn_cart btn_cart_interkassa">Оплатить</button>
                                        </form>
                                    </div>
                                </div> 
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <a href="javascript:history.go(-1)" class="">Отменить</a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div>
        </body>
    </html>
    <?
} else {
    ?>
    <div>Корзина пуста</div>
    <?
}