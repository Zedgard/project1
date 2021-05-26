var searchProductStr = '';
$.fn.isInViewport = function () {
    var elementTop = 0;
    if (!!$(this).offset()) {
        elementTop = $(this).offset().top;
    }
    var elementBottom = elementTop + $(this).outerHeight();
    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
};

$(document).ready(function () {



    setInterval(function () {
        //console.log('btn_category_controll_active');
        var filter = $(".btn_category_controll_active").attr("data-filter");
        if ($(".product_load_next").isInViewport() && filter == 'all') {
            var i = 0;
            var max = 6;
            var t = 1;
            $(".container_mix").find(".mixitup-container").each(function () {
                i++;
                if ($(this).is(':hidden') && max > 0) {
                    max--;
                    var e = this;
                    setTimeout(function () {
                        $(e).show(200);
                    }, (t * 100));
                    t = t + 1;
                }
                if (max < 0) {
                    max = 10;
                    t = 1;
                }
            });
        } else {

        }
    }, 500);


//    $('.carousel').carousel({
//        interval: 2000
//    })

    $("img.lazyload").lazyload();
    /*
     * Актив\ация фильтра каталога
     * @type Element
     */


    $(".btn_category_controll").click(function () {
        var elm = $(this).attr('elm');
        sendPostLigth('/jpost.php?extension=products', {"category_controll": elm}, function (e) {

        });
        $(".btn_category_controll").removeClass("btn_category_controll_active");
        $(this).addClass("btn_category_controll_active");
    });

    $(".btn_category_controll_cart").click(function () {
        var elm = $(this).attr('elm');
        sendPostLigth('/jpost.php?extension=products', {"category_controll": elm}, function (e) {
            location.href = '/shop/';
        });
    });
    $(".waresImg").mouseover(function () {
        $(this).css("position", "sticky");
    }).mouseout(function () {
        $(this).css("position", "static");
    });
    $(".searchProductStr").keyup(function () {
        var v = $(this).val();
        setSearchProductStr(v);
        if (v.length > 1) {

        }
    });
    /**
     * Продукты 
     * @returns {undefined}
     */
    function getProducts() {
        sendPostLigth('/jpost.php?extension=products', {"getProducts": '1', "searchStr": searchProductStr}, function (e) {
            // console.log(e['data']);
            $(".elements_products").html(e['data']);
        });
    }

    // Отчистка фильтра
    $(".filter_clear").unbind('click').click(function () {
        sendPostLigth('/jpost.php?extension=products', {"filter_clear": 1}, function (e) {
            document.location.href = './';
        });
    });

    // Новинки
    $(".productNew").change(function () {
        var checked = 0;
        if ($(this).prop('checked')) {
            checked = 1;
        }
        sendPostLigth('/jpost.php?extension=products', {"checkedProductNew": checked}, function (e) {
            document.location.reload();
        });
        //$(this).prop('checked', true);
    });

    // Промо
    $(".productPromo").change(function () {
        var checked = 0;
        if ($(this).prop('checked')) {
            checked = 1;
        }
        sendPostLigth('/jpost.php?extension=products', {"checkedProductPromo": checked}, function (e) {
            document.location.reload();
        });
    });

    // Категория
    $(".check_categorys").change(function () {
        var checked = 0;
        var val = $(this).val();
        if ($(this).prop('checked')) {
            checked = 1;
        }
        sendPostLigth('/jpost.php?extension=products', {"check_categorys": val, "checked": checked}, function (e) {
            document.location.reload();
        });
    });

    // Тема
//    $(".product_theme_btn").unbind('click').click(function () {
//        var val = $(this).attr("elm_id");
//        sendPostLigth('/jpost.php?extension=products', {"click_product_theme": val}, function (e) {
//            document.location.reload();
//        });
//    });
    $(".productSearchString").change(function () {
        var productSearchString = $(this).val();
        sendPostLigth('/jpost.php?extension=products', {"productSearchString": productSearchString}, function (e) {
            document.location.href = '/shop/';
        });
    });
    initCartProductAdd();
    initCartProductRemove();
    init_category_controll();

});
function setSearchProductStr(v) {
    searchProductStr = v;
}

// Показы товаров -------------
window.dataLayer = window.dataLayer || [];
$(".product_info").each(function () {
    var product_info_title = $.trim($(this).find(".product_info_title").html());
    var product_info_price = $.trim($(this).find(".product_info_price").html());

    dataLayer.push({
        "ecommerce": {
            "currencyCode": "RUB",
            "impressions": [{
                    "name": product_info_title, // Например, https://prnt.sc/un3f6x 
                    "price": product_info_price, // Например, https://prnt.sc/un3hf7 
                },
                {
                    "name": product_info_title, // Например, https://prnt.sc/un3f6x 
                    "price": product_info_price, // Например, https://prnt.sc/un3hf7 
                    "category": "{Категория товара}",
                }]
        },
        'event': 'gtm-ee-event',
        'gtm-ee-event-category': 'Enhanced Ecommerce',
        'gtm-ee-event-action': 'Product Impressions',
        'gtm-ee-event-non-interaction': 'True',
    });
});


function init_category_controll() {
    setTimeout(function () {
        if (typeof (category_controll) != 'undefined' && category_controll.length > 0) {
            if (Number(category_controll) > 0) {
                setTimeout(function () {
                    $(".fast_control_btn").find('button[elm="' + category_controll + '"]').click();
                }, 100);
            }
        }
    }, 900);

}