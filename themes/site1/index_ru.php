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
        <link href="/assets/plugins/video/css/videojs.css<?= $_SESSION['rand'] ?>" rel="stylesheet">

        <script type="text/javascript" src="/assets/plugins/mixitup/mixitup.js<?= $_SESSION['rand'] ?>"></script>
        <script type="text/javascript" src="/assets/js/init.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/js/cart.js<?= $_SESSION['rand'] ?>"></script>  
        <script type="text/javascript" src="/assets/plugins/lazyload/lazyload.min.js<?= $_SESSION['rand'] ?>"></script>
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



        <!--Main Slider-->
        <!--     
        -->
        <link rel="stylesheet" href="/themes/site1/css/carousel.css<?= $_SESSION['rand'] ?>">
        <div id="carouselEdgardCaptions" class="carousel slide carousel-fade" data-ride="carousel" >
            <ol class="carousel-indicators">
                <?
                /*
                  <li type="button" data-bs-target="#carouselEdgardCaptions" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></li>
                 */
                ?>
                <li type="button" data-bs-target="#carouselEdgardCaptions" data-bs-slide-to="0" aria-label="Slide 2"></li>
                <li type="button" data-bs-target="#carouselEdgardCaptions" data-bs-slide-to="1" class="active" aria-label="Slide 3"></li>
            </ol>
            <div class="carousel-inner">
                <?
                /*
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
                 */
                ?>
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



        <?
        include 'footer_' . $_SESSION['lang'] . '.php'
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
    <script src="//vjs.zencdn.net/7.10.2/video.min.js<?= $_SESSION['rand'] ?>"></script>
    <script src="/assets/plugins/video/Youtube.js<?= $_SESSION['rand'] ?>"></script>

    <!--Google Map API-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJnKEvlwpyjXfS_h-J1Cne2fPMqeb44Mk"></script>
    <script src="/themes/site1/js/functions.js<?= $_SESSION['rand'] ?>"></script>	
    <?
    foreach ($_SESSION['body_javascript'] as $js) {
        echo $js . "\n";
    }
    ?>
    
</html>
