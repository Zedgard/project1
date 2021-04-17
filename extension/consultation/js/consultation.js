var consultation_date = '';
var consultation_period = '';
var consultation_price = '';
var consultation_elm_id = 0;

var consultation_date_click = '';

$(".calendar_day_active").unbind("click").click(function () {
    var o = this;
    $(".calendar_day_active").removeClass("active");
    $(this).addClass("active");
    consultation_date = $(this).attr("date");

    if (consultation_date_click === consultation_date) {
        $(".new_tr").toggle(200);
    } else {
        consultation_date_click = consultation_date;
        $(".new_tr").remove();
        $(o).closest("tr").after('<tr class="new_tr"><td colspan="7" class="consultant_periods"><div class="spinner-border" role="status"><span class="sr-only">Загрузка...</span></div></td></tr>');
        sendPostLigth('/jpost.php?extension=sign_up_consultation', {"get_master_consultant_period": 1, "master_id": 1, 'day': consultation_date}, function (e) {
            if (e['success'] == '1') {
                $(".consultant_periods").html('<table class="table table-striped"><tbody></tbody></table>');
                for (var i = 0; i < e['data'].length; i++) {
                    var active = 0;
                    var elm_class = 'btn button btn-secondary button_lg textcenter';
                    var alert = 'onClick="alert(\'Время занято!\')"';
                    console.log(111);
                    if (e['data'][i]['period_active'] == "1" && e['data'][i]['is_pay'] == "0" && e['data'][i]['rejection_day'] == "0" && e['data'][i]['rejection_period'] == "0") {
                        active = 1;
                        alert = '';
                        elm_class = 'btn button button_lg btngreen textcenter btn_consultation_pay';
                    }
                    $(".consultant_periods").find("tbody").append('<tr><td><i class="far fa-clock"></i> ' + e['data'][i]['period_time'] + '</td>\n\
                        <td><a href="javascript:void(0)" class="' + elm_class + '" price="' + e['data'][i]['period_price'] + '" period_text="' + e['data'][i]['period_time'] + '" elm_id="' + e['data'][i]['id'] + '" ' + alert + '>Оплатить</a></td>\n\
                        </tr>');
                }
                setTimeout(init_btn_consultation_pay(), 1000);
            } else {

                $(".fast_consultation_result").html("Ошибка! " + e['success_text']);
            }
        });
    }



});

function init_btn_consultation_pay() {
    if (!!$(".btn_consultation_pay")) {
        $(".btn_consultation_pay").unbind('click').click(function () {
            $(".btn_consultation_pay_show").show();
            $(".btn_consultation_pay_text").hide();
            $(".btn_consultation_pay_block").hide();
            consultation_period = $(this).attr("period_text");
            consultation_elm_id = Number($(this).attr("elm_id"));
            consultation_price = $(this).attr("price");
            $("#modal_consultation_pay").find(".consultation_period").html(consultation_period);
            $("#modal_consultation_pay").find(".consultation_date").html(consultation_date);
            $("#modal_consultation_pay").find(".consultation_price").html(consultation_price);
            $("#modal_consultation_pay").modal("toggle");
        });
    }
    if (!!$(".btn_consultation_pay_show")) {
        $(".btn_consultation_pay_show").unbind('click').click(function () {
            var user_fio = $(".block_consultation_user_info").find('[name="consultation_user_fio"]').val();
            var user_phone = $(".block_consultation_user_info").find('[name="consultation_user_phone"]').val();
            var user_email = $(".block_consultation_user_info").find('[name="consultation_user_email"]').val();
            var user_pass = $(".block_consultation_user_info").find('[name="consultation_user_pass"]').val();
            var agreement = 0;
            if (!$("#modal_consultation_pay").find('[name="consultation_pay_agreement"]').prop('checked')) {
                agreement = 1;
            }

            var errors = [];
            if (user_fio.length < 2) {
                console.log('user_fio: ' + user_fio + ' || ' + user_fio.length);
                errors.push('Поле "Имя" не заполнено!');
            }
            if (user_phone.length < 4) {
                errors.push('Поле "Телефон" не заполнен!');
            }
            if (user_email.length < 2) {
                errors.push('Поле "Почта" не заполнен!');
            }
            if (agreement == 1) {
                errors.push('Необходимо согласиться с условиями для предоставления консультации!');
            }
            if (errors.length === 0) {
                $(".btn_consultation_pay_text").show();
                $(".btn_consultation_pay_show").hide();

                sendPostLigth('/jpost.php?extension=auth', {
                    "check_and_register_user": 1,
                    "consultation_user_fio": user_fio,
                    "consultation_user_phone": user_phone,
                    "consultation_user_email": user_email,
                    "consultation_user_pass": user_pass
                }, function (e) {
                    if (e['success'] == '1') {
                        $(".btn_consultation_pay_block").show(500);
                        // Зафиксируем в корзину
                        sendPostLigth('/jpost.php?extension=cart', {
                            "add_other_consultation_cart": 1,
                            "consultation_user_fio": user_fio,
                            "product_period_id": consultation_elm_id,
                            "consultation_date": consultation_date,
                            "consultation_period": consultation_period
                        }, function (e) {});
                    } else {
                        var h = '';
                        if (e['errors'].length > 0) {
                            for (var i = 0; i < e['errors'].length; i++) {
                                h += e['errors'][i] + " \n";
                                console.log(e['errors'][i]);
                            }
                        }
                        $(".fast_auth_block").show(500);
                        //alert(h);
                    }

                });
            } else {
                /*
                 * Вывести сообщения
                 */
                var h = '';
                for (var i = 0; i < errors.length; i++) {
                    h += errors[i] + " \n";
                    console.log(errors[i]);
                }
                alert(h);
            }
        });
    }
}
