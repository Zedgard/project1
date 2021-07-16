
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg mt-3 mt-lg-3 text-center text-lg-left">
                    <h2>Настройки</h2>
                </div>
                <div class="col-lg mt-3 mt-lg-3 text-center text-lg-right">
                    <a href="#" class="btn btn-primary form_category" data-toggle="modal" data-target="#form_category_modal">Управление категориями</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="text-center text-lg-left">
                <a href="#" class="btn btn-primary mt-3 mb-3 add_config" data-toggle="modal" data-target="#form_edit_config_modal">Добавить настройку</a>
            </div>
            <div id="accordion1" class="accordion accordion-bordered">
                <?
                foreach ($categorys as $value) {
                    ?>
                    <div id="accordion3" class="accordion accordion-bordered ">
                        <div class="card">
                            <div class="card-header" id="heading3">
                                <button class="btn btn-link collapsed btn_category" category_id="<?= $value['id'] ?>" data-toggle="collapse" data-target="#collapse<?= $value['id'] ?>" aria-expanded="false" aria-controls="collapse">
                                    <?= $value['title'] ?>
                                </button>
                            </div>
                            <div id="collapse<?= $value['id'] ?>" class="collapse" aria-labelledby="heading3" data-parent="#accordion3">
                                <div class="card-body card-default w-100">
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered table-striped config_arrays_data<?= $value['id'] ?>">
                                            <thead>
                                                <tr>
                                                    <th>Код</th>
                                                    <th>Наименование</th>
                                                    <th>Значение</th>
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
                    <?
                }
                ?>
            </div>
        </div> 
    </div>

    <div class="form-footer pt-4 pt-5 mt-4 border-top">
        <i class="">
    </div>
