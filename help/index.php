<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
$user = new \project\user();

if (!$user->isEditor()) {
    ?>
    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="/assets/css/sleek.min.css<?= $_SESSION['rand'] ?>" />
    <link rel="stylesheet" href="/themes/site1/css/plugins.css<?= $_SESSION['rand'] ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css<?= $_SESSION['rand'] ?>" 
          integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" 
          crossorigin="anonymous">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css<?= $_SESSION['rand'] ?>">


    <link href="/assets/plugins/daterangepicker/daterangepicker.css<?= $_SESSION['rand'] ?>" rel="stylesheet" />


    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,600;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Overpass+Mono&display=swap" rel="stylesheet">

    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="/assets/plugins/bootstrap5/css/bootstrap.min.css<?= $_SESSION['rand'] ?>">

    <link rel="stylesheet" href="/themes/site1/css/style.css<?= $_SESSION['rand'] ?>">
    <link rel="stylesheet" href="/assets/plugins/animate/animate.css<?= $_SESSION['rand'] ?>">

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/assets/plugins/jquery/jquery.js<?= $_SESSION['rand'] ?>"></script>
    <link rel="stylesheet" href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.css<?= $_SESSION['rand'] ?>">
    <link rel="stylesheet" href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.theme.css<?= $_SESSION['rand'] ?>">
    <script src="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.js<?= $_SESSION['rand'] ?>"></script>

    <!-- timepicker -->
    <script type="text/javascript" src="/assets/plugins/jquery/timepicker/jquery-ui-timepicker-addon.js<?= $_SESSION['rand'] ?>"></script>
    <script type="text/javascript" src="/assets/plugins/jquery/timepicker/i18n/jquery-ui-timepicker-addon-i18n.min.js<?= $_SESSION['rand'] ?>"></script>
    <script type="text/javascript" src="/assets/plugins/jquery/timepicker/jquery-ui-sliderAccess.js<?= $_SESSION['rand'] ?>"></script>
    <link rel="stylesheet" media="all" type="text/css" href="/assets/plugins/jquery/timepicker/jquery-ui-timepicker-addon.css<?= $_SESSION['rand'] ?>" />

    <script type="text/javascript" src="/assets/plugins/mixitup/mixitup.js<?= $_SESSION['rand'] ?>"></script>
    <script type="text/javascript" src="/assets/js/init.js<?= $_SESSION['rand'] ?>"></script>
    <script src="/assets/js/cart.js<?= $_SESSION['rand'] ?>"></script>  
    <script src="/assets/js/ajax.js<?= $_SESSION['rand'] ?>"></script>  
    <!-- Theme CSS -->
    <link rel="stylesheet" href="/assets/css/porto/css/theme.css<?= $_SESSION['rand'] ?>">
    <link rel="stylesheet" href="/assets/css/porto/css/theme-elements.css<?= $_SESSION['rand'] ?>">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="/assets/css/porto/css/skins/skin-corporate-4.css<?= $_SESSION['rand'] ?>">	

    <!-- Theme Base, Components and Settings background-cover -->
    <script src="/assets/css/porto/js/theme.js<?= $_SESSION['rand'] ?>"></script>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/tmpl/fast_login.php';
    //header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    //location_href('/');
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Докумнтация</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body style="display: flex;flex-direction: column;height:98vh;margin: 0;padding: 0;">
        <div class="container-fluid h-100">
            <div class="row h-100" >
                <div class="col-2">
                    <h3>Меню</h3>
                    <p><a href="items/index.html" target="iframe_a">Главная</a></p>
                    <p><a href="items/login.html" target="iframe_a">Логин</a></p>
                    <p>Товары</p>
                    <p><a href="items/statistik.html" target="iframe_a">Статистика</a></p>
                    <p><a href="items/consultation.html" target="iframe_a">Консультации</a></p>
                    <p><a href="items/pays.html" target="iframe_a">Покупки</a></p>
                    <p><a href="items/products.html" target="iframe_a">Продукты</a></p>
                    <p><a href="items/wares.html" target="iframe_a">Товары</a></p>
                    <p>Сайт</p> 
                    <p><a href="items/pages.html" target="iframe_a" style="font-weight: bold;">Страницы сайта</a></p>
                    <p><a href="items/menu.html" target="iframe_a">Меню</a></p>
                    <p><a href="items/users.html" target="iframe_a">Пользователи</a></p>
                    <p><a href="items/themes.html" target="iframe_a">Шаблоны</a></p>
                    <p>Настройки</p>
                    <p><a href="items/configs.html" target="iframe_a">Настройки сайта</a></p>
                    <p><a href="items/config_email.html" target="iframe_a">Почтовые оповещения</a></p>
                </div>
                <div class="col-10 h-100">
                    <iframe src="items/index.html" name="iframe_a" class="w-100 h-100" style="border: none;"></iframe>
                </div>
            </div>
        </div>
    </body>
</html>
