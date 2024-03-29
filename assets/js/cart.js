var pay_status = 0;
$(document).ready(function () {
    init_pay();
});

function fn_dataLayer() {
    window.dataLayer = window.dataLayer || [];
    for (var i = 0; i < cart_itms.length; i++) {
        var isPromo = 0;
        var product_price = 0;
        if (typeof cart_itms[i]['price_promo'] != 'undefined' && cart_itms[i]['price_promo'].length > 0 && Number(cart_itms[i]['price_promo']) > 0) {
            isPromo = 1;
        }
        if (isPromo == 1) {
            product_price = cart_itms[i]['price_promo'];
        } else {
            product_price = cart_itms[i]['price'];
        }
        var product_info_title = $.trim(cart_itms[i]['title']);
        var product_info_price = product_price;
        //console.log("product_info_title: " + product_info_title + ' - ' + product_info_price);
        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'UAH',
                'coupon': 'none', // Должен подтягиваться код купона при успешной реализации 
                'checkout': {
                    'actionField': {'step': 1},
                    'products': [{
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
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Checkout Step 1',
            'gtm-ee-event-non-interaction': 'False'
        });
    }
}

function init_pay() {

    $(".header-nav-features-toggle").click(function () {
        var opacity = $(".header-nav-features-dropdown").css("opacity");
        if (opacity == 0) {
            $(".header-nav-features-dropdown").css("opacity", "1");
            $(".header-nav-features-dropdown").css("top", "12px");
            $(".header-nav-features-dropdown").css("pointer-events", "all");
        } else {
            $(".header-nav-features-dropdown").css("opacity", "0");
            $(".header-nav-features-dropdown").css("top", "-10000px");
            $(".header-nav-features-dropdown").css("pointer-events", "none");
        }
    });



    $(".btn_cart_yandex").unbind('click').click(function () {
        // /pay.php?yandex=1
        fn_dataLayer();
        // Пока это убираем
//        setTimeout(function () {
//            document.location.href = '/pay.php?yandex=1';
//        }, 500);
    });

    // Тинькоф обычная оплата
    $(".btn_cart_tinkoff").unbind('click').click(function () {
        fn_dataLayer();
        window.location.href = '/pay.php?tinkoff=1';
    });



    $(".btn_cart_cloudpayments").unbind('click').click(function () {
        pay_status = 0;
        //console.log('btn_cart_cloudpayments');
        fn_dataLayer();
        sendPostLigth('/jpost.php?extension=cart', {
            "set_cloudpayments": 1
        }, function (e) {
            if (e['success'] == '1') {
                if (typeof e['action'] !== 'undefined' && e['action'].length > 0) {
                    document.location.href = e['action'];
                } else {
                    //console.log('pay');
                    if (e['data']['pay_id'] > 0) {
                        this.pay = function () {
                            var widget = new cp.CloudPayments();
                            widget.pay('auth', // или auth 'charge'
                                    {//options
                                        publicId: e['data']['publicId'], //id из личного кабинета
                                        description: e['data']['pay_descr'], //назначение
                                        amount: e['data']['amount'], //сумма
                                        currency: e['data']['currency'], //валюта
                                        invoiceId: e['data']['pay_id'], //номер заказа  (необязательно)
                                        accountId: e['data']['customer_email'], //идентификатор плательщика (необязательно)
                                        skin: "mini", //дизайн виджета (необязательно)
                                        data: {
                                            //   myProp: 'myProp value'
                                        }
                                    },
                                    {
                                        onSuccess: function (options) { // success
                                            if (pay_status == 1) {
                                                $(".pay_result").append('<div class="font-size-16"><a href="/office/" target="_blank">Пройдите в личный кабинет</a></div>');
                                            }
                                            initCartArray();
                                        },
                                        onFail: function (reason, options) { // fail
                                            console.log('fail');
                                            //console.log(reason);
                                            //console.log(options);
                                            //$(".pay_result").append('<div>Ошибка операции! Недостаточно средств или карта не активна!</div>');
                                        },
                                        onComplete: function (paymentResult, options) {
                                            //console.log(paymentResult['success']);
                                            // console.log('G: ' +  (paymentResult['success'] == true) );
                                            if (paymentResult['success'] == true) {
                                                sendPostLigth('/jpost.php?extension=cart', {
                                                    "check_cloudpayments": 1,
                                                    "paymentResult": paymentResult,
                                                    "options": options
                                                }, function (e) {
                                                    console.log(e);
                                                    if (e['success'] == '1') {
                                                        pay_status = 1;
                                                    }
                                                    $(".pay_result").append("<div class='font-size-20'>" + e['success_text'] + "</div>");
                                                    $(".pay_result").show(200);
                                                    if (typeof e['action'] !== 'undefined' && e['action'].length > 0) {
                                                        //console.log('document.location.href=' + e['action']);
                                                        document.location.href = e['action'];
                                                    }
                                                    //}
                                                });
                                            } else {
                                                console.log('paymentResult_success: ' + paymentResult['success']);
                                                $(".pay_result").append("<div class='font-size-20'>" + paymentResult['message'] + "</div>");
                                                $(".pay_result").show(200);
                                            }
                                            console.log('paymentResult');
                                            console.log(paymentResult);
                                            console.log('options');
                                            console.log(options);
                                        }
                                    }
                            );
                        };
                        pay();
                    } else {
                        alert("Ошибка номера заказа!");
                    }
                }
            } else {
                alert(e['errors'].toString());
            }
        });
    });


//    $(".btn_cart_tinkoff").unbind('click').click(function () {
//        fn_dataLayer();
//        pay_status = 0;
//        sendPostLigth('/jpost.php?extension=cart', {
//            "set_tinkoff": 1
//        }, function (e) {
//            console.log(e);
//            if (e['success'] == '1') {
//
//            } else {
//                alert(e['errors'].toString());
//            }
//        });
//    });



    $(".btn_cart_interkassa").unbind('click').click(function () {
        // /pay.php?yandex=1
        //console.log(cart_itms);
        fn_dataLayer();
        setTimeout(function () {
            document.location.href = '/pay.php?interkassa=1';
        }, 500);
    });

    // btn_cart_interkassa
    $(".btn_cart_paypal").unbind('click').click(function () {
        var e = $(this).attr('e');
        var pay_email = prompt("Email для платежа?", e);
        if (pay_email != null) {
            fn_dataLayer();
            setTimeout(function () {
                //alert(onSubmit);
                document.location.href = '/pay.php?paypal=1&pay_email=' + pay_email;
            }, 500);
        }
    });

    $(".btn_cart_other").unbind('click').click(function () {
        var preloader = '<div class="pay_preloader"><div class="spinner-border text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
        $(".block_cart_other").html('<div id="payment-form"></div>');
        pay_status = 0;
        $(".block_cart_other").show(200);
        $(".pay_preloader").show(200);

        fn_dataLayer();
        sendPostLigth('/jpost.php?extension=cart', {
            "get_cart_other": 1
        }, function (e) {
            if (e['success'] == '1') {
                if (typeof e['action'] !== 'undefined' && e['action'].length > 0) {
                    document.location.href = e['action'];
                } else {
                    var pay_key = e['pay_key'];
                    var return_url = e['return_url'];
                    //Инициализация виджета. Все параметры обязательные.
                    const checkout = new window.YooMoneyCheckoutWidget({
                        confirmation_token: 'ct-' + pay_key,
                        return_url: return_url,
                        error_callback(error) {
                            //Обработка ошибок инициализации
                        }
                    });

                    //Отображение платежной формы в контейнере
                    checkout.render('payment-form')
                            //После отображения платежной формы метод render возвращает Promise (можно не использовать).
                            .then(() => {
                                //Код, который нужно выполнить после отображения платежной формы.
                                //$(".block_cart_other").show(200);
                                $(".pay_preloader").hide(200);
                            });
                }
            } else {
                alert(e['errors'].toString());
                $(".pay_preloader").hide(200);
                $(".block_cart_other").hide(200);
            }
        });
    });

    $(".btn_cart_credit").unbind('click').click(function () {
        fn_dataLayer();
        window.location.href = '/tinkoff_credit_pay.php';
    });
}