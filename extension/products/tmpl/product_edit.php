<div class="card card-default">

    <div class="card-header card-header-border-bottom"> 
        <h2 class="col"><a href="./">Каталог</a> - Управление продуктом</h2>
        <div class="text-right" style="background-color: #FFF;padding: 1rem;border: 1px solid #CCCCCC;position: fixed;top: 20vh;right: 5%;z-index: 9999;">
            <span class="btn btn-primary btn_save_products">Сохранить</span>
        </div>
    </div>

    <div class="card-body form_save_products">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="config_title">Название</label>
                        <input type="text" class="form-control products_title" id="products_title" placeholder="Наименование..." required>
                    </div>
                    <div class="form-group">
                        <label for="products_account" class="label_products_account">Счёт для оплаты</label>
                        <select class="form-control products_account" name="states[]" style="width: 100%">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="products_wares" class="label_products_wares">Товары</label>
                        <select class="form-control products_wares" name="states[]" multiple="multiple" style="width: 100%">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="config_code">Темы</label>
                        <select class="form-control products_topic" name="states[]" multiple="multiple" style="width: 100%">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="config_code">Категории</label>
                        <select class="form-control products_category" name="states[]" style="width: 100%">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="config_code">Тема продукта</label>
                        <select class="form-control product_theme" name="states[]" multiple="multiple" style="width: 100%">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="product_new">Новый товар (признак)</label><br/>
                        <label class="switch switch-text switch-primary form-control-label">
                            <input type="checkbox" class="switch-input form-check-input product_new" value="1">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="config_code">Описание (кратко)</label>
                        <textarea name="products_desc_minimal" id="products_desc_minimal" class="form-control products_desc_minimal" placeholder="Текст описания (краткое)..." style="width: 100%;height: 50px;"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="products_desc">Текст полного описания</label>
                        <textarea name="products_desc" id="products_desc" class="form-control products_desc" placeholder="Текст полного описания..." style="width: 100%;height: 100px;"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="products_price">Продано</label>
                        <input type="text" class="form-control products_sold" id="products_sold" onkeyup="this.value = this.value.replace(/[^0-9+]/, '')" placeholder="Колличество продано..." required>
                    </div>

                    <div class="form-group">
                        <label for="products_active">Отображение</label><br/>
                        <label class="switch switch-text switch-primary form-control-label">
                            <input type="checkbox" class="switch-input form-check-input products_active" value="1" checked="checked">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="products_price">Цена</label>
                        <input type="text" class="form-control products_price" id="products_price" onkeyup="this.value = this.value.replace(/[^0-9+]/, '')" placeholder="Цена продукта" required>
                    </div>

                    <div class="form-group">
                        <label for="products_price">Цена со скидкой</label>
                        <input type="text" class="form-control products_price_promo" id="products_price_promo" onkeyup="this.value = this.value.replace(/[^0-9+]/, '')" placeholder="Цена продукта" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="products_price">Ограничить срок использования в днях (0 = бессрочно)</label>
                        <input type="text" class="form-control products_period_open" id="products_period_open" value="0" onkeyup="this.value = this.value.replace(/[^0-9+]/, '')" placeholder="Колличество дней" required>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header bg-light" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Содержание товара(Произвольный текст)
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse hide" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <textarea name="product_content" id="product_content" class="form-control product_content" placeholder="Текст содержание товара..." style="width: 100%;height: 100px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header bg-light" id="headingTwo">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            Налог (указывается в чеке)
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse hide" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <select class="form-control products_tax" name="states[]" style="width: 100%">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?
                    importELFinder(1);
                    ?>

                    <?
                    if ($_GET['product_edit'] > 0) {
                        include 'block_profit.php';
                        include 'block_trailer.php';
                        include 'block_feedback.php';
                        include 'block_conditions.php';
                    } else {
                        ?>
                        <div>Управление блоками возможно только на уже созданом товаре</div>
                        <?
                    }
                    ?>

                </div>
            </div>
            <div class="row mt-3">
                <input type="hidden" name="products_id" class="products_id" id="products_id" value="0" />
                <span class="btn btn-primary btn_save_products">Сохранить</span>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="./" class="btn btn-link">назад</a>
    </div>
