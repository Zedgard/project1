/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var productMenuShow = 0;
var w = 0;
var site_scrollY = 0;
$(document).ready(function () {
    /*
     * Остановка видео
     */
    $(".carousel-video").on("mouseover", function () {
        this.pause();
    });
    $(".carousel-video").on("mouseleave", function () {
        this.play();
        $(this).css("background-color", "black");
    });


    initCartArray();
    //initCartCount();
    init_price_val();
    init_logout();
    init_not_processed_col();
    init_get_emails_col();
    init_btn_send_message();
    init_office_list_categorys_col();
    init_bottom_cookie_btn();

//    $("#menu").on("click", "a", function (event) {
//        event.preventDefault();
//        var id = $(this).attr('href'),
//                top = $(id).offset().top;
//        $('body,html').animate({scrollTop: top}, 1500);
//    });

    $(window).scroll(function () {
        var h = $(window).height();
        var s = 80;
        if (h > 600) {
            s = 150;
        }

        if ($(window).scrollTop() > s) {
            //$(".product-menu-show").show(200);
            //$(".border-top-none").css("height", "200px");

            $('.border-top-0').animate({'top': '0px'}, 500);

            $(".border-top-0").css("background-color", '#FFFFFF').css('background-image', "url('/themes/site1/images/top_bg.png')");
            $(".border-top-0").css('position', 'fixed').css('box-shadow', '0 5px 5px -5px rgba(0, 0, 0, .5');
        } else {
            //$(".product-menu-show").hide(200);
            $('.border-top-0').stop(true).animate({'top': '-200px'}, 500);
            $(".border-top-0").css('position', '').css("background-color", '').css('background-image', "");
            $(".border-top-0").css('box-shadow', '');
        }
        //console.log('ss: ' + window.scrollY);

    });
//    $(window).scroll(function () {
//        
//        if (site_scrollY > window.scrollY) {
//            $(".footer_mobile_menu").css("bottom", "-20px");
//            //$(".footer_mobile_menu_div span").html("-20px");
//            //console.log('up');
//        } else {
//            $(".footer_mobile_menu").css("bottom", "-49px");
//            //$(".footer_mobile_menu_div span").html("-49px");
//            //console.log('down');
//        }
//        site_scrollY = window.scrollY;
//    });

//    setInterval(function () {
//            if (site_scrollY > window.scrollY) {
//                $(".footer_mobile_menu").css("bottom", "-40px");
//            } else {
//                $(".footer_mobile_menu").css("bottom", "-70px");
//            }
//            site_scrollY = window.scrollY;
//        }, 100);

//    setInterval(function () {
//        //$('.border-top-0').animate({scrollTop: top}, 1500);
//        var s = $(window).scrollTop();
//        //console.log("s: " + s);
//        //$(".border-top-0").animate({'left':'0px'},500); .css('position', 'fixed').css('top', '-300')
//
//
//        $(window).scroll(function () {
//            var h = $(window).height();
//            var s = 80;
//            if (h > 600) {
//                s = 150;
//            }
//
//            if ($(window).scrollTop() > s) {
//                //$(".product-menu-show").show(200);
//                //$(".border-top-none").css("height", "200px");
//
//                $('.border-top-0').animate({'top': '0px'}, 500);
//
//                $(".border-top-0").css("background-color", '#FFFFFF').css('background-image', "url('/themes/site1/images/top_bg.png')");
//                $(".border-top-0").css('position', 'fixed').css('box-shadow', '0 5px 5px -5px rgba(0, 0, 0, .5');
//            } else {
//                //$(".product-menu-show").hide(200);
//                $('.border-top-0').stop(true).animate({'top': '-200px'}, 500);
//                $(".border-top-0").css('position', '').css("background-color", '').css('background-image', "");
//                $(".border-top-0").css('box-shadow', '');
//            }
//
//
//        });
//        $('#slidebox .close').bind('click', function () {
//            $(this).parent().remove();
//        });
//
//
//    }, 200);

//    setInterval(function () {
//        if ($(window).scrollTop() > 300) {
//            if (productMenuShow == 0) {
//                $(".product-menu-show").show();
//                productMenuShow = 1;
//            }
//        } else {
//            if (productMenuShow == 1) {
//                $(".product-menu-show").hide();
//                productMenuShow = 0;
//            }
//        }
//    }, 200);

//    $(".product-menu-show").click(function () {
//        $(".product-menu-block").show("slide", {direction: "right"}, "100%");
//    });
//    $(".product-menu-hide").click(function () {
//        $(".product-menu-block").show("slide", {direction: "right"}, "-600");
//    });

    /*
     * Фильтр для мобильной версии 
     */
    w = $(window).width();
    var productMenuShowAction = 0;
    $('.product-menu-show, .product-menu-top-title').click(function () {
        $(".product-menu-top-elements").width(w - 40);
        //alert('width' + w + ' ' +  $('.product-menu-block').css("right"));

        if (productMenuShowAction == 1)
        {
            productMenuShowAction = 0;
            $('.product-menu-block').animate({"right": '-1000px'});

            $('.product-menu-show i').animate({"right": '20px'});
            $('.product-menu-show i').css("left", 'auto');
            //alert('r: ' + $('.product-menu-show i').css("right") + ' l: '+ $('.product-menu-show i').css("left"));
        } else
        {
            productMenuShowAction = 1;
            $('.product-menu-block').animate({"right": '0px'});

            $('.product-menu-show i').animate({"left": '20px'});
            $('.product-menu-show i').css("right", 'auto');
            //alert('r: ' + $('.product-menu-show i').css("right") + ' l: '+ $('.product-menu-show i').css("left"));
        }
    });

    initCartProductAdd();
    initCartProductRemove();

});
var animateTopVal = 0;
function animateTop(val, height) {
    if (animateTopVal === 0) {
        animateTopVal = 1;
    }
    //console.log('animateTop: ' + animateTopVal);
    setInterval(function () {
        if (Number(val) == 0 || Number(val) == Number(height)) {
            animateTopVal = 0;
        }
        if (animateTopVal == 1) {
            $(".border-top-0").css('top', val);
            //console.log(val);
            val = val + 1;
        }
    }, 200);

}



