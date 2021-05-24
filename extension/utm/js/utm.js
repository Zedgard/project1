$(document).ready(function () {
    init_utm();
    init_utm_filter();
    init_utm_tags();
    if ($(".inp_datepicker").length > 0) {
        init_datepicker(3);
    }
});


function init_utm() {
    if ($(".utm_list").length > 0) {
        sendPostLigth('/jpost.php?extension=utm', {
            "utm_list": 1
        }, function (e) {
            $(".utm_list tbody tr").remove();
            if (e['success'] == '1') {
                if (e['data'].length > 0) {
                    for (var i = 0; i < e['data'].length; i++) {
                        $(".utm_list tbody").append(
                                '<tr>\n\
                            <td><input type="text" name="tag_title" value="' + e['data'][i]['title'] + '" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_utm" elm_row="title" class="form-control init_elm_edit"></td>\n\
                            <td class="text-center">\n\
                                <span class="btn btn-primary config_utm_values" elm_id="' + e['data'][i]['id'] + '">Настроить теги</span>\n\
                                <span class="btn btn-danger init_elm_delete" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_utm" func="init_utm()"><i class="mdi mdi-delete"></i></span>\n\
                            </td>\n\
                            </tr>\n\
                            <tr class="utm_tags_lists_block utm_tags_list_' + e['data'][i]['id'] + '" elm_id="' + e['data'][i]['id'] + '" style="display:none;">\n\
                                <td colspan="2">\n\
                                    <div class="table-responsive-lg">\n\
                                    <table class="table table-striped table-bordered w-100 utm_tag_values_list">\n\
                                        <thead>\n\
                                            <tr>\n\
                                                <th style="width: 200px;padding: 1.4rem;">Код метки</th>\n\
                                                <th><div style="padding: 0.6rem 0.6rem 0 0;">Значение</div></th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>\n\
                                        </tbody>\n\
                                    </table>\n\
                                    </div>\n\
                                    <div>Ссылка: <input type="text" value="" class="form-control copy_link" onclick="this.select();"></div>\n\
                                </td>\n\
                            </tr>'
                                );
                    }
                    //<button onclick="copy_text(\'' + e['data'][i]['id'] + '\')" class="btn btn-sm btn-secondary">Скопировать в буфер</button>\n\
                    init_config_utm_values_btn();
                    //input_text_select('.copy_link');
                }
            }
        });
    }
}


function init_utm_tags() {
    if ($(".utm_tags_list").length > 0) {
        sendPostLigth('/jpost.php?extension=utm', {
            "utm_tags_list": 1
        }, function (e) {
            $(".utm_tags_list tbody tr").remove();
            if (e['success'] == '1') {
                if (e['data'].length > 0) {
                    for (var i = 0; i < e['data'].length; i++) {
                        $(".utm_tags_list tbody").append(
                                '<tr>\n\
                            <td><input type="text" name="tag_code" value="' + e['data'][i]['code'] + '" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_utm_tags" elm_row="code" class="form-control init_elm_edit"></td>\n\
                            <td><input type="text" name="tag_title" value="' + e['data'][i]['title'] + '" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_utm_tags" elm_row="title" class="form-control init_elm_edit"></td>\n\
                            <td><input type="text" name="tag_descr" value="' + e['data'][i]['descr'] + '" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_utm_tags" elm_row="descr" class="form-control init_elm_edit"></td>\n\
                            <td><span class="btn btn-danger init_elm_delete" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_utm_tags" func="init_utm_tags()"><i class="mdi mdi-delete"></i></span></td>\n\
                            </tr>'
                                );
                    }

                    super_init();
                }
            }

        });
    }
}

function init_config_utm_values_btn() {
    if ($(".config_utm_values").length > 0) {
        setTimeout(function () {
            $(".config_utm_values").unbind('click').click(function () {
                //$(".utm_tags_lists_block").hide(200);
                var elm_id = $(this).attr('elm_id');
                $(".utm_tags_list_" + elm_id).toggle(200);
                // Получим данные по меткам
                utm_tag_values_list_post(elm_id);
            });
        }, 200);
    }
}

