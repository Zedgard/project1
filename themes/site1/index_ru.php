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
        <meta name="facebook-domain-verification" content="vc6skm5viu4tp16daw2a6q7arju3kx" />
        <?= $_SESSION['noindex'] ?>

        <!-- SLEEK CSS -->
        <link rel="stylesheet" href="/themes/site1/css/plugins.css<?= $_SESSION['rand'] ?>">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">
        <link href="/assets/fonts/SkolarPE/stylesheet.css<?= $_SESSION['rand'] ?>" rel="stylesheet">

        <link href="/themes/site1/css/fonts.css<?= $_SESSION['rand'] ?>" rel="stylesheet">

        <link rel="stylesheet" href="/assets/css/fontawesome/css/fontawesome.min.css<?= $_SESSION['rand'] ?>"> 
        <link rel="stylesheet" href="/assets/css/fontawesome/css/brands.min.css<?= $_SESSION['rand'] ?>"> 
        <link rel="stylesheet" href="/assets/css/fontawesome/css/all.min.css<?= $_SESSION['rand'] ?>"> 
        <link rel="stylesheet" href="/assets/css/fontawesome/css/regular.min<?= $_SESSION['rand'] ?>">
        <link rel="stylesheet" href="/assets/css/fontawesome/css/solid.min<?= $_SESSION['rand'] ?>">
        <link rel="stylesheet" href="/assets/css/fontawesome/css/svg-with-js.min<?= $_SESSION['rand'] ?>">
        <link rel="stylesheet" href="/assets/css/fontawesome/css/v4-shims.min<?= $_SESSION['rand'] ?>">


        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css<?= $_SESSION['rand'] ?>">
        <link href="/assets/plugins/daterangepicker/daterangepicker.css<?= $_SESSION['rand'] ?>" rel="stylesheet" />

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,600;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Overpass+Mono&display=swap" rel="stylesheet">

        <!-- bootstrap CSS -->
        <link rel="stylesheet" href="/assets/plugins/bootstrap5/css/bootstrap.min.css<?= $_SESSION['rand'] ?>">
        <link rel="stylesheet" href="/assets/plugins/bootslider/css/bootslider.css<?= $_SESSION['rand'] ?>">
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
        <script async="async" type="text/javascript" src="/assets/plugins/lazyload/lazyload.min.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/video/videojs.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/plugins/video/Youtube.js<?= $_SESSION['rand'] ?>"></script>
        <?= $config->getConfigParam('yandex_metrika') ?>

    </head>  
    <body data-spy="scroll" data-target=".navbar" data-offset="90" style="background-color: #FFFFFF;">

        <?= $config->getConfigParam('site_development') ?>

        <?= $_SESSION['message']['text'] ?>

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




        <div class="bootslider m-0 p-0" id="bootslider">
            <!-- Bootslider Loader -->
            <div class="bs-loader">
                <img src="/assets/img/ajax_load_2.svg" width="31" height="31" alt="Loading.." id="loader"/>
            </div>
            <!-- /Bootslider Loader -->

            <!-- Bootslider Container -->
            <div class="bs-container">


                <!-- Bootslider Slide -->
                <div class="bs-slide active" data-animate-in="flipInX" data-animate-out="holeOut">
                    <div class="bs-foreground">
                        <div class="container h-100">
                            <div class="row h-100">
                                <div class="col h-100 d-flex align-items-end"> 
                                    <img src="/assets/files/image/banner_index/edgard.png" class="m-auto m-lg-0 mb-0 " style="width: 75%;"
                                         data-animate-in="fadeInRightBig" data-animate-out="fadeOutRightBig" data-delay="400"
                                         />
                                </div> 
                                <div class="col d-flex justify-content-center">
                                    <div class="bs-vertical-center text-center ">
                                        <div 
                                            data-animate-in="fadeInRight" data-animate-out="fadeOutUpBig" data-delay="1600">
                                            <div class="text-white font_2">ОНЛАЙН-КОНСУЛЬТАЦИИ</div>
                                            <div class="text-white font_26" style="font-weight: bold;">
                                                ЭДГАРДА ЗАЙЦЕВА
                                            </div>
                                            <div class="subheading skolar mt-2 mt-lg-3 font_26" style="color: #ffe36e;">
                                                РЕЗУЛЬТАТ<br/>
                                                С ПЕРВОЙ<br/>
                                                КОНСУЛЬТАЦИИ
                                            </div>
                                            <div class="mt-2 mt-lg-3">
                                                <a href="/consultations/" class="btn btn-warning btn_slider_link_consultations">ПОЛУЧИТЬ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bs-background">

                        <img src="/assets/files/image/banner_index/consult_bg.jpg" alt="" />
                    </div>
                </div>
                <!-- /Bootslider Slide -->

                <!-- Bootslider Slide -->
                <div class="bs-slide active" data-animate-in="flipInX" data-animate-out="holeOut">
                    <div class="bs-foreground">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="bs-vertical-center">

                                    </div>
                                </div> 
                                <div class="col d-flex justify-content-center">
                                    <div class="bs-vertical-center text-center ">
                                        <div>
                                            <div class="">
                                                <img src="/assets/files/image/banner_index/exam_text1.png" style="width: 80%;"
                                                     data-animate-in="fadeInRight" data-animate-out="fadeOutUpBig" data-delay="400"
                                                     />
                                            </div>
                                            <div class="">
                                                <img src="/assets/files/image/banner_index/exam_text2.png" style="width: 80%;"
                                                     data-animate-in="fadeInRight" data-animate-out="fadeOutUpBig" data-delay="800"
                                                     >
                                            </div>
                                            <div class="mt-2 mt-lg-3">
                                                <a href="/shop/?product=4634" 
                                                   data-animate-in="fadeInRight" data-animate-out="fadeOutUpBig" data-delay="1400"
                                                   class="btn btn-warning btn_slider_link_exam">ПОЛУЧИТЬ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bs-background">

                        <img src="/assets/files/image/banner_index/exam_bg.jpg" alt="" class="exam_bg" />
                    </div>
                </div>
                <!-- /Bootslider Slide -->





                <!-- Bootslider Slide -->

                <div class="bs-slide active" data-animate-in="bounceInUp" data-animate-out="hinge">
                    <div class="bs-foreground">
                        <div class="container h-100">
                            <div class="row h-100">
                                <div class="col d-flex align-items-end text-center">
                                    <a href="/shop/?product=4610" class="btn btn-warning btn_slider_link_keise"
                                       data-animate-in="fadeInRight" data-animate-out="fadeOutUpBig" data-delay="1400">ПОЛУЧИТЬ</a>
                                </div> 
                                <div class="col">

                                </div> 
                                <div class="col">

                                </div> 
                                <div class="col  justify-content-center">
                                    <div class="bs-vertical-center text-center ">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bs-background">
                        <div class="slider_text_keise bs-layer"
                             <div class="slider_text_keise bs-layer"  
                             data-animate-in="fadeInLeftBig" data-animate-out="fadeOutLeftBig" data-delay="600"
                             data-width="400" data-height="300" data-left="290" data-bottom="0" data-top="90">
                            КЕЙС
                        </div>
                        <img src="/assets/files/image/banner_index/hbd_2.png" class="bs-layer"
                             data-animate-in="fadeInLeftBig" data-animate-out="fadeOutLeftBig" data-delay="600"
                             data-width="400" data-height="300" data-left="150" data-bottom="0" data-top="200"/>
                        <img src="/assets/files/image/banner_index/nbd_bg.jpg" alt="" />
                        <img src="/assets/files/image/banner_index/flakes_bg.png" class="bs-layer" 
                             data-animate-in="fadeInRightBig" data-animate-out="fadeOutRightBig" data-delay="300"
                             data-width="100%" data-height="100%" data-bottom="0" />
                    </div>
                </div>

                <!-- /Bootslider Slide -->


                <!-- Bootslider Slide -->

                <div class="bs-slide active" data-animate-in="bounceInUp" data-animate-out="hinge">
                    <div class="bs-foreground">
                        <div class="container text-center h-100">
                            <div class="row mt-4 mt-lg-5">
                                <div class="col">
                                    <img src="/assets/files/image/banner_index/club_text_top.png" style="width: 100%;"
                                         data-animate-in="fadeInLeftBig" data-animate-out="fadeOutLeftBig" data-delay="600"
                                         />
                                </div> 
                                <div class="col"></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <img src="/assets/files/image/banner_index/club_text.png" style="width: 100%;margin-left: 9%;"
                                         data-animate-in="fadeInLeftBig" data-animate-out="fadeOutLeftBig" data-delay="900"
                                         />
                                </div> 
                                <div class="col"></div>
                            </div>
                            <div class="row mt-2 h-100">
                                <div class="col">
                                    <div>
                                        <a href="https://edgardzaycev.ru/club" target="_blank" class="btn btn-warning btn_slider_link_club"
                                           data-animate-in="fadeInLeftBig" data-animate-out="fadeOutLeftBig" data-delay="1200">ПРИСОЕДИНИТЬСЯ</a>
                                    </div>
                                </div> 
                                <div class="col  justify-content-center">
                                    <div class="bs-vertical-center text-center "></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bs-background">


                        <img src="/assets/files/image/banner_index/club_bg.jpg" alt="" />

                    </div>
                </div>

                <!-- /Bootslider Slide -->

                <?php /*
                  <!-- Bootslider Slide -->
                  <!--
                  <div class="bs-slide" data-animate-in="bounceInUp" data-animate-out="hinge">
                  <div class="bs-foreground">
                  <div class="container">
                  <div class="row" data-animate-in="fadeInLeftBig" data-delay="1000" data-animate-out="fadeOutDown">
                  <div class="col-md-12">
                  <h1 class="heading">BOOTSLIDER</h1>
                  <p class="subheading text-white">SIMPLY LOVES BOOTSTRAP</p>
                  <p>
                  <a class="btn btn-primary" href="http://codecanyon.net/item/bootslider-responsive-bootstrap-css3-slider/6477433?ref=AlexGrozav">BUY NOW</a>
                  </p>
                  </div>
                  </div>
                  </div>
                  </div>
                  <div class="bs-background">
                  <img src="/themes/site1/images/slider_banner 2.jpg"
                  data-animate-in="fadeInUpBig" data-animate-out="fadeLeftDownBig" class="bs-layer"
                  data-width="683" data-height="302" data-left="342" data-bottom="100"/>
                  <img src="/themes/site1/images/slider_banner 2.jpg"
                  data-animate-in="fadeInLeftBig" data-animate-out="fadeInDownBig" class="bs-layer"
                  data-width="442" data-height="273" data-left="382" data-bottom="0" data-delay="1200"/>
                  <img src="/themes/site1/images/slider_banner 2.jpg" alt="" />
                  </div>
                  </div>
                  -->
                  <!-- /Bootslider Slide -->

                  <!-- Bootslider Slide -->
                  <!--
                  <div class="bs-slide" data-animate-in="bounceInDown" data-animate-out="flipOutX">
                  <div class="bs-foreground">
                  <div class="container">
                  <div class="row">
                  <div class="col-md-12 text-center">
                  <div data-animate-in="tada" data-animate-out="fadeOutUpBig" data-delay="2000">
                  <h1 class="heading">
                  BOOTSLIDER
                  </h1>
                  <h2 class="subheading text-white">
                  ABSOLUTELY RESPONSIVE
                  </h2>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>
                  <div class="bs-background">
                  <img src="img/slide-2-layer-4.png" class="bs-layer"
                  data-animate-in="fadeInDown" data-animate-out="fadeOutUpBig" data-delay="2000"
                  data-width="775" data-height="473" data-right="125" data-top="243"/>
                  <img src="img/slide-2-layer-1.png" class="bs-layer"
                  data-animate-in="fadeInDownBig" data-animate-out="fadeOutUpBig" data-delay="800"
                  data-width="922" data-height="532" data-left="237" data-top="174"/>
                  <img src="img/slide-2-layer-2.png" class="bs-layer"
                  data-animate-in="fadeInRightBig" data-animate-out="fadeOutUpBig" data-delay="1200"
                  data-width="208" data-height="410" data-right="322" data-top="276"/>
                  <img src="img/slide-2-layer-3.png" class="bs-layer"
                  data-animate-in="fadeInLeftBig" data-animate-out="fadeOutUpBig" data-delay="1600"
                  data-width="423" data-height="512" data-left="183" data-top="203"/>
                  <img src="img/slide-2.jpg" alt="" />
                  </div>
                  </div>
                  -->
                  <!-- /Bootslider Slide -->

                  <!-- Bootslider Slide -->
                  <!--
                  <div class="bs-slide" data-animate-in="rollIn" data-animate-out="flipOutX">
                  <div class="bs-foreground">
                  <div class="container">
                  <div class="row">
                  <div class="col-md-12">
                  <h1 class="heading"
                  data-animate-in="fadeInLeftBig" data-animate-out="fadeOutLeftBig" data-delay="800">
                  NOW LAYERED
                  </h1>
                  <h2 class="subheading text-white"
                  data-animate-in="fadeInLeftBig" data-animate-out="fadeOutLeftBig" data-delay="2000">
                  AND EVEN MORE AWESOME
                  </h2>
                  </div>
                  </div>
                  </div>
                  </div>
                  <div class="bs-background">
                  <img src="img/slide-3-layer-1.png" class="bs-layer"
                  data-animate-in="fadeInRightBig" data-animate-out="fadeOutLeftBig" data-delay="800"
                  data-width="854" data-height="508" data-left="82" data-top="200"/>
                  <img src="img/slide-3-layer-2.png" class="bs-layer"
                  data-animate-in="fadeInRightBig" data-animate-out="fadeOutLeftBig" data-delay="1200"
                  data-width="854" data-height="508" data-left="336" data-top="140"/>
                  <img src="img/slide-3-layer-3.png" class="bs-layer"
                  data-animate-in="fadeInRightBig" data-animate-out="fadeOutLeftBig" data-delay="1600"
                  data-width="854" data-height="508" data-right="23" data-top="95"/>
                  <img src="img/slide-3.jpg" alt="" />
                  </div>
                  </div>
                  -->
                  <!-- /Bootslider Slide -->

                  <!-- Bootslider Slide -->
                  <!--
                  <div class="bs-slide" data-animate-in="scaleUpIn" data-animate-out="scaleUpOut">
                  <div class="bs-background">
                  <img src="img/slide-5-layer-1.png" class="bs-layer"
                  data-animate-in="scaleDownIn" data-animate-out="fadeOutLeftBig" data-delay="800"
                  data-width="1440" data-height="720" data-right="0" data-top="0"/>
                  <div class="bs-layer"
                  data-width="894" data-height="510" data-left="282" data-top="85">
                  <div class="bs-video black" data-animate-in="fadeIn" data-delay="1500" data-animate-out="fadeOutLeftBig">
                  <iframe src="http://player.vimeo.com/video/79470878" width="500" height="285" frameborder="0" allowfullscreen></iframe>
                  </div>
                  </div>
                  <img src="img/slide-5.jpg" alt="" />
                  </div>
                  </div>
                  -->
                  <!-- /Bootslider Slide -->

                  <!-- Bootslider Slide -->
                  <!--
                  <div class="bs-slide" data-animate-in="openDownLeftReturn" data-animate-out="slideUp">
                  <div class="bs-foreground">
                  <div class="bs-video-fullscreen">
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/-qwevh0_bZY" data-bs-video-autoplay="true" frameborder="0" allowfullscreen></iframe>
                  </div>
                  </div>
                  <div class="bs-background">
                  <img src="img/slide-6.jpg" alt="" />
                  </div>
                  </div>
                  -->
                  <!-- /Bootslider Slide -->

                 */
                ?>

            </div>

            <!-- /Bootslider Container -->

            <!-- Bootslider Progress -->
            <div class="bs-progress progress">
                <div class="progress-bar progress-primary bg-warning"></div>
            </div>
            <!-- /Bootslider Progress -->

            <!-- Bootslider Thumbnails -->
            <div class="bs-thumbnails text-center text-turquoise">
                <ul class=""></ul>
            </div>
            <!-- /Bootslider Thumbnails -->

            <!-- Bootslider Pagination -->
            <div class="bs-pagination text-center text-turquoise">
                <ul class="pagination"></ul>
            </div>
            <!-- /Bootslider Pagination -->

            <!-- Bootslider Controls -->
            <div class="text-center">
                <div class="btn-group w-100 Bootslider_Controls">
                    <a href="javascript:void(0);" class="slider_btn_prev bs-prev wow fadeInLeft" style="animation-delay: 400ms; animation-name: fadeInLeft; visibility: visible;">&lt;</a>
                    <a href="javascript:void(0);" class="slider_btn_next bs-next wow fadeInRight" style="animation-delay: 400ms; animation-name: fadeInRight; visibility: visible;">&gt;</a>
                </div>
            </div>
            <!-- /Bootslider Controls -->

        </div>
        <script src="/assets/plugins/bootslider/jquery.grozav.plugins.min.js" type="text/javascript"></script>
        <script src="/assets/plugins/bootslider/jquery.grozav.bootslider.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                var slider = new bootslider('#bootslider', {
                    animationIn: "fadeInUp",
                    animationOut: "flipOutX",
                    timeout: 5000,
                    autoplay: true,
                    preload: false,
                    pauseOnHover: true,
                    thumbnails: false,
                    pagination: false,
                    mousewheel: false,
                    keyboard: true,
                    touchscreen: true,
                    layout: 'fixedheight-center',
                    canvas: {
                        width: 1440,
                        height: 800
                    }
                });
                slider.init();


            });
        </script>


        <!--Main Slider-->
        <!--     -->



        <?= $_SESSION['page']['block_center'] ?>



        <?
        include 'footer_' . $_SESSION['lang'] . '.php'
        ?>

        <?
        include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/promo/index.php';
        ?>

    </body>
    <!--Bootstrap Core-->
    <script src="/themes/site1/js/popper.min.js<?= $_SESSION['rand'] ?>"></script>
    <script src="/assets/plugins/bootstrap5/js/bootstrap.min.js<?= $_SESSION['rand'] ?>"></script>

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

</html>