var move_start = 0;
function move(elm, animate) {
    if (typeof animate == "undefined" || animate.length == 0) {
        animate = 300;
    }
    //console.log('move: ' + elm);
    if (move_start == 0) {
        setTimeout(function () {
            //event.preventDefault();
            try {
                var height = $(window).height();
                var top = $(elm).offset().top - (height / 2);
                $('body,html').animate({scrollTop: top}, animate);
            } catch (exception) {
                console.log('move');
            }

            move_start = 0;
        }, 500);
    }
    move_start = 1;
}

/**
 * Добавить в цены пробелы
 * @param {type} num
 * @returns {unresolved}
 */
function prettify(num) {
    var n = num.toString();
    var separator = " ";
    return n.replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g, "$1" + separator);
}
/**
 * Пробежимся по странице и отформатируем цены
 * @returns {undefined}
 */
function init_price_val() {
    $(".init_price_val").each(function () {
        var v = $(this).html();
        $(this).html(prettify(v));
    });
}

var cart_itms = [];
function initCartArray() {
    /* Данные по корзины */
    sendPostLigth('/jpost.php?extension=cart', {"cart_product_get_array": 1}, function (e) {
        var o = $(".mini-products-list");
        var total_titles = '';
        var total = 0;

        /* Отображение в мини корзине */
        if (!!$(".cart-info")) {
            o.html("");
            if (!!e['data']) {
                for (var i = 0; i < e['data'].length; i++) {
                    var price = e['data'][i]['price'];
                    if (e['data'][i]['price_promo'] > 0) {
                        price = Number(e['data'][i]['price_promo']);

                    }
                    var imgFirst = '/themes/site1/images/gallery-box1.jpg';
                    //console.log("g: " + e['data'][i]['images_str']);

                    if (typeof e['data'][i]['images_str'] != 'undefined' && e['data'][i]['images_str'].length > 0) { //e['data'][i]['products_wares_info'].length > 0
                        imgFirst = e['data'][i]['images_str'];//e['data'][i]['products_wares_info'][0]['images'];
                    }

                    total += Number(price);
                    o.append('<li class="item">\n\
                    <a href="/shop/?product=' + e['data'][i]['id'] + '" title="' + e['data'][i]['title'] + '" class="product-image"><img src="' + imgFirst + '"></a>\n\
                    <div class="product-details">\n\
                    <p class="product-name">\n\
                    <a href="/shop/?product=' + e['data'][i]['id'] + '">' + e['data'][i]['title'] + '</a>\n\
                    </p>\n\
                    <p class="qty-price"><span class="price">' + price + '</span>\n\
                    </p>\n\
                    <a href="javascript:void(0)" title="Удалить из корзины" class="btn-remove cart_product_remove" product_id="' + e['data'][i]['id'] + '">\n\
                    <i class="fas fa-times"></i>\n\
                    </a>\n\
                    </div>\n\
                    </li>');
                    //console.log('itm: ' +  e['data'][i]['id']);
                    total_titles += '"' + e['data'][i]['title'] + '" ';
                    $('.cart_product_add[product_id="' + e['data'][i]['id'] + '"]').hide();
                    $('.cart_product_go_card[product_id="' + e['data'][i]['id'] + '"]').show();
                    $(".cart-info").find(".cart-qty").html(e['data']['count']);
                }
                $(".price-total").find(".price").html(total);
                //$(".total_titles").val(total_titles);
                $(".cart-info").find(".cart-qty").html(e['data'].length);
                if (e['data'].length > 0) {
                    $(".cart-info").show();
                } else {
                    $(".cart-info").hide();
                }
                //$(".cart_total_val").val(total);
            }
        }


        if (!!$(".cart_list")) {
            cart_itms = [];
            var total = 0;
            var price_promo_total = 0;
            $(".cart_list").html("");
            if (!!e['data']) {
                window.dataLayer = window.dataLayer || [];
                for (var i = 0; i < e['data'].length; i++) {
                    cart_itms.push(e['data'][i]);
                    var isPromo = 0;
                    var price_promo = 0;
                    var price = e['data'][i]['price'];
                    if (e['data'][i]['price_promo'] > 0) {
                        isPromo = 1;
                        price_promo = Number(e['data'][i]['price_promo']);
                        price_promo_total += price - price_promo;
                    }
                    var imgFirst = '/themes/site1/images/gallery-box1.jpg';
                    if (typeof e['data'][i]['images_str'] != 'undefined' && e['data'][i]['images_str'].length > 0) { //e['data'][i]['products_wares_info'].length > 0
                        imgFirst = e['data'][i]['images_str'];//e['data'][i]['products_wares_info'][0]['images'];
                    }

                    var products_category_list = e['data'][i]['products_category_list'];
                    // ' + products_category_list.toString() + '

                    var html = '<div class="row">';
                    html += '<div class="col-3">';

                    html += '<a href="' + imgFirst + '" class="fancybox d-none d-lg-block"><img src="' + imgFirst + '" class="cart_product_list_img"/></a>';
                    html += '<a href="' + imgFirst + '" class="fancybox d-lg-none"><img src="' + imgFirst + '" class="w-100"/></a>';
                    html += '</div>';
                    html += '<div class="col-6">';
                    html += '<div class="row">';
                    html += '<div class="col-12 font-weight-bold"></div>';
                    html += '</div>';
                    html += '<div class="row">';
                    html += '<div class="col-12 cart_product_list_title">' + e['data'][i]['title'] + '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="col-3 text-right font-weight-bold" style="font-size: 1.4rem;">';

                    var product_price = 0;
                    if (isPromo > 0) {
                        total += Number(price_promo);
                        product_price = price_promo;
                        html += '<div><span class="init_price_val" style="color:#FF0000;">' + price_promo + '</span> <i class="fa fa-ruble" style="color:#FF0000;"></i></div>';
                        html += '<div><span class="init_price_val wares_old_price_cart">' + price + '</span> <i class="fa fa-ruble" style="color: #808080;"></i></div>';
                    } else {
                        total += Number(price);
                        product_price = price;
                        html += '<div><span class="init_price_val">' + price + '</span> <i class="fa fa-ruble"></i></div>';
                    }


                    html += '</div>';
                    html += '</div>';
                    html += '<div class="cart_product_remove btn_cart_product_remove_display_none" product_id="' + e['data'][i]['id'] + '" title="Удалить из корзины" style="font-size: 1rem;text-align: right;z-index: 9;position: relative;">Удалить</div>';

                    html += '<hr/>';
                    // <span class="fas fa-times"></span>

                    $(".price_promo_total").html((price_promo_total * -1));

                    $(".cart_list").append(html);

                    // Оформление заказа.
                    if (window.location.pathname == "/shop/cart/") { // зафиксируем только на странице корзины
                        dataLayer.push({
                            'ecommerce': {
                                'currencyCode': 'UAH',
                                'coupon': 'Номер купона',
                                'checkout': {
                                    'actionField': {'step': 1},
                                    'products': [{
                                            "name": e['data'][i]['title'],
                                            "price": product_price,
                                            "quantity": 1,
                                        },
                                        {
                                            "name": e['data'][i]['title'],
                                            "price": product_price,
                                            "quantity": 1
                                        }]
                                }
                            },
                            'event': 'gtm-ee-event',
                            'gtm-ee-event-category': 'Enhanced Ecommerce',
                            'gtm-ee-event-action': 'Checkout Step 1',
                            'gtm-ee-event-non-interaction': 'False',
                        });
                    }
                }
                if (price_promo_total > 0) {
                    $(".cart_product_promo_block").show();
                } else {
                    $(".cart_product_promo_block").hide();
                }
                $(".total_cart").html(total);
                $(".cart_total").html(total);
                if (e['data'].length > 0) {
                    $(".cart-info").show();
                } else {
                    $(".cart-info").hide();
                }
                // cart_list
                move(".cart_list", 300);
                ;
            }
        }
        if (typeof $(".fancybox")[0] != 'undefined') {
            $(".fancybox").fancybox();
        }
        initCartProductRemove();
        init_price_val();
    });
}

