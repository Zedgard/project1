$(document).ready(function () {
    $(".btn_cart_yandex").click(function () {
        // /pay.php?yandex=1
        //console.log(cart_itms);
        window.dataLayer = window.dataLayer || [];
        for (var i = 0; i < cart_itms.length; i++) {
            var isPromo = 0;
            var product_price = 0;
            if (cart_itms[i]['price_promo'].length > 0 && Number(cart_itms[i]['price_promo']) > 0) {
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
                                "name": product_info_title, // например, https://prnt.sc/un4kvj 
                                "price": product_info_price, // например, https://prnt.sc/un4kvj 
                                "quantity": 1 // Количество, например, https://prnt.sc/un4kvj 
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
                'gtm-ee-event-non-interaction': 'False',
            });
        }
        setTimeout(function () {
            document.location.href = '/pay.php?yandex=1';
        }, 500);
    });
    $(".btn_cart_interkassa").click(function () {
        // /pay.php?yandex=1
        //console.log(cart_itms);
        window.dataLayer = window.dataLayer || [];
        for (var i = 0; i < cart_itms.length; i++) {
            var isPromo = 0;
            var product_price = 0;
            if (cart_itms[i]['price_promo'].length > 0 && Number(cart_itms[i]['price_promo']) > 0) {
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
                                "name": product_info_title, // например, https://prnt.sc/un4kvj 
                                "price": product_info_price, // например, https://prnt.sc/un4kvj 
                                "quantity": 1 // Количество, например, https://prnt.sc/un4kvj 
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
                'gtm-ee-event-non-interaction': 'False',
            });
        }
        setTimeout(function () {
            document.location.href = '/pay.php?interkassa=1';
        }, 500);
    });
    // btn_cart_interkassa
    $(".btn_cart_paypal").click(function () {
        var e = $(this).attr('e');
        var pay_email = prompt("Email для платежа?", e);
        if (pay_email != null) {
            setTimeout(function () {
                //alert(onSubmit);
                document.location.href = '/pay.php?paypal=1';
            }, 500);
        }
    });
});
// btn_cart_yandex