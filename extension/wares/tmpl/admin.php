<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Управление товарами</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <? if (!isset($_GET['edit'])): ?>
                                <a href="#" class="btn btn-primary float-left add_wares" data-toggle="modal" data-target="#form_edit_wares_modal">Добавление товара</a>
                                <?
                                include 'admin_edit.php';
                                importWisiwyng('wares_descr');
                                ?>
                            <? endif; ?>
                            <select name="visible" class="form-control w-25 float-left ml-2 visible_wares">
                                <option value="1" <?= (isset($_SESSION['wares']['visible']) && $_SESSION['wares']['visible'] == 1) ? 'selected="selected"' : '' ?>>Отображаемые</option>
                                <option value="0" <?= (isset($_SESSION['wares']['visible']) && $_SESSION['wares']['visible'] == 0) ? 'selected="selected"' : '' ?>>Не отображаемые</option>
                                <option value="9" <?= (isset($_SESSION['wares']['visible']) && $_SESSION['wares']['visible'] == 9) ? 'selected="selected"' : '' ?>>Удаленные</option>
                            </select>
                        </div>
                        <div class="col-4 col-offset-4">
                            <input type="text" class="form-control search_wares" value="<?= $_SESSION['wares']['searchStr'] ?>" placeholder="Поиск товаров...">
                            <div class="float-right" style="font-size: 0.7rem;">Найдено <span class="search_wares_col"></span></div>
                        </div>

                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive-lg">
                                <table class="table table-striped table-bordered wares_arrays_data" style="width:100%;background-color: #FFFFFF;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">id</th>
                                            <th>Наименование</th>
                                            <!--<th style="text-align: center;">Код</th>-->
                                            <th style="text-align: center;">Артикул</th>
                                            <th style="text-align: center;">Колличество</th>
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
    var wares_id = '<?= $wares_id ?>';
    var searchStr = '';
    var visible_wares = '1';
    $(document).ready(function () {

        var wares_categorys = $(".wares_categorys").select2({
            width: "100%",
            placeholder: "Выбирете категории",
            allowClear: true
        });

        getCategoryArray([]);

        searchStr = $(".search_wares").val();
        $(".search_wares").delayKeyup(function () {
            var v = $(".search_wares").val();
            searchStr = v;
            getWaresArray(searchStr, visible_wares);
        }, 700);

        $(".visible_wares").change(function () {
            visible_wares = $(this).val();
            getWaresArray(searchStr, visible_wares);
        });


        /*
         * Настройки значения список
         */
        function getWaresArray(str, visible) {
            searchStr = str;

            sendPostLigth('/jpost.php?extension=wares', {"getWaresArray": '1', "searchStr": searchStr, "visible": visible}, function (e) {
                var data = e['data'];
                $(".wares_arrays_data tbody tr").remove();
                $(".search_wares_col").html(0);
                if (data.length > 0) {
                    $(".search_wares_col").html(data.length);
                    for (var i = 0; i < data.length; i++) {
                        var checked = '';
                        var active_str = 'не отображается';
                        if (data[i]['active'] > 0) {
                            checked = 'checked="checked"';
                            active_str = 'отображается';
                        }
                        var is_delete_str = '';
                        if (data[i]['is_delete'] > 0) {
                            is_delete_str = 'удален';
                        }
                        $(".wares_arrays_data tbody").append(
                                '<tr elm_id="' + data[i]['id'] + '"> \n\
                                <td>' + data[i]['id'] + '</td>\n\
                                <td>' + data[i]['title'] + '</td>\n\
                                <td style="text-align: center;">' + data[i]['articul'] + '</td>\n\
                                <td style="text-align: center;">' + data[i]['col'] + '</td>\n\
                                <td style="text-align: center;"><span style="font-size: 0.7rem;">' + active_str + ' ' + is_delete_str + '</span></td>\n\
                                <td style="text-align: center;white-space: nowrap">\n\
                                <a href="?edit=' + data[i]['id'] + '" class="btn btn-sm btn-primary" title="Редактировать"><i class="mdi mdi-pencil"></i></a>\n\
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger btn_wares_delete" title="Удалить"><i class="mdi mdi-delete"></i></a> \n\
                                </td>\n\
                            </tr>');
                    }
                    /*
                     <td style="text-align: center;">\n\
                     <label class="switch switch-text switch-primary form-control-label">\n\
                     <input type="checkbox" class="switch-input form-check-input wares_active wares_active_switch" elm_id="' + data[i]['id'] + '" value="1" ' + checked + '>\n\
                     <span class="switch-label" data-on="On" data-off="Off"></span>\n\
                     <span class="switch-handle"></span>\n\
                     </label>\n\
                     </td>\n\
                     */
                    wares_switch_init();
                }

                save_wares_init();
                wares_delete_init();
            });
        }
        getWaresArray(searchStr, visible_wares);



        // Инициализация кнопки редактирования
        function save_wares_init() {
            if (wares_id != '') {

            } else {
                $(".btn_wares_edit").click(function () {
                    clear_form_save_wares();
                    var wares_id = $(this).closest("tr").attr("elm_id");
                    sendPostLigth('/jpost.php?extension=wares',
                            {"getWaresElemId": wares_id},
                            function (e) {
                                if (e['success'] == '1') {
                                    $(".form_save_wares").find(".wares_id").val(e['data']['id']);
                                    $(".form_save_wares").find(".wares_title").val(e['data']['title']);
                                    $(".form_save_wares").find(".wares_ex_code").val(e['data']['ex_code']);
                                    $(".form_save_wares").find(".wares_articul").val(e['data']['articul']);
                                    tinymce.get('wares_descr').setContent(e['data']['descr']);
                                    $(".form_save_wares").find(".wares_col").val(e['data']['col']);

                                    // Каталоги
                                    var wares_categorys_array = [];
                                    if (e['data']['products_category'].length > 0) {
                                        for (var i = 0; i < e['data']['products_category'].length; i++) {
                                            wares_categorys_array.push(e['data']['products_category'][i]);
                                        }
                                    }
                                    getCategoryArray(wares_categorys_array);


                                    if (e['data']['active'] > 0) {
                                        if (!$(".form_save_wares").find(".wares_active").is(':checked')) {
                                            $(".form_save_wares").find(".wares_active").click();
                                        }
                                    } else {
                                        $(".form_save_wares").find(".wares_active").removeAttr("checked");
                                    }
                                    /* -- images -- */
                                    console.log(e['data']['images']);
                                    var images = e['data']['images'].split(',');
                                    for (var i = 0; i < images.length; i++) {
                                        $(".form_save_wares").find(".images").append(get_html_images_block(images[i], i));
                                    }
                                    /* -- images end -- */
                                    $('#form_edit_wares_modal').modal('show');
                                }
                            });
                });
            }


        }


        // обнулить данные блока
        function clear_form_save_wares() {
            $(".form_save_wares").find(".wares_id").val("0");
            $(".form_save_wares").find(".wares_title").val("");
            $(".form_save_wares").find(".wares_ex_code").val("");
            $(".form_save_wares").find(".wares_articul").val("");
            wares_categorys.val([]).trigger("change");
            tinymce.get('wares_descr').setContent("<p></p>");
            $(".form_save_wares").find(".wares_col").val("");
            $(".form_save_wares").find('.images').html("");
            $(".form_save_wares").find(".wares_id").val("0");
        }

        $(".btn_save_config").click(function () {
            var wares_id = $(".form_save_wares").find(".wares_id").val();
            var wares_title = $(".form_save_wares").find(".wares_title").val();
            var wares_categorys = $(".form_save_wares").find(".wares_categorys").val();
            var wares_ex_code = $(".form_save_wares").find(".wares_ex_code").val();
            var wares_articul = $(".form_save_wares").find(".wares_articul").val();
            var wares_col = $(".form_save_wares").find(".wares_col").val();
            var wares_descr = tinymce.get('wares_descr').getContent();
            // tinymce.get('wares_descr').setContent("<p>Hello world!</p>")
            //var wares_active = $(".form_save_wares").find(".wares_active").val();

            let images_col = $(".form_save_wares").find('.image_elm').length;
            var images_str = [];
            for (var i = 0; i < images_col; i++) {
                images_str.push($($(".form_save_wares").find('.image_elm')[i]).find(".image_obj_value").val());
            }

            sendPostLigth('/jpost.php?extension=wares',
                    {"edit_wares": wares_id,
                        "wares_title": wares_title,
                        "wares_categorys": wares_categorys,
                        "wares_ex_code": wares_ex_code,
                        "wares_articul": wares_articul,
                        "wares_col": wares_col,
                        "club_month_period": club_month_period,
                        "wares_descr": wares_descr,
                        //"wares_active": wares_active,
                        "wares_images": images_str.toString()},
                    function (e) {
                        if (e['success'] == '1') {
                            //$(".form_save_wares").find('data-dismiss="modal"').click();
                            $('#form_edit_wares_modal').modal('hide');
                            getWaresArray(searchStr, visible_wares);
                        }
                    });
        });

        // если нажали создать новый блок
        $(".add_wares").click(function () {
            clear_form_save_wares();
        });

        /**
         * Действия
         */
        function wares_delete_init() {
            $(".btn_wares_delete").click(function () {
                var wares_id = $(this).closest("tr").attr("elm_id");
                sendPostLigth('/jpost.php?extension=wares',
                        {"deleteWares": wares_id},
                        function (e) {
                            getWaresArray(searchStr, visible_wares);
                        });
            });
        }





    });

    function wares_switch_init() {
        $(".wares_active_switch").unbind("click").click(function () {
            var wares_id = $(this).attr("elm_id");
            var checked = 0;
            if ($(this).prop('checked')) {
                checked = 1;
            }
            sendPostLigth('/jpost.php?extension=wares',
                    {"setWaresActive": wares_id,
                        "active": checked},
                    function (e) {
                        getWaresArray(searchStr, visible_wares);
                    });
        });
    }

    /**
     * Категории 
     * @returns {undefined}
     */
    function getCategoryArray(v) {
        console.log('getCategoryArray');
        $(".wares_categorys option").remove();
        sendPostLigth('/jpost.php?extension=category', {"getCategoryArray": '1', "searchStr": ''}, function (e) {
            var data = e['data'];
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    $(".wares_categorys").append('<option value="' + data[i]['id'] + '">' + data[i]['title'] + '</option>');
                }
                if (!!v && v.length > 0) {
                    wares_categorys.val(v).trigger("change");
                }
            }
        });
    }

</script>    