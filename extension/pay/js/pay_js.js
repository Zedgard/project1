var pay_num = 1;
var pay_list_col = 0;
var pay_list_col_true = 1;
var search_pay_user_str = '';
$(document).ready(function () {
    init_pay_data_list();
    init_get_next_page();
    init_search_pay_user();
});

/**
 * Список платежей
 * @returns {undefined}
 */
function init_pay_data_list() {
    // pay_datas_page
    sendPostLigth('/jpost.php?extension=pay', {
        "pay_data_page": pay_num,
        "search_pay_user_str": search_pay_user_str
    }, function (e) {
        $(".pay_data tbody").html("");

        for (var i = 0; i < e['data'].length; i++) {
            var user_title = '';
            var user_descr = '';
            var pay_descr = '';
            if (e['data'][i]['email'].length > 0) {
                user_title = e['data'][i]['email'];

                if (e['data'][i]['phone'].length > 0) {
                    user_title = e['data'][i]['email'] + '<br/>' + e['data'][i]['phone'];
                }
                user_descr = e['data'][i]['first_name'] + ' ' + e['data'][i]['last_name'];

                if (e['data'][i]['pay_descr'].length > 0) {
                    pay_descr = e['data'][i]['pay_descr'];
                }
                if (e['data'][i]['info'].length > 0) {
                    pay_descr = '';
                    for (var a = 0; a < e['data'][i]['info'].length; a++) {
                        pay_descr = pay_descr + '<div class="mb-2"><img src="' + e['data'][i]['info'][a]['images_str'] + '" style="width:60px;" />' + e['data'][i]['info'][a]['title'] + ' Цена:' + e['data'][i]['info'][a]['price'] + ' <a href="/shop/?product=' + e['data'][i]['info'][a]['id'] + '" target="_blank">>></a></div>';
                    }
                }

                var pay_status = e['data'][i]['pay_status'];
                var border_class = '';
                if (e['data'][i]['pay_status'] === 'succeeded') {
                    pay_status = 'выполнено';
                    border_class = 'table-success';
                }
                if (e['data'][i]['pay_status'] === 'canceled') {
                    pay_status = 'отмененная';
                    border_class = 'table-danger';
                }
                if (e['data'][i]['pay_status'] === 'pending') {
                    pay_status = 'Незавершенная';
                    border_class = 'table-danger';
                }


                var processed = '<a href="javascript:void(0)" objid="' + e['data'][i]['id'] + '" class="btn btn-danger btn-pill btn_set_processed btn-sm text-nowrap">не просмотрено</a>';
                if (e['data'][i]['processed'] == '1') {
                    processed = '<a href="javascript:void(0)" objid="' + e['data'][i]['id'] + '" class="btn btn-success btn-pill btn_set_processed btn-sm text-nowrap">обработано</a>';
                }

                $(".pay_data tbody").append('<tr class="' + border_class + '" objid="' + e['data'][i]['id'] + '" title="' + user_descr + '"> \
                                    <td class="text-center"><a href="javascript:void(0)" class="btn btn-link btn_pay_info_modal" objid="' + e['data'][i]['id'] + '">' + e['data'][i]['id'] + '</a></td> \
                                    <td>' + user_title + '</td> \
                                    <td class="text-center">' + e['data'][i]['pay_type_title'] + '</td> \
                                    <td class="text-center font-weight-bold">' + e['data'][i]['pay_sum'] + '</td> \
                                    <td class="text-center">' + e['data'][i]['pay_date'] + '</td> \
                                    <td class="text-center">' + pay_status + '</td> \
                                    <td class="text-center">' + pay_descr + '</td> \
                                    <td class="text-center">' + processed + '</td> \
                                    </tr>');
            }
        }
        if (pay_list_col_true === 1 && pay_list_col == e['data'].length) {
            $(".get_next_page").hide();
        } else {
            $(".get_next_page").show();
            pay_list_col = e['data'].length;
        }
        init_btn_set_processed();
        pay_list_col_true = 1;

        init_pay_info();
    });
}

/**
 * отметить что просмотрено
 * @returns {undefined}
 */
function init_btn_set_processed() {
    $(".btn_set_processed").unbind("click").click(function () {
        pay_list_col_true = 0;
        var objid = $(this).attr("objid");
        sendPostLigth('/jpost.php?extension=pay', {"set_processed": objid}, function (e) {
            init_pay_data_list();
            init_not_processed_col();
        });
    });
}

/**
 * Кнопка отобразить следующие данные
 * @returns {undefined} 
 */
function init_get_next_page() {
    $(".get_next_page").unbind("click").click(function () {
        pay_num = pay_num + 1;
        init_pay_data_list();
    });
}

function init_search_pay_user() {
    $(".search_pay_user").change(function () {
        pay_list_col_true = 0;
        search_pay_user_str = $(this).val();
        pay_num = 1;
        init_pay_data_list();
    });
}

function init_pay_info() {
    $(".btn_pay_info_modal").click(function () {
        $('#form_pay_info_modal').modal('toggle');
        var objid = $(this).attr('objid');
        $(".pay_info_data").html("");
        sendPostLigth('/jpost.php?extension=pay', {"get_pay_info": objid}, function (e) {
            var pay_status = '';
            var border_class = '';
            if (e['data']['pay_status'] === 'succeeded') {
                pay_status = 'выполнено';
                border_class = 'table-success';
            }
            if (e['data']['pay_status'] === 'canceled') {
                pay_status = 'отмененная';
                border_class = 'table-danger';
            }
            if (e['data']['pay_status'] === 'pending') {
                pay_status = 'Незавершенная';
                border_class = 'table-danger';
            }
            $(".pay_info_data").append("<tr><td>Идентификатор</td><td>" + objid + "</td></tr>");
            $(".pay_info_data").append("<tr><td>Дата</td><td>" + e['data']['pay_date'] + "</td></tr>");
            $(".pay_info_data").append("<tr><td>Описание</td><td>" + e['data']['pay_descr'] + "</td></tr>");
            $(".pay_info_data").append("<tr><td>Статус платежа</td><td class=\"border_class\">" + pay_status + "</td></tr>");
            $(".pay_info_data").append("<tr><td>Сумма</td><td>" + e['data']['pay_sum'] + " руб</td></tr>");
            $(".pay_info_data").append("<tr><td>Тип</td><td>" + e['data']['pay_type_title'] + "</td></tr>");
            $(".pay_info_data").append("<tr><td>Пользователь</td><td>" + e['data_user']['first_name'] + " " + e['data_user']['last_name'] + "<br/>\n\
                " + e['data_user']['email'] + "<br/>\n\
                " + e['data_user']['phone'] + "<br/>\n\
                <a href=\"/admin/admin_users/?edit=" + e['data_user']['id'] + "&search_str=" + e['data_user']['email'] + "\" target=\"_blank\">Ред. данные пользователя</a></td></tr>");
            $(".pay_info_data_products").html("");
            for (var i = 0; i < e['data_products'].length; i++) {
                $(".pay_info_data_products").append("<tr><td><img src=\"" + e['data_products'][i]['images_str'] + "\" class=\"w-100\"/></td><td><div class=\"mb-3\"><a href=\"/shop/?product=" + e['data_products'][i]['id'] + "\" target=\"_blank\">Просмотреть</a></div>\n\
<div class=\"mb-3\"><a href=\"/admin/products/?product_edit=" + e['data_products'][i]['id'] + "\" target=\"_blank\">Редактировать</a></div></td></tr>")
            }
        });
    });
}