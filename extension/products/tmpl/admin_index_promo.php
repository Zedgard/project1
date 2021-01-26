<link rel="stylesheet" href="/extension/products/product.css<?= $_SESSION['rand'] ?>">
<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6"><a href="/admin/products/">Каталог</a> - Промо на главной</h2>
                    <div class="col-lg-6">

                    </div>
                </div>
                <style>
                    .price_promo{
                        font-size: 8px;
                        background-color: #FF0000;
                        color: #FFFFFF;
                        padding: 2px;
                    }
                </style>

                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <a href="javascript:void(0)" class="btn btn-primary float-left add_promo_product" data-toggle="modal" data-target="#form_add_promo_product_modal">Добавление</a>
                        </div>
                    </div>
                    <br/>
                    <div class="row row-cols-1 row-cols-md-3 list_promo_product">



                    </div>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">

                </div>

            </div> 
        </div>
    </div>
</div>
<!-- Modal add promo product -->
<!-- Large Modal -->
<div class="modal fade" id="form_add_promo_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_save_promo_product">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Добавление промо продукта</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control search_promo_product" id="search_promo_product" placeholder="Поиск промо продукта..." required>
                        </div>
                        <div class="mt-3 mb-3 search_list_promo_products">
                            Введите наименование продукта для поиска
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="products_id" class="products_id" id="products_id" value="0" />
                <span class="btn btn-danger" data-dismiss="modal">Закрыть</span>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
