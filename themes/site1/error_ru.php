<!DOCTYPE html>
<html lang="ru">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $_SESSION['site_title'] ?></title>
        <meta name="description" content="<?= $_SESSION['page']['info']['description'] ?>" />
        <link href="/favicon.ico<?= $_SESSION['rand'] ?>" rel="icon">
        <meta name="google-site-verification" content="Sozz79bTt3VOI21yJOn4xH2czaki3n7psELbIxXdI34" />
        <meta name="interkassa-verification" content="777d8a842d5f8a07fe433d7f9e9537fd" />
        <?= $_SESSION['noindex'] ?>

        <!-- SLEEK CSS -->
        <link rel="stylesheet" href="/themes/site1/css/plugins.css<?= $_SESSION['rand'] ?>">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="/assets/css/fontawesome/css/fontawesome.min.css<?= $_SESSION['rand'] ?>"> 
        <link rel="stylesheet" href="/assets/css/fontawesome/css/brands.min.css<?= $_SESSION['rand'] ?>"> 
        <link rel="stylesheet" href="/assets/css/fontawesome/css/all.min.css<?= $_SESSION['rand'] ?>"> 

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css<?= $_SESSION['rand'] ?>">
        <link href="/assets/plugins/daterangepicker/daterangepicker.css<?= $_SESSION['rand'] ?>" rel="stylesheet" />

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,600;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Overpass+Mono&display=swap" rel="stylesheet">

        <!-- bootstrap CSS -->
        <link rel="stylesheet" href="/assets/plugins/bootstrap5/css/bootstrap.min.css<?= $_SESSION['rand'] ?>">
        <link rel="stylesheet" href="/themes/site1/css/style.css<?= $_SESSION['rand'] ?>">
        <link rel="stylesheet" href="/assets/css/edit.css<?= $_SESSION['rand'] ?>">

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
        <link href="/assets/plugins/video/css/videojs.css<?= $_SESSION['rand'] ?>" rel="stylesheet">

        <script type="text/javascript" src="/assets/plugins/mixitup/mixitup.js<?= $_SESSION['rand'] ?>"></script>
        <script type="text/javascript" src="/assets/js/init.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/js/cart.js<?= $_SESSION['rand'] ?>"></script>  
        <script type="text/javascript" src="/assets/plugins/lazyload/lazyload.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/video/videojs.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/video/Youtube.js<?= $_SESSION['rand'] ?>"></script>
        <?= $config->getConfigParam('yandex_metrika') ?>

    </head>    
    <body data-spy="scroll" data-target=".navbar" data-offset="90" style="background-color: #FFFFFF;">

        <?= $config->getConfigParam('site_development') ?>

        <?= $_SESSION['message']['text'] ?>

        <?
        include $_SERVER['DOCUMENT_ROOT'] . '/extension/topmenu/index.php';
        ?>
        <div class="error_page_bg">
            <object class="svg_objects" type="image/svg+xml" data="/themes/site1/images/ez_site_bg404.svg" width="0px" height="0px" ></object>
            <object class="svg_objects" type="image/svg+xml" data="/themes/site1/images/ez_site_edgard404.svg" width="0px" height="0px" ></object>

            <div class="container">
                <div class="error_page_text_404">
                    <div class="error_line_text1">Страница</div>
                    <div class="error_line_text2">404</div>
                </div>
                <div class="error_page_edgard404">
                    <div class="error_page_edgard404_line">
                        <div class="error_page_edgard404_line_text">
                            <div>Добрая душа,</div>
                            <div>Такой страницы нет</div>
                        </div>
                        <object class="" type="image/svg+xml" data="/themes/site1/images/ez_site_line404.svg" width="70px" height="70px" ></object>
                    </div>
                    <div>
                        <object type="image/svg+xml" data="/themes/site1/images/ez_site_edgard404.svg" class="error_page_edgard404_img"></object>
                    </div>
                </div>
            </div>
        </div>

        <?
        include 'footer_' . $_SESSION['lang'] . '.php'
        ?>

        <!--Bootstrap Core-->
        <script src="/themes/site1/js/popper.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/themes/site1/js/bootstrap.min.js<?= $_SESSION['rand'] ?>"></script>

        <!--to view items on reach-->
        <script src="/themes/site1/js/jquery.appear.js<?= $_SESSION['rand'] ?>"></script>

        <!--Equal-Heights-->
        <script src="/themes/site1/js/jquery.matchHeight-min.js<?= $_SESSION['rand'] ?>"></script>

        <!--Owl Slider-->
        <script src="/themes/site1/js/owl.carousel.min.js<?= $_SESSION['rand'] ?>"></script>

        <!--number counters-->
        <script src="/themes/site1/js/jquery-countTo.js<?= $_SESSION['rand'] ?>"></script>

        <!--Parallax Background-->
        <script src="/themes/site1/js/parallaxie.js<?= $_SESSION['rand'] ?>"></script>

        <!--Cubefolio Gallery-->
        <script src="/themes/site1/js/jquery.cubeportfolio.min.js<?= $_SESSION['rand'] ?>"></script>

        <!--FancyBox popup-->
        <script src="/themes/site1/js/jquery.fancybox.min.js<?= $_SESSION['rand'] ?>"></script>       

        <!-- Video Background-->
        <script src="/themes/site1/js/jquery.background-video.js<?= $_SESSION['rand'] ?>"></script>

        <!--TypeWriter-->
        <script src="/themes/site1/js/typewriter.js<?= $_SESSION['rand'] ?>"></script> 

        <!--Particles-->
        <script src="/themes/site1/js/particles.min.js<?= $_SESSION['rand'] ?>"></script>            

        <!--WOw animations-->
        <script src="/themes/site1/js/wow.min.js<?= $_SESSION['rand'] ?>"></script>

        <script src="/assets/plugins/daterangepicker/moment.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/daterangepicker/daterangepicker.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/select2/js/select2.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/jquery-mask-input/jquery.mask.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/js/ajax.js<?= $_SESSION['rand'] ?>"></script>   
        <script src="/extension/products/js/products.js<?= $_SESSION['rand'] ?>"></script>

        <!--Google Map API-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJnKEvlwpyjXfS_h-J1Cne2fPMqeb44Mk"></script>
        <script src="/themes/site1/js/functions.js<?= $_SESSION['rand'] ?>"></script>	
        <?
        foreach ($_SESSION['body_javascript'] as $js) {
            echo $js . "\n";
        }
        ?>
    </body>
</html>