/**
 * Выход из системы
 * @returns {undefined}
 */
function init_logout() {
    $(".btn_logout").unbind('click').click(function () {
        //console.log("btn_logout");
        sendPostLigth('/jpost.php?extension=auth', {"logout": 1}, function () {

        });
    });
}

/**
 * Необработанные заказы
 * @returns {undefined}
 */
function init_not_processed_col() {
    //alert("not_processed_col");
    if (!!$(".not_processed_col")) {
        sendPostLigth('/jpost.php?extension=cart', {"not_processed_col": 1}, function (e) {
            //$(".cart-info").find(".cart-qty").html(e['data']['count']);
            $(".not_processed_col").html("");
            if (Number(e['not_processed_col']) > 0) {
                $(".not_processed_col").html("(" + e['not_processed_col'] + ")");
            }
        });
    }
}

/**
 * Новые подписчики
 * @returns {undefined}
 */
function init_get_emails_col() {
    if (!!$(".get_emails_col")) {
        sendPostLigth('/jpost.php?extension=get_emails', {"get_emails_col": 1}, function (e) {
            $(".get_emails_col").html("");
            if (Number(e['get_emails_col']) > 0) {
                $(".get_emails_col").html("(" + e['get_emails_col'] + ")");
            }
        });
    }
}

