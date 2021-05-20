$(document).ready(function () {
    init_utm();
    init_utm_tags();
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
                            <tr class="utm_tags_list_' + e['data'][i]['id'] + '" style="display:none;">\n\
                                <td colspan="2">\n\
                                    <div class="table-responsive-lg">\n\
                                    <table class="table table-striped table-bordered w-100 utm_tag_values_list">\n\
                                        <thead>\n\
                                            <tr>\n\
                                                <th style="width: 200px;">Код метки</th>\n\
                                                <th>Значение</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>\n\
                                        </tbody>\n\
                                    </table>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>'
                                );
                    }
                    init_config_utm_values_btn();
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
                var elm_id = $(this).attr('elm_id');

                $(".utm_tags_list_" + elm_id).toggle(200);
                // Получим данные по меткам
                sendPostLigth('/jpost.php?extension=utm', {
                    "utm_tag_values_list": 1,
                    "utm_id": elm_id
                }, function (e) {
                    $(".utm_tag_values_list tbody tr").remove();
                    if (e['success'] == '1') {
                        if (e['data'].length > 0) {
                            for (var i = 0; i < e['data'].length; i++) {
                                $(".utm_tag_values_list tbody").append(
                                        '<tr>\n\
                                            <td>' + e['data'][i]['code'] + '</td>\n\
                                            <td><input type="text" name="tag_val" value="' + e['data'][i]['val'] + '" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_utm_tag_values" elm_row="val" class="form-control init_elm_edit"></td>\n\
                                        </tr>'
                                        );
                            }
                        }
                    }

                });
            });
        }, 200);
    }
}
