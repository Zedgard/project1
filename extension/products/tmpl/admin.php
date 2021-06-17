
<div class="card card-default">

    <div class="card-header card-header-border-bottom"> 
        <h2 class="col-lg mb-2 mb-lg-0">Каталог</h2>
        <div class="col-lg mb-2 mb-lg-0"><span style="font-size: 0.8rem;">Кол. актуальных: (<?= $productsFilterCount ?>)</span></div>
        <div class="col-lg mb-2 mb-lg-0">
            <a href="?index_promo" class="btn btn-primary float-right">Специальные предложения на главной</a>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg mt-3 mb-lg-0 mt-lg-0">
                    <? if (!isset($_GET['edit'])): ?>
                        <a href="/admin/catalog/?product_edit=0" class="btn btn-primary float-left">Добавление</a>
                        <?
                        //include 'admin_edit.php';
                        //importWisiwyng('products_desc_minimal', 150);
                        //importWisiwyng('products_desc', 300);
                        //importWisiwyng('product_content', 150);
                        ?>
                    <? endif; ?>

                </div>
                <div class="col-lg mt-3 mb-lg-0 mt-lg-0">
                    <select name="visible" class="form-control float-left visible_products">
                        <option value="1" <?= (isset($_SESSION['product']['active']) && $_SESSION['product']['active'] == 1) ? 'selected="selected"' : '' ?>>Отображаемые</option>
                        <option value="0" <?= (isset($_SESSION['product']['active']) && $_SESSION['product']['active'] == 0) ? 'selected="selected"' : '' ?>>Не отображаемые</option>
                        <option value="9" <?= (isset($_SESSION['product']['active']) && $_SESSION['product']['active'] == 9) ? 'selected="selected"' : '' ?>>Удаленные</option>
                    </select>
                </div>
                <div class="col-lg mt-3 mb-lg-0 mt-lg-0 col-offset-4">
                    <input type="text" class="form-control search_products" value="<?= $_SESSION['product']['searchStr'] ?>" placeholder="Поиск...">
                    <div class="float-right" style="font-size: 0.7rem;">Найдено <span class="search_products_col"></span></div>
                </div>

            </div>
            <br/>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive-lg">
                        <table class="table table-striped table-bordered products_arrays_data" style="width:100%;background-color: #FFFFFF;">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">id</th>
                                    <th style="text-align: center;"></th>
                                    <th>Наименование</th>
                                    <th style="text-align: center;">Товары</th>
                                    <th style="text-align: center;">Цена</th>
                                    <th style="text-align: center;">Продажи</th>
                                    <th style="text-align: center;">Отображение</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="form-footer pt-4 pt-5 mt-4 border-top">

    </div>

