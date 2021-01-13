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

        <?php
        /*
        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({'gtm.start':
                            new Date().getTime(), event: 'gtm.js'});
                var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-NVPSKXJ');</script>
        <!-- End Google Tag Manager -->
        */
        ?>
        <!-- SLEEK CSS -->
        <link id="sleek-css" rel="stylesheet" href="/assets/css/sleek.css<?= $_SESSION['rand'] ?>" />
        <link rel="stylesheet" href="/themes/site1/css/plugins.css<?= $_SESSION['rand'] ?>">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css<?= $_SESSION['rand'] ?>" 
              integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" 
              crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css<?= $_SESSION['rand'] ?>">
        <link rel="stylesheet" href="/themes/site1/css/style.css<?= $_SESSION['rand'] ?>">
        <link href="/assets/plugins/daterangepicker/daterangepicker.css<?= $_SESSION['rand'] ?>" rel="stylesheet" />

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
        <script type="text/javascript" src="/assets/js/init.js?v=<?= rand() ?>"></script>
        <script src="/assets/js/ajax.js?v=<?= rand() ?>"></script>   
        <script type="text/javascript" src="/assets/plugins/lazyload/lazyload.min.js<?= $_SESSION['rand'] ?>"></script>
    </head>  
    <body data-spy="scroll" data-target=".navbar" data-offset="90" style="background-color: #FFFFFF;">
        <?
        /*
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NVPSKXJ"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
         */
        ?>        
        <?= $config->getConfigParam('site_development1') ?>
        <!--PreLoader-->
        <!--
        <div class="loader">
            <div class="loader-inner">
                <div class="loader-blocks">
                    <span class="block-1"></span>
                    <span class="block-2"></span>
                    <span class="block-3"></span>
                    <span class="block-4"></span>
                    <span class="block-5"></span>
                    <span class="block-6"></span>
                    <span class="block-7"></span>
                    <span class="block-8"></span>
                    <span class="block-9"></span>
                    <span class="block-10"></span>
                    <span class="block-11"></span>
                    <span class="block-12"></span>
                    <span class="block-13"></span>
                    <span class="block-14"></span>
                    <span class="block-15"></span>
                    <span class="block-16"></span>
                </div>
            </div>
        </div>
        -->
        <!--PreLoader Ends-->

        <?= $_SESSION['page']['block_top'] ?>

<!--
        <div class="row">
            <div class="col-12 mt-5 mb-5"></div>
        </div>
        <div class="row">
            <div class="col-12 mt-4 mb-5"></div>
        </div>
        <div class="row mt-5 mb-5 d-block d-lg-none"> 
            <div class="col-12 mt-5 mb-5"></div>
        </div>
