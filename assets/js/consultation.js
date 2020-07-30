var errors = [];
var consultation = new Object();

$(function () {
    $('.consult_user_phone').mask('+7 (999) 999-9999');
    $(".btn_next_step").click(function () {
        var step_next = Number($(this).attr("step"));
        var step_last = step_next - 1;
        errors = [];
        if (step_next == '2') {
            step2();
        }
        if (step_next == '3') {
            step3();
        }
        for (var i = 0; i < errors.length; i++) {
            console.log("errors: " + errors[i]);
        }
        if (errors.length == 0) {
            $(".step" + step_next).show(400);
            $(".step" + step_last).hide(400);
        }
    });

    $(".btn_last_step").click(function () {
        var last_step = Number($(this).attr("step"));
        var step_next = last_step + 1;
        $(".step" + last_step).show(400);
        $(".step" + step_next).hide(400);
    });

    $(".btn_step_end").click(function () {
        $('#consultation_send').modal('show');
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
        numberOfMonths: 3,
        showButtonPanel: false,
        onSelect: function (selectedDate) {
            //console.log("onSelect: " + selectedDate);
            //$(".datepicker_data").datepicker("option", "maxDate", selectedDate);
            $(".datepicker_data").val(selectedDate);
        }
    });

    /*
     * Время
     */
    $('.timepicker').timepicker({
        timeFormat: 'HH:mm',
        timeOnly: true,
        hourMin: 8,
        hourMax: 17,
        stepHour: 1,
        stepMinute: 30,
        showButtonPanel: false,
        controlType: 'select',
        timeOnlyTitle: 'Выберите время',
        timeText: 'Время',
        hourText: 'Часы',
        minuteText: 'Минуты',
        secondText: 'Секунды',
        currentText: 'Сейчас',
        closeText: 'Закрыть',
        onSelect: function (selectedTime) {
            //console.log("selectedTime: " + selectedTime);
            $(".timepicker_data").val(selectedTime);
        }
    });

});

function step2() {
    var consult_first_name = $(".step1 .consult_first_name").val();
    var consult_user_phone_noformat = $(".step1 .consult_user_phone").val();
    var consult_user_phone = replasePhone($(".step1 .consult_user_phone").val());
    var consult_user_email = $(".step1 .consult_user_email").val();
    var consult_your_master = $('.step1 .consult_your_master').val();
    var consult_your_master_text = $('.step1 .consult_your_master option[value="' + consult_your_master + '"]').html();

    if (consult_first_name.length < 4) {
        errors.push('consult_first_name');
        $(".step1 .consult_first_name").css("border", "3px solid #FF0000");
    }
    if (consult_user_phone.length < 10) {
        errors.push('consult_user_phone');
        $(".step1 .consult_user_phone").css("border", "3px solid #FF0000");
    }
    if (validateEmail(consult_user_email) == false) {
        errors.push('consult_user_email');
        $(".step1 .consult_user_email").css("border", "3px solid #FF0000");
    }
    if (consult_your_master == '0') {
        errors.push('consult_your_master');
        $(".step1 .consult_your_master").css("border", "3px solid #FF0000");
    }

    $(".step1 .consult_first_name").keydown(function () {
        $(this).css("border", "");
    });
    $(".step1 .consult_user_phone").keydown(function () {
        $(this).css("border", "");
    });
    $(".step1 .consult_user_email").keydown(function () {
        $(this).css("border", "");
    });
    $(".step1 .consult_your_master").change(function () {
        $(this).css("border", "");
    });
    if (errors.length == 0) {
        consultation.first_name = consult_first_name;
        consultation.user_phone = consult_user_phone;
        consultation.user_phone_noformat = consult_user_phone_noformat;
        consultation.user_email = consult_user_email;
        consultation.your_master = consult_your_master;
        consultation.your_master_text = consult_your_master_text;
    }

}
function step3() {
    var datepicker_data = $(".step2 .datepicker_data").val();
    var timepicker_data = replasePhone($(".step2 .timepicker_data").val());

    if (datepicker_data == '') {
        errors.push('datepicker_data');
        $(".step2 .datepicker .ui-datepicker-multi").css("border", "3px solid #FF0000");
    }

    if (timepicker_data == '') {
        errors.push('timepicker_data');
        $(".step2 .ui-timepicker-div").css("border", "3px solid #FF0000");
    }

    $(".step2 .datepicker .ui-datepicker-multi").hover(function () {
        $(this).css("border", "");
    });
    $(".step2 .ui-timepicker-div").hover(function () {
        $(this).css("border", "");
    });
    if (errors.length == 0) {
        consultation.datepicker_data = datepicker_data;
        consultation.timepicker_data = timepicker_data;
    }

    $(".step3 .first_name").html(consultation.first_name);
    $(".step3 .user_phone").html(consultation.user_phone_noformat);
    $(".step3 .user_email").html(consultation.user_email);
    $(".step3 .your_master").html(consultation.your_master_text);
    $(".step3 .datepicker_data").html(consultation.datepicker_data);
    $(".step3 .timepicker_data").html(consultation.timepicker_data);
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