function initCartCount() {
    /* Данные по корзины */
    sendPostLigth('/jpost.php?extension=cart', {"cart_product_get_count": 1}, function (e) {
        $(".cart-info").find(".cart-qty").html(e['data']['count']);

    });
}


// Добавление товаров в корзину -------------

/* Добавление в корзину */
function initCartProductAdd() {
    $(".cart_product_add").unbind('click').click(function () {
        var cart_product_id = $(this).attr('product_id');
        var o = $('.cart_product_add[product_id="' + cart_product_id + '"]').closest(".product_info");
        var product_info_title = $.trim(o.find(".product_info_title").html());
        var product_info_price = $.trim(o.find(".product_info_price").html());
        //console.log("product_info_title: " + product_info_title + ' - ' + product_info_price);
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            "ecommerce": {
                "currencyCode": "RUB",
                "add": {
                    "products": [{
                            "name": product_info_title, // Например, https://prnt.sc/un3f6x 
                            "price": product_info_price, // Например, https://prnt.sc/un3hf7 
                            "quantity": 1
                        }, {
                            "name": product_info_title, // Например, https://prnt.sc/un3f6x 
                            "price": product_info_price, // Например, https://prnt.sc/un3hf7 
                            "quantity": 1,
                        }]
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Product Add Cart',
            'gtm-ee-event-non-interaction': 'False',
        });


        sendPostLigth('/jpost.php?extension=cart', {"cart_product_add": 1, "cart_product_id": cart_product_id}, function (e) {
            //$(".cart_product_add").html("");
            //initCartCount();
            initCartArray();
        });
    }
    );
}
/* Удаление с корзины */
function initCartProductRemove() {
    $(".cart_product_remove").unbind('click').click(function () {
        var cart_product_id = $(this).attr('product_id');

        var o = $('.cart_product_add[product_id="' + cart_product_id + '"]').closest(".product_info");
        var product_info_title = $.trim(o.find(".product_info_title").html());
        var product_info_price = $.trim(o.find(".product_info_price").html());
        //console.log("product_info_title: " + product_info_title + ' - ' + product_info_price);
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            "ecommerce": {
                "currencyCode": "RUB",
                "remove": {
                    "products": [{
                            "name": product_info_title,
                            "price": product_info_price,
                            "quantity": 1
                        },
                        {
                            "name": product_info_title,
                            "price": product_info_price,
                            "quantity": 1
                        }]
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': "Enhanced Ecommerce",
            'gtm-ee-event-action': "Product Remove Cart",
            'gtm-ee-event-non-interaction': "False",
        });

        sendPostLigth('/jpost.php?extension=cart', {"cart_product_remove": 1, "cart_product_id": cart_product_id}, function (e) {
            //initCartCount();
            initCartArray();
            $('.cart_product_add[product_id="' + cart_product_id + '"]').show();
            $('.cart_product_go_card[product_id="' + cart_product_id + '"]').hide();
        });
    });
}