-->
        

        <?= $_SESSION['page']['block_center'] ?>





        <!--Site Footer Here-->
        <footer id="site-footer" class="padding_half" style="background-color: #000000;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <span class="font-weight-bold text-white">МОИ КОНТАКТЫ</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div style="color: #bbbbbb; font-size: 15px;">
                                    <i class="fa fa-life-ring"></i><a href="https://edgardzaitsev.com/contact" class="ml-2">Техническая поддержка</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <p style="color: #bbbbbb; font-size: 15px;">
                                    <i class="fa fa-envelope"></i><a href="" class="link_ed_mailto ml-2"></a>

                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <p style="color: #bbbbbb; font-size: 15px;">
                                    <i class="fa fa-map-marker"></i> <span class="ml-2">г. Комсомольск-на-Амуре,<br> ул. Вокзальная, 49, оф. 1006</span>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <p style="color: #bbbbbb; font-size: 15px;">
                                    Пользуйтесь мобильным приложением
                                    <br><b>"Эдгард Зайцев. Сам себе психолог"</b>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <a href="https://apps.apple.com/us/app/эдгард-зайцев/id1468250750" target="_blank" rel="noopener noreferrer">
                                    <img src="https://storage.yandexcloud.net/cdn.edgardzaitsev.com/wp-content/uploads/2019/07/download_app.png" width="97" height="30">
                                </a>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <a href="https://play.google.com/store/apps/details?id=ru.dvfx.edgardzaitsev" target="_blank" rel="noopener noreferrer">
                                    <img src="https://storage.yandexcloud.net/cdn.edgardzaitsev.com/wp-content/uploads/2019/07/download_google-300x99.png" width="97" height="30">
                                </a>
                            </div>
                        </div>
                        <!--
                        <ul class="social-icons bottom25 wow fadeInUp" data-wow-delay="300ms">
                            <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i> </a> </li>
                            <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i> </a> </li>
                            <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i> </a> </li>
                            <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i> </a> </li>
                            <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i> </a> </li>
                            <li><a href="javascript:void(0)"><i class="fa fa-envelope-o"></i> </a> </li>
                        </ul>
                        <p class="copyrights wow fadeInUp" data-wow-delay="350ms"> &copy; 2019 XeOne. made with love by <a href="http://www.themesindustry.com/" target="_blank">themesindustry</a> </p>
                        -->
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <span class="font-weight-bold text-white">СОЦИАЛЬНЫЕ СЕТИ</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <a class="facebook hasTooltip" href="https://www.facebook.com/profile.php?id=100002017651033" target="_self">
                                    <i class="fa fa-facebook rounded-circle"></i><span class="ml-3">Facebook</span>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <a class="dribbble hasTooltip" href="https://ok.ru/edgardzaitsev" target="_self">
                                    <i class="fa fa-dribbble rounded-circle"></i><span class="ml-3">Одноклассники</span>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <a class="pinterest hasTooltip" href="https://vm.tiktok.com/J1kKUEL/" target="_self">
                                    <i class="fa fa-pinterest rounded-circle"></i><span class="ml-3">Tik-Tok</span>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <a class="instagram hasTooltip" href="http://instagram.com/edgard_zaycev" target="_self">
                                    <i class="fa fa-instagram rounded-circle"></i><span class="ml-3">Instagram</span>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <a class="youtube hasTooltip" href="https://www.youtube.com/user/zaiaz67" target="_self">
                                    <i class="fa fa-youtube rounded-circle"></i><span class="ml-3">Youtube</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <span class="font-weight-bold text-white">ПОДПИСАТЬСЯ НА НОВОСТИ</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <a href="https://t.me/edgardzaitsev_channel">
                                    <img class="alignnone size-full wp-image-421776" src="https://download.edgardzaitsev.com/wp-content/uploads/2020/09/tgg-4.jpg" alt="" width="190" height="70">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
        <!--Footer ends-->   




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

        <!--Revolution SLider-->
        <script src="/themes/site1/js/revolution/jquery.themepunch.tools.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/themes/site1/js/revolution/jquery.themepunch.revolution.min.js<?= $_SESSION['rand'] ?>"></script>
        <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
        <script src="/themes/site1/js/revolution/extensions/revolution.extension.actions.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/themes/site1/js/revolution/extensions/revolution.extension.carousel.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/themes/site1/js/revolution/extensions/revolution.extension.kenburn.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/themes/site1/js/revolution/extensions/revolution.extension.layeranimation.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/themes/site1/js/revolution/extensions/revolution.extension.migration.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/themes/site1/js/revolution/extensions/revolution.extension.navigation.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/themes/site1/js/revolution/extensions/revolution.extension.parallax.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/themes/site1/js/revolution/extensions/revolution.extension.slideanims.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/themes/site1/js/revolution/extensions/revolution.extension.video.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/daterangepicker/moment.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/daterangepicker/daterangepicker.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/select2/js/select2.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/jquery-mask-input/jquery.mask.min.js<?= $_SESSION['rand'] ?>"></script>


        <!--Google Map API-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJnKEvlwpyjXfS_h-J1Cne2fPMqeb44Mk"></script>
        <script src="/themes/site1/js/functions.js<?= $_SESSION['rand'] ?>"></script>	
        <?
        foreach ($_SESSION['body_javascript'] as $js) {
            echo $js . "\n";
        }
        ?>
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $(".link_ed_mailto").attr("href", "mailto:<?= $config->getConfigParam('link_ed_mailto') ?>");
                    $(".link_ed_mailto").html("<?= $config->getConfigParam('link_ed_mailto') ?>");
                }, 2000);
            });
        </script>
    </body>
</html>
