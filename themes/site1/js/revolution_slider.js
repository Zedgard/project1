/* ------ Revolution Slider ------ */


function sliderResize() {
    var width = $(".container").width();
    var height = $(".container").height();

    if (width <= 700) {
        $(".revo_slide_1").remove();
        $(".plastik_block").show(200);
        $(".rev_slider_wrapper, .rev_slider").css("min-height", "870px");
    } else {
        $(".plastik_block").remove();
        //console.log("plastik_block remove");
    }
    var w = 0;
    var h = 0;
    var dh1 = "";
    var dv1 = "";
    var dh2 = "";
    var dv2 = "";
    var dh3 = "";
    var dv3 = "";
    var dh4 = "";
    var dv4 = "";

    if (width >= 720) {
        var w = 200;
        var h = 130;
        dh1 = "['-150','0','0','0']";
        dv1 = "['10','0','0','0']";
        dh2 = "['150','0','0','0']";
        dv2 = "['10','0','0','0']";
        dh3 = "['-150','0','0','0']";
        dv3 = "['150','0','0','0']";
        dh4 = "['150','0','0','0']";
        dv4 = "['150','0','0','0']";
    }
    if (width >= 940) {
        var w = 290;
        var h = 114;
        dh1 = "['-185','0','0','0']";
        dv1 = "['-20','0','0','0']";
        dh2 = "['185','0','0','0']";
        dv2 = "['-20','0','0','0']";
        dh3 = "['-185','0','0','0']";
        dv3 = "['145','0','0','0']";
        dh4 = "['185','0','0','0']";
        dv4 = "['145','0','0','0']";
    }
    if (width >= 1100) {
        var w = 380;
        var h = 148;
        dh1 = "['-245','0','0','0']";
        dv1 = "['-50','0','0','0']";
        dh2 = "['245','0','0','0']";
        dv2 = "['-50','0','0','0']";
        dh3 = "['-245','0','0','0']";
        dv3 = "['165','0','0','0']";
        dh4 = "['245','0','0','0']";
        dv4 = "['165','0','0','0']";
        /*
         dh1 = "['-280','0','0','0']";
         dv1 = "['-60','0','0','0']";
         dh2 = "['290','0','0','0']";
         dv2 = "['-60','0','0','0']";
         dh3 = "['-280','0','0','0']";
         dv3 = "['190','0','0','0']";
         dh4 = "['290','0','0','0']";
         dv4 = "['190','0','0','0']";
         */
    }
    $(".ggg").html("w: " + width + " h: " + height + " <br/>w2: " + w);
    $(".plitka_1").width(w).height(h);
    $(".caption_1").attr("data-hoffset", dh1);
    $(".caption_1").attr("data-voffset", dv1);
    $(".plitka_2").width(w).height(h);
    $(".caption_2").attr("data-hoffset", dh2);
    $(".caption_2").attr("data-voffset", dv2);
    $(".plitka_3").width(w).height(h);
    $(".caption_3").attr("data-hoffset", dh3);
    $(".caption_3").attr("data-voffset", dv3);
    $(".plitka_4").width(w).height(h);
    $(".caption_4").attr("data-hoffset", dh4);
    $(".caption_4").attr("data-voffset", dv4);
    $(".ggg").html("w: " + width + " h: " + height + " <br/>w2: " + w);
}


sliderResize();

/*main slider*/
$("#banner-main").show().revolution({
    sliderType: "standard",
    sliderLayout: "auto",
    scrollbarDrag: "true",
    dottedOverlay: "none",
    delay: 15000,
    navigation: {
        keyboardNavigation: "off",
        keyboard_direction: "horizontal",
        mouseScrollNavigation: "off",
        bullets: {
            style: "",
            enable: true,
            rtl: false,
            hide_onmobile: false,
            hide_onleave: false,
            hide_under: 767,
            hide_over: 9999,
            tmp: '',
            direction: "vertical",
            space: 10,
            h_align: "right",
            v_align: "center",
            h_offset: 40,
            v_offset: 0
        },
        arrows: {
            enable: false,
            hide_onmobile: false,
            hide_onleave: false,
            hide_under: 767,
            left: {
                h_align: "left",
                v_align: "center",
                h_offset: 20,
                v_offset: 30,
            },
            right: {
                h_align: "right",
                v_align: "center",
                h_offset: 20,
                v_offset: 30
            },
        },
        touch: {
            touchenabled: "on",
            swipe_threshold: 75,
            swipe_min_touches: 1,
            swipe_direction: "horizontal",
            drag_block_vertical: false,
        }
    },
    viewPort: {
        enable: true,
        outof: "pause",
        visible_area: "90%"
    },
    responsiveLevels: [4096, 1024, 778, 480],
    gridwidth: [1140, 1024, 768, 480],
    gridheight: [600, 500, 500, 350],
    lazyType: "none",
    parallax: {
        type: "mouse",
        origo: "enterpoint ", /* slidercenter */
        speed: 15000,
        /* levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50], */
    },
    shadow: 0,
    spinner: "off",
    stopLoop: "off",
    stopAfterLoops: -1,
    stopAtSlide: -1,
    shuffle: "off",
    autoHeight: "off",
    hideThumbsOnMobile: "off",
    hideSliderAtLimit: 0,
    hideCaptionAtLimit: 0,
    hideAllCaptionAtLilmit: 0,
    debugMode: false,
    fallbacks: {
        simplifyAll: "off",
        nextSlideOnWindowFocus: "off",
        disableFocusListener: false,
    }
});


