<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom"> 
                    <h2 class="col-lg-6">Каталог &nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size: 0.8rem;">Кол. актуальных: (<?= $productsFilterCount ?>)</span></h2>
                    <div class="col-lg-6">
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
                    <div class="row">
                        <div class="col-8">
                            <? if (!isset($_GET['edit'])): ?>
                                <a href="javascript:void(0)" class="btn btn-primary float-left add_products" data-toggle="modal" data-target="#form_edit_products_modal">Добавление</a>
                                <?
                                include 'admin_edit.php';
                                importWisiwyng('products_desc_minimal', 150);
                                importWisiwyng('products_desc', 300);
                                ?>
                            <? endif; ?>
                            <select name="visible" class="form-control w-25 float-left ml-2 visible_products">
                                <option value="1" <?= (isset($_SESSION['product']['active']) && $_SESSION['product']['active'] == 1) ? 'selected="selected"' : '' ?>>Отображаемые</option>
                                <option value="0" <?= (isset($_SESSION['product']['active']) && $_SESSION['product']['active'] == 0) ? 'selected="selected"' : '' ?>>Не отображаемые</option>
                                <option value="9" <?= (isset($_SESSION['product']['active']) && $_SESSION['product']['active'] == 9) ? 'selected="selected"' : '' ?>>Удаленные</option>
                            </select>
                        </div>
                        <div class="col-4 col-offset-4">
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

                <div class="form-footer pt-4 pt-5 mt-4 border-top">

                </div>

            </div> 
        </div>
    </div>