</div> 
<script>
    var products_id = 0;
    var searchStr = '';
    var visible_products = '1';

    var products_category = '';

    $(document).ready(function () {



        $(".visible_products").change(function () {
            visible_products = $(this).val();
            getProductsArray();
        });
        // products_wares.val(["CA", "AL"]).trigger("change");
        // products_category.val(["CA", "AL"]).trigger("change");
        // products_topic.val(["CA", "AL"]).trigger("change");


        searchStr = $(".search_products").val();
        $(".search_products").delayKeyup(function () {
            var v = $(".search_products").val();
            searchStr = v;
            getProductsArray();
        }, 700);
//        $(".search_products").change(function () {
//            searchStr = $(this).val();
//            getProductsArray();
//        });


        /*
         * Настройки значения список
         */
        function getProductsArray() {
            sendPostLigth('/jpost.php?extension=products',
                    {
                        "getProductsArray": '1',
                        "searchStr": searchStr,
                        "visible_products": visible_products,
                        "product_edit": ''
                    }, function (e) {
                $(".products_arrays_data tbody tr").remove();
                var data = e['data'];
                $(".search_products_col").html(0);
                if (data.length > 0) {
                    $(".search_products_col").html(data.length);
                    for (var i = 0; i < data.length; i++) {
                        let checked = '';
                        if (data[i]['active'] > 0) {
                            checked = 'checked="checked"';
                        }

                        var price = data[i]['price'];
                        if (data[i]['price_promo'] > 0) {
                            price = data[i]['price_promo'] + ' <span class="price_promo">promo</span>';
                        }

                        var waress = '';
                        if (data[i]['wares_info'].length > 0) {
                            for (var a = 0; a < data[i]['wares_info'].length; a++) {
                                waress = waress + '<div class="mb-2" title="Просмотреть информацию по товару">' + data[i]['wares_info'][a]['title'] + ' <a href="/admin/wares/?edit=' + data[i]['wares_info'][a]['id'] + '" target="_blank">>></a></div>';
                            }
                        }

                        // <td style="text-align: center;">' + data[i]['desc_minimal'] + '</td>\n\
                        $(".products_arrays_data tbody").append(
                                '<tr elm_id="' + data[i]['id'] + '"> \n\
                                <td style="text-align: center;">' + data[i]['id'] + '</td>\n\
                                <td style="text-align: center;"><img src="' + data[i]['images_str'] + '" style="width: 100px;" /></td>\n\
                                <td><a href="/shop/?product=' + data[i]['id'] + '" target="_blank">' + data[i]['title'] + '</a></td>\n\
                                <td style="text-align: center;">' + waress + '</td>\n\
                                <td style="text-align: center;">' + price + '</td>\n\
                                <td style="text-align: center;">' + data[i]['sold'] + '</td>\n\
                                <td style="text-align: center;">\n\
                                    <label class="switch switch-text switch-primary form-control-label">\n\
                                        <input type="checkbox" class="switch-input form-check-input products_active products_active_switch" elm_id="' + data[i]['id'] + '" value="1" ' + checked + '>\n\
                                        <span class="switch-label" data-on="On" data-off="Off"></span>\n\
                                        <span class="switch-handle"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td style="text-align: center;white-space: nowrap;">\n\
                            <a href="./?product_edit=' + data[i]['id'] + '" class="btn btn-sm btn-primary" title="Редактировать"><i class="mdi mdi-pencil"></i></a>\n\
                            <span class="btn btn-sm btn-danger btn_products_delete" title="Удалить"><i class="mdi mdi-delete"></i></span> \n\
                            </td>\n\
                            </tr>');
// <span class="btn btn-sm btn-primary btn_products_edit" title="Редактировать"><i class="mdi mdi-pencil"></i></span>
                    }
                    products_switch_init();
//                    if (product_edit.length > 0) {
//                        setTimeout(function () {
//                            $(".products_arrays_data tbody").find('tr[elm_id="' + product_edit + '"]').find(".btn_products_edit").click();
//                        }, 1000);
//                    }

                }

                save_products_init();
                products_delete_init();
            });
        }
        getProductsArray();







        /**
         * Действия
         */
        function products_delete_init() {
            if ($(".btn_products_delete").length > 0) {
                $(".btn_products_delete").click(function () {
                    var product_id = $(this).closest("tr").attr("elm_id");
                    sendPostLigth('/jpost.php?extension=products',
                            {"deleteProducts": product_id},
                            function (e) {
                                getProductsArray();
                            });
                });
            }
        }

    });

    function products_switch_init() {
        if ($(".products_active_switch").length > 0) {
            $(".products_active_switch").unbind("click").click(function () {
                var products_id = $(this).attr("elm_id");
                var checked = 0;
                if ($(this).prop('checked')) {
                    checked = 1;
                }
                sendPostLigth('/jpost.php?extension=products',
                        {"setProductsActive": products_id,
                            "active": checked},
                        function (e) {
                            getProductsArray();
                        });
            });
        }
    }


    /*
     * Отобразить или скрыть дополнительный блок
     */
    function block_checked_init() {
        if ($(".block_checked").length > 0) {
            $(".block_checked").unbind('click').click(function () {
                var block_type = $(this).attr("block_type");
                var show = 0;
                if ($(this).prop('checked')) {
                    show = 1;
                }
                sendPostLigth('/jpost.php?extension=products',
                        {"block_show": 1, "products_id": products_id, "block": block_type, "show": show},
                        function (e) {

                        });

            });
        }
    }
</script>    