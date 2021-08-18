var pay_num = 1;
var pay_list_col = 0;
var pay_list_col_true = 1;
var search_pay_user_str = '';
var search_pay_info_str = '';
var pay_search_type = '';
var pay_search_status = '';
var excel_from = '';
var excel_to = '';
$(document).ready(function () {
    $(".excel-from, .excel-to").change(function () {
        excel_from = $(".excel-from").val();
        excel_to = $(".excel-to").val();
        init_pay_data_list();
    });
    init_pay_data_list();
    init_get_next_page();
    init_search_pay_user();
    init_pay_select_type();
    init_pay_select_status();
});

/**
 * Список платежей
 * @returns {undefined}
 */
function init_pay_data_list() {
    excel_from = $(".excel-from").val();
    excel_to = $(".excel-to").val();
    $(".get_next_page").html(ajax_spinner);
    // pay_datas_page
    sendPostLigth('/jpost.php?extension=pay', {
        "pay_data_page": pay_num,
        "pay_search_type": pay_search_type,
        "pay_search_status": pay_search_status,
        "excel_from": excel_from,
        "excel_to": excel_to,
        "search_pay_user_str": search_pay_user_str,
        "search_pay_info_str": search_pay_info_str
    }, function (e) {
        $(".pay_data tbody").html("");
        $(".get_next_page").html("Дальше...");
        var pay_summ_all = 0;
        if (e['data'].length > 0) {
            pay_list_col = 0;
            for (var i = 0; i < e['data'].length; i++) {
                var user_title = '';
                var user_descr = '';
                var pay_descr = '';
                pay_summ_all = pay_summ_all + Number(e['data'][i]['pay_sum']);
                //console.log(typeof e['data'][i]['email']);
                if (e['data'][i]['email'].length > 0) {
                    user_title = e['data'][i]['email'];

                    if (e['data'][i]['phone'].length > 0) {
                        user_title = e['data'][i]['email'] + '<br/>' + e['data'][i]['phone'];
                    }
                    user_descr = e['data'][i]['first_name'] + ' ' + e['data'][i]['last_name'];

                    if (e['data'][i]['pay_descr'].length > 0) {
                        pay_descr = e['data'][i]['pay_descr'];
                    }
                    if (!!e['data'][i]['info'] && e['data'][i]['info'].length > 0) {
                        pay_descr = '';
                        for (var a = 0; a < e['data'][i]['info'].length; a++) {
                            if (pay_descr.length > 0) {
                                pay_descr += '<hr/>';
                            }
                            pay_descr = pay_descr + '<div class="mb-2">' + e['data'][i]['info'][a]['title'] + '<br/>\n<img src="' + e['data'][i]['info'][a]['images_str'] + '" style="width:50px;" /> Цена:' + e['data'][i]['info'][a]['price'] + 'р. <a href="/shop/?product=' + e['data'][i]['info'][a]['id'] + '" target="_blank">>></a></div>';
                        }
                    }

                    var business_check = '<div class="business_check_text_' + e['data'][i]['id'] + '">Чек сформирован</div>';
                    if (e['data'][i]['pay_sum'] > 0 && e['data'][i]['business_check'].length == 0) {
                        business_check = '<div class="business_check_text_' + e['data'][i]['id'] + '">Нет чека</div> <div><input type="button" class="btn btn-sm btn-primary btn_send_business_check" value="Сформировать чек" pay_id="' + e['data'][i]['id'] + '" /></div>';
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
                    var credit_type = '';
                    if (e['data'][i]['pay_credit'] > 0) {
                        credit_type = '( Кредитный )';
                    }

                    $(".pay_data tbody").append('<tr class="' + border_class + '" objid="' + e['data'][i]['id'] + '" title="' + user_descr + '"> \
                                    <td class="text-center align-middle"><a href="javascript:void(0)" class="btn btn-link btn_pay_info_modal" objid="' + e['data'][i]['id'] + '">' + e['data'][i]['id'] + '</a></td> \
                                    <td class="align-middle">' + user_title + '</td> \
                                    <td class="text-center align-middle">' + e['data'][i]['pay_type_title'] + ' ' + credit_type + '</td> \
                                    <td class="text-center align-middle">' + e['data'][i]['pay_date'] + '</td> \
                                    <td class="text-center align-middle">' + pay_status + '<br/>' + business_check + '</td> \
                                    <td class="text-center align-middle">' + pay_descr + '</td>\
                                    </tr>');
                }
            }
            $(".pay_summ_all").html(pay_summ_all + 'р.');
            if (pay_list_col_true === 1 && pay_list_col == e['data'].length) {
                $(".get_next_page").hide();
            } else {
                $(".get_next_page").show();
                pay_list_col = e['data'].length;
            }
            init_btn_set_processed();
            pay_list_col_true = 1;

            init_pay_info();
            init_send_business_check();
        }
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

// Получить типы операций
function init_pay_select_type() {
    sendPostLigth('/jpost.php?extension=pay', {"pay_select_type": 1}, function (e) {
        $(".pay_select_type").html("<option value=\"\">Тип</option>");
        if (e['data'].length > 0) {
            for (var i = 0; i < e['data'].length; i++) {
                var pay_type = e['data'][i]['pay_type'];
                var pay_type_title = e['data'][i]['pay_type_title'];
                if (pay_type_title.length == 0) {
                    pay_type_title = pay_type;
                }
                $(".pay_select_type").append('<option value="' + pay_type + '">' + pay_type_title + '</option>');
            }
        }
        $(".pay_select_type").change(function () {
            pay_search_type = $(this).val();
            init_pay_data_list();
        });
    });
}

// Получить Статусы операций
function init_pay_select_status() {
    sendPostLigth('/jpost.php?extension=pay', {"pay_select_status": 1}, function (e) {
        $(".pay_select_status").html("<option value=\"\">Статус</option>");
        if (e['data'].length > 0) {
            for (var i = 0; i < e['data'].length; i++) {
                var pay_status = e['data'][i]['pay_status'];
                if (pay_status === 'succeeded') {
                    pay_status_text = 'выполнено';
                }
                if (pay_status === 'canceled') {
                    pay_status_text = 'отмененная';
                }
                if (pay_status === 'pending') {
                    pay_status_text = 'Незавершенная';
                }
                $(".pay_select_status").append('<option value="' + pay_status + '">' + pay_status_text + '</option>');
            }
        }
        $(".pay_select_status").change(function () {
            pay_search_status = $(this).val();
            init_pay_data_list();
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
//    $(".search_pay_user,.search_pay_info").change(function () {
//        pay_list_col_true = 0;
//        search_pay_user_str = $(".search_pay_user").val();
//        search_pay_info_str = $(".search_pay_info").val();
//        pay_num = 1;
//        init_pay_data_list();
//    });
    $(".search_pay_user,.search_pay_info").delayKeyup(function () {
        pay_list_col_true = 0;
        search_pay_user_str = $(".search_pay_user").val();
        search_pay_info_str = $(".search_pay_info").val();
        pay_num = 1;
        init_pay_data_list();
    }, 700);
}

function init_pay_info() {
    $(".btn_pay_info_modal").unbind('click').click(function () {
        console.log('init_pay_info');
        $('#form_pay_info_modal').modal('toggle');
        var objid = $(this).attr('objid');
        if (objid > 0) {
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

                var btn_pay_check = '';
                var credit_type = '';
                var pay_credit = 0;
                var pay_key_id = '';
                var pay_tinkoff_link = '';
                if (e['data']['pay_credit'] > 0) {
                    credit_type = '( Кредитный )';
                    pay_key_id = '<br/>Тинькоф: ' + e['data']['pay_tinkoff_id'];
                    pay_tinkoff_link = e['data']['pay_tinkoff_link'];
                    pay_credit = e['data']['pay_credit'];
                }

                // Проверить платеж на CloudPayments
                if (e['data']['pay_type'] == 'cp') {
                    if (e['data']['pay_status'] !== 'succeeded') {
                        btn_pay_check = '<input type="button" value="Проверить платеж" class="btn btn-sm btn-primary btn_pay_check" elm_id="' + objid + '" pay_type="' + e['data']['pay_type'] + '" />';
                    }
                }
                // Проверить платеж на yandex
                if (e['data']['pay_type'] == 'ya') {
                    pay_key_id = e['data']['pay_key'];
                    if (e['data']['pay_status'] !== 'succeeded') {
                        btn_pay_check = '<input type="button" value="Проверить платеж" class="btn btn-sm btn-primary btn_pay_check" elm_id="' + e['data']['pay_key'] + '" pay_type="' + e['data']['pay_type'] + '" />';
                    }
                }

                // Проверить платеж на tinkoff
                if (e['data']['pay_type'] == 'tk' && e['data']['confirmationUrl'].length > 0) {
                    if (e['data']['pay_status'] !== 'succeeded') {
                        btn_pay_check = '<a href="' + e['data']['confirmationUrl'] + '" class="btn btn-sm btn-primary" target="_blank">Проверить платеж</a>';
                    }
                }


                var pay_status_html = '<select name="pay_status" class="form-control pay_status init_elm_edit" elm_id="' + objid + '" elm_table="zay_pay" elm_row="pay_status" func="init_pay_data_list()">\n\
                                            <option value="' + e['data']['pay_status'] + '" selected="selected">' + pay_status + '</option>\n\
                                            <option value="succeeded">выполнено</option>\n\
                                            <option value="canceled">отмененная</option>\n\
                                            <option value="pending">Незавершенная</option>\n\
                                       </select>';


                $(".pay_info_data").append("<tr><td>Идентификатор</td><td>" + objid + " <b style=\"font-size: 0.8rem;\">" + pay_key_id + "</b></td></tr>");
                $(".pay_info_data").append("<tr><td>Дата</td><td>" + e['data']['pay_date'] + "</td></tr>");
                $(".pay_info_data").append("<tr><td class=\"align-middle\">Описание</td><td>" + e['data']['pay_descr'] + "</td></tr>");
                $(".pay_info_data").append("<tr><td class=\"align-middle\">Статус платежа</td><td class=\"border_class\">" + pay_status_html + "</td></tr>");
                $(".pay_info_data").append("<tr><td>Сумма</td><td>" + e['data']['pay_sum'] + " руб</td></tr>");
                $(".pay_info_data").append("<tr><td>Тип</td><td>" + e['data']['pay_type_title'] + " " + credit_type + " " + btn_pay_check + "</td></tr>");
                if (pay_credit > 0) {
                    $(".pay_info_data").append('<tr><td>Ссылка на проверку оплаты</td><td><a href="' + e['data']['confirmationUrl'] + '" target="_blank">' + e['data']['confirmationUrl'] + '</a></td></tr>');
                }
                $(".pay_info_data").append("<tr><td class=\"align-middle\">Пользователь</td><td>" + e['data_user']['first_name'] + " " + e['data_user']['last_name'] + "<br/>\n\
                " + e['data_user']['email'] + "<br/>\n\
                " + e['data_user']['phone'] + "<br/>\n\
                <a href=\"/admin/admin_users/?edit=" + e['data_user']['id'] + "&search_str=" + e['data_user']['email'] + "\" target=\"_blank\">Ред. данные пользователя</a></td></tr>");
                $(".pay_info_data").append("<tr><td class=\"align-middle\">Лог</td><td>" + e['data']['pay_log'] + "</td></tr>");
                $(".pay_info_data_products").html("");
                for (var i = 0; i < e['data_products'].length; i++) {
                    $(".pay_info_data_products").append("<tr><td><img src=\"" + e['data_products'][i]['images_str'] + "\" class=\"w-100\"/></td><td><div class=\"mb-3\"><a href=\"/shop/?product=" + e['data_products'][i]['id'] + "\" target=\"_blank\" title=\"Просмотреть\"><i class=\"far fa-file-alt\"></i></a></div>\n\
                <div class=\"mb-3\"><a href=\"/admin/catalog/?product_edit=" + e['data_products'][i]['id'] + "\" target=\"_blank\" title=\"Редактировать\"><i class=\"fas fa-file-signature\"></i></a></div></td></tr>")
                }
                init_btn_pay_check();
            });
        }
    });
}

/**
 * Проверка платежа 
 * @returns {undefined}
 */
function init_btn_pay_check() {
    $(".btn_pay_check").unbind('click').click(function () {
        var o = this;
        var pay_type = $(this).attr("pay_type");
        var elm_id = $(this).attr("elm_id");
        if (pay_type === 'cp') {
            // Для CloudPayments
            sendPostLigth('/system/cloudpayments-php-client-master/my.php', {"id": elm_id}, function (e) {
                if (e['success'] == 1) {
                    $(o).closest(".pay_info_data").find('option[value="succeeded"]').prop('selected', true).trigger('change');
                } else {
                    toastr.success(e['success_text']);
                }
            });
        }
        if (pay_type === 'ya') {
            // Для Yandex
            sendPostLigth('/extension/pay/cron.php?pay_type=ya&pay_key=' + elm_id, {}, function (e) {
                if (e['success'] == 1) {
                    $(o).closest(".pay_info_data").find('option[value="succeeded"]').prop('selected', true).trigger('change');
                } else {
                    toastr.success(e['success_text']);
                }
            });
        }
    });
}

function init_send_business_check() {
    $(".btn_send_business_check").unbind('click').click(function () {
        var o = this;
        var pay_id = $(this).attr("pay_id");
        sendPostLigth('/jpost.php?extension=cart', {"send_business_check": 1, "pay_id": pay_id}, function (e) {
            if (e['success'] == 1) {
                $(".business_check_text_" + pay_id).html("Чек сформирован");
                $(o).hide(200);
            } else {
                $(".business_check_text_" + pay_id).html("Нет чека");
            }
        });
    });
}