</div>
<script>
    var products_id = 0;
    var searchStr = '';
    var visible_products = '1';

    var products_category = '';
    // если перешли по ссылке откроем товар сразу
    var product_edit = '<?= $_GET['product_edit'] ?>';

    $(document).ready(function () {

        /*======== MULTIPLE SELECT ========*/
        var products_wares = $(".products_wares").select2({
            width: "style",
            placeholder: "Выбирете товары",
            allowClear: true
        });

        products_category = $(".products_category").select2({
            width: "100%",
            placeholder: "Выбирете категории",
            allowClear: true
        });

        var products_topic = $(".products_topic").select2({
            width: "100%",
            placeholder: "Выбирете темы",
            allowClear: true
        });

        var product_theme = $(".product_theme").select2({
            width: "100%",
            placeholder: "Выбирете темы",
            allowClear: true
        });

        $(".visible_products").change(function () {
            visible_products = $(this).val();
            getProductsArray();
        });
        // products_wares.val(["CA", "AL"]).trigger("change");
        // products_category.val(["CA", "AL"]).trigger("change");
        // products_topic.val(["CA", "AL"]).trigger("change");

        /**
         * Товары 
         * @returns {undefined}
         */
        function getWaresArray(v) {
            $(".products_wares option").remove();
            sendPostLigth('/jpost.php?extension=wares', {"getWaresArray": '1', "searchStr": ''}, function (e) {
                var data = e['data'];
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        $(".products_wares").append('<option value="' + data[i]['id'] + '">' + data[i]['title'] + ' ' + data[i]['articul'] + ' ' + data[i]['ex_code'] + '</option>');
                    }
                    if (!!v && v.length > 0) {
                        products_wares.val(v).trigger("change");
                    }
                }
            });
        }

        /**
         * Категории 
         * @returns {undefined}
         */
        function getCategoryArray(v) {
            $(".products_category option").remove();
            sendPostLigth('/jpost.php?extension=category', {"getCategoryArray": '1', "searchStr": ''}, function (e) {
                var data = e['data'];
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        $(".products_category").append('<option value="' + data[i]['id'] + '">' + data[i]['title'] + '</option>');
                    }
                    if (!!v && v.length > 0) {
                        products_category.val(v).trigger("change");
                    }
                }
            });
        }

        /**
         * Темы 
         * @returns {undefined}
         */
        function getTopicArray(v) {
            $(".products_topic option").remove();
            sendPostLigth('/jpost.php?extension=category', {"getTopicArray": '1', "searchStr": ''}, function (e) {
                var data = e['data'];
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        $(".products_topic").append('<option value="' + data[i]['id'] + '">' + data[i]['title'] + '</option>');
                    }
                    if (!!v && v.length > 0) {
                        products_topic.val(v).trigger("change");
                    }
                }
            });
        }

        /**
         * Темы 
         * @returns {undefined}
         */
        function getProductThemeArray(v) {
            $(".product_theme option").remove();
            sendPostLigth('/jpost.php?extension=category', {"getProductTheme": '1', "searchStr": ''}, function (e) {
                var data = e['data'];
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        $(".product_theme").append('<option value="' + data[i]['id'] + '">' + data[i]['title'] + '</option>');
                    }
                    if (!!v && v.length > 0) {
                        product_theme.val(v).trigger("change");
                    }
                }
            });
        }


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
                        "product_edit": product_edit
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
                            <span class="btn btn-sm btn-primary btn_products_edit" title="Редактировать"><i class="mdi mdi-pencil"></i></span>\n\
                            <span class="btn btn-sm btn-danger btn_products_delete" title="Удалить"><i class="mdi mdi-delete"></i></span> \n\
                            </td>\n\
                            </tr>');

                    }
                    products_switch_init();
                    if (product_edit.length > 0) {
                        setTimeout(function () {
                            $(".products_arrays_data tbody").find('tr[elm_id="' + product_edit + '"]').find(".btn_products_edit").click();
                        }, 1000)
                    }

                }

                save_products_init();
                products_delete_init();
            });
        }
        getProductsArray();



        // Инициализация кнопки редактирования
        function save_products_init() {
            $(".btn_products_edit").click(function () {
                clear_form_save_products();
                products_id = $(this).closest("tr").attr("elm_id");
                sendPostLigth('/jpost.php?extension=products',
                        {"getProductElemId": products_id},
                        function (e) {
                            if (e['success'] == '1') {
                                $(".form_save_products").find(".products_id").val(e['data']['id']);
                                $(".form_save_products").find(".products_title").val(e['data']['title']);

                                // товары
                                products_wares_array = [];
                                if (e['data']['products_wares'].length > 0) {
                                    for (var i = 0; i < e['data']['products_wares'].length; i++) {
                                        products_wares_array.push(e['data']['products_wares'][i]);
                                    }
                                }
                                //products_wares.val(products_wares_array).trigger("change");

                                // Каталоги
                                var products_category_array = [];
                                if (e['data']['products_category'].length > 0) {
                                    for (var i = 0; i < e['data']['products_category'].length; i++) {
                                        products_category_array.push(e['data']['products_category'][i]);
                                    }
                                }
                                //products_category.val(products_category_array).trigger("change");

                                // Темы
                                var products_topic_array = [];
                                if (e['data']['products_topic'].length > 0) {
                                    for (var i = 0; i < e['data']['products_topic'].length; i++) {
                                        products_topic_array.push(e['data']['products_topic'][i]);
                                    }
                                }
                                var products_theme_array = [];
                                if (e['data']['products_theme'].length > 0) {
                                    for (var i = 0; i < e['data']['products_theme'].length; i++) {
                                        products_theme_array.push(e['data']['products_theme'][i]);
                                    }
                                }

                                getWaresArray(products_wares_array);
                                getTopicArray(products_topic_array);
                                getCategoryArray(products_category_array);
                                getProductThemeArray(products_theme_array);


                                tinymce.get('products_desc_minimal').setContent(e['data']['desc_minimal']);
                                tinymce.get('products_desc').setContent(e['data']['desc']);

                                $(".form_save_products").find(".products_sold").val(e['data']['sold']);

                                // active
                                if (e['data']['active'] > 0) {
                                    if (!$(".form_save_products").find(".products_active").is(':checked')) {
                                        $(".form_save_products").find(".products_active").click();
                                    }
                                } else {
                                    $(".form_save_products").find(".products_active").removeAttr("checked");
                                }
                                // product_new
                                if (e['data']['product_new'] > 0) {
                                    if (!$(".form_save_products").find(".product_new").is(':checked')) {
                                        $(".form_save_products").find(".product_new").click();
                                    }
                                } else {
                                    $(".form_save_products").find(".product_new").removeAttr("checked");
                                }

                                $(".form_save_products").find(".products_price").val(e['data']['price']);
                                $(".form_save_products").find(".products_price_promo").val(e['data']['price_promo']);

                                /* -- images -- */
                                var images = e['data']['images_str'].split(',');
                                for (var i = 0; i < images.length; i++) {
                                    $(".form_save_products").find(".images").append(get_html_images_block(images[i], i));
                                }
                                /* -- images end -- */

                                // Отобразим "Блок выгода" 
                                if (e['data']['block_profit'] == '1') {
                                    if (!$(".block_profit_checked").is(':checked')) {
                                        $(".block_profit_checked").click();
                                        $(".btn_block_profit").click();
                                    }
                                }
                                init_block_profit_questions_array();
                                init_block_profit_plus_array();

                                // Отобразим "Блок выгода" 
                                if (e['data']['block_trailer'] == '1') {
                                    if (!$(".block_trailer_checked").is(':checked')) {
                                        $(".block_trailer_checked").click();
                                        $(".btn_block_trailer").click();
                                    }
                                }
                                init_block_trailer_array();

                                // Отобразим "Отзывы счастливых клиентов" 
                                if (e['data']['block_feedback'] == '1') {
                                    if (!$(".block_feedback_checked").is(':checked')) {
                                        $(".block_feedback_checked").click();
                                        $(".btn_block_feedback").click();
                                    }
                                }
                                init_block_feedback_array();

                                block_checked_init();

                                $('#form_edit_products_modal').modal('show');
                            }
                        });
            });

        }


        // обнулить данные блока
        function clear_form_save_products() {
            $(".form_save_products").find(".products_id").val("0");
            $(".form_save_products").find(".products_title").val("");
            products_wares.val([]).trigger("change");
            products_category.val([]).trigger("change");
            products_topic.val([]).trigger("change");
            product_theme.val([]).trigger("change");
            tinymce.get('products_desc_minimal').setContent("<p></p>");
            tinymce.get('products_desc').setContent("<p></p>");
            $(".form_save_products").find(".products_sold").val("");
            if (!$(".form_save_products").find(".products_active").is(':checked')) {
                $(".form_save_products").find(".products_active").click();
            }
            if (!$(".form_save_products").find(".product_new").is(':checked')) {
                $(".form_save_products").find(".product_new").click();
            }
            $(".form_save_products").find(".products_price").val("");
            $(".form_save_products").find(".products_price_promo").val("");
            $(".form_save_products").find(".products_id").val("0");
            $(".form_save_products").find(".images").html("");
        }

        /*
         * Сохраниение информации по продукту
         * @returns {undefined}
         */
        $(".btn_save_products").click(function () {
            products_id = $(".form_save_products").find(".products_id").val();
            var products_title = $(".form_save_products").find(".products_title").val();
            var products_wares = $(".form_save_products").find(".products_wares").val();
            var products_topic = $(".form_save_products").find(".products_topic").val();
            var products_category = $(".form_save_products").find(".products_category").val();
            var products_theme = $(".form_save_products").find(".product_theme").val();
            var products_desc_minimal = tinymce.get('products_desc_minimal').getContent();
            var products_desc = tinymce.get('products_desc').getContent();
            // tinymce.get('wares_descr').setContent("<p>Hello world!</p>")
            var products_sold = $(".form_save_products").find(".products_sold").val();
            // checked
            var products_active = '0';
            if ($(".form_save_products").find(".products_active").prop("checked")) {
                var products_active = '1';
            }
            var product_new = '0';
            if ($(".form_save_products").find(".product_new").prop("checked")) {
                var product_new = '1';
            }

            var products_price = $(".form_save_products").find(".products_price").val();
            var products_price_promo = $(".form_save_products").find(".products_price_promo").val();

            let images_col = $(".form_save_products").find('.image_elm').length;
            var images_str = [];
            for (var i = 0; i < images_col; i++) {
                images_str.push($($(".form_save_products").find('.image_elm')[i]).find(".image_obj_value").val());
            }

            sendPostLigth('/jpost.php?extension=products',
                    {"edit_products": products_id,
                        "products_title": products_title,
                        "products_wares": products_wares,
                        "products_topic": products_topic,
                        "products_category": products_category,
                        "products_theme": products_theme,
                        "products_desc_minimal": products_desc_minimal,
                        "products_desc": products_desc,
                        "products_sold": products_sold,
                        "products_active": products_active,
                        "products_price": products_price,
                        "products_price_promo": products_price_promo,
                        "product_new": product_new,
                        "images_str": images_str.toString()},
                    function (e) {
                        if (e['success'] == '1') {
                            //$(".form_save_products").find('data-dismiss="modal"').click();
                            $('#form_edit_products_modal').modal('hide');
                            getProductsArray();
                            if (product_edit.length > 0) {
                                window.location.href = '/admin/catalog/';
                            }
                        }
                    });
        });

        // если нажали создать новый блок
        $(".add_products").click(function () {
            clear_form_save_products();
            getWaresArray([]);
            getTopicArray([]);
            getCategoryArray([]);
            getProductThemeArray([]);
        });

        /**
         * Действия
         */
        function products_delete_init() {
            $(".btn_products_delete").click(function () {
                var product_id = $(this).closest("tr").attr("elm_id");
                sendPostLigth('/jpost.php?extension=products',
                        {"deleteProducts": product_id},
                        function (e) {
                            getProductsArray();
                        });
            });
        }

    });

    function products_switch_init() {
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


    /*
     * Отобразить или скрыть дополнительный блок
     */
    function block_checked_init() {
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

    /*
     * Общая функция обновление данных блоков
     */
    function block_data_edit_init(func) {
        $(".block_data_edit").unbind('change').change(function () {
            var block_id = $(this).attr("elm_id");
            var block_type = $(this).attr("block_type");
            var row = $(this).attr("row");
            var val = $(this).val();
            sendPostLigth('/jpost.php?extension=products',
                    {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": row, "val": val},
                    function (e) {
                        func();
                    });
        });
    }

    /*
     * Общая функция удаления информации по блоку
     */
    function block_data_delete_init(func) {
        $(".block_elm_delete").unbind('click').click(function () {
            var block_id = $(this).attr("elm_id");
            sendPostLigth('/jpost.php?extension=products',
                    {"block_data_delete": 1, "block_id": block_id},
                    function (e) {
                        func();
                    });
        });
    }

</script>    