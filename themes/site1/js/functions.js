//LOADER
jQuery(window).on("load", function () {
    "use strict";
    jQuery(".loader").fadeOut(800);

});


jQuery(function ($) {
    "use strict";
    var $window = $(window);
    var windowsize = $(window).width();
    var $root = $("html, body");
    var $this = $(this);


    //Contact Us
    $("#submit_btn").click(function () {

        var user_name = $('input[name=first_name]').val() + ' ' + $('input[name=last_name]').val();
        var user_email = $('input[name=email]').val();
        var user_phone = $('input[name=phone]').val();
        var user_message = $('textarea[name=message]').val();

        //simple validation at client's end
        var post_data, output;
        var proceed = true;
        if (user_name == "") {
            proceed = false;
        }
        if (user_email == "") {
            proceed = false;
        }
        // if (user_phone == "") {
        //proceed = false;
        // }

        if (user_message == "") {
            proceed = false;
        }
        //everything looks good! proceed...
        if (proceed) {

            //data to be sent to server
            post_data = {'userName': user_name, 'userEmail': user_email, 'userPhone': user_phone, 'userMessage': user_message};

            //Ajax post data to server
            $.post('contact.php', post_data, function (response) {

                //load json data from server and output message
                if (response.type == 'error') {
                    output = '<div class="alert-danger" style="padding:10px; margin-bottom:25px;">' + response.text + '</div>';
                } else {
                    output = '<div class="alert-success" style="padding:10px; margin-bottom:25px;">' + response.text + '</div>';

                    //reset values in all input fields
                    $('.getin_form input').val('');
                    $('.getin_form textarea').val('');
                }

                $("#result").hide().html(output).slideDown();
            }, 'json');

        } else {
            output = '<div class="alert-danger" style="padding:10px; margin-bottom:25px;">Please provide the missing fields.</div>';
            $("#result").hide().html(output).slideDown();
        }

    });






    /* ----- Back to Top ----- */
    $("body").append('<a href="#" class="back-top"><i class="fa fa-angle-up"></i></a>');
    var amountScrolled = 700;
    var backBtn = $("a.back-top");
    $window.on("scroll", function () {
        if ($window.scrollTop() > amountScrolled) {
            backBtn.addClass("back-top-visible");
        } else {
            backBtn.removeClass("back-top-visible");
        }
    });
    backBtn.on("click", function () {
        $root.animate({
            scrollTop: 0
        }, 700);
        return false;
    });


    if ($(".just-sidemenu").length) {
        var anchor_point = $(".rotating-words").height();
        var side_toggle = $(".just-sidemenu #sidemenu_toggle");
        side_toggle.addClass("toggle_white");
        $window.on("scroll", function () {
            if ($window.scrollTop() >= anchor_point) {
                side_toggle.removeClass("toggle_white");
            } else {
                side_toggle.addClass("toggle_white");
            }
        });
    }



    /*----- Menu On click -----*/
    if ($("#sidemenu_toggle").length) {
        $("body").addClass("pushwrap");
        $("#sidemenu_toggle").on("click", function () {
            $(".pushwrap").toggleClass("active");
            $(".side-menu").addClass("side-menu-active"), $("#close_side_menu").fadeIn(700)
        }), $("#close_side_menu").on("click", function () {
            $(".side-menu").removeClass("side-menu-active"), $(this).fadeOut(200), $(".pushwrap").removeClass("active")
        }), $("#btn_sideNavClose").on("click", function () {
            $(".side-menu").removeClass("side-menu-active"), $("#close_side_menu").fadeOut(200), $(".pushwrap").removeClass("active")
        });
    }


    /* ------- Smooth scroll ------- */
    $("a.pagescroll").on("click", function (event) {
        event.preventDefault();
        $("html,body").animate({
            scrollTop: $(this.hash).offset().top
        }, 1200);
    });
    /*hide menu on mobile click*/
    $(".navbar-nav>li>a").on("click", function () {
        $(".navbar-collapse").collapse("hide");
    });

    /*$(".dl-menu >.menu-item >a").on("click", function(){
     $(".pushmenu-right").collapse("hide");
     });*/



    /*------ MENU Fixed ------*/
    if ($("nav.navbar").hasClass("static-nav")) {
        $window.scroll(function () {
            var $scroll = $window.scrollTop();
            var $navbar = $(".static-nav");
            if ($scroll > 200) {
                $navbar.addClass("fixedmenu");
            } else {
                $navbar.removeClass("fixedmenu");
            }
        });
    }

    /*bottom menu fix*/
    if ($("nav.navbar").hasClass("fixed-bottom")) {
        var navHeight = $(".fixed-bottom").offset().top;
        $window.scroll(function () {
            if ($window.scrollTop() > navHeight) {
                $('.fixed-bottom').addClass('fixedmenu');
            } else {
                $('.fixed-bottom').removeClass('fixedmenu');
            }
        });
    }



    /* ----- Full Screen ----- */
    function resizebanner() {
        var $fullscreen = $(".full-screen");
        $fullscreen.css("height", $window.height());
        $fullscreen.css("width", $window.width());
    }
    resizebanner();
    $window.resize(function () {
        resizebanner();
    });


    /*----- Replace Images on Mobile -----*/
    fiximBlocks();
    porfoliofix();
    $window.resize(function () {
        fiximBlocks();
        porfoliofix();
    });

    function fiximBlocks() {
        if (windowsize < 993) {
            $(".half-section").each(function () {
                $(".img-container", this).insertAfter($(".split-box > .heading-title h2", this));
            });
        }
    }

    function porfoliofix() {
        if (windowsize < 768) {
            $("#portfolio_top .cbp-item:nth-child(2)", this).insertBefore($("#portfolio_top .cbp-item:nth-child(1)", this));
        }
    }


    /* -------- SKILL BARS -------- */
    //For Skills Bar on Different Pages
    $('.progress').each(function () {
        $(this).appear(function () {
            $(this).animate({opacity: 1, left: "0px"}, 800);
            var b = jQuery(this).find(".progress-bar").attr("data-value");
            $(this).find(".progress-bar").animate({
                width: b + "%"
            }, 500);
        });
    });


    /* --------Equal Heights -------- */
    checheight();
    $window.on("resize", function () {
        checheight();
    });

    function checheight() {
        var $smae_height = $(".equalheight");
        if ($smae_height.length) {
            if (windowsize > 767) {
                $smae_height.matchHeight({
                    property: "height",
                });
            }
        }
    }


    /* -------BG Video banner -------*/
    $(function () {
        if ($(".my-background-video").length) {
            $('.my-background-video').bgVideo();
        }
    });


    /* ------ OWL Slider ------ */
    /*Partners / LOgo*/
    /*
     $("#partners-slider").owlCarousel({
     items: 5,
     autoplay: 1500,
     smartSpeed: 1500,
     autoplayHoverPause: true,
     slideBy: 1,
     loop: true,
     margin: 30,
     dots: false,
     nav: false,
     responsive: {
     1200: {
     items: 5,
     },
     900: {
     items: 4,
     },
     768: {
     items: 3,
     },
     480: {
     items: 2,
     },
     320: {
     items: 1,
     },
     }
     });
     */

    /*Testimonials 3columns*/
    $("#testimonial-slider").owlCarousel({
        items: 3,
        autoplay: 2500,
        autoplayHoverPause: true,
        loop: true,
        margin: 30,
        dots: true,
        nav: false,
        responsive: {
            1280: {
                items: 3,
            },
            600: {
                items: 2,
            },
            320: {
                items: 1,
            },
        }
    });

    /*Testimonial one slide fade*/
    /*
     $("#testimonial-quote").owlCarousel({
     items: 1,
     autoplay: 2500,
     autoplayHoverPause: true,
     mouseDrag: false,
     loop: true,
     margin: 30,
     dots: true,
     dotsContainer: "#owl-thumbs",
     nav: false,
     animateIn: "fadeIn",
     animateOut: "fadeOut",
     responsive: {
     1280: {
     items: 1,
     },
     600: {
     items: 1,
     },
     320: {
     items: 1,
     },
     }
     });
     
     $("#testimonial-quote-nav").owlCarousel({
     items: 1,
     autoplay: 2500,
     autoplayHoverPause: true,
     mouseDrag: false,
     loop: true,
     margin: 30,
     animateIn: "fadeIn",
     animateOut: "fadeOut",
     dots: true,
     dotsContainer: "#owl-thumbs",
     nav: true,
     navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"],
     responsive: {
     1280: {
     items: 1,
     },
     600: {
     items: 1,
     },
     320: {
     items: 1,
     },
     }
     });
     */

    /*Our Team*/
    /*
     $("#ourteam-slider").owlCarousel({
     items: 3,
     margin: 30,
     dots: false,
     nav: false,
     responsive: {
     1280: {
     items: 3,
     },
     600: {
     items: 2,
     },
     320: {
     items: 1,
     },
     }
     });
     */
    /*Simple text fadng banner*/
    /*
     $("#text-fading").owlCarousel({
     items: 1,
     autoplay: true,
     autoplayHoverPause: true,
     loop: true,
     mouseDrag: false,
     animateIn: "fadeIn",
     animateOut: "fadeOut",
     dots: true,
     nav: false,
     responsive: {
     0: {
     items: 1
     }
     }
     });
     */

    /*Services Box Slider*/
    /*
     $("#services-slider").owlCarousel({
     autoplay: true,
     autoplayTimeout: 3000,
     autoplayHoverPause: true,
     smartSpeed: 1200,
     loop: true,
     nav: false,
     navText: false,
     dots: false,
     mouseDrag: true,
     touchDrag: true,
     center: true,
     responsive: {
     0: {
     items: 1
     },
     640: {
     items: 3
     }
     }
     });
     */

    /* ----------- Counters ---------- */
    $(".value_formatter").data("countToOptions", {
        formatter: function (value, options) {
            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
        }
    });
    $(".counters").appear(function () {
        $(".count_nums").each(count);
    });

    function count(options) {
        var $this = $(this);
        options = $.extend({}, options || {}, $this.data("countToOptions") || {});
        $this.countTo(options);
    }


    /* ---------- Parallax Backgrounds ---------- */
    if (windowsize > 992) {
        $(".parallaxie").parallaxie({
            speed: 0.55,
            offset: 0,
        });
    }


    /*----- Type Writter Effect -----*/
    if ($("#typewriting").length) {
        var app = document.getElementById("typewriting");
        var typewriter = new Typewriter(app, {
            loop: true
        });
        typewriter.typeString('Creative').pauseFor(2000).deleteAll()
                .typeString('Parallax').pauseFor(2000).deleteAll()
                .typeString('Flexible').start();
    }


    /*----- FancyBox -----*/
    $('[data-fancybox]').fancybox({
        protect: true,
        animationEffect: "fade",
        hash: null,
    });

    $(".fancybox").fancybox();


    /* ------ Revolution Slider ------ */


    /* Промо время */
//
//    function promoTimeInit(e, startTime) {
//        if (startTime == undefined) {
//            startTime = 'Sep 30, 2020 00:00:00';
//        }
//        let obj = $(e);
//        const second = 1000,
//                minute = second * 60,
//                hour = minute * 60,
//                day = hour * 24;
//        
//        let countDown = new Date(startTime).getTime();
//        let x = setInterval(function () {
//
//            let now = new Date().getTime();
//            let distance = countDown - now;
//            
//            //console.log('distance: ' + distance + ' countDown - now: ' + countDown + ' - ' + now);
//            //console.log('days: ' + Math.floor(distance / (day)));
//            
//            $(e).find(".promoTime_days").html( String(Math.floor(distance / (day))) );
//            $(e).find(".promoTime_hours").html( String(Math.floor((distance % (day)) / (hour)))) ;
//            $(e).find(".promoTime_minutes").html( String(Math.floor((distance % (hour)) / (minute)))) ;
//            $(e).find(".promoTime_seconds").html( String(Math.floor((distance % (minute)) / second))) ;
//
//
//            //do something later when date is reached
//            //if (distance < 0) {
//            //  clearInterval(x);
//            //  Акция закончилась
//            //}
//
//        }, second);
//    }
//
//    promoTimeInit(".promoTime1", 'Sep 30, 2020 00:00:00');
//    promoTimeInit(".promoTime2", 'Sep 30, 2020 00:00:00');
//    promoTimeInit(".promoTime3", 'Sep 24, 2020 00:00:00');

});


/*
 jQuery(function () {
 jQuery("#bgndVideo").vimeo_player();
 });
 */





