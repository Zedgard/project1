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
//    $(".carousel-video").on("mouseover", function () {
//        this.pause();
//    });
//    $(".carousel-video").on("mouseleave", function () {
//        this.play();
//        $(this).css("background-color", "black");
//    });

    initCartArray();
    //initCartCount();
    init_price_val();
    init_logout();
    init_not_processed_col();
    init_get_emails_col();
    init_office_list_categorys_col();
    init_bottom_cookie_btn();
    init_promo_input();
    init_real_time();
    get_promos('0');

    init_ckick_to_upload_page();

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
     * WOW effect 
     * 
     */
    if (typeof WOW !== "undefined") {
        wow = new WOW(
                {
                    boxClass: 'wow', // default
                    animateClass: 'animated', // default
                    offset: 0, // default
                    mobile: true, // default
                    live: true        // default
                }
        )
        wow.init();
    }

    /*
     * Фильтр для мобильной версии 
     */
    w = $(window).width();
    var productMenuShowAction = 0;
    $('.product-menu-show, .product-menu-top-title').click(function () {
        //$(".product-menu-top-elements").width(w - 20);
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

    $('.jaccordion').accordion({
        heightStyle: 'content'
    });

    // Отобразить пароль
    $('body').on('click', '.password-checkbox', function () {
        if ($(this).is(':checked')) {
            $('[name="password"]').attr('type', 'text');
        } else {
            $('[name="password"]').attr('type', 'password');
        }
    });

});

Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

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

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

var move_start = 0;
function move(elm, animate) {
    if (typeof animate == "undefined" || animate.length == 0) {
        animate = 300;
    }
    if (move_start == 0) {
        setTimeout(function () {
            //event.preventDefault();
            try {
                var height = $(window).height();
                var top = $(elm).offset().top - 100; // (height / 2)
                //console.log('offset: ' + $(elm).offset().top + ' - ' + (height / 2));
                $('body,html').animate({scrollTop: top}, animate);
            } catch (exception) {
            }

            move_start = 0;
        }, 300);
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
    if ($(".mini-products-list").length > 0) {
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
                        if(e['data'][i]['account_id'] != 2){//kaijean
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
                    //move(".cart_list", 300);

                    ;
                }
            }
            //kaijean
            if (!!$(".disabled_cart_list")) {
                var disabled_cart_itms = [];
                var total = 0;
                var price_promo_total = 0;
                $(".disabled_cart_list").html("");
                if (!!e['data']) {
                    for (var i = 0; i < e['data'].length; i++) {
                        // console.log(e['data'][i]['account_id']);
                        if(e['data'][i]['account_id'] == 2){//kaijean
                        disabled_cart_itms.push(e['data'][i]['id']);
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

                        $(".disabled_cart_list").append(html);

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
                    }
                }
                if(disabled_cart_itms.length > 0){
                    html = '<div class="alert alert-warning">Обратите внимание.Товар выше приобретается отдельно. <a href="https://oplata.edgardzaycev.com/?go_cart=['+disabled_cart_itms+']&email='+e['email']+'" class="alert-link" target="_blank">Оплатить отдельно</a></div>';
                    $(".disabled_cart_list").append(html);
                }
                
            }
            //kaijean
            if (typeof $(".fancybox")[0] != 'undefined') {
                $(".fancybox").fancybox();
            }
            initCartProductRemove();
            init_price_val();
        });
    }
}
//if (typeof promos === 'undefined') {
//    var promos = [];
//}
/**
 * Промо
 * @returns {undefined}
 */
function init_promo_input() {
    if ($(".input_promo_code").length > 0) {
        $(".btn_input_promo_code").unbind('click').click(function () {
            var v = $(".input_promo_code").val();
            get_promos(v);

        });
        get_promos('0');
    }
}

