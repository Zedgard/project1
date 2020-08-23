<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <div class="col-md-6">
                        <h2>Настройки значения</h2>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="btn btn-primary add_config" data-toggle="modal" data-target="#form_edit_config_modal" style="float: right;">Добавить</a>
                    </div>
                </div>
                <div class="card-body">


                    <table class="table table-bordered table-striped config_arrays_data">
                        <thead>
                            <tr>
                                <th>Код</th>
                                <th>Наименование</th>
                                <th>Описание</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <i class="">
                </div>
            </div> 
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        /*
         * Настройки значения список
         */
        function getConfigArray(searchStr) {
            $(".config_arrays_data tbody tr").remove();
            sendPostLigth('/jpost.php?extension=config', {"getConfigArray": '1', "searchStr": searchStr}, function (e) {
                var data = e['data'];
                for (var i = 0; i < data.length;
                        i++
                        ) {
                    $(".config_arrays_data tbody").append(
                            '<tr elm_id="' + data[i]['id'] + '"> \n\
                                <td>' + data[i]['config_code'] + '</td>\n\
                                <td>' + data[i]['config_title'] + '</td>\n\
                                <td>' + data[i]['config_descr'] + '</td>\n\
                                <td style="text-align: center;">\n\
<a href="#" class="btn btn-sm btn-primary btn_config_edit" title="Редактировать"><i class="mdi mdi-pencil"></i></a>\n\
<a href="#" class="btn btn-sm btn-danger btn_config_delete" title="Удалить"><i class="mdi mdi-delete"></i></a> \n\
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
        getConfigArray('');


        /*
         * Действия
         */

        function config_delete_init() {
            $(".btn_config_delete").click(function () {
                var config_id = $(this).closest("tr").attr("elm_id");
                sendPostLigth('/jpost.php?extension=config',
                        {"deleteConfig": config_id},
                        function (e) {
                            getConfigArray('');
                        });
            });
        }


        // Инициализация кнопки редактирования
        function save_config_init() {
            $(".btn_config_edit").click(function () {
                clear_form_save_config();
                var config_id = $(this).closest("tr").attr("elm_id");
                sendPostLigth('/jpost.php?extension=config',
                        {"getConfigElemId": config_id},
                        function (e) {
                            if (e['success'] == '1') {
                                console.log('config_code: ' + e['data']['config_code']);
                                $(".form_save_config").find(".config_id").val(config_id);
                                $(".form_save_config").find(".config_code").val(e['data']['config_code']);
                                $(".form_save_config").find(".config_title").val(e['data']['config_title']);
                                $(".form_save_config").find(".config_descr").val(e['data']['config_descr']);
                                $(".form_save_config").find('.config_type option[value="' + e['data']['config_type'] + '"]').attr("selected", "selected"); // 

                                $(".form_save_config").find(".block").hide();
                                if (e['data']['config_type'] == 'input') {
                                    $(".form_save_config").find(".block_input").show();
                                    $(".form_save_config").find(".config_input_val").val(e['data']['config_val']);
                                }
                                if (e['data']['config_type'] == 'textarea') {
                                    $(".form_save_config").find(".block_textarea").show();
                                    $(".form_save_config").find(".config_textarea_val").val(e['data']['config_val']);
                                }
                                if (e['data']['config_type'] == 'checkbox') {
                                    $(".form_save_config").find(".block_checkbox").show();
                                    if (e['data']['config_val'] == '1') {
                                        $(".form_save_config").find(".config_checkbox_val").attr("checked", "checked"); // checked="checked"
                                    }else{
                                        $(".form_save_config").find(".config_checkbox_val").removeAttr("checked");
                                    }
                                }

                                // Залочим поля которые нельзя изменять
                                $(".form_save_config").find('.config_code').attr("disabled", "disabled");
                                $(".form_save_config").find('.config_type').attr("disabled", "disabled");
                                $('#form_edit_config_modal').modal('show');
                            }
                        });
            });
        }


        // обнулить данные блока
        function clear_form_save_config() {
            $(".form_save_config").find(".config_id").val("0");
            $(".form_save_config").find(".config_code").val("");
            $(".form_save_config").find(".config_title").val("");
            $(".form_save_config").find(".config_descr").val("");
            $(".form_save_config").find(".config_type").val("");
            $(".form_save_config").find('.config_code').removeAttr("disabled");
            $(".form_save_config").find('.config_type').removeAttr("disabled");
            $(".form_save_config").find('[name="config_val"]').val("");
        }




        // Выбрать тип блока
        $(".config_type").change(function () {
            var v = $(this).val();
            $(".block").hide();
            if (v.length > 0) {
                if (v == "input") {
                    $(".block_input").show(200);
                }
                if (v == "textarea") {
                    $(".block_textarea").show(200);
                }
                if (v == "checkbox") {
                    $(".block_checkbox").show(200);
                }
            } else {
                alert("Выбирите тип настройки");
            }
        });


        $(".btn_save_config").click(function () {
            var config_id = $(".form_save_config").find(".config_id").val();
            var config_code = $(".form_save_config").find(".config_code").val();
            var config_title = $(".form_save_config").find(".config_title").val();
            var config_descr = $(".form_save_config").find(".config_descr").val();
            var config_type = $(".form_save_config").find(".config_type").val();
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
                    config_val = '';
                }
            }

            sendPostLigth('/jpost.php?extension=config',
                    {"configEdit": config_id,
                        "config_code": config_code,
                        "config_title": config_title,
                        "config_descr": config_descr,
                        "config_type": config_type,
                        "config_val": config_val},
                    function (e) {
                        if (e['success'] == '1') {
                            //$(".form_save_config").find('data-dismiss="modal"').click();
                            $('#form_edit_config_modal').modal('hide');
                            getConfigArray('');
                        }
                    });
        });


        // если нажали создать новый блок
        $(".add_config").click(function () {
            clear_form_save_config();
        });

    });



</script>