setTimeout(function () {
    /*arrows thumb Slider*/
    $("#rev_arrows").show().revolution({
        sliderType: "standard",
        jsFileLocation: "js/revolution/",
        sliderLayout: "fullwidth",
        dottedOverlay: "none",
        delay: 9000,
        navigation: {
            keyboardNavigation: "off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            mouseScrollReverse: "default",
            onHoverStop: "off",
            touch: {
                touchenabled: "on",
                swipe_threshold: 75,
                swipe_min_touches: 1,
                swipe_direction: "horizontal",
                drag_block_vertical: false
            },
            arrows: {
                style: "zeus",
                enable: true,
                hide_onmobile: true,
                hide_under: 600,
                hide_onleave: true,
                hide_delay: 200,
                hide_delay_mobile: 1200,
                tmp: '<div class="tp-title-wrap"> <div class="tp-arr-imgholder"></div> </div>',
                left: {
                    h_align: "left",
                    v_align: "center",
                    h_offset: 30,
                    v_offset: 0
                },
                right: {
                    h_align: "right",
                    v_align: "center",
                    h_offset: 30,
                    v_offset: 0
                }
            }
        },
        viewPort: {
            enable: true,
            outof: "pause",
            visible_area: "80%",
            presize: false
        },
        responsiveLevels: [1240, 1024, 778, 480],
        visibilityLevels: [1240, 1024, 778, 480],
        gridwidth: [1140, 1024, 768, 480],
        gridheight: [660, 650, 600, 490],
        lazyType: "none",
        parallax: {
            type: "mouse",
            origo: "slidercenter",
            speed: 2000,
            speedbg: 0,
            speedls: 0,
            levels: [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 20, 25, 55],
            disable_onmobile: "on"
        },
        shadow: 0,
        spinner: "off",
        stopLoop: "off",
        stopAfterLoops: -1,
        stopAtSlide: -1,
        shuffle: "off",
        autoHeight: "off",
        hideThumbsOnMobile: "off",
        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        debugMode: false,
        fallbacks: {
            simplifyAll: "off",
            nextSlideOnWindowFocus: "off",
            disableFocusListener: false,
        }
    });

    /*Revolution Carousel 3 cols*/
    $("#rev_carousel").show().revolution({
        sliderType: "carousel",
        jsFileLocation: "js/revolution",
        sliderLayout: "fullscreen",
        dottedOverlay: "none",
        delay: 7000,
        navigation: {
            keyboardNavigation: "off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            mouseScrollReverse: "default",
            onHoverStop: "off",
            bullets: {
                style: "uranus",
                enable: true,
                tmp: '<span class="tp-bullet-inner"></span>',
                hide_onmobile: true,
                hide_under: 480,
                hide_onleave: false,
                hide_delay: 200,
                direction: "horizontal",
                space: 10,
                h_align: "center",
                v_align: "bottom",
                h_offset: 0,
                v_offset: 30
            }
        },
        carousel: {
            horizontal_align: "center",
            vertical_align: "center",
            fadeout: "on",
            vary_fade: "on",
            maxVisibleItems: 3,
            infinity: "on",
            space: 0,
            stretch: "off",
            showLayersAllTime: "off",
            easing: "Power3.easeInOut",
            speed: "900"
        },
        responsiveLevels: [1240, 1024, 778, 480],
        visibilityLevels: [1240, 1024, 778, 480],
        gridwidth: [1140, 960, 750, 480],
        gridheight: [720, 720, 480, 360],
        lazyType: "none",
        parallax: {
            type: "scroll",
            origo: "enterpoint",
            speed: 400,
            speedbg: 0,
            speedls: 0,
            levels: [5, 7, 10, 15, 20, 25, 30, 35, 40, 45, 25, 47, 48, 49, 50, 51, 55],
        },
        shadow: 0,
        spinner: "off",
        stopLoop: "on",
        stopAfterLoops: 0,
        stopAtSlide: 1,
        shuffle: "off",
        autoHeight: "off",
        disableProgressBar: "on",
        hideThumbsOnMobile: "off",
        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        debugMode: false,
        fallbacks: {
            simplifyAll: "off",
            nextSlideOnWindowFocus: "off",
            disableFocusListener: false,
        }
    });

    /*animated elements hero banner*/
    $("#rev_single").show().revolution({
        sliderType: "hero",
        jsFileLocation: "js/revolution",
        sliderLayout: "fullscreen",
        scrollbarDrag: "true",
        dottedOverlay: "none",
        delay: 9000,
        navigation: {},
        responsiveLevels: [1240, 1024, 778, 480],
        visibilityLevels: [1240, 1024, 778, 480],
        gridwidth: [1170, 1024, 778, 480],
        gridheight: [868, 768, 960, 720],
        lazyType: "none",
        parallax: {
            type: "scroll",
            origo: "slidercenter",
            speed: 400,
            levels: [10, 15, 20, 25, 30, 35, 40, -10, -15, -20, -25, -30, -35, -40, -45, 55]
        },
        shadow: 0,
        spinner: "off",
        autoHeight: "off",
        fullScreenAutoWidth: "off",
        fullScreenAlignForce: "off",
        fullScreenOffsetContainer: "",
        disableProgressBar: "on",
        hideThumbsOnMobile: "off",
        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        debugMode: false,
        fallbacks: {
            simplifyAll: "off",
            disableFocusListener: false
        }
    });



    /* ----- Google Map ----- */
    if ($("#map-container").length) {
        function initialize() {
            var mapOptions = {
                zoom: 18,
                scrollwheel: false,
                styles: [{
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [{
                                "color": "#e9e9e9"
                            }, {
                                "lightness": 17
                            }]
                    }, {
                        "featureType": "landscape",
                        "elementType": "geometry",
                        "stylers": [{
                                "color": "#f5f5f5"
                            }, {
                                "lightness": 20
                            }]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [{
                                "color": "#ffffff"
                            }, {
                                "lightness": 17
                            }]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [{
                                "color": "#ffffff"
                            }, {
                                "lightness": 29
                            }, {
                                "weight": 0.2
                            }]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [{
                                "color": "#ffffff"
                            }, {
                                "lightness": 18
                            }]
                    }, {
                        "featureType": "road.local",
                        "elementType": "geometry",
                        "stylers": [{
                                "color": "#ffffff"
                            }, {
                                "lightness": 18
                            }]
                    }, {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [{
                                "color": "#f5f5f5"
                            }, {
                                "lightness": 21
                            }]
                    }, {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [{
                                "color": "#d5d5d5"
                            }, {
                                "lightness": 21
                            }]
                    }, {
                        "elementType": "labels.text.stroke",
                        "stylers": [{
                                "visibility": "on"
                            }, {
                                "color": "#f8f8f8"
                            }, {
                                "lightness": 25
                            }]
                    }, {
                        "elementType": "labels.text.fill",
                        "stylers": [{
                                "saturation": 36
                            }, {
                                "color": "#222222"
                            }, {
                                "lightness": 30
                            }]
                    }, {
                        "elementType": "labels.icon",
                        "stylers": [{
                                "visibility": "off"
                            }]
                    }, {
                        "featureType": "transit",
                        "elementType": "geometry",
                        "stylers": [{
                                "color": "#f5f5f5"
                            }, {
                                "lightness": 19
                            }]
                    }, {
                        "featureType": "administrative",
                        "elementType": "geometry.fill",
                        "stylers": [{
                                "color": "#fefefe"
                            }, {
                                "lightness": 10
                            }]
                    }, {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [{
                                "color": "#fefefe"
                            }, {
                                "lightness": 17
                            }, {
                                "weight": 1.2
                            }]
                    }],
                center: new google.maps.LatLng(40.712775, -74.005973) //please add your location here
            };
            var map = new google.maps.Map(document.getElementById('map-container'),
                    mapOptions);
            var marker = new google.maps.Marker({
                position: map.getCenter(),
                //icon: 'images/locating.png', if u want custom 
                map: map
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    }


    /* Initializing Particles */
    if ($("#particles-js").length) {
        window.onload = function () {
            Particles.init({
                selector: '#particles-js',
                color: '#ffffff',
                connectParticles: false,
                sizeVariations: 14,
                maxParticles: 140,
            });
        };
    }

    /*Wow Animations*/
    if ($(".wow").length) {
        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: false,
            live: true
        });
        new WOW().init();
    }

}, 200);