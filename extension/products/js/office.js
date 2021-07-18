$(document).ready(function () {
    init_getClientPayProducts();
});
/*
 * Купленные товары - Старая версия -
 */
function getClientProducts() {
    $(".products_arrays_data div").remove();
    $(".products_arrays_data").html('<div class="w-100 text-center"><div class="spinner-border text-dark" role="status"><span class="sr-only">Загрузка...</span></div></div>');
    sendPostLigth('/jpost.php?extension=wares', {
        "getClientProducts": '1',
        "category_id": category_id
    }, function (e) {
        $(".products_arrays_data").html("");
        var data = e['data'];
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                if (!$(".products_arrays_data").find('.product_id_' + data[i]['product_id'])[0]) {
                    // Основной продукт
                    $(".products_arrays_data").append('<div class="product product_id_' + data[i]['product_id'] + ' mixitup-container category-' + data[i]['wcat_category_id'] + ' w-100" \n\
                        data-ref="mixitup-target" style="display: block;">\n\
                        <div class="product_title w-100 mt-3 ml-0 ml-lg-3">' + data[i]['product_title'] + '</div>\n\
                        <div class="product_elms row row-cols-2 row-cols-md-4 w-100" style="margin-right:0;padding-right:0;margin-left:0;padding-left:0;"></div>\n\
                        </div>');
                }
                var wcc_color = data[i]['wcc_color'];
                var wares_cat_name = '<span class="class_category" style="color: ' + wcc_color + ';">' + data[i]['wcc_title'] + '</span>';
                // Товары продукта
                $('.products_arrays_data .product_id_' + data[i]['product_id'] + ' .product_elms').append(
                        '<div class="product_info">\n\
                                <a href="?wares_id=' + data[i]['id'] + '">\n\
                                <div class="card item p-3 p-lg-4 h-100 text-center">\n\
                                <span class="class_category_lbl opacity75" style="background-color: ' + wcc_color + ';margin-top: 0rem;">' + data[i]['wcc_title'] + '</span>\n\
                                <div class="mb-2"><img src="' + data[i]['images'] + '" style="max-width: 100%;max-height: 160px;"/></div>\n\
                                <div class="mb-3 wares_title h-100">' + wares_cat_name + ' <span class="">' + data[i]['title'] + '111</span></div>\n\
                                </div>\n\
                                </a>\n\
                                </div>\n\
                                ');
            }
            /*
             * Активируем фильтр
             */
            setTimeout(function () {
                var containerEl = document.querySelector('[data-ref~="mixitup-container"]');
                if (!!containerEl) {
                    var mixer = mixitup(containerEl, {
                        selectors: {
                            target: '[data-ref~="mixitup-target"]'
                        }
                    });
                }
            }, 500);
        } else {
            $(".products_arrays_data").html('<div class="w-100 text-center">Нет записей</div>');
        }
    });
}

/**
 * Купленные продукты
 * @returns {undefined}
 */
function init_getClientPayProducts() {
    $(".products_arrays_data div").remove();
    $(".products_arrays_data").html('<div class="w-100 text-center"><div class="spinner-border text-dark" role="status"><span class="sr-only">Загрузка...</span></div></div>');
    sendPostLigth('/jpost.php?extension=wares', {
        "getClientPayProducts": '1'
    }, function (e) {
        $(".products_arrays_data").html("");
        var data = e['data'];
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
//                if (!$(".products_arrays_data").find('.product_id_' + data[i]['id'])[0]) {
//                    // Основной продукт
//                    $(".products_arrays_data").append('<div class="product product_id_' + data[i]['id'] + ' mixitup-container category-' + data[i]['pcategory_id'] + ' w-100" \n\
//                        data-ref="mixitup-target" style="display: block;">\n\
//                        <div class="product_title w-100 mt-3 ml-0 ml-lg-3">' + data[i]['title'] + '</div>\n\
//                        <div class="product_elms row row-cols-2 row-cols-md-4 w-100" style="margin-right:0;padding-right:0;margin-left:0;padding-left:0;"></div>\n\
//                        </div>');
//                }
                var wcc_color = data[i]['cat_color'];
                //var wares_cat_name = '<span class="class_category" style="color: ' + wcc_color + ';">' + data[i]['cat_title'] + '</span>';
                // Товары продукта .product_id_' + data[i]['id'] + ' .product_elms
//                $('.products_arrays_data').append(
//                        '<a href="?katalog&product_id=' + data[i]['id'] + '" class="col m-0 m-lg-2 p-2 p-lg-4 w-100 item category-' + data[i]['pcategory_id'] + '" data-ref="mixitup-target">\n\
//                                <div class="product_info h-100 d-flex flex-column">\n\
//                                        <span class="class_category_lbl opacity75" style="background-color: ' + wcc_color + ';margin-top: 0rem;">' + data[i]['cat_title'] + '</span>\n\
//                                        <div class="mb-2 align-items-start text-center flex-fill"><img src="' + data[i]['images_str'] + '" style="width: 100%;"/></div>\n\
//                                        <div class="d-flex align-items-end text-center flex-fill wares_title">' + data[i]['title'] + '</div>\n\
//                                </div>\n\
//                         </a>');
                $(".products_arrays_data").append(
                        '<a href="?wares_id=' + data[i]['id'] + '" class="mb-0 mb-lg-3">\n\
                                <div class="m-0 m-lg-2 p-2 p-lg-4 h-100 d-flex flex-column product_info item category-' + data[i]['pcategory_id'] + '" data-ref="mixitup-target">\n\
                                    <span class="class_category_lbl opacity75" style="background-color: ' + wcc_color + ';margin-top: 0rem;">' + data[i]['cat_title'] + '</span>\n\
                                    <div class="mb-2 align-items-start text-center flex-fill"><img src="' + data[i]['images_str'] + '" style="width: 100%;"/></div>\n\
                                    <div class="wares_title d-flex align-items-end text-center flex-fill">\n\
                                        <div class="mt-0 mb-0 ml-auto mr-auto">' + data[i]['title'] + '</div>\n\
                                    </div>\n\
                                </div>\n\
                                </a>');
            }
            /*
             * Активируем фильтр
             */
            setTimeout(function () {
                var containerEl = document.querySelector('[data-ref~="mixitup-container"]');
                if (!!containerEl) {
                    var mixer = mixitup(containerEl, {
                        selectors: {
                            target: '[data-ref~="mixitup-target"]'
                        }
                    });
                }
            }, 500);
        } else {
            $(".products_arrays_data").html('<div class="w-100 text-center">Ничего не приобрели <a href="/shop/">Каталог</a></div>');
        }
    });
}