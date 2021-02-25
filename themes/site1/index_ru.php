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

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.css<?= $_SESSION['rand'] ?>">	

        <link rel="stylesheet" href="/themes/site1/css/style.css<?= $_SESSION['rand'] ?>">

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

        <script type="text/javascript" src="/assets/plugins/mixitup/mixitup.min.js<?= $_SESSION['rand'] ?>"></script>
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
        <video id="v0" class="d-block w-100" data-src="http://www.mokselle.ru/video/video-bg.mp4" src="http://www.mokselle.ru/video/video-bg.mp4" data-holder-rendered="true"></video>
                    
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


        <div id="carouselExampleCaptions" class="carousel slide  carousel-fade" data-ride="carousel" >
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2" class=""></li>
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
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <?php
        /*
          <div id="revo_main_wrapper" class="rev_slider_wrapper fullwidthbanner-container">
          <div id="banner-main" class="rev_slider" style="display:none;max-height: 600px;" data-version="5.4.1">
          <ul>
          <!-- SLIDE 1  id="banner-main" class="rev_slider fullwidthabanner"  -->
          <li data-index="rs-01" data-transition="fade" data-slotamount="default" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="2000" data-fsmasterspeed="1500" class="revo_slide_1 rev_gradient">

          <!-- MAIN IMAGE -->
          <img src="/themes/site1/images/transparent.png" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10"  data-no-retina>
          <!-- LAYER NR. 1 -->

          <div class="tp-caption tp-resizeme not_show_mobile caption_1"
          data-x="['center','center','center','center']" data-hoffset="['-240','0','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['10','0','0','0']"
          data-whitespace="nowrap" data-responsive_offset="on"
          data-width="['none','none','none','none']" data-type="text"
          data-textalign="['center','center','center','center']"
          data-transform_idle="o:1;"
          data-transform_in="x:-50px;opacity:0;s:2000;e:Power3.easeOut;"
          data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
          data-start="1000" data-splitin="none" data-splitout="none">
          <a href="/auth/" >
          <span class="button plitka_1 image hover-effect img-container"
          style="background-image: url(/assets/img/EZsite_button_Centr.svg);
          background-repeat: no-repeat;
          "
          ></span>
          </a>
          </div>

          <a href="#">
          <div class="tp-caption tp-resizeme not_show_mobile caption_2"
          data-x="['center','center','center','center']" data-hoffset="['250','0','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['10','0','0','0']"
          data-whitespace="nowrap" data-responsive_offset="on"
          data-width="['none','none','none','none']" data-type="text"
          data-textalign="['center','center','center','center']"
          data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
          data-start="1000" data-splitin="none" data-splitout="none">
          <span class="button plitka_2 image hover-effect img-container"
          style="background-image: url(/assets/img/EZsite_button_Centr.svg);
          background-repeat: no-repeat;
          "
          ></span>
          </div>
          </a>
          <a href="#">
          <div class="tp-caption tp-resizeme not_show_mobile caption_3"
          data-x="['center','center','center','center']" data-hoffset="['-240','0','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['220','0','0','0']"
          data-whitespace="nowrap" data-responsive_offset="on"
          data-width="['none','none','none','none']" data-type="text"
          data-textalign="['center','center','center','center']"
          data-transform_idle="o:1;"
          data-transform_in="x:-50px;opacity:0;s:2000;e:Power3.easeOut;"
          data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
          data-start="1000" data-splitin="none" data-splitout="none">

          <span class="button plitka_3 image hover-effect img-container"
          style="background-image: url(/assets/img/EZsite_button_Centr.svg);
          background-repeat: no-repeat;
          "
          ></span>
          </div>
          </a>
          <a href="#">
          <div class="tp-caption tp-resizeme not_show_mobile caption_4"
          data-x="['center','center','center','center']" data-hoffset="['250','0','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['220','0','0','0']"
          data-whitespace="nowrap" data-responsive_offset="on"
          data-width="['none','none','none','none']" data-type="text"
          data-textalign="['center','center','center','center']"
          data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
          data-start="1000" data-splitin="none" data-splitout="none">
          <span class="button plitka_4 image hover-effect img-container"
          style="background-image: url(/assets/img/EZsite_button_Centr.svg);
          background-repeat: no-repeat;
          "
          ></span>
          </div>
          </a>

          </li>
          <!-- SLIDE 2  -->
          <li data-index="rs-02" data-transition="fade" data-slotamount="default" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="2000" data-fsmasterspeed="1500" class="banner-overlay">
          <!-- MAIN IMAGE -->
          <img src="/themes/site1/images/slider_banner 2.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="7" data-no-retina>
          <!-- LAYER NR. 1 -->
          <!--
          <div class="tp-caption tp-resizeme not_show_mobile caption_1"
          data-x="['center','center','center','center']" data-hoffset="['-240','0','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['10','0','0','0']"
          data-whitespace="nowrap" data-responsive_offset="on"
          data-width="['none','none','none','none']" data-type="text"
          data-textalign="['center','center','center','center']"
          data-transform_idle="o:1;"
          data-transform_in="x:-50px;opacity:0;s:2000;e:Power3.easeOut;"
          data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
          data-start="1000" data-splitin="none" data-splitout="none">
          <a href="/auth/" >
          <span class="button plitka_1 image hover-effect img-container"
          style="background-image: url(/assets/img/EZsite_button_Centr.svg);
          background-repeat: no-repeat;
          "
          ></span>
          </a>
          </div>

          <a href="#">
          <div class="tp-caption tp-resizeme not_show_mobile caption_2"
          data-x="['center','center','center','center']" data-hoffset="['250','0','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['10','0','0','0']"
          data-whitespace="nowrap" data-responsive_offset="on"
          data-width="['none','none','none','none']" data-type="text"
          data-textalign="['center','center','center','center']"
          data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
          data-start="1000" data-splitin="none" data-splitout="none">
          <span class="button plitka_2 image hover-effect img-container"
          style="background-image: url(/assets/img/EZsite_button_Centr.svg);
          background-repeat: no-repeat;
          "
          ></span>
          </div>
          </a>
          <a href="#">
          <div class="tp-caption tp-resizeme not_show_mobile caption_3"
          data-x="['center','center','center','center']" data-hoffset="['-240','0','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['220','0','0','0']"
          data-whitespace="nowrap" data-responsive_offset="on"
          data-width="['none','none','none','none']" data-type="text"
          data-textalign="['center','center','center','center']"
          data-transform_idle="o:1;"
          data-transform_in="x:-50px;opacity:0;s:2000;e:Power3.easeOut;"
          data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
          data-start="1000" data-splitin="none" data-splitout="none">

          <span class="button plitka_3 image hover-effect img-container"
          style="background-image: url(/assets/img/EZsite_button_Centr.svg);
          background-repeat: no-repeat;
          "
          ></span>
          </div>
          </a>
          <a href="#">
          <div class="tp-caption tp-resizeme not_show_mobile caption_4"
          data-x="['center','center','center','center']" data-hoffset="['250','0','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['220','0','0','0']"
          data-whitespace="nowrap" data-responsive_offset="on"
          data-width="['none','none','none','none']" data-type="text"
          data-textalign="['center','center','center','center']"
          data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
          data-start="1000" data-splitin="none" data-splitout="none">
          <span class="button plitka_4 image hover-effect img-container"
          style="background-image: url(/assets/img/EZsite_button_Centr.svg);
          background-repeat: no-repeat;
          "
          ></span>
          </div>
          </a>
          -->

          </li>

          <!-- SLIDE 3  -->
          <li data-index="rs-03" data-transition="fade" data-slotamount="default" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="2000" data-fsmasterspeed="1500" class="rev_gradient"<!-- banner-overlay -->>
          <!-- MAIN IMAGE -->
          <img src="/themes/site1/images/bg-youtube.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="7" data-no-retina>
          <!--<div class="rs-background-video-layer"
          data-forcerewind="on"
          data-volume="mute"
          data-videowidth="100%"
          data-videoheight="100%"
          data-videomp4="video/video-slide.mp4"
          data-videopreload="auto"
          data-videoloop="loopandnoslidestop"
          data-forceCover="1"
          data-aspectratio="16:9"
          data-autoplay="true"
          data-autoplayonlyfirsttime="false"></div>-->

          <!--If you need youtube video-->
          <!--<div class="rs-background-video-layer"
          data-ytid="hEkiWaEp03k"
          data-volume="mute"
          data-forcerewind="on"
          data-nextslideatend="true"
          data-autoplay="true"
          data-autoplayonlyfirsttime="true"
          data-videoloop="loopandnoslidestop"
          data-videoattributes="version=3&enablejsapi=1&html5=1&hd=1&autoplay=1&wmode=opaque&showinfo=0&rel=0&
          origin=http://server.local"></div>


          <div class="rs-background-video-layer"
          data-forcerewind="on"
          data-volume="mute"
          data-ytid="RU9NUfgjvMI"
          data-videoattributes="version=3&amp;enablejsapi=1&amp;html5=1&amp;hd=1&amp;wmode=opaque&amp;showinfo=0&amp;rel=0&amp;origin=http://sadaf.ads;"
          data-videowidth="100%"
          data-videoheight="100%"
          data-videocontrols="none"
          data-videostartat="00:00"
          data-videoendat="05:02"
          data-videoloop="loop"
          data-forceCover="1"
          data-aspectratio="16:9"
          data-autoplay="true"
          data-autoplayonlyfirsttime="false"
          data-nextslideatend="true"
          ></div>



          <div class="tp-caption tp-resizeme"
          data-x="['left','left','left','center']" data-hoffset="['0','0','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['-70','-70','-50','-50']"
          data-whitespace="nowrap" data-responsive_offset="on"
          data-width="['none','none','none','none']" data-type="text"
          data-textalign="['left','left','left','center']"
          data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
          data-start="1200" data-splitin="none" data-splitout="none">
          <h1 class="text-capitalize whitecolor fontbold"> Video Background </h1>
          </div>
          <div class="tp-caption tp-resizeme whitecolor"
          data-x="['left','left','left','center']" data-hoffset="['0','50','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['-10','-10','0','0']"
          data-whitespace="nowrap" data-responsive_offset="on"
          data-width="['none','none','none','none']" data-type="text"
          data-textalign="['left','left','left','center']" data-fontsize="['24','24','20','20']"
          data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;"
          data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
          data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
          data-start="1500" data-splitin="none" data-splitout="none">
          <h4 class="whitecolor font-light">The Best Multipurpose One Page Template in Market</h4>
          </div>
          <a class="tp-caption tp-resizeme text-center button btnwhite-hole pagescroll" href="#our-process"
          data-x="['left','left','left','center']" data-hoffset="['0','50','0','0']"
          data-y="['middle','middle','middle','middle']" data-voffset="['90','80','80','80']"
          data-whitespace="nowrap" data-type="button" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeInOut;"
          data-transform_out="s:900;e:Power2.easeInOut;s:900;e:Power2.easeInOut;"
          data-start="2000" data-splitin="none" data-splitout="none" data-responsive_offset="on">
          <span>Learn More</span>
          </a>
          -->
          </li>

          <!-- SLIDE 3  -->

          </ul>


          </div>

          </div>

         */
        ?>
        <!--
        <div style="position: fixed;top: 0px;right: 0px;width: 100px;height: 40px;background-color: #FFFFFF;" class="ggg"></div>
        -->
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
                                        <p class="bottom40">После целого ряда неудачных отношений стало понятно, что это не чистая случайность, что я привлекаю не таких мужчин, которые мне нравятся, но иначе не могу, другие или мне не нравятся, или не нравлюс я.</p>
                                    </div>
                                    <h4 class="darkcolor mt-5">Виктория Сборовская</h4>
                                    <small class="defaultcolor">Бизнес-вумен</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="bottom40">Я Абсолют, после таких медитаций это утверждение не кажется пустой фразой, оно сила, оно помогает жить и дает понимание многого. И со своими отношениями я разобралась, позволила себе быть счастливой.</p>
                                    </div>
                                    <h4 class="darkcolor mt-5">Адам Сендлер</h4>
                                    <small class="defaultcolor">Менеджер</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="bottom40">Весь мой предыдущий опыт никак не соответствовал первым дням моей «новой» медитации. Я буквально почувствовала освобождение. Меня это очень вдохновило и я начала все больше узнавать про медитацию.</p>

                                    </div>
                                    <h4 class="darkcolor mt-5">Людмила Казакова</h4>
                                    <small class="defaultcolor">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="bottom40">После целого ряда неудачных отношений стало понятно, что это не чистая случайность, что я привлекаю не таких мужчин, которые мне нравятся, но иначе не могу, другие или мне не нравятся, или не нравлюс я.</p>
                                    </div>
                                    <h4 class="darkcolor mt-5">Виктория Сборовская</h4>
                                    <small class="defaultcolor">Бизнес-вумен</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="bottom40">Я Абсолют, после таких медитаций это утверждение не кажется пустой фразой, оно сила, оно помогает жить и дает понимание многого. И со своими отношениями я разобралась, позволила себе быть счастливой.</p>
                                    </div>
                                    <h4 class="darkcolor mt-5">Адам Сендлер</h4>
                                    <small class="defaultcolor">Менеджер</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="bottom40">Весь мой предыдущий опыт никак не соответствовал первым дням моей «новой» медитации. Я буквально почувствовала освобождение. Меня это очень вдохновило и я начала все больше узнавать про медитацию.</p>

                                    </div>
                                    <h4 class="darkcolor mt-5">Людмила Казакова</h4>
                                    <small class="defaultcolor">Счастливая жена</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="bottom40">После целого ряда неудачных отношений стало понятно, что это не чистая случайность, что я привлекаю не таких мужчин, которые мне нравятся, но иначе не могу, другие или мне не нравятся, или не нравлюс я.</p>
                                    </div>
                                    <h4 class="darkcolor mt-5">Виктория Сборовская</h4>
                                    <small class="defaultcolor">Бизнес-вумен</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="bottom40">Я Абсолют, после таких медитаций это утверждение не кажется пустой фразой, оно сила, оно помогает жить и дает понимание многого. И со своими отношениями я разобралась, позволила себе быть счастливой.</p>
                                    </div>
                                    <h4 class="darkcolor mt-5">Адам Сендлер</h4>
                                    <small class="defaultcolor">Менеджер</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapp">
                                    <span class="quoted"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-text">
                                        <p class="bottom40">Весь мой предыдущий опыт никак не соответствовал первым дням моей «новой» медитации. Я буквально почувствовала освобождение. Меня это очень вдохновило и я начала все больше узнавать про медитацию.</p>

                                    </div>
                                    <h4 class="darkcolor mt-5">Людмила Казакова</h4>
                                    <small class="defaultcolor">Счастливая жена</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Testimonials Ends-->


        


    

    <!-- WOrk Process-->  
    <!--
    <section id="our-process" class="padding gradient_bg_default">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="heading-title wow fadeInUp" data-wow-delay="300ms">
                        <h2 class="whitecolor">Work <span class="fontregular">Process</span> </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <ul class="process-wrapp">
                    <li class="whitecolor wow fadeIn" data-wow-delay="300ms">
                        <span class="pro-step bottom20">01</span>
                        <p class="fontbold bottom25">Concept</p>
                        <p>Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="400ms">
                        <span class="pro-step bottom20">02</span>
                        <p class="fontbold bottom25">Plan</p>
                        <p>Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="500ms">
                        <span class="pro-step bottom20">03</span>
                        <p class="fontbold bottom25">Design</p>
                        <p>Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="600ms">
                        <span class="pro-step bottom20">04</span>
                        <p class="fontbold bottom25">Development</p>
                        <p>Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="700ms">
                        <span class="pro-step bottom20">05</span>
                        <p class="fontbold bottom25">Quality Check</p>
                        <p>Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    -->
    <!--WOrk Process ends-->

    <? /*


      <!--half img section-->
      <div id="twocopies">
      <section class="half-section">
      <div class="container-fluid">
      <div class="row">
      <div class="col-lg-6 nopadding">
      <div class="image hover-effect img-container">
      <img alt="" src="/themes/site1/images/split-img1.jpg" class="equalheight">
      </div>
      </div>
      <div class="col-lg-6 nopadding">
      <div class="split-box text-center center-block container-padding equalheight">
      <div class="heading-title padding">
      <span class="wow fadeInUp" data-wow-delay="300ms">Services We Offer</span>
      <h2 class="darkcolor bottom20 wow fadeInUp" data-wow-delay="400ms">Creative Designs</h2>
      <p class="heading_space wow fadeInUp" data-wow-delay="500ms">Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus.  Fusce faucibus nulla at viverra condimentum. </p>
      <a href="#portfolio_top" class="button btnprimary pagescroll wow fadeInUp" data-wow-delay="600ms">Design Works</a>
      </div>
      </div>
      </div>
      </div>
      </div>
      </section>
      <section class="half-section">
      <div class="container-fluid">
      <div class="row">
      <div class="col-lg-6 nopadding">
      <div class="split-box text-center center-block container-padding equalheight">
      <div class="heading-title padding">
      <span class="wow fadeInUp" data-wow-delay="300ms">Services We Offer</span>
      <h2 class="darkcolor bottom20 wow fadeInUp" data-wow-delay="400ms">SEO Marketing</h2>
      <p class="heading_space wow fadeInUp" data-wow-delay="500ms">Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus.</p>
      <a href="#our-team" class="button btnsecondary pagescroll wow fadeInUp" data-wow-delay="600ms">SEO Team</a>
      </div>
      </div>
      </div>
      <div class="col-lg-6 nopadding">
      <div class="image hover-effect img-container">
      <img alt="" src="/themes/site1/images/split-img2.jpg" class="equalheight">
      </div>
      </div>
      </div>
      </div>
      </section>
      </div>
      <!--half img section ends-->


      <li data-index="rs-03" data-transition="fade" data-slotamount="default" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="2000" data-fsmasterspeed="1500" class="rev_gradient">
      <!-- MAIN IMAGE -->
      <img src="/themes/site1/images/banner-1.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10" data-no-retina>

      <div class="tp-caption tp-resizeme"
      data-x="['right','right','right','center']" data-hoffset="['0','0','0','0']"
      data-y="['middle','middle','middle','middle']" data-voffset="['-70','-70','-50','-50']"
      data-whitespace="nowrap" data-responsive_offset="on"
      data-width="['none','none','none','none']" data-type="text"
      data-textalign="['right','right','right','center']"
      data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;"
      data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
      data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
      data-start="1200" data-splitin="none" data-splitout="none">
      <h1 class="text-capitalize fontbold whitecolor text-center"> Next Big Thing </h1>
      </div>
      <div class="tp-caption tp-resizeme"
      data-x="['right','right','right','center']" data-hoffset="['10','10','10','10']"
      data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
      data-whitespace="nowrap" data-responsive_offset="on"
      data-width="['none','none','none','none']" data-type="text"
      data-textalign="['right','right','right','center']"
      data-transform_idle="o:1;"
      data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
      data-transform_out="s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
      data-start="1000" data-splitin="none" data-splitout="none">
      <h1 class="text-capitalize font-xlight whitecolor text-center">In One Page</h1>
      </div>
      <div class="tp-caption tp-resizeme whitecolor"
      data-x="['right','right','right','center']" data-hoffset="['0','0','0','0']"
      data-y="['middle','middle','middle','middle']" data-voffset="['70','70','70','70']"
      data-whitespace="nowrap" data-responsive_offset="on"
      data-width="['none','none','none','none']" data-type="text"
      data-textalign="['right','right','right','center']" data-fontsize="['24','24','20','20']"
      data-transform_idle="o:1;"
      data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;"
      data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
      data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
      data-start="1500" data-splitin="none" data-splitout="none">
      <h4 class="whitecolor font-light text-center">The Best Multipurpose One Page Template in Market</h4>
      </div>
      <div class="tp-caption tp-resizeme"
      data-x="['right','right','right','center']" data-hoffset="['0','0','0','0']"
      data-y="['middle','middle','middle','middle']" data-voffset="['160','160','160','160']"
      data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeInOut;"
      data-transform_out="s:900;e:Power2.easeInOut;s:900;e:Power2.easeInOut;"
      data-type="button" data-start="2000" data-splitin="none" data-splitout="none" data-responsive_offset="on">
      <a class="button btnprimary hvrwhite pagescroll" href="#our-process">Learn More</a>
      <a class="button btnsecondary hvrwhite pagescroll" href="#contactus">Contact Us</a>
      </div>
      </li>
      <!-- SLIDE 4  -->
      <li data-index="rs-04" data-transition="fade" data-slotamount="default" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="2000" data-fsmasterspeed="1500" class="rev_gradient">
      <!-- MAIN IMAGE -->
      <img src="/themes/site1/images/banner-2.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10" data-no-retina>
      <!-- LAYER NR. 1 -->
      <div class="tp-caption tp-resizeme"
      data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
      data-y="['middle','middle','middle','middle']" data-voffset="['-140','-140','-140','-140']"
      data-whitespace="nowrap" data-responsive_offset="on"
      data-width="['none','none','none','none']" data-type="text"
      data-textalign="['center','center','center','center']"
      data-transform_idle="o:1;"
      data-transform_in="x:-50px;opacity:0;s:2000;e:Power3.easeOut;"
      data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
      data-start="1000" data-splitin="none" data-splitout="none">
      <h1 class="text-capitalize font-xlight whitecolor"> The Ultimate </h1>
      </div>
      <div class="tp-caption tp-resizeme"
      data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
      data-y="['middle','middle','middle','middle']" data-voffset="['-70','-70','-70','-70']"
      data-whitespace="nowrap" data-responsive_offset="on"
      data-width="['none','none','none','none']" data-type="text"
      data-textalign="['center','center','center','center']"
      data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;"
      data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
      data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
      data-start="1200" data-splitin="none" data-splitout="none">
      <h1 class="text-capitalize fontbold whitecolor"> Next Big Thing </h1>
      </div>
      <div class="tp-caption tp-resizeme"
      data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
      data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
      data-whitespace="nowrap" data-responsive_offset="on"
      data-width="['none','none','none','none']" data-type="text"
      data-textalign="['center','center','center','center']"
      data-transform_idle="o:1;"
      data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
      data-transform_out="s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
      data-start="1000" data-splitin="none" data-splitout="none">
      <h1 class="text-capitalize font-xlight whitecolor">In One Page</h1>
      </div>
      <div class="tp-caption tp-resizeme whitecolor"
      data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
      data-y="['middle','middle','middle','middle']" data-voffset="['70','70','70','70']"
      data-whitespace="nowrap" data-responsive_offset="on"
      data-width="['none','none','none','none']" data-type="text"
      data-textalign="['center','center','center','center']" data-fontsize="['24','24','20','20']"
      data-transform_idle="o:1;"
      data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;"
      data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
      data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
      data-start="1500" data-splitin="none" data-splitout="none">
      <h4 class="whitecolor font-light">The Best Multipurpose One Page Template in Market</h4>
      </div>
      <a class="tp-caption tp-resizeme button btnprimary pagescroll" href="#our-process"
      data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
      data-y="['middle','middle','middle','middle']" data-voffset="['160','160','160','160']"
      data-whitespace="nowrap" data-type="button"  data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeInOut;"
      data-transform_out="s:900;e:Power2.easeInOut;s:900;e:Power2.easeInOut;"
      data-start="2000" data-splitin="none" data-splitout="none" data-responsive_offset="on">
      <span>Learn More</span>
      </a>
      </li>
     * 
     * 
      <!-- Our Team-->
      <section id="our-team" class="padding bglight">
      <div class="container">
      <div class="row">
      <div class="col-md-8 offset-md-2 col-sm-12 text-center">
      <div class="heading-title wow fadeInUp" data-wow-delay="300ms">
      <span>Heros Behind the Company</span>
      <h2 class="darkcolor bottom20">Creative Team</h2>
      <p class="heading_space">Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>
      </div>
      </div>
      </div>
      <div class="row">
      <div class="col-md-12">
      <div id="ourteam-slider" class="owl-carousel">
      <div class="item">
      <div class="team-box wow fadeInUp" data-wow-delay="300ms">
      <div class="image">
      <img src="/themes/site1/images/team-1.jpg" alt="">
      </div>
      <div class="team-content gradient_bg whitecolor">
      <h3>Johny Walkin.</h3>
      <p class="bottom40">CEO, The XeOne Company</p>
      <div class="progress-bars">
      <div class="progress">
      <p>Marketing online</p>
      <div class="progress-bar" data-value="90"><span>90%</span></div>
      </div>
      <div class="progress">
      <p>Web Designing</p>
      <div class="progress-bar" data-value="75"><span>75%</span></div>
      </div>
      </div>
      </div>
      </div>
      </div>
      <div class="item">
      <div class="team-box wow fadeInUp" data-wow-delay="350ms">
      <div class="image">
      <img src="/themes/site1/images/team-2.jpg" alt="">
      </div>
      <div class="team-content gradient_bg_default whitecolor">
      <h3>Johny Walkin.</h3>
      <p class="bottom40">Designer, The XeOne Company</p>
      <div class="progress-bars">
      <div class="progress">
      <p>Web Designing</p>
      <div class="progress-bar" data-value="75"><span>75%</span></div>
      </div>
      <div class="progress">
      <p>Marketing online</p>
      <div class="progress-bar" data-value="90"><span>90%</span></div>
      </div>
      </div>
      </div>
      </div>
      </div>
      <div class="item">
      <div class="team-box single wow fadeInUp" data-wow-delay="400ms">
      <div class="image">
      <img src="/themes/site1/images/team-3.jpg" alt="">
      </div>
      <div class="team-content gradient_bg whitecolor">
      <h3>Teena Walkin</h3>
      <p class="bottom40">Model, The XeOne Company</p>
      <div class="progress-bars">
      <div class="progress">
      <p>Fashion Designing</p>
      <div class="progress-bar" data-value="80"><span>80%</span></div>
      </div>
      </div>
      </div>
      </div>
      </div>
      <div class="item">
      <div class="team-box wow fadeInUp" data-wow-delay="300ms">
      <div class="image">
      <img src="/themes/site1/images/team-1.jpg" alt="">
      </div>
      <div class="team-content gradient_bg whitecolor">
      <h3>Johny Walkin.</h3>
      <p class="bottom40">CEO, The XeOne Company</p>
      <div class="progress-bars">
      <div class="progress">
      <p>Marketing online</p>
      <div class="progress-bar" data-value="90"><span>90%</span></div>
      </div>
      <div class="progress">
      <p>Web Designing</p>
      <div class="progress-bar" data-value="75"><span>75%</span></div>
      </div>
      </div>
      </div>
      </div>
      </div>
      <div class="item">
      <div class="team-box wow fadeInUp" data-wow-delay="350ms">
      <div class="image">
      <img src="/themes/site1/images/team-2.jpg" alt="">
      </div>
      <div class="team-content gradient_bg_default whitecolor">
      <h3>Johny Walkin.</h3>
      <p class="bottom40">Designer, The XeOne Company</p>
      <div class="progress-bars">
      <div class="progress">
      <p>Web Designing</p>
      <div class="progress-bar" data-value="75"><span>75%</span></div>
      </div>
      <div class="progress">
      <p>Marketing online</p>
      <div class="progress-bar" data-value="90"><span>90%</span></div>
      </div>
      </div>
      </div>
      </div>
      </div>
      <div class="item">
      <div class="team-box wow fadeInUp" data-wow-delay="400ms">
      <div class="image">
      <img src="/themes/site1/images/team-3.jpg" alt="">
      </div>
      <div class="team-content gradient_bg whitecolor">
      <h3>Teena Walkin</h3>
      <p class="bottom40">Model, The XeOne Company</p>
      <div class="progress-bars">
      <div class="progress">
      <p>Fashion Designing</p>
      <div class="progress-bar" data-value="80"><span>80%</span></div>
      </div>
      <div class="progress">
      <p>Marketing online</p>
      <div class="progress-bar" data-value="90"><span>90%</span></div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </section>
      <!-- Our Team ends-->

      <!--Some Feature -->
      <section id="our-feature" class="padding single-feature">
      <div class="container">
      <div class="row">
      <div class="col-md-6 col-sm-7 text-md-left text-center wow fadeInLeft" data-wow-delay="300ms">
      <div class="heading-title heading_space">
      <span>Service We Offer</span>
      <h2 class="darkcolor bottom30">Awesome Features</h2>
      </div>
      <p class="bottom35">Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>
      <a href="#our-blog" class="button btnsecondary pagescroll">Our Blog</a>
      </div>
      <div class="col-md-6 col-sm-5 wow fadeInRight" data-wow-delay="350ms">
      <div class="image top50"><img alt="SEO" src="/themes/site1/images/awesome--feature.png"></div>
      </div>
      </div>
      </div>
      </section>
      <!--Some Feature ends-->

      <!--Gallery-->
      <section id="portfolio_top" class="bglight">
      <div class="container">
      <div id="portfolio-measonry" class="cbp border-portfolio simple_overlay">
      <div class="cbp-item itemshadow">
      <img src="/themes/site1/images/portfolio-1.jpg" alt="">
      <div class="overlay center-block whitecolor">
      <a class="plus" data-fancybox="gallery" href="/themes/site1/images/portfolio-1.jpg"></a>
      <h4 class="top30">Wood Work</h4>
      <p>Small Portfolio Detail Here</p>
      </div>
      </div>
      <div class="cbp-item">
      <div class="text_wrap wow fadeIn" data-wow-delay="350ms">
      <div class="heading-title text-center padding_top">
      <span>Portfolio Designs</span>
      <h2 class="darkcolor bottom10">Creative Work</h2>
      <p>Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend,</p>
      </div>
      </div>
      </div>
      <div class="cbp-item itemshadow">
      <img src="/themes/site1/images/portfolio-2.jpg" alt="">
      <div class="overlay center-block whitecolor">
      <a class="plus" data-fancybox="gallery" href="https://www.youtube.com/watch?v=_sI_Ps7JSEk&autoplay=1&rel=0&controls=0&showinfo=0"></a>
      <h4 class="top30">Wood Work</h4>
      <p>Small Portfolio Detail Here</p>
      </div>
      </div>
      <div class="cbp-item itemshadow">
      <img src="/themes/site1/images/portfolio-3.jpg" alt="">
      <div class="overlay center-block whitecolor">
      <a class="plus" data-fancybox="gallery" href="/themes/site1/images/portfolio-3.jpg"></a>
      <h4 class="top30">Wood Work</h4>
      <p>Small Portfolio Detail Here</p>
      </div>
      </div>
      <div class="cbp-item itemshadow">
      <img src="/themes/site1/images/portfolio-4.jpg" alt="">
      <div class="overlay center-block whitecolor">
      <a class="plus" data-fancybox="gallery" href="/themes/site1/images/portfolio-4.jpg"></a>
      <h4 class="top30">Wood Work</h4>
      <p>Small Portfolio Detail Here</p>
      </div>
      </div>
      <div class="cbp-item">
      <div class="bottom-text">
      <div class="cells  wow fadeIn" data-wow-delay="350ms">
      <p>We’ve Completed More Than </p>
      <h2 class="port_head gradient_text">682</h2>
      <p class="bottom15">projects for our amazing clients,</p>
      </div>
      <div class="cells wow fadeIn" data-wow-delay="350ms">
      <a href="gallery-detail.html" class="button btnsecondary btn-gradient-hvr">View All Work</a>
      </div>
      </div>
      </div>
      </div>
      </div>
      </section>
      <!--Gallery ends -->


      <!-- Mobile Apps -->
      <section id="our-apps" class="padding">
      <div class="container">
      <div class="row">
      <div class="col-md-12 col-sm-12 text-center">
      <div class="heading-title wow fadeInUp" data-wow-delay="300ms">
      <span>Yes We Provide Mobile Apps</span>
      <h2 class="darkcolor heading_space">Mobile Applications</h2>
      </div>
      </div>
      </div>
      <div class="row" id="app-feature">
      <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="content-left clearfix">
      <div class="feature-item left top30 bottom30 wow fadeInUp" data-wow-delay="300ms">
      <span class="icon"><i class="fa fa-mobile-phone"></i></span>
      <div class="text">
      <h4>Responsive Design</h4>
      <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet</p>
      </div>
      </div>
      <div class="feature-item left top30 bottom30 wow fadeInUp" data-wow-delay="350ms">
      <span class="icon"><i class="fa fa-cog"></i></span>
      <div class="text">
      <h4>Amazing Theme Options</h4>
      <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet</p>
      </div>
      </div>
      <div class="feature-item left top30 bottom30 wow fadeInUp" data-wow-delay="400ms">
      <span class="icon"><i class="fa fa-edit"></i></span>
      <div class="text">
      <h4>Easy to Customize</h4>
      <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet</p>
      </div>
      </div>
      </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="image feature-item text-center  wow fadeIn" data-wow-delay="500ms">
      <img src="/themes/site1/images/responsive.png" alt="">
      </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="content-right clearfix">
      <div class="feature-item right top30 bottom30 wow fadeInUp" data-wow-delay="300ms">
      <span class="icon"><i class="fa fa-code"></i></span>
      <div class="text">
      <h4>Powerful BackEnd</h4>
      <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet</p>
      </div>
      </div>
      <div class="feature-item right top30 bottom30 wow fadeInUp" data-wow-delay="350ms">
      <span class="icon"><i class="fa fa-folder-o"></i></span>
      <div class="text">
      <h4>Well Documented</h4>
      <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet</p>
      </div>
      </div>
      <div class="feature-item right top30 bottom30 wow fadeInUp" data-wow-delay="400ms">
      <span class="icon"><i class="fa fa-support"></i></span>
      <div class="text">
      <h4>24/7 Support</h4>
      <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet</p>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </section>
      <!--Mobile Apps ends-->


      <!-- Counters -->
      <section id="funfacts" class="padding_top fact-iconic gradient_bg">
      <div class="container">
      <div class="row">
      <div class="col-md-5 col-sm-12 margin_bottom whitecolor text-md-left text-center wow fadeInLeft" data-wow-delay="300ms">
      <h3 class="bottom25">Our many years of experience in numbers</h3>
      <p class="title">We show you our professional achievements in numbers, which show the acquired skills and trust of many clients.</p>
      </div>
      <div class="col-md-7 col-sm-12 text-center">
      <div class="row">
      <div class="col-md-4 col-sm-4 icon-counters whitecolor margin_bottom  wow fadeInRight" data-wow-delay="400ms">
      <div class="img-icon bottom15">
      <i class="fa fa-smile-o"></i>
      </div>
      <div class="counters">
      <span class="count_nums" data-to="2500" data-speed="2500"> </span> <i class="fa fa-plus"></i>
      </div>
      <p class="title">Satisfied customers</p>
      </div>
      <div class="col-md-4 col-sm-4 icon-counters whitecolor margin_bottom wow fadeInRight" data-wow-delay="350ms">
      <div class="img-icon bottom15">
      <i class="fa fa-language"> </i>
      </div>
      <div class="counters">
      <span class="count_nums" data-to="9500" data-speed="2500"> </span> <i class="fa fa-plus"></i>
      </div>
      <p class="title">Completed consultations</p>
      </div>
      <div class="col-md-4 col-sm-4 icon-counters whitecolor margin_bottom wow fadeInRight" data-wow-delay="300ms">
      <div class="img-icon bottom15">
      <i class="fa fa-desktop"></i>
      </div>
      <div class="counters">
      <span class="count_nums" data-to="6000" data-speed="2500"> </span> <i class="fa fa-plus"></i>
      </div>
      <p class="title">Carried out training</p>
      </div>
      </div>
      </div>
      </div>
      </div>
      </section>
      <!--Counters ends-->

      <!-- Pricing Tables -->
      <section id="our-pricings" class="padding bglight">
      <div class="container">
      <div class="row">
      <div class="col-md-8 offset-md-2 col-sm-12 text-center">
      <div class="heading-title wow fadeInUp" data-wow-delay="300ms">
      <span>Choose The Best One</span>
      <h2 class="darkcolor bottom30">Our Packages</h2>
      <p>Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. </p>
      </div>
      </div>
      </div>
      <div class="row">
      <div class="col-md-6 col-sm-12">
      <div class="price-table top60 wow fadeIn" data-wow-delay="400ms">
      <h3 class="bottom20 darkcolor">Starter Plan</h3>
      <p>If you are a small business and you are interested in small rebranding then this is a perfect plan for you</p>
      <div class="ammount">
      <h2 class="defaultcolor"><i class="fa fa-dollar"></i> 9.99 <span class="dur">/ month</span></h2>
      </div>
      <ul class="top20">
      <li><span>Designing a small brand</span></li>
      <li><span>Redesign the company logo</span></li>
      <li><span>New visual design of the website</span></li>
      <li><span>Deploying a website</span></li>
      <li class="not-support"><span>Studio and product photography</span></li>
      <li class="not-support"><span>Professional project support</span></li>
      <li class="not-support"><span>Support and care</span></li>
      </ul>
      <div class="clearfix"></div>
      <a href="javascript:void(0)" class="button btnprimary top50">Get Started </a>
      </div>
      </div>
      <div class="col-md-6 col-sm-12">
      <div class="price-table active top60 wow fadeIn" data-wow-delay="500ms">
      <h3 class="bottom20 darkcolor">Business Plan</h3>
      <p>If you are a small business and you are interested in small rebranding then this is a perfect plan for you</p>
      <div class="ammount">
      <h2 class="defaultcolor"><i class="fa fa-dollar"></i> 29.99 <span class="dur">/ month</span></h2>
      </div>
      <ul class="top20">
      <li><span>Designing a small brand</span></li>
      <li><span>Redesign the company logo</span></li>
      <li><span>New visual design of the website</span></li>
      <li><span>Deploying a website</span></li>
      <li><span>Studio and product photography</span></li>
      <li><span>Professional project support</span></li>
      <li><span>Support and care</span></li>
      </ul>
      <div class="clearfix"></div>
      <a href="javascript:void(0)" class="button btnsecondary top50">Get Started </a>
      </div>
      </div>
      </div>
      </div>
      </section>
      <!--Pricing Tables ends-->


      <!-- Background Parallax -->
      <section id="video-parallax" class="video-parallax padding parallaxie">
      <div class="container">
      <div class="row">
      <div class="col-md-7 col-sm-7">
      <div class="heading-title whitecolor text-md-left text-center wow fadeInUp" data-wow-delay="300ms">
      <span>We have an excellent story</span>
      <h2 class="fontregular">Watch Our Video</h2>
      <a data-fancybox href="https://www.youtube.com/watch?v=GhvD7NtUT-Q&autoplay=1&rel=0&controls=1&showinfo=0" class="button btnprimary fontmedium top20"><i class="fa fa-play"></i> &nbsp;Play Now</a>
      </div>
      </div>
      </div>
      </div>
      </section>
      <!--Background Parallax-->





      <!-- Partners -->
      <section id="logos" class="padding_bottom">
      <div class="container">
      <h3 class="invisible">hidden</h3>
      <div class="row">
      <div class="col-md-12 col-sm-12">
      <div id="partners-slider" class="owl-carousel">
      <div class="item">
      <div class="logo-item"> <img alt="" src="/themes/site1/images/logo-1.png"></div>
      </div>
      <div class="item">
      <div class="logo-item"><img alt="" src="/themes/site1/images/logo-2.png"></div>
      </div>
      <div class="item">
      <div class="logo-item"><img alt="" src="/themes/site1/images/logo-3.png"></div>
      </div>
      <div class="item">
      <div class="logo-item"><img alt="" src="/themes/site1/images/logo-4.png"></div>
      </div>
      <div class="item">
      <div class="logo-item"><img alt="" src="/themes/site1/images/logo-5.png"></div>
      </div>
      <div class="item">
      <div class="logo-item"><img alt="" src="/themes/site1/images/logo-1.png"></div>
      </div>
      <div class="item">
      <div class="logo-item"><img alt="" src="/themes/site1/images/logo-2.png"></div>
      </div>
      <div class="item">
      <div class="logo-item"><img alt="" src="/themes/site1/images/logo-3.png"></div>
      </div>
      <div class="item">
      <div class="logo-item"><img alt="" src="/themes/site1/images/logo-4.png"></div>
      </div>
      <div class="item">
      <div class="logo-item"><img alt="" src="/themes/site1/images/logo-5.png"></div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </section>
      <!--Partners Ends-->


      <!-- Our Blogs -->
      <section id="our-blog" class="half-section bglight">
      <div class="container-fluid">
      <div class="row">
      <div class="col-md-6 col-sm-12 nopadding">
      <div class="image hover-effect"><img src="/themes/site1/images/split-blog.jpg" alt="our blog" class="equalheight"></div>
      </div>
      <div class="col-md-6 col-sm-12">
      <div class="split-box text-center center-block equalheight container-padding">
      <div class="heading-title padding_half">
      <span class="wow fadeIn" data-wow-delay="300ms">Read Our News</span>
      <h2 class="darkcolor bottom25 wow fadeIn" data-wow-delay="350ms">Latest Blog Post</h2>
      <p class="heading_space wow fadeIn" data-wow-delay="400ms">Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>
      <a href="blog.html" class="button btnsecondary wow fadeInUp" data-wow-delay="450ms">Read Full Story</a>
      </div>
      </div>
      </div>
      </div>
      </div>
      </section>
      <!--Our Blogs Ends-->


      <!-- Contact US -->
      <section id="contactus" class="padding_top">
      <div class="container">
      <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="heading-title heading_space wow fadeIn" data-wow-delay="300ms">
      <span>Lets Get In Touch</span>
      <h2 class="darkcolor">Contact XeOne</h2>
      </div>
      </div>
      <div class="col-md-6 col-sm-12 margin_bottom wow fadeInUp" data-wow-delay="350ms">
      <p>West is not just about graphic design; it's more than that. We offer integral communication services, and we're responsible for our process and results. We thank each client and their projects.</p>
      <div class="row">
      <div class="col-md-6 col-sm-6 our-address top40">
      <h5 class="bottom25">Our Address</h5>
      <p class="bottom15">123 Stree New York City , United States Of America. </p>
      <a class="pickus" href="#." data-text="Get Directions">Get Directions</a>
      </div>
      <div class="col-md-6 col-sm-6 our-address top40">
      <h5 class="bottom25">Our Phone</h5>
      <p class="bottom15">Office Telephone : 001 01085379709 <span class="block">
      Mobile : 001 63165370895
      </span> </p>
      <a class="pickus" href="#." data-text="Call Us">Call Us</a>
      </div>
      <div class="col-md-6 col-sm-6 our-address top40">
      <h5 class="bottom25">Our Email</h5>
      <p class="bottom15">Main Email : admin@website.com <span class="block">Inquiries : email@website.com</span> </p>
      <a class="pickus" href="#." data-text="Send a Message">Send a Message</a>
      </div>
      <div class="col-md-6 col-sm-6 our-address top40">
      <h5 class="bottom25">Our Support</h5>
      <p class="bottom15">Main Support : info@website.com <span>Sales : support@website</span> </p>
      <a class="pickus" href="#." data-text="Open a Ticket">Open a Ticket</a>
      </div>
      </div>
      </div>
      <div class="col-md-6 col-sm-12 margin_bottom">
      <form class="getin_form wow fadeInUp" data-wow-delay="400ms" onsubmit="return false;">
      <div class="row">

      <div class="col-sm-12" id="result"></div>

      <div class="col-md-6 col-sm-6">
      <div class="form-group bottom35">
      <input class="form-control" type="text" placeholder="First Name:" required id="first_name" name="first_name">
      </div>
      </div>
      <div class="col-md-6 col-sm-6">
      <div class="form-group bottom35">
      <input class="form-control" type="text" placeholder="Last Name:" required id="last_name" name="last_name">
      </div>
      </div>
      <div class="col-md-6 col-sm-6">
      <div class="form-group bottom35">
      <input class="form-control" type="email" placeholder="Email:" required id="email" name="email">
      </div>
      </div>
      <div class="col-md-6 col-sm-6">
      <div class="form-group bottom35">
      <input class="form-control" type="tel" placeholder="Phone:" id="phone" name="phone">
      </div>
      </div>
      <div class="col-md-12 col-sm-12">
      <div class="form-group bottom35">
      <textarea class="form-control" placeholder="Message" id="message" name="message"></textarea>
      </div>
      </div>
      <div class="col-sm-12">
      <button type="submit" class="button btnprimary" id="submit_btn">submit request</button>
      </div>
      </div>
      </form>
      </div>
      </div>
      </div>

      <!--Location Map here-->
      <div id="map-container"></div>
      </section>
      <!--Contact US Ends-->
     */
    ?>



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