</div> 
<!-- Large Modal -->
<div class="modal fade" id="form_category_modal" tabindex="-1" role="dialog" aria-labelledby="form_category_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_category_modal">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление категориями</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?
                include $_SERVER['DOCUMENT_ROOT'] . '/extension/category/admin.php';
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    var category_id = 0;
    var searchStr = '';
    $(document).ready(function () {
        $(".btn_category").unbind("click").click(function () {
            category_id = $(this).attr("category_id");
            getConfigArray(searchStr);
        });

        //getConfigArray();



    });

    /*
     * Настройки значения список
     */
    function getConfigArray() {
        $(".config_arrays_data" + category_id + " tbody tr").remove();
        sendPostLigth('/jpost.php?extension=config',
                {
                    "getConfigArray": '1',
                    "category_id": category_id,
                    "searchStr": searchStr
                }
        , function (e) {
            var data = e['data'];
            for (var i = 0; i < data.length; i++) {
                var config_type = data[i]['config_type'];
                var config_val = data[i]['config_val'];
                if (config_type === "checkbox") {
                    var checked = '';
                    if (data[i]['config_val'] == "1") {
                        checked = 'checked="checked"';
                    }
                    config_val = '<input type="checkbox" name="config_val" class="form-check-input" value="1" ' + checked + ' disabled="disabled" />';
                }
                $(".config_arrays_data" + category_id + " tbody").append(
                        '<tr elm_id="' + data[i]['id'] + '" title="' + data[i]['config_descr'] + '"> \n\
                                <td>' + data[i]['config_code'] + '</td>\n\
                                <td>' + data[i]['config_title'] + '</td>\n\
                                <td>' + config_val + '</td>\n\
                                <td style="text-align: center;white-space: nowrap;">\n\
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary btn_config_edit" title="Редактировать"><i class="mdi mdi-pencil"></i></a>\n\
                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger btn_config_delete" title="Удалить"><i class="mdi mdi-delete"></i></a> \n\
                                </td>\n\
                            </tr>'
//                        '<div class="form-group"> \
//                        <label for="' + data['config_code'] + '">' + data['config_title'] + '</label> \
//                        <input type="text" class="form-control" config_id="' + data['id'] + '" value="' + data['config_val'] + '" placeholder="Введите значение..."> \
//                    </div>'
                        );
            }

            save_config_init();
            config_delete_init();
        });
    }



    /*
     * Действия
     */
    function config_delete_init() {
        $(".btn_config_delete").click(function () {
            if (confirm("Подтвердить удаление!")) {
                var config_id = $(this).closest("tr").attr("elm_id");
                sendPostLigth('/jpost.php?extension=config',
                        {"deleteConfig": config_id},
                        function (e) {
                            getConfigArray();
                        });
            }
        });
    }


    // Инициализация кнопки редактирования
    function save_config_init() {
        $(".btn_config_edit").click(function () {
            clear_form_save_config();
//            $(".form_save_config").find('.config_code').removeAttr("disabled");
//            $(".form_save_config").find('.config_type').removeAttr("disabled");
//            $(".form_save_config").find('.config_type option').removeAttr("selected");
//            $(".form_save_config").find(".block_input").hide();
//            $(".form_save_config").find(".block_textarea").hide();
//            $(".form_save_config").find(".block_checkbox").hide();
            var config_id = $(this).closest("tr").attr("elm_id");
            sendPostLigth('/jpost.php?extension=config',
                    {"getConfigElemId": config_id},
                    function (e) {
                        if (e['success'] == '1') {
                            //console.log('config_code: ' + e['data']['config_type']);
                            $(".form_save_config").find('.config_type').removeAttr("disabled");
                            $(".form_save_config").find(".config_id").val(config_id);
                            $(".form_save_config").find(".config_code").val(e['data']['config_code']);
                            $(".form_save_config").find(".config_title").val(e['data']['config_title']);
                            $(".form_save_config").find(".config_descr").val(e['data']['config_descr']);
                            $(".form_save_config").find('.config_type option[value="' + e['data']['config_type'] + '"]').prop('selected', true); // 
                            init_config_categorys(e['data']['category']);
                            //$(".form_save_config").find(".block").hide();
                            let config_type = e['data']['config_type'];
                            let config_val = e['data']['config_val'];
                            init_config_types(config_type, config_val);

                            // Залочим поля которые нельзя изменять
                            $(".form_save_config").find('.config_code').attr("disabled", "disabled");
                            $(".form_save_config").find('.config_type').attr("disabled", "disabled");
                            $('#form_edit_config_modal').modal('show');
                            init_btn_save_config();
                        }
                    });
        });
    }


    // обнулить данные блока
    function clear_form_save_config() {
        $(".form_save_config").find('.config_code').removeAttr("disabled");
        $(".form_save_config").find(".block_input").hide(200);
        $(".form_save_config").find(".block_textarea").hide(200);
        $(".form_save_config").find(".block_checkbox").hide(200);
        $(".form_save_config").find(".config_id").val("0");
        $(".form_save_config").find(".config_code").val("");
        $(".form_save_config").find(".config_title").val("");
        $(".form_save_config").find(".config_descr").val("");
        $(".form_save_config").find(".config_type").val("");

        $(".form_save_config").find('[name="config_val"]').val("");
    }




    // Выбрать тип блока