//        $(".add_promo_product").unbind('click').click(function () {
//
//        });
        init_search_promo_products();
        init_list_promo_product();
        $("img.lazyload").lazyload();
    });

    /**
     * Поиск продуктов для добавления
     * @returns {undefined}
     */
    function init_search_promo_products() {
        $(".search_promo_product").unbind('keyup').keyup(function () {
            var searchStr = $(this).val();
            if (searchStr.length > 2) {
                $(".search_list_promo_products").html("Поиск.");
                var si = setInterval(function () {
                    $(".search_list_promo_products").append('.');
                }, 200);
                sendPostLigth('/jpost.php?extension=products',
                        {"getProductsArray": 1, "searchStr": searchStr},
                        function (e) {
                            clearInterval(si);
                            $(".search_list_promo_products").html("");
                            var col = e['data'].length;
                            if (col > 0) {
                                for (var i = 0; i < col; i++) {
                                    var h = '<div class="mb-2"><a href="javascript:void()" class="btn btn-light add_promo_product" elmid="' + e['data'][i]['id'] + '" title="Выбрать для добавления">' + e['data'][i]['title'] + '</a></div>';
                                    $(".search_list_promo_products").append(h);
                                    init_add_promo_product();
                                }
                            }
                        });
            } else {
                $(".search_list_promo_products").html("Введите наименование продукта для поиска");
            }
        })
    }

    /**
     * Добавление промо товара
     * @returns {undefined}
     */
    function init_add_promo_product() {
        $(".add_promo_product").unbind('click').click(function () {
            var elmid = $(this).attr("elmid");
            sendPostLigth('/jpost.php?extension=products',
                    {"add_promo_product": 1, "elmid": elmid},
                    function (e) {
                        if (e['success'] == '1') {
                            $("#form_add_promo_product_modal").modal('hide');
                            init_list_promo_product();
                        } else {
                            //alert(e['success_text']);
                        }
                    });
        });
    }

    function init_list_promo_product() {
        // list_promo_product
        sendPostLigth('/jpost.php?extension=products',
                {"list_promo_product": 1},
                function (e) {
                    $(".list_promo_product").html("");
                    var col = e['data'].length;
                    if (col > 0) {
                        for (var i = 0; i < col; i++) {
                            $(".list_promo_product").append('<div class="col mb-4 mixitup-container " i="0" data-ref="mixitup-target" style="">'
                                    + '<div class="card p-4 item">'
                                    + '<div class="row h-100 d-inline-block pl-3 pr-3">'
                                    + '<div class="col-12 h-100 d-flex flex-column product_info">'
                                    + '<div class="row waresListImages">'
                                    + '<div class="align-self-center text-center w-100">'
                                    + '<a href="/shop/?product=' + e['data'][i]['id'] + '">'
                                    + '<img src="' + e['data'][i]['images_str'] + '" class="waresImg waresListImagesStyle1" style="position: static;"></a>'
                                    + '</div>'
                                    + '</div>'
                                    + '<div class="row mt-2">'
                                    + '<div class="col-mb-12">'
                                    + '<div style="clear: both;">'
                                    + '<span class="init_price_val product_info_price" style="color:#FF0000;">' + e['data'][i]['price_promo'] + '</span>'
                                    + '<span class="wares_old_price" style="margin-left: 16px;"><span class="init_price_val">' + e['data'][i]['price'] + '</span> <i class="fa fa-ruble"></i></span>'
                                    + '</div>'
                                    + '</div>'
                                    + '</div>'
                                    + '<div class="row mt-1">'
                                    + '<div class="col-mb-12">'
                                    + '<div class="cart_product_title_block">'
                                    + '<a href="/shop/?product=4142" class="product_links product_info_title">'
                                    + '&nbsp;&nbsp;<span class="cart_product_title">' + e['data'][i]['title'] + '</span>'
                                    + '</a>'
                                    + '</div>'
                                    + '</div>'
                                    + '</div>'
                                    + '<div class="row bd-highlight cart_product_button_bg">'
                                    + '<div class="col-12">'
                                    + '<div class="float-left">'
                                    + '</div>'
                                    + '<div class="float-right">'
                                    + '<a href="javascript:void(0)" class="btn btn-sm btn-outline-dark ml-2 position_up" metod="up" position="' + e['data'][i]['position'] + '" elem="' + e['data'][i]['ip_id'] + '" style="font-size:1.4rem;"><i class="mdi mdi-chevron-up"></i></a>'
                                    + '<a href="javascript:void(0)" class="btn btn-sm btn-outline-dark ml-2 position_down" metod="down" position="' + e['data'][i]['position'] + '" elem="' + e['data'][i]['ip_id'] + '" style="font-size:1.4rem;"><i class="mdi mdi-chevron-down"></i></a>'
                                    + '<a href="javascript:void(0)" class="btn btn-danger ml-2 delete_promo_product" elem="' + e['data'][i]['ip_id'] + '">Удалить</a>'
                                    + '</div>'
                                    + '</div>'
                                    + '</div>'
                                    + '</div>'
                                    + '</div>'
                                    + '</div>'
                                    + '</div>');

                        }
                        $(".position_up").unbind('click').click(function () {
                            console.log('position_up');
                            var elem = $(this).attr("elem");
                            var position = Number($(this).attr("position")) - 1;
                            init_set_position(elem, position, 1);
                        });
                        $(".position_down").unbind('click').click(function () {
                            console.log('position_down');
                            var elem = $(this).attr("elem");
                            var position = Number($(this).attr("position")) + 1;
                            init_set_position(elem, position, 1);
                        });
                        init_delete_promo_product();
                    }
                });
    }

    function init_set_position(item_id, position, metod) {
        if (metod == undefined) {
            metod = 0;
        } else {
            metod = 1;
        }
        sendPostLigth('/jpost.php?extension=products',
                {
                    "set_position_promo": position,
                    "item_id": item_id
                },
                function (e) {
                    if (metod == 1) {
                        init_list_promo_product();
                    }
                });

    }

    function init_delete_promo_product() {
        $(".delete_promo_product").unbind('click').click(function () {
            var elm_id = $(this).attr("elem");
            sendPostLigth('/jpost.php?extension=products',
                    {
                        "delete_promo_product": elm_id
                    },
                    function (e) {
                        if (e['success'] == '1') {
                            init_list_promo_product();
                        }
                    });
        });

    }

</script>    