function get_promos(code) {
    if ($(".input_promo_code").length > 0) {
        $(".errors_promo_code .html_text").html(ajax_load);
        sendPostLigth('/jpost.php?extension=promo', {"getCodePromos": code}, function (e) {
            $(".list_promos div").remove();
            if (e['success'] == '1') {
                //console.log(e['data']);
                if (e['data'].length > 0) {
                    $(".list_promos").append('<div class="mb-3" style="font-size:1.5rem;">Список купонов:</div>');
                    //console.log(e['data'].length);
                    for (var i = 0; i < e['data'].length; i++) {
                        var price = e['data'][i]['amount'] + 'р.';
                        if (e['data'][i]['percent'] > 0) {
                            price = e['data'][i]['percent'] + '%';
                        }
                        $(".list_promos").append('<div class="item_promo">\n\
                            <span class="list_promo_title">' + e['data'][i]['title'] + '</span> \n\
                            <span class="list_promo_code ml-3">' + e['data'][i]['code'] + '</span> \n\
                            <span class="list_promo_delete ml-3" promo_delete_code="' + e['data'][i]['code'] + '"><i class="fas fa-times"></i></span>\n\
                            <span class="list_promo_price ml-3">' + price + '</span>\n\
                    </div>');
                    }
                }
            } else {
                var errors_html = e['errors'].toString();
                $(".errors_promo_code .html_text").html(errors_html);
            }
            initCartArray();
            init_delete_promo();
        });
    }
}

function init_delete_promo() {
    if ($(".list_promo_delete").length > 0) {
        $(".list_promo_delete").unbind('click').click(function () {
            var v = $(this).attr("promo_delete_code");
            sendPostLigth('/jpost.php?extension=promo', {"deleteCodePromo": v}, function (e) {
                get_promos('0');
            });
        });
    }
}

//function get_promo_price(product_id, price) {
//    if (promos.length > 0) {
//        for (var i = 0; i < promos.length; i++) {
//            if (promos[i]['product_ids'].length > 0) {
//                var ex = promos[i]['product_ids'].split(',');
//                for (var ii = 0; ii < ex.length; ii++) {
//                    if (ex[ii] == product_id) {
//                        amount
//                    }
//                }
//            }
//        }
//    }
//}


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
    if ($(".not_processed_col").length > 0) {
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
    if ($(".get_emails_col").length > 0) {
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
    if ($(".cart_product_add").length > 0) {
        $(".cart_product_add").unbind('click').click(function () {
            var cart_product_id = $(this).attr('product_id');
            var go_url = '';
            if (!!$(this).attr('go_url')) {
                go_url = $(this).attr('go_url');
            }
            // Информаия по товару
            var cart_product_title = $(this).closest(".btn_product_list").find(".info_product_title").val();
            var cart_product_img = $(this).closest(".btn_product_list").find(".info_product_img").val();

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
                if (e['success'] == 1) {
                    open_cart_modal(cart_product_title, cart_product_img);
                    initCartArray();
                    if (go_url.length > 0) {
                        window.location.href = go_url;
                    }
                } else {
                    alert(e['errors'].toString());
                }

            });
        });
    }
}

/* 
 * Модальное окно
 */
function open_cart_modal(title, img) {
    if (typeof title == "undefined" || typeof img == "undefined") {
        console.log('Not data open_cart_modal');
        return 1;
    }
    $("#go_cart_modal").find(".info_product_title").html(title);
    //$("#go_cart_modal").find(".info_product_price").html(price);
    $("#go_cart_modal").find(".info_product_img").attr("src", img);

    $("#go_cart_modal").modal('show');

    /*
     * Модальное окно кнопка закрыть 
     */
    $(".close_cart_modal").unbind('click').click(function () {
        $("#go_cart_modal").modal('hide');
    });
}