//    $(".config_type").change(function () {
//        var v = $(this).val();
//        $(".block").hide();
//        if (v.length > 0) {
//            if (v == "input") {
//                $(".block_input").show(200);
//            }
//            if (v == "textarea") {
//                $(".block_textarea").show(200);
//            }
//            if (v == "checkbox") {
//                $(".block_checkbox").show(200);
//            }
//        } else {
//            alert("Выбирите тип настройки");
//        }
//    });

    // сохранение настройки
    function init_btn_save_config() {
        $(".btn_save_config").unbind('click').click(function () {
            var config_id = $(".form_save_config").find(".config_id").val();
            var config_code = $(".form_save_config").find(".config_code").val();
            var config_title = $(".form_save_config").find(".config_title").val();
            var config_descr = $(".form_save_config").find(".config_descr").val();
            var config_type = $(".form_save_config").find(".config_type").val();
            var config_category = $(".form_save_config").find(".config_category").val();
            var config_val = '';
            if (config_type == 'input') {
                config_val = $(".form_save_config").find(".config_input_val").val();
            }
            if (config_type == 'textarea') {
                config_val = $(".form_save_config").find(".config_textarea_val").val();
            }
            if (config_type == 'checkbox') {
                if ($(".form_save_config").find(".config_checkbox_val").is(':checked')) {
                    config_val = '1';
                } else {
                    config_val = '0';
                }
            }

            sendPostLigth('/jpost.php?extension=config',
                    {"configEdit": config_id,
                        "config_category": config_category,
                        "config_code": config_code,
                        "config_title": config_title,
                        "config_descr": config_descr,
                        "config_type": config_type,
                        "config_val": config_val},
                    function (e) {
                        if (e['success'] == '1') {
                            //$(".form_save_config").find('data-dismiss="modal"').click();
                            $('#form_edit_config_modal').modal('hide');
                            getConfigArray();
                        }
                    });
        });
    }

    // Получим категории
    function init_config_categorys(category_id) {
        $(".config_category").html("");
        $(".config_category").append('<option value="0">Выберите категорию...</option>');
        sendPostLigth('/jpost.php?extension=config',
                {"get_config_categoryes": 1},
                function (e) {
                    if (e['success'] == '1') {
                        if (e['data'].length > 0) {
                            for (var i = 0; i < e['data'].length; i++) {
                                let s = '';
                                if (category_id == e['data'][i]['id']) {
                                    s = 'selected="selected"';
                                }
                                $(".config_category").append('<option value="' + e['data'][i]['id'] + '" ' + s + '>' + e['data'][i]['title'] + '</option>');
                            }
                        }
                    }
                });
    }


    // если нажали создать новый блок
    $(".add_config").click(function () {
        clear_form_save_config();
        init_config_categorys();
        init_config_types('');
        init_btn_save_config();
    });

    // обработаем типы настроек 
    function init_config_types(config_type_value, config_val) {
        if (config_type_value === '') {
            $('.config_type').removeAttr("disabled");
        } else {
            $(".form_save_config").find('.config_type').attr("disabled", "disabled");
            if (config_type_value === 'input') {
                $(".form_save_config").find(".block_input").show(200);
                $(".form_save_config").find(".config_input_val").val(config_val);
            }
            if (config_type_value === 'textarea') {
                $(".form_save_config").find(".block_textarea").show(200);
                $(".form_save_config").find(".config_textarea_val").val(config_val);
            }
            if (config_type_value === 'checkbox') {
                $(".form_save_config").find(".block_checkbox").show(200);
                if (config_val == '1') {
                    $(".form_save_config").find(".config_checkbox_val").attr("checked", "checked"); // checked="checked"
                } else {
                    $(".form_save_config").find(".config_checkbox_val").removeAttr("checked");
                }
            }
        }
        $(".form_save_config").find(".config_type").unbind("change").change(function () {
            $(".form_save_config").find(".block_input").hide(200);
            $(".form_save_config").find(".block_textarea").hide(200);
            $(".form_save_config").find(".block_checkbox").hide(200);

            if ($(this).val() == 'input') {
                $(".form_save_config").find(".block_input").show(200);
                $(".form_save_config").find(".config_input_val").val(config_val);
            }
            if ($(this).val() == 'textarea') {
                $(".form_save_config").find(".block_textarea").show(200);
                $(".form_save_config").find(".config_textarea_val").val(config_val);
            }
            if ($(this).val() == 'checkbox') {
                $(".form_save_config").find(".block_checkbox").show(200);
                if (config_val == '1') {
                    //console.log("h: " + e['data']['config_val']);
                    //$(".form_save_config").find(".config_checkbox_val").length
                    $(".form_save_config").find(".config_checkbox_val").attr("checked", "checked"); // checked="checked"
                } else {
                    $(".form_save_config").find(".config_checkbox_val").removeAttr("checked");
                }
            }
        });
    }
</script>