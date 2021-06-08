var errors = [];
var consult_masters = [];
var consultation = new Object();
var consult_main_body = 0;
var master_consultants = [];

$(function () {
    //$('.consult_user_phone').mask('+7 (999) 999-9999');
    $(".select_timer").html("Выберите специалиста");
    //consult_main_body = $(".consult_main_body").height();
    //$(".consult_main_body").height(consult_main_body);
    // Следующий шаг
    $(".btn_next_step").click(function () { 

        var step_next = Number($(this).attr("step"));
        var step_last = step_next - 1;
        errors = [];
        if (step_next == '2') {

            step2();
        }
//        for (var i = 0; i < errors.length; i++) {
//            console.log("errors: " + errors[i]);
//        }
        if (errors.length == 0) {
            $(".step" + step_next).show(400);
            $(".step" + step_last).hide(400);
        }


    });

    // Предыдущий шаг
    $(".btn_last_step").click(function () {
        var last_step = Number($(this).attr("step"));
        var step_next = last_step + 1;
        $(".step" + last_step).show(400);
        $(".step" + step_next).hide(400);
    });

    // Завершить
    $(".btn_step_end").click(function () {
        if (!$(this).hasClass("disabled") && consultation.total_price > 0) {
            send_consultation_form();
            $('#consultation_send').modal('show');
        } else {
            $(".select_time_period").css("border", "3px solid #FF0000");
        }
    });

    var dateToday = new Date();
    var minDate = new Date();
    // Русифицируем
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: 'Пред',
        nextText: 'След',
        currentText: 'Сегодня',
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
            'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
        dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
        dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        weekHeader: 'Нед',
        dateFormat: 'dd/mm/yy',
        maxDate: "+1M +10D",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    /*
     $('#ps_second_input_from').datepicker({
     changeMonth: true,
     changeYear: true,
     maxDate: dateToday,
     onSelect: function (selectedDate) {
     $("#ps_second_input_to").datepicker("option", "minDate", selectedDate);
     },
     });
     */

    /*
     * Выбор числа
     */
    $('.datepicker').datepicker({
        changeMonth: false,
        changeYear: false,
        //maxDate: dateToday,
        minDate: minDate,
        numberOfMonths: 1, // колличество отображаемых месяцев
        showButtonPanel: false,
        onSelect: function (selectedDate) {
            var consult_your_master = $('.consult_your_master').val();
            if (consult_your_master == '0') {
                //errors.push('consult_your_master');
                move(".consult_user_phone");
                $(".consult_your_master").css("border", "3px solid #FF0000");
            }
            $(".datepicker_data").val(selectedDate);
            //console.log(master_consultants);
            find_master_consultants(selectedDate);
            //init_calendar_user_data(selectedDate);
            $(".datepicker").css("border", "");
        }
    });

    init_consultation_master();

    /**
     * Выбор консультанта 
     */
    $(".consult_your_master").change(function () {
        var master_id = $(this).val();
        var consult_masters_i = $('.step1 .consult_your_master option[value="' + master_id + '"]').attr("consult_masters_i");

        init_select_time_period(master_id);
        init_get_master_consultants(master_id);

        if (master_id > 0) {
            $(".select_timer").html("");
            var list_times = consult_masters[consult_masters_i]['list_times'].split(',');
            for (var i = 0; i < list_times.length; i++) {
                $(".select_timer").append('<span class="mb-3 ml-3 btn btn-sm btn-outline-info float-left btn_select_timer" val="' + list_times[i] + '">' + list_times[i] + '</span>');
            }
        } else {
            $(".select_timer").html("Выберите специалиста");
        }

        $(".btn_select_timer").click(function () {
            console.log(!$(this).attr("disabled"));
            if (!$(this).attr("disabled")) {

                $(".btn_select_timer").removeClass('active');
                $(this).addClass('active');
                $(".select_timer").css("border", "");

                $(".timepicker_data").val($(this).html());
            }
        });
    });

    $(".select_time_period").change(function () {
        var total_price = $(this).val();
        var period_id = $(".select_time_period option[value=" + total_price + "]").attr("period_id");
        consultation.period_id = period_id;
        if (total_price > 0) {
            $(".select_time_period").css("border", "");
            $(".total_price").html(total_price);
            consultation.total_price = total_price;
            //consultation.total_price = total_price;
            $(".btn_step_end").removeClass('disabled');
        } else {
            $(".btn_step_end").addClass('disabled');
        }
    });

    $(".btn_fast_consultation").unbind('click').click(function () {
        $("#form_fast_consultation_modal").modal('show');
        $(".btn_send_fast_consultation").unbind('click').click(function () {
            $(".fast_consultation_result").removeClass("alert").removeClass("alert-success");
            var e = [];
            var fio = $(".fast_consultation_fio").val();
            var email = $(".fast_consultation_email").val();
            var phone = $(".fast_consultation_name_phone").val();
            var topic = $(".fast_consultation_topic").val();
            if (fio.length == 0) {
                $(".fast_consultation_fio").css("border", "1px solid #FF0000");
                e.push(1);
            }
            if (email.length == 0) {
                $(".fast_consultation_email").css("border", "1px solid #FF0000");
                e.push(1);
            }
            if (phone.length == 0) {
                $(".fast_consultation_name_phone").css("border", "1px solid #FF0000");
                e.push(1);
            }
            if (topic.length == 0) {
                $(".fast_consultation_topic").css("border", "1px solid #FF0000");
                e.push(1);
            }
            if (e.length == 0) {
                sendPostLigth('/jpost.php?extension=sign_up_consultation', {"send_fast_consultation": 1,
                    'fio': fio, 'email': email, 'phone': phone, 'topic': topic, }, function (e) {
                    if (e['success'] == '1') {
                        $(".fast_consultation_result").addClass("alert").addClass("alert-success");
                        $(".fast_consultation_result").html("Сообщение успешно отправлено");
                        //alert("Сообщение успешно отправлено");
                    } else {
                        $(".fast_consultation_result").addClass("alert").addClass("alert-danger");
                        //alert("Ошибка отправки сообщения");
                        $(".fast_consultation_result").html("Ошибка! " + e['success_text']);
                    }
                });
            } else {
                $(".form_save_fast_consultation").find("input").keydown(function () {
                    $(this).css("border", "");
                });
                setTimeout(function () {
                    alert("Заполните все поля!");
                }, 200);

            }
        });
    });

});



