$(document).ready(function () {
    init_utm_tags();
});

function init_utm_tags() {
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
            }
        }
    });
}