/* Удаление с корзины */
function initCartProductRemove() {
    if ($(".cart_product_remove").length > 0) {
        $(".cart_product_remove").unbind('click').click(function () {
            var btn_o = this;
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
}


function init_office_list_categorys_col() {
    if ($(".office_list_categorys").length > 0) {
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

function init_datepicker(numberOfMonths) {
    if (numberOfMonths.length == 0) {
        numberOfMonths = 3
    }
    // Русифицируем
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: 'Пред',
        nextText: 'След',
        currentText: 'Сегодня',
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
            'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
        dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
        dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        weekHeader: 'Нед',
        dateFormat: 'yy-mm-dd',
        //maxDate: "+2M +30D",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    $('.inp_datepicker').datepicker({
        changeMonth: false,
        changeYear: false,
        numberOfMonths: numberOfMonths,
        showButtonPanel: false
    });
}

function init_bottom_cookie_btn() {
    if ($(".bottom_cookie_btn").length > 0) {
        $(".bottom_cookie_btn").unbind('click').click(function () {
            sendPostLigth('/jpost.php', {
                "bottom_cookie_btn": 1
            }, function (e) {
                if (e['data'].length > 0) {
                    //console.log(e['data']);
                    var cookie_date = new Date();
                    cookie_date.setYear(cookie_date.getFullYear() + 5);
                    setCookie(e['data'], '1', {secure: true, path: '/', expires: cookie_date.toUTCString()});
                    $(".bottom_cookie_block").remove();
                }
            });
        });

    }
}

// возвращает куки с указанным name,
// или undefined, если ничего не найдено
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}


// Пример использования:
//setCookie('user', 'John', {secure: true, 'max-age': 3600});
function setCookie(name, value, options = {}) {

    var cookie_date = new Date();
    cookie_date.setYear(cookie_date.getFullYear() + 5);

    //options = {
    //    path: '/'//,
    //expires: cookie_date.toUTCString()
    //};


    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}

// Удаление 
function deleteCookie(name) {
    setCookie(name, "", {
        'max-age': -1
    });
}

/**
 * Текущее время на сайте
 * @returns {undefined}
 */
function init_real_time() {
    if ($(".real_time").length > 0) {

        function time_format_str(val) {
            var text = String((val.toString().length === 2) ? val : '0' + val.toString());
            return text;
        }

        function server_time() {
            sendPostLigth('/jpost.php?extension=auth', {"get_real_time": 1}, function (e) {
                if (e['data'].length > 0) {
                    var date = new Date(e['data']);
                    var seconds = date.getSeconds();

                    var hours_str = (date.getHours().toString().length === 2) ? date.getHours() : '0' + date.getHours().toString();
                    var minutes_str = (date.getMinutes().toString().length === 2) ? date.getMinutes() : '0' + date.getMinutes().toString();
                    var seconds_str = (date.getSeconds().toString().length === 2) ? date.getSeconds() : '0' + date.getSeconds().toString();
                    $(".real_time").html((hours_str + ":" + minutes_str + ":" + seconds_str));
                    setInterval(function () {
                        seconds++;
                        date.setSeconds(seconds);
                        var hours_str = time_format_str(date.getHours());
                        var minutes_str = time_format_str(date.getMinutes());
                        var seconds_str = time_format_str(date.getSeconds());
                        $(".real_time").html((hours_str + ":" + minutes_str + ":" + seconds_str));
                        if (seconds === 60) {
                            seconds = 0;
                        }
                    }, 1000);
                } else {
                    $(".real_time").html('---');
                }
            });
        }
//    var time = setInterval(function () {
//        server_time();
//    }, 60000);
        server_time();
    }
}

/**
 * Выполнить клик по видимому элементу после загрузки страницы
 * @returns {undefined}
 */
function init_ckick_to_upload_page() {
    if ($(".ckick_to_upload_page").length > 0) {
        $(".ckick_to_upload_page").each(function (indx, element) {
            setTimeout(function () {
                if ($(element).is(':visible')) {
                    $(element).click();
                }
            }, 200);
        });
    }
}