function init_btn_send_message() {
    if (!!$(".btn_send_user_message")) {
        $(".form_send_user_message").find(".user_email").keyup(function () {
            $(".form_send_user_message").find(".user_email").css("border-color", "");
        });
        $(".form_send_user_message").find(".user_message").keyup(function () {
            $(".form_send_user_message").find(".user_message").css("border-color", "");
        });
        $(".btn_send_user_message").click(function () {
            var user_fio = $(".form_send_user_message").find(".user_fio").val();
            var user_email = $(".form_send_user_message").find(".user_email").val();
            var user_subject = $(".form_send_user_message").find(".user_subject").val();
            var user_message = $(".form_send_user_message").find(".user_message").val();
            if (user_email.length > 2 && user_message.length > 10) {
                sendPostLigth('/jpost.php?extension=cart', {
                    "user_send_message": 1,
                    "user_fio": user_fio,
                    "user_email": user_email,
                    "user_subject": user_subject,
                    "user_message": user_message,
                }, function (e) {

                });
            } else {
                if (user_email.length <= 2) {
                    $(".form_send_user_message").find(".user_email").css("border-color", "#ff0000");
                }
                if (user_message.length <= 10) {
                    $(".form_send_user_message").find(".user_message").css("border-color", "#ff0000");
                }
                alert('Не заполнены поля!');
            }

        });
    }
}


function init_office_list_categorys_col() {
    if (!!$(".office_list_categorys")) {
        sendPostLigth('/jpost.php?extension=wares', {
            "init_office_list_categorys_col": 1
        }, function (e) {
            if (e['data'].length > 0) {
                var a = 0;
                for (var i = 0; i < e['data'].length; i++) {
                    if (!!$(".katalog_elm_col_" + e['data'][i]['category_id'])) {
                        $(".katalog_elm_col_" + e['data'][i]['category_id']).html(e['data'][i]['col']);
                    }
                    a = a + Number(e['data'][i]['col']);
                }
                if (!!$('.katalog_elm_col_all')) {
                    $('.katalog_elm_col_all').html(a);
                }
            }
        });
    }
}

function init_bottom_cookie_btn() {
    if (!!$(".bottom_cookie_btn")) {
        $(".bottom_cookie_btn").unbind('click').click(function () {
            sendPostLigth('/jpost.php', {
                "bottom_cookie_btn": 1
            }, function (e) {
                if (e['data'].length > 0) {
                    console.log(e['data']);
                    $(".bottom_cookie_block").remove();
                }
            });
        });

    }
}