function utm_tag_values_list_post(elm_id) {

    sendPostLigth('/jpost.php?extension=utm', {
        "utm_tag_values_list": 1,
        "utm_id": elm_id
    }, function (e) {
        $(".utm_tags_list_" + elm_id).find(".utm_tag_values_list tbody tr").remove();
        if (e['success'] == '1') {
            var copy_link = '';
            if (e['data'].length > 0) {
                for (var i = 0; i < e['data'].length; i++) {
                    $(".utm_tags_list_" + elm_id).find(".utm_tag_values_list tbody").append(
                            '<tr>\n\
                                            <td>' + e['data'][i]['code'] + '</td>\n\
                                            <td><input type="text" name="tag_val" value="' + e['data'][i]['val'] + '" tag_code="' + e['data'][i]['code'] + '" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_utm_tag_values" elm_row="val" class="form-control tag_val_class init_elm_edit" func="update_tag_val()"></td>\n\
                                        </tr>'
                            );
                    if (i == 0) {
                        copy_link += '?';
                    } else {
                        copy_link += '&';
                    }
                    copy_link += e['data'][i]['code'] + '=' + e['data'][i]['val'];
                    $(".utm_tags_list_" + elm_id).find(".copy_link").val(copy_link);
                }
            }
        }

    });
}

/**
 * Обновление при измененении поля "tag_val_class"
 * @returns {undefined}
 */
function update_tag_val() {
    $('.utm_tags_lists_block').each(function () {
        var e = $(this)[0];
        var elm_id = $(e).attr('elm_id');
        //utm_tag_values_list_post(elm_id);
        var copy_link = '';
        var i = 0;
        $(e).find(".tag_val_class").each(function () {
            var tag_code = $(this).attr("tag_code");
            var value = $(this).val();
            if (i == 0) {
                copy_link += '?';
            } else {
                copy_link += '&';
            }
            copy_link += tag_code + '=' + value;
            $(e).find(".copy_link").val(copy_link);
            i++;
        });
    });

}


function copy_text(elm_id) {
    var copyText = $(".utm_tags_list_" + elm_id).find(".copy_link")[0];
    copyText.select();
    document.execCommand("copy");
    alert("Скопировано в буфер: " + copyText.value);
}

/**
 * Выделить текст поля при клике
 * @param {type} elm
 * @returns {undefined}
 */
function input_text_select(elm) {
    //console.log('input_text_select elm ' + elm);
    $(elm).focus(function () {
        if (this.value == this.defaultValue) {
            this.select();
        }
    });
}

function init_utm_filter() {
    console.log('init_utm_filter');
    if ($(".utm_filter").length > 0) {

        $(".utm_filter, .utm_date_start_filter, .utm_date_end_filter, .utm_tags_list_filter").unbind('change').change(function () {
            init_utm_filter();
        });

        var utm_filter = $(".utm_filter").val();
        var utm_date_start_filter = $(".utm_date_start_filter").val();
        var utm_date_end_filter = $(".utm_date_end_filter").val();
        var utm_tags_list_filter = $(".utm_tags_list_filter").val();

        sendPostLigth('/jpost.php?extension=utm', {
            "utm_list_filter": 1,
            "utm_filter": utm_filter,
            "utm_date_start_filter": utm_date_start_filter,
            "utm_date_end_filter": utm_date_end_filter,
            "utm_tags_list_filter": utm_tags_list_filter
        }, function (e) {
            $(".table_utm_list_filter tbody tr").remove();
            if (e['success'] == '1') {
                if (e['data'].length > 0) {
                    for (var i = 0; i < e['data'].length; i++) {
                        $(".table_utm_list_filter tbody").append(
                                '<tr>\n\
                            <td>' + e['data'][i]['title'] + '</td>\n\
                            <td>' + e['data'][i]['lastdate'] + '</td>\n\
                            <td>' + e['data'][i]['col'] + '</td>\n\
                            <td>' + e['data'][i]['tag_title'] + '</td>\n\
                            </tr>'
                                );
                    }

                }
            }

        });
    }
}