</div>
<script src="/assets/plugins/tinymce/tinymce.js<?= $_SESSION['rand'] ?>"></script>
<?
//include 'admin_edit.php';
importWisiwyng('products_desc_minimal', 150);
importWisiwyng('products_desc', 300);
importWisiwyng('product_content', 300);
?>
<script>
    var product_edit = '<?= $_GET['product_edit'] ?>';
    var products_id = product_edit;

    $(document).ready(function () {

        get_taxs();

        /*======== MULTIPLE SELECT ========*/
        var products_wares = $(".products_wares").select2({
            width: "style",
            placeholder: "Выберите товары",
            allowClear: true
        });

        products_category = $(".products_category").select2({
            width: "100%",
            placeholder: "Выберите категории",
            allowClear: true
        });
        //kaijean
        products_account = $(".products_account").select2({
            width: "100%",
            placeholder: "Выберите счёт для платежей",
            allowClear: true
        });
        //kaijean
        var products_topic = $(".products_topic").select2({
            width: "100%",
            placeholder: "Выберите темы",
            allowClear: true
        });

        var product_theme = $(".product_theme").select2({
            width: "100%",
            placeholder: "Выберите темы",
            allowClear: true
        });

        $(".visible_products").change(function () {
            visible_products = $(this).val();
        });
        // products_wares.val(["CA", "AL"]).trigger("change");
        // products_category.val(["CA", "AL"]).trigger("change");
        // products_topic.val(["CA", "AL"]).trigger("change");

        if (products_id == '0') {
            getWaresArray(0);
            getTopicArray(0);
            getCategoryArray(0);
            getAccountArray(0);//kaijean
            getProductThemeArray(0);
        }

        /**
         * Товары 
         * @returns {undefined}
         */
        function getWaresArray(v) {
            if ($(".products_wares").length > 0) {
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
        }

        /**
         * Платежный счёт
         * @returns {undefined}
         */
         //kaijean
        function getAccountArray(v) {
            if ($(".products_account").length > 0) {
                $(".products_account option").remove();
                sendPostLigth('/jpost.php?extension=accounts', {"get_accounts_all": 1}, function (e) {
                    var data = e['data'];
                    if (data.length > 0) {
                        $(".products_account").append('<option></option>');//kaijean
                        for (var i = 0; i < data.length; i++) {
                            $(".products_account").append('<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>');
                        }
                        if (!!v && v.length > 0) {
                            products_account.val(v).trigger("change");
                        }
                    }
                });
            }
        }
        //kaijean
        /**
         * Категории 
         * @returns {undefined}
         */
        function getCategoryArray(v) {
            if ($(".products_category").length > 0) {
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
        }

        /**
         * Темы 
         * @returns {undefined}
         */
        function getTopicArray(v) {
            if ($(".products_topic").length > 0) {
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
        }

        /**
         * Темы 
         * @returns {undefined}
         */
        function getProductThemeArray(v) {
            if ($(".product_theme").length > 0) {
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
        }

        // Инициализация кнопки редактирования
        function products_init() {
            if (product_edit > 0) {
                sendPostLigth('/jpost.php?extension=products',
                        {"getProductElemId": product_edit},
                        function (e) {
                            console.log('products_init');
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
                                //kaijean
                                 // Счёт для платежных систем
                                var products_account_array = [];
                                if (e['data']['products_account'] > 0) {
                                    // for (var i = 0; i < e['data']['products_account'].length; i++) {
                                        products_account_array.push(e['data']['products_account']);
                                    // }
                                }
                                //kaijean

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

                                $(".products_tax").find('option[value="' + e['data']['tax'] + '"]').attr("selected", "selected");

                                getWaresArray(products_wares_array);
                                getTopicArray(products_topic_array);
                                getCategoryArray(products_category_array);
                                getAccountArray(products_account_array);//kaijean
                                getProductThemeArray(products_theme_array);
                                // kaijean
                                //устанавливаем описание в контейнер для дальнейшего редактирования
                                $(".products_desc_minimal").html(e['data']['desc_minimal']);
                                $(".products_desc").html(e['data']['desc']);
                                // setTimeout(function () {
                                    // try {
                                        // устанавливаем содержимое контейнера в редактор при запросе через ajax
                                        // tinymce.get('products_desc_minimal').setContent(e['data']['desc_minimal']);
                                    // } catch (e) {
                                        // console.log('Error products_desc_minimal');
                                    // }

                                    // try {
                                        // tinymce.get('products_desc').setContent(e['data']['desc']);
                                    // } catch (e) {
                                        // console.log('Error products_desc');
                                    // }
                                // }, 1500);
                                // kaijean




                                $(".form_save_products").find(".products_sold").val(e['data']['sold']);
                                $(".product_content").val(e['data']['product_content']);

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
                                $(".form_save_products").find(".products_period_open").val(e['data']['period_open']);

                                /* -- images -- */
                                var images = e['data']['images_str'].split(',');
                                for (var i = 0; i < images.length; i++) {
                                    $(".form_save_products").find(".images").append(get_html_images_block(images[i], i));
                                }
                                /* -- images end -- */

                                // Отобразим "Блок" 
                                if (e['data']['block_profit'] == '1') {
                                    if (!$(".block_profit_checked").is(':checked')) {
                                        $(".block_profit_checked").click();
                                        $(".btn_block_profit").click();
                                    }
                                }
                                init_block_profit_questions_array();
                                init_block_profit_plus_array();

                                // Отобразим "Блок" 
                                if (e['data']['block_trailer'] == '1') {
                                    if (!$(".block_trailer_checked").is(':checked')) {
                                        $(".block_trailer_checked").click();
                                        $(".btn_block_trailer").click();
                                    }
                                }
                                
                                // Отобразим "Блок" 
                                if (e['data']['block_conditions'] == '1') {
                                    if (!$(".block_conditions_checked").is(':checked')) {
                                        $(".block_conditions_checked").click();
                                        $(".btn_block_conditions").click();
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
            }
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
            var products_account = $(".form_save_products").find(".products_account").val();//kaijean
            var products_theme = $(".form_save_products").find(".product_theme").val();
            var products_tax = $(".form_save_products").find(".products_tax").val();
            var products_desc_minimal = tinymce.get('products_desc_minimal').getContent();
            var products_desc = tinymce.get('products_desc').getContent();
            // tinymce.get('wares_descr').setContent("<p>Hello world!</p>")
            var products_sold = $(".form_save_products").find(".products_sold").val();
            var product_content = tinymce.get('product_content').getContent();
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
            var products_period_open = $(".form_save_products").find(".products_period_open").val();

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
                        "products_account": products_account,//kaijean
                        "products_tax": products_tax,
                        "products_theme": products_theme,
                        "products_desc_minimal": products_desc_minimal,
                        "products_desc": products_desc,
                        "products_sold": products_sold,
                        "products_active": products_active,
                        "products_price": products_price,
                        "products_price_promo": products_price_promo,
                        "products_period_open": products_period_open,
                        "product_new": product_new,
                        "product_content": product_content,
                        "images_str": images_str.toString()},
                    function (e) {
                        if (e['success'] == '1') {
                            //$(".form_save_products").find('data-dismiss="modal"').click();
                            //$('#form_edit_products_modal').modal('hide');

                            if (products_id == '0') {
                                window.location.href = '/admin/catalog/';
                            }
                        }
                    });
        });

        // если нажали создать новый блок
        $(".add_products").click(function () {
            getWaresArray([]);
            getTopicArray([]);
            getCategoryArray([]);
            getProductThemeArray([]);
        });

        products_init();

        // setTimeout(function () {

            // tinymce.get('products_desc_minimal').getContent();
        // },1000);
    });

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

    /*
     * Общая функция обновление данных блоков
     */
    function block_data_edit_init(func) {
        if ($(".block_data_edit").length > 0) {
            $(".block_data_edit").unbind('change').change(function () {
                var block_id = $(this).attr("elm_id");
                var block_type = $(this).attr("block_type");
                var row = $(this).attr("row");
                var parent = $(this).attr("parent");
                var val = $(this).val();
                sendPostLigth('/jpost.php?extension=products',
                        {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": row, "val": val, "parent": parent},
                        function (e) {
                            func();
                        });
            });
        }
    }
    
    /*
     * Общая функция удаления информации по блоку
     */
    function block_data_delete_init(func) {
        if ($(".block_elm_delete").length > 0) {
            $(".block_elm_delete").unbind('click').click(function () {
                var block_id = $(this).attr("elm_id");
                sendPostLigth('/jpost.php?extension=products',
                        {"block_data_delete": 1, "block_id": block_id},
                        function (e) {
                            func();
                        });
            });
        }
    }

    function get_taxs() {
        var products_taxs = [];
        sendPostLigth('/jpost.php?extension=category',
                {"getCategoryType": 'tax'},
                function (e) {
                    $(".products_tax").append('<option value="0">По умолчанию без налога</option>');
                    if (e['success'] == '1') {
                        products_taxs.push(e['data']);
                        for (var i = 0; i < e['data'].length; i++) {
                            $(".products_tax").append('<option value="' + e['data'][i]['title'] + '">' + e['data'][i]['title'] + '</option>');
                        }
                    }
                });
    }
</script>