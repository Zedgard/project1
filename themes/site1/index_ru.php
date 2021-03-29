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
        <script type="text/javascript" src="/assets/plugins/lazyload/lazyload.min.js<?= $_SESSION['rand'] ?>"></script>
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



        <!--Main Slider-->
        <!--     
        -->
        <style>
            .carousel {
                height: 40rem !important;
                overflow: hidden;
            }
            .carousel-inner {
                overflow: visible;
            }
            .carousel-inner img {
                left: 50%;
                width: 100%;
                max-width: none !important;
                min-height: 60rem;
                min-width: 100%;
                position: absolute;
                top: 20rem;
                transform: translate(-50%,-50%);
            }
            .carousel-inner video {
                left: 50%;
                width: 100%;
                max-width: none !important;
                min-height: 40rem;
                min-width: 100%;
                position: absolute;
                top: 10rem;
                transform: translate(-50%,-50%);
            }
            .carousel-inner .video {
                left: 50%;
                width: 100%;
                max-width: none !important;
                min-height: 30rem;
                min-width: 100%;
                position: absolute;
                top: 30rem;
                transform: translate(-50%,-50%);
            }
            @media (max-width: 682px) {

                .carousel {
                    height: 40rem !important;
                    overflow: hidden;
                }
                .carousel-inner img {
                    left: 50%;
                    width: 180%;
                    max-width: none !important;
                    min-height: 36rem;
                    min-width: 180%;
                    position: absolute;
                    top: 16rem;
                    transform: translate(-50%,-50%);
                }
                .carousel-inner video {
                    left: 50%;
                    width: 185%;
                    max-width: none !important;
                    min-height: 50rem;
                    min-width: 185%;
                    position: absolute;
                    top: 17rem;
                    transform: translate(-50%,-50%);
                }
                .carousel-inner .video {
                    left: 60%;
                    width: 130%;
                    max-width: none !important;
                    min-height: 60rem;
                    min-width: 130%;
                    position: absolute;
                    top: 20rem;
                    transform: translate(-50%,-50%);
                }

            }
        </style>


        <div id="carouselEdgardCaptions" class="carousel slide carousel-fade" data-ride="carousel" >
            <ol class="carousel-indicators">
                <li type="button" data-bs-target="#carouselEdgardCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></li>
                <li type="button" data-bs-target="#carouselEdgardCaptions" data-bs-slide-to="1" aria-label="Slide 2"></li>
                <li type="button" data-bs-target="#carouselEdgardCaptions" data-bs-slide-to="2" aria-label="Slide 3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item carousel-item-next carousel-item-left" data-interval="50000">
                    <!--
                    <object width="100%" class="d-block w-100 video">
                        <param name="movie" value="https://www.youtube.com/embed/ovf26Ujm_Ds?controls=0&disablekb=0&iv_load_policy=0&mute=1&loop=1&enablejsapi=0&autoplay=1&modestbranding=0&rel=0&showinfo=0"/>
                        <param name="allowFullScreen" value="true"/>
                        <param name="allowscriptaccess" value="always"/>
                        <embed width="100%" height="360" src="https://www.youtube.com/embed/ovf26Ujm_Ds?controls=0&disablekb=0&iv_load_policy=0&mute=1&loop=1&enablejsapi=0&&autoplay=1&modestbranding=0&rel=0&showinfo=0" class="youtube-player" type="text/html" allowscriptaccess="always" allowfullscreen="true"/>
                    </object>
                    -->
                    <video class="d-block w-100 carousel-video" data-holder-rendered="true" autoplay loop muted>
                        <source src="/themes/site1/video/video-slide.mp4" type="video/mp4">
                        <source src="/themes/site1/video/video-slide.webm" type="video/webm"> 
                        <source src="/themes/site1/video/video-slide.ogv" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                    <!--
                    <img class="d-block w-100" data-src="/themes/site1/images/transparent.png" src="/themes/site1/images/slider_banner 2.jpg" data-holder-rendered="true">
                    -->
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </div>
                </div>
                <div class="carousel-item" data-interval="50000">
                    <!--
                    <video class="d-block w-100 carousel-video" data-holder-rendered="true" autoplay loop muted>
                        <source src="/themes/site1/video/video-slide.mp4" type="video/mp4">
                        <source src="/themes/site1/video/video-slide.webm" type="video/webm"> 
                        <source src="/themes/site1/video/video-slide.ogv" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                    -->
                    <img class="d-block w-100" data-src="/themes/site1/images/slider_banner 2.jpg" src="/themes/site1/images/slider_banner 2.jpg" data-holder-rendered="true">

                   <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->


                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>

                </div>
                <div class="carousel-item active carousel-item-left" data-interval="50000">
                    <img class="d-block w-100" data-src="/themes/site1/images/slider_banner 2.jpg" src="/themes/site1/images/slider_banner 2.jpg" data-holder-rendered="true">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" type="button" data-bs-target="#carouselEdgardCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <a class="carousel-control-next" type="button" data-bs-target="#carouselEdgardCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
        </div>

        <!--Main Slider ends -->


        <?= $_SESSION['page']['block_center'] ?>



        <section id="funfacts" class="padding_top fact-iconic gradient_bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-12 margin_bottom text-md-left text-center wow fadeInLeft" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInLeft;">
                        <h3 class="bottom25" style="font-size: 36px;">Опыт нашей команды в цифрах</h3>
                        <p class="title">Наша команда высококвалифицированных профессионалов широко зарекомендовала себя за десять лет работы.</p>
                    </div>
                    <div class="col-md-7 col-sm-12 text-center">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 icon-counters margin_bottom  wow fadeInRight" data-wow-delay="400ms" style="visibility: visible; animation-delay: 400ms; animation-name: fadeInRight;text-align: center;">
                                <div class="img-icon bottom15">
                                    <!--<i class="fa fa-smile-o"></i>--> 
                                    <img src="/assets/img/mental-health.svg" style="width: 60px;"/>

                                </div>
                                <p class="title">более</p>
                                <div class="counters">
                                    <span class="count_nums" data-to="900" data-speed="3000">900</span> <i class="fa fa-plus"></i>
                                </div>
                                <p class="title">Консультаций в год</p>
                            </div>
                            <div class="col-md-4 col-sm-4 icon-counters margin_bottom wow fadeInRight" data-wow-delay="350ms" style="visibility: visible; animation-delay: 350ms; animation-name: fadeInRight;">
                                <div class="img-icon bottom15">
                                    <!-- <i class="fa fa-language"> </i>-->
                                    <img src="/assets/img/positive-thinking.svg" style="width: 60px;"/>
                                </div>
                                <p class="title">более</p>
                                <div class="counters">
                                    <span class="count_nums" data-to="20000" data-speed="2500">20000</span> <i class="fa fa-plus"></i>
                                </div>
                                <p class="title">Счастливых клиентов</p>
                            </div>
                            <div class="col-md-4 col-sm-4 icon-counters margin_bottom wow fadeInRight" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInRight;">
                                <div class="img-icon bottom15">
                                    <!--<i class="fa fa-desktop"></i>-->
                                    <img src="/assets/img/award.svg" style="width: 60px;"/>
                                </div>
                                <p class="title">более</p>
                                <div class="counters">
                                    <span class="count_nums" data-to="7" data-speed="3000">7</span> <i class="fa fa-plus"></i>
                                </div>
                                <p class="title">Книг и более 20 статей написано</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>






        <!-- Testimonials -->
        <section id="our-testimonial" class="padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center">
                        <div class="heading-title bottom30 wow fadeInUp" data-wow-delay="300ms">
                            <h2 class="TestimonialsTitle">Отзывы счастливых людей</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div id="testimonial-slider" class="owl-carousel">
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-58-47.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Виктория Сборовская</h4>
                                    <small class="defaultcolor" style="display: none;">Бизнес-вумен</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-58-50.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5 " style="display: none;">Адам Сендлер</h4>
                                    <small class="defaultcolor" style="display: none;">Менеджер</small>
                                </div>
                            </div>
                            <div class="item h-100 d-inline-block">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-58-53.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-58-56.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Виктория Сборовская</h4>
                                    <small class="defaultcolor" style="display: none;">Бизнес-вумен</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-58-59.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Адам Сендлер</h4>
                                    <small class="defaultcolor" style="display: none;">Менеджер</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-59-01.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-59-03.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Виктория Сборовская</h4>
                                    <small class="defaultcolor" style="display: none;">Бизнес-вумен</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-59-05.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Адам Сендлер</h4>
                                    <small class="defaultcolor" style="display: none;">Менеджер</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-59-08.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-59-10.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-59-14.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-59-16.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-59-18.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-26_11-59-20.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-28_16-05-53.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-28_16-06-14.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="testimonial-wrapp2 scroll-block">
                                            <img src="/assets/files/image/comments/photo_2021-03-28_16-06-18.jpg"/>
                                        </p>
                                    </div>
                                    <h4 class="darkcolor mt-5" style="display: none;">Людмила Казакова</h4>
                                    <small class="defaultcolor" style="display: none;">Счастливая жена</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Testimonials Ends-->

        <?
        include 'footer_' . $_SESSION['lang'] . '.php'
        ?>

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
    </body>
</html>
