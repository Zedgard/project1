var consultation_date = '';
var consultation_period = '';
var consultation_elm_id = 0;

$(".calendar_day_active").unbind("click").click(function () {
    $(".calendar_day_active").removeClass("active");
    $(this).addClass("active");
    consultation_date = $(this).attr("date");
    $(".new_tr").remove();
    var o = this;
    $(o).closest("tr").after('<tr class="new_tr"><td colspan="7" class="consultant_periods"><div class="spinner-border" role="status"><span class="sr-only">Загрузка...</span></div></td></tr>');
    sendPostLigth('/jpost.php?extension=sign_up_consultation', {"get_master_consultant_period": 1, "master_id": 1}, function (e) {
        if (e['success'] == '1') {
            $(".consultant_periods").html('<table class="table table-striped"><tbody></tbody></table>');
            for (var i = 0; i < e['data'].length; i++) {
                $(".consultant_periods").find("tbody").append('<tr><td><i class="far fa-clock"></i> ' + e['data'][i]['period_time'] + '</td><td><a href="javascript:void(0)" class="btn button button_lg btngreen textcenter btn_consultation_pay" period_text="' + e['data'][i]['period_time'] + '" elm_id="' + e['data'][i]['id'] + '">Оплатить</a></td></tr>');
            }
            setTimeout(init_btn_consultation_pay(), 1000);
        } else {

            $(".fast_consultation_result").html("Ошибка! " + e['success_text']);
        }
    });


});

function init_btn_consultation_pay() {
    if (!!$(".btn_consultation_pay")) {
        $(".btn_consultation_pay").unbind('click').click(function () {
            consultation_period = $(this).attr("period_text");
            consultation_elm_id = Number($(this).attr("elm_id"));
            $("#modal_consultation_pay").find(".consultation_period").html(consultation_period);
            $("#modal_consultation_pay").find(".consultation_date").html(consultation_date);
            $("#modal_consultation_pay").modal("toggle");
        });
    }
    if (!!$(".btn_consultation_pay_show")) {
        $(".btn_consultation_pay_show").unbind('click').click(function () {
            var user_phone = $(".block_consultation_user_info").find('[name="consultation_user_phone"]').val();
            var user_email = $(".block_consultation_user_info").find('[name="consultation_user_email"]').val();
            var user_pass = $(".block_consultation_user_info").find('[name="consultation_user_pass"]').val();
            var agreement = 0;
            if (!$("#modal_consultation_pay").find('[name="consultation_pay_agreement"]').prop('checked')) {
                agreement = 1;
            }

            console.log(consultation_elm_id);
            var error = 0;
            if (user_phone.length < 2) {
                alert('Поле "Телефон" не заполнен!');
                error = 1;
            }
            if (user_email.length < 2) {
                alert('Поле "Почта" не заполнен!');
                error = 1;
            }
            if (agreement == 1) {
                alert('Необходимо согласиться с условиями для предоставления консультации!');
                error = 1;
            }
            if (error == 0) {
                $(".btn_consultation_pay_block").show(500);
                sendPostLigth('/jpost.php?extension=cart', {
                    "send_consultation_pay": 1,
                    "consultation_user_phone": user_phone,
                    "consultation_user_email": user_email,
                    "consultation_user_pass": user_pass,
                }, function (e) {
                    if (e['success'] == 1) {

                    } else {
                        alert('Ошибка!');
                    }

                });
            }
        });
    }
}
