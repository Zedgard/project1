var errors = [];
var consult_masters = [];
var consultation = new Object();


$(function () {
    //$('.consult_user_phone').mask('+7 (999) 999-9999');
    $(".select_timer").html("Выберите специалиста");
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
            console.log("selectedDate: " + selectedDate);
            //$(".datepicker_data").datepicker("option", "maxDate", selectedDate);
            $(".datepicker_data").val(selectedDate);
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
            $(".btn_select_timer").removeClass('active');
            $(this).addClass('active');
            $(".select_timer").css("border", "");

            $(".timepicker_data").val($(this).html());
        });
    });

    $(".select_time_period").change(function () {
        var total_price = $(this).val();
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
            var fio = $(".fast_consultation_fio").val();
            var email = $(".fast_consultation_email").val();
            var phone = $(".fast_consultation_name_phone").val();
            var topic = $(".fast_consultation_topic").val();
            sendPostLigth('/jpost.php?extension=sign_up_consultation', {"send_fast_consultation": 1,
                'fio': fio, 'email': email, 'phone': phone, 'topic': topic, }, function (e) {

            });
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
        move(".consult_first_name");
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
        move(".consult_your_master");
        $(".consult_your_master").css("border", "3px solid #FF0000");
    }

    if (datepicker_data == '') {
        errors.push('datepicker_data');
        move(".datepicker_data");
        $(".datepicker").css("border", "3px solid #FF0000");
    }
    if (timepicker_data == '') {
        errors.push('timepicker_data');
        move(".select_timer");
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
        move(".step2");
    }



    $(".first_name").html(consultation.first_name);
    $(".user_phone").html(consultation.user_phone_noformat);
    $(".user_email").html(consultation.user_email);
    $(".your_master").html(consultation.your_master_text);
    $(".datepicker_data").html(consultation.datepicker_data);
    $(".timepicker_data").html(consultation.timepicker_data);

}


/**
 * Список людей которые проводят консультации
 * @returns {undefined}
 */
function init_consultation_master() {
    $(".consult_your_master").html("");
    consult_masters = [];
    sendPostLigth('/jpost.php?extension=sign_up_consultation', {"get_consultation_master": 1}, function (e) {
        $(".consult_your_master").append('<option value="0">Выберите специалиста</option>');
        for (var i = 0; i < e['data'].length; i++) {
            consult_masters.push(e['data'][i]);
            $(".consult_your_master").append('<option value="' + e['data'][i]['id'] + '" consult_masters_i="' + i + '">' + e['data'][i]['master_name'] + '</option>');
        }
    });
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
        "price": consultation.total_price
    }, function (e) {

    });
}
var master_consultation_periods = [];
function init_select_time_period(master_id) {
    sendPostLigth('/jpost.php?extension=sign_up_consultation', {
        "get_master_consultation_periods": 1,
        "master_id": master_id,
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
            $(".select_time_period").append('<option value="' + e['data'][i]['period_price'] + '">' + period_hour + e['data'][i]['periods_minute'] + ' минут</option>');
        }
    });
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