function step2() {
    var consult_first_name = $(".consult_first_name").val();
    var consult_user_phone_noformat = $(".consult_user_phone").val();
    var consult_user_phone = replasePhone($(".consult_user_phone").val());
    var consult_user_email = $(".consult_user_email").val();
    var consult_your_master = $('.consult_your_master').val();
    var consult_your_master_text = $('.consult_your_master option[value="' + consult_your_master + '"]').html();
    var consult_masters_i = $('.consult_your_master option[value="' + consult_your_master + '"]').attr("consult_masters_i");
    var datepicker_data = $(".datepicker_data").val();
    var timepicker_data = $(".timepicker_data").val();

    if (consult_first_name.length < 4) {
        errors.push('consult_first_name');
        move(".consult_user_phone");
        $(".consult_first_name").css("border", "3px solid #FF0000");
    }
    if (consult_user_phone.length < 10) {
        errors.push('consult_user_phone');
        move(".consult_user_phone");
        $(".consult_user_phone").css("border", "3px solid #FF0000");
    }
    if (validateEmail(consult_user_email) == false) {
        errors.push('consult_user_email');
        $(".consult_user_email").css("border", "3px solid #FF0000");
    }
    if (consult_your_master == '0') {
        errors.push('consult_your_master');
        move(".consult_user_phone");
        $(".consult_your_master").css("border", "3px solid #FF0000");
    }

    if (datepicker_data == '') {
        errors.push('datepicker_data');
        move(".consult_user_phone");
        $(".datepicker").css("border", "3px solid #FF0000");
    }
    if (timepicker_data == '') {
        errors.push('timepicker_data');
        move(".consult_user_phone");
        $(".select_timer").css("border", "3px solid #FF0000");
    }

    $(".consult_first_name").keydown(function () {
        $(this).css("border", "");
    });
    $(".consult_user_phone").keydown(function () {
        $(this).css("border", "");
    });
    $(".consult_user_email").keydown(function () {
        $(this).css("border", "");
    });
    $(".consult_your_master").change(function () {
        $(this).css("border", "");
    });



    if (errors.length == 0) {
        consultation.first_name = consult_first_name;
        consultation.user_phone = consult_user_phone;
        consultation.user_phone_noformat = consult_user_phone_noformat;
        consultation.user_email = consult_user_email;
        consultation.your_master = consult_your_master;
        consultation.your_master_text = consult_your_master_text;
        consultation.consult_masters_i = consult_masters_i;
        consultation.datepicker_data = datepicker_data;
        consultation.timepicker_data = timepicker_data;
        //move(".step2");
    }



    $(".first_name").html(consultation.first_name);
    $(".user_phone").html(consultation.user_phone_noformat);
    $(".user_email").html(consultation.user_email);
    $(".your_master").html(consultation.your_master_text);
    $(".datepicker_data").html(consultation.datepicker_data);
    $(".timepicker_data").html(consultation.timepicker_data);

    sendPostLigth('/jpost.php?extension=sign_up_consultation', {"consultation_s_save": 1,
        'first_name': consultation.first_name,
        'user_phone': consultation.user_phone,
        'user_email': consultation.user_email,
        'your_master': consultation.your_master,
        'your_master_text': consultation.your_master_text,
        'consult_masters_i': consultation.consult_masters_i,
        'datepicker_data': consultation.datepicker_data,
        'timepicker_data': consultation.timepicker_data
    }, function (e) {

    });

}


/**
 * Список людей которые проводят консультации
 * @returns {undefined}
 */
function init_consultation_master() {
    var interval = setInterval(function () {
        if ($(".consult_your_master").find("option").length > 0) {
            clearInterval(interval);
        }
        sendPostLigth('/jpost.php?extension=sign_up_consultation', {"get_consultation_master": 1}, function (e) {
            consult_masters = [];
            $(".consult_your_master").html("");
            $(".consult_your_master").append('<option value="0">Выберите специалиста</option>');
            if (e['data'].length > 0) {
                for (var i = 0; i < e['data'].length; i++) {
                    consult_masters.push(e['data'][i]);
                    var select = '';
//            if(Number(consult_your_master_select) == e['data'][i]['id']) {
//                select = ' selected="selected" ';
//            }
                    $(".consult_your_master").append('<option value="' + e['data'][i]['id'] + '" consult_masters_i="' + i + '" ' + select + ' >' + e['data'][i]['master_name'] + '</option>');
                }
            }
        });
    }, 1000);
}

function send_consultation_form() {
    sendPostLigth('/jpost.php?extension=cart', {
        "send_consultation_form": 1,
        "first_name": consultation.first_name,
        "user_phone": consultation.user_phone,
        "user_email": consultation.user_email,
        "your_master": consultation.your_master,
        "your_master_text": consultation.your_master_text,
        "datepicker_data": consultation.datepicker_data,
        "timepicker_data": consultation.timepicker_data,
        "price": consultation.total_price,
        "period_id": consultation.period_id,
    }, function (e) {

    });
}
var master_consultation_periods = [];
function init_select_time_period(master_id) {
    sendPostLigth('/jpost.php?extension=sign_up_consultation', {
        "get_master_consultation_periods": 1,
        "master_id": master_id
    }, function (e) {
        $(".select_time_period").html("");
        master_consultation_periods = [];
        $(".select_time_period").append('<option value="0">Выберите продолжительность...</option>');
        for (var i = 0; i < e['data'].length; i++) { // periods_minute
            master_consultation_periods.push(e['data'][i]);
            var period_hour = '';
            if (e['data'][i]['period_hour'] > 1) {
                period_hour = e['data'][i]['period_hour'] + ' часа ';
            } else {
                period_hour = e['data'][i]['period_hour'] + ' час ';
            }
            if (e['data'][i]['period_hour'] == 0) {
                period_hour = '';
            }
            $(".select_time_period").append('<option value="' + e['data'][i]['period_price'] + '" period_id="' + e['data'][i]['id'] + '">' + period_hour + e['data'][i]['periods_minute'] + ' минут</option>');
        }
    });
}

function init_get_master_consultants(master_id) {
    sendPostLigth('/jpost.php?extension=sign_up_consultation', {
        "get_master_consultants": 1,
        "master_id": master_id,
    }, function (e) {
        //console.log(e['data']);
        master_consultants = e['data'];
    });
}

function find_master_consultants(selectedDate) {
    console.log("selectedDate: " + selectedDate);
    $('.select_timer').find(".disabled").addClass("btn_select_timer");
    $('.btn_select_timer').removeClass("disabled");
    $('.btn_select_timer').removeAttr("disabled");
    $(".timepicker_data").val("");
    if (master_consultants.length > 0) {
        for (var i = 0; i < master_consultants.length; i++) {
            var consultation_date = dateDBFormat(master_consultants[i]['consultation_date']);
            var consultation_time = timeDBFormat(master_consultants[i]['consultation_time']);
            console.log("consultation_date: " + consultation_date +
                    " consultation_time: " + consultation_time);
            if (consultation_date == selectedDate) {
                $('.btn_select_timer[val="' + consultation_time + '"]').addClass("disabled").removeClass("btn_select_timer")
                        .attr("disabled", "disabled");// .removeClass("btn_select_timer")

            }
        }
    }
}


function replasePhone(phoneStr) {
    var regexp = /\D+/g;
    phoneStr = phoneStr.replace('+7', '');
    phoneStr = phoneStr.replace(regexp, '');
    return phoneStr;
}
function validateEmail(email) {
    var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern.test(String(email).toLowerCase());
}

function dateDBFormat(var_date) {
    var arr = var_date.split('-');
    return arr[2] + '/' + arr[1] + '/' + arr[0];
}
function timeDBFormat(var_time) {
    var arr = var_time.split(':');
    return arr[0] + ':' + arr